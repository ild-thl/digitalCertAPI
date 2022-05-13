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
     * Retrieve the certifier for the given address.
     *
     * @param  string  $address
     * @return Response
     */
    public function read($address)
    {
        $result = $this->get_certifier($address);

        if (array_key_exists('error', $result)) {
            return response()->json($result, 404);
        }

        return response()->json($result);
    }

    /**
     * Retrieve the certifier for the given address.
     *
     * @param  string  $address
     * @return array
     */
    public function get_certifier($address)
    {
        $web3 = new Web3(new HttpProvider(new HttpRequestManager(Controller::get_blockchain_node(), 30)));

        $contract_schema = Controller::get_identity_contract();
        $contract = new Contract($web3->provider, Controller::get_contract_abi($contract_schema));
        $contract->at(Controller::get_contract_address($contract_schema));
        $contract->call('isAccreditedCertifier', $address, function ($err, $result) {
            if ($err !== null) {
                return [
                    'error' => $err
                ];
            }

            return $result;
        });
    }

    /**
     * Create a new certifier in the blockchain.
     *
     * @param Request $request
     * @return Response
     */
    function create(Request $request)
    {
        if (!($request->json()->has('address') &&
            $request->json()->has('pk'))) {
            return response()->json([
                'error' => 'Missing post parameters.'
            ], 406);
        }

        $contract = Controller::get_identity_contract();
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

        $functiondata = $contract->getData('registerCertifier', $request->json()->get('address'));

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

        return response('', 204);
    }

    /**
     * Remove a certifier identified by a blockchain address.
     *
     * @param  string  $address
     * @return Response
     */
    function remove(Request $request, $address)
    {
        if (!$request->json()->has('pk')) {
            return response()->json([
                'error' => 'Missing post parameter: pk'
            ], 406);
        }

        $contract = Controller::get_identity_contract();
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

        $functiondata = $contract->getData('removeCertifier', $address);

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

        return response('', 204);
    }
}
