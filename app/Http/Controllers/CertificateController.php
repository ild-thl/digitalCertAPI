<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Web3\Web3;
use Web3\Contract;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;
use Web3p\EthereumTx\Transaction;
use Web3p\EthereumUtil\Util;
use Illuminate\Support\Facades\Log;

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
     * @param string $hash
     * @return Response
     */
    public function read($hash)
    {
        $result = $this->getCertificate($hash);

        if (!isset($result) || !is_array($result) || empty($result)) {
            return response("No certificate found for hash: $hash", 404);
        }

        if ($result['institution'] === '0x0000000000000000000000000000000000000000') {
            return response($result, 404);
        }

        return response()->json($result);
    }

    /**
     * Retrieve the certificate contract.
     *
     * @return Response
     */
    public function readContract() {
        $contract_schema = Controller::get_certificate_contract();

        if (!isset($contract_schema)) {
            return response("No contract_schema found", 404);
        }

        return response()->json($contract_schema);
    }

    /**
     * Retrieve the certificate for the given hash.
     *
     * @param  string  $hash
     * @return array
     */
    public function getCertificate($hash)
    {
        $cert = [];
        $web3 = new Web3(new HttpProvider(new HttpRequestManager(Controller::get_node(), 30)));
        $contract_schema = Controller::get_certificate_contract();
        $contract = new Contract($web3->provider, Controller::get_contract_abi($contract_schema));
        $contract->at(Controller::get_contract_address($contract_schema));

        $contract->call('getCertificate', $hash, function ($err, $result) use (&$cert) {
            if (isset($err)) {
                $cert = $err;
            }
            if ($result) {
                $cert = [
                    'institution' => $result[2],
                    'institutionProfile' => $result[3],
                    'startingDate' => $result[4][0]->value,
                    'endingDate' => $result[4][1]->value,
                    'onHold' => $result[5]->value,
                    'valid' => $result[6],
                ];
            }
        });

        return $cert;
    }

    /**
     * Write the given certificate $hash in the blockchain with a given privatekey.
     *
     * @param Request $request
     * @return Response
     */
    function create(Request $request)
    {
        if (!($request->has(['hash', 'pk', 'startdate', 'enddate']))) {
            return response()->json([
                'error' => 'Missing post parameters.',
                'request' => $request->all(),
            ], 406);
        }

        $hash = $request->input('hash');
        $pk = $request->input('pk');
        $startdate = $request->input('startdate');
        $enddate = $request->input('enddate');

        $contract_schema = Controller::get_certificate_contract();
        $account = Controller::get_address_from_pk($pk);
        $contractabi = Controller::get_contract_abi($contract_schema);
        $contractadress = Controller::get_contract_address($contract_schema);
        $chainid = config('chain_id', 10);
        $url = Controller::get_node();

        $web3 = new Web3(new HttpProvider(new HttpRequestManager($url, 30)));
        $eth = $web3->eth;

        $contract = new Contract($web3->provider, $contractabi);
        $contract->at($contractadress);

        $hashes["certhash"] = $hash;

        $nonce = 0;
        $r = $eth->getTransactionCount($account, 'latest', function ($err, $data)  use (&$nonce) {
            if ($err !== null) {
                return response()->json([
                    'error' => $err
                ], 500);
            }
            $nonce = $data->toString();
        });

        $functiondata = $contract->getData('storeCertificate', $hash, $startdate, $enddate);

        $transaction = new Transaction(array(
            'from' => $account,
            'nonce' => '0x' . dechex($nonce),
            'to' => $contractadress,
            'gas' => dechex(450),
            'data' => '0x' . $functiondata,
            'chainId' => $chainid
        ));
        $signedtransaction = $transaction->sign($pk);

        $eth->sendRawTransaction('0x' . $signedtransaction, function ($err, $tx) use (&$hashes) {
            if ($err !== null) {
                return response()->json([
                    'error' => $err
                ], 500);
            }
            $hashes["txhash"] = $tx;
        });

        // TODO warum geht das nicht (getTransactionReceipt)?
        // Prüfen ob Zertifikat auch in BC exisiert.
        $start = time();
        do {
            $now = time();
            $cert = $this->getCertificate($hashes["certhash"]);
            if (isset($cert['valid']) && $cert['valid'] == true) {
                return response()->json($hashes, 201);
            }
        } while ($now - $start < 30);

        return response()->json([
            'error' => 'Certificate creation timed out.'
        ], 500);
    }

    /**
     * Revocation of a certificate identified by a hash using the private key of a certifier.
     *
     * @param  Request  $request
     * @param  string  $hash
     * @return Response
     */
    function revoke(Request $request, $hash)
    {
        if (!$request->has('pk')) {
            return response()->json([
                'error' => 'Missing post parameter: pk',
                'request' => $request->all(),
                'hash' => $hash,
            ], 406);
        }

        $pk = $request->input('pk');

        $contractschema = Controller::get_certificate_contract();
        $url = Controller::get_node();
        $account = Controller::get_address_from_pk($pk);
        $contractabi = Controller::get_contract_abi($contractschema);
        $contractadress = Controller::get_contract_address($contractschema);
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
                ], 500);
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
        $signedtransaction = $transaction->sign($pk);

        // return response()->json([
        //     'node' => $url,
        //     'contract_address' => $contractadress,
        //     'account' => $account,
        //     'hash' => $hash,
        //     'pk' => $pk,
        //     'nonce' => $nonce,
        //     'signedtransaction' => $signedtransaction,
        // ]);

        $eth->sendRawTransaction('0x' . $signedtransaction, function ($err, $tx) {
            if ($err !== null) {
                return response()->json([
                    'error' => $err
                ], 500);
            }
        });


        $start = time();
        do {
            $now = time();
            $cert = $this->getCertificate($hash);
            if (!is_array($cert) || !array_key_exists('valid', $cert) || $cert['valid'] == false) {
                return response('', 204);
            }
        } while ($now - $start < 30);

        return response()->json([
            "err" => 'Couldn´t revoke certificate. Timed out.'
        ], 500);
    }
}
