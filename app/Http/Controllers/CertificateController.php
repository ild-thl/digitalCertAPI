<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Web3\Contract;
use Web3p\EthereumTx\Transaction;

class CertificateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Retrieve the certificate for the given hash.
     *
     * @param  string  $hash
     * @return Response
     */
    public function read($hash)
    {
        $result = $this->get_certificate($hash);

        if (array_key_exists('error', $result)) {
            return response()->json($result, 404);
        }

        return response()->json($result);
    }

    /**
     * Retrieve the certificate for the given hash.
     *
     * @param  string  $hash
     * @return array
     */
    public function get_certificate($hash)
    {
        $web3 = new Web3(new HttpProvider(new HttpRequestManager(Controller::get_blockchain_node(), 30)));

        $contract_schema = Controller::get_certificate_contract();
        $contract = new Contract($web3->provider, Controller::get_contract_abi($contract_schema));
        $contract->at(Controller::get_contract_address($contract_schema));
        $contract->call('getCertificate', $hash, function ($err, $result) {
            if ($err !== null) {
                return [
                    'error' => $err
                ];
            }
            if ($result) {
                return [
                    'institution' => $result[2],
                    'institutionProfile' => $result[3],
                    'startingDate' => $result[4][0]->value,
                    'endingDate' => $result[4][1]->value,
                    'onHold' => $result[5]->value,
                    'valid' => $result[6],
                ];
            }
        });
    }

    /**
     * Write the given certificate $hash in the blockchain with a given privatekey.
     *
     * @param Request $request
     * @return Response
     */
    function create(Request $request)
    {
        if (!($request->json()->has('hash') &&
            $request->json()->has('pk') &&
            $request->json()->has('startdate') &&
            $request->json()->has('enddate'))) {
            return response()->json([
                'error' => $request
            ], 406);
        }

        $contract = Controller::get_certificate_contract();
        $url = Controller::get_blockchain_node();
        $account = Controller::get_address_from_pk($request->json()->get('pk'));
        $contractabi = Controller::get_contract_abi($contract);
        $contractadress = Controller::get_contract_address($contract);
        $chainid = config('chain_id', 10);

        $web3 = new Web3(new HttpProvider(new HttpRequestManager($url, 30)));
        $eth = $web3->eth;

        $contract = new Contract($web3->provider, $contractabi);

        $contract->at($contractadress);

        $hashes["certhash"] = $request->json()->get('hash');

        $nonce = 0;
        $r = $eth->getTransactionCount($account, 'latest', function ($err, $data)  use (&$nonce) {
            if ($err !== null) {
                return response()->json([
                    'error' => $err
                ], 404);
            }
            $nonce = $data->toString();
        });

        $functiondata = $contract->getData('storeCertificate', $request->json()->get('hash'), $request->json()->get('startdate'), $request->json()->get('enddate'));

        $transaction = new Transaction(array(
            'from' => $account,
            'nonce' => '0x' . dechex($nonce),
            'to' => $contractadress,
            'gas' => dechex(450),
            'data' => '0x' . $functiondata,
            'chainId' => $chainid
        ));
        $signedtransaction = $transaction->sign($request->json()->get('pk'));

        $eth->sendRawTransaction('0x' . $signedtransaction, function ($err, $tx) use (&$hashes) {
            if ($err !== null) {
                return response()->json([
                    'error' => $err
                ], 404);
            }
            $hashes["txhash"] = $tx;
        });

        // TODO warum geht das nicht (getTransactionReceipt)?
        // Prüfen ob Zertifikat auch in BC exisiert.
        $start = time();
        while (true) {
            $now = time();
            $cert = $this->get_certificate($hashes["certhash"]);
            if (isset($cert['valid']) and $cert['valid'] == true) {
                break;
            }
            if ($now - $start > 30) {
                return response()->json([
                    'error' => 'Unexpected error creating certificate.'
                ], 500);
            }
        }
        return response()->json($hashes, 201);
    }

    /**
     * Revocation of a certificate identified by a hash using the private key of a certifier.
     *
     * @return Response
     * @param  string  $hash
     */
    function revoke(Request $request, $hash)
    {
        if (!$request->json()->has('pk')) {
            return response()->json([
                'error' => 'Missing post parameter: pk'
            ], 406);
        }

        $contract = Controller::get_certificate_contract();
        $url = Controller::get_blockchain_node();
        $account = Controller::get_address_from_pk($request->json()->get('pk'));
        $contractabi = Controller::get_contract_abi($contract);
        $contractadress = Controller::get_contract_address($contract);
        $chainid = config('chain_id', 10);

        $web3 = new Web3(new HttpProvider(new HttpRequestManager($url, 30)));
        $eth = $web3->eth;

        $contract = new Contract($web3->provider, $contractabi);
        $contract->at($contractadress);

        $nonce = 0;
        $r = $eth->getTransactionCount($account, 'latest', function ($err, $data)  use (&$nonce) {
            if ($err !== null) {
                return response()->json([
                    'error' => $err
                ], 404);
            }
            $nonce = $data->toString();
        });

        $functiondata = $contract->getData('revokeCertificate', $hash);

        $transaction = new Transaction(array(
            'from' => $account,
            'nonce' => '0x' . dechex($nonce),
            'to' => $contractadress,
            'gas' => dechex(450),
            'data' => '0x' . $functiondata,
            'chainId' => $chainid
        ));
        $signedtransaction = $transaction->sign($request->json()->get('pk'));

        $eth->sendRawTransaction('0x' . $signedtransaction, function ($err, $tx) {
            if ($err !== null) {
                return response()->json([
                    'error' => $err
                ], 404);
            }
        });

        $start = time();
        while (1) {
            $now = time();
            $cert = $this->get_certificate($hash);
            if (isset($cert['valid']) and $cert['valid'] != true) {
                return response('', 204);
            }
            if ($now - $start > 30) {
                break;
            }
        }
        return response()->json([
            "err" => 'Couldn´t revoke certificate.'
        ], 500);
    }
}
