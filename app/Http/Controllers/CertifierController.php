<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Web3\Web3;
use Web3\Contract;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;
use Web3p\EthereumTx\Transaction;
use Web3p\EthereumUtil\Util;

class CertifierController extends Controller
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
    * Get certifier for the given address.
    *
    * @param  string  $address
    * @return Response
    */
   public function read($address)
   {
       $isaccredited = $this->isAccredited($address);

       if (is_array($isaccredited) && array_key_exists('error', $isaccredited)) {
           return response()->json($isaccredited, 404);
       }
       return response()->json($isaccredited);
   }

   /**
    * Retrieve the certificate contract.
    *
    * @return Response
    */
   public function readContract() {
       $contract_schema = Controller::get_identity_contract();

       if (!isset($contract_schema)) {
           return response("No contract_schema found", 404);
       }

       return response()->json($contract_schema);
   }

    /**
     * Check if there is an accredited certifier for the given address.
     *
     * @param  string  $address
     * @return array
     */
    public function isAccredited($address)
    {
        $isaccredited = [];
        $contractschema = Controller::get_identity_contract();
        $contractabi = Controller::get_contract_abi($contractschema);
        $contractadress = Controller::get_contract_address($contractschema);
        $url = Controller::get_node();

        $web3 = new Web3(new HttpProvider(new HttpRequestManager($url, 30)));
        $contract = new Contract($web3->provider, $contractabi);
        $contract->at($contractadress);

        $contract->call('isAccreditedCertifier', $address, function ($err, $result) use (&$isaccredited) {
            if (isset($err)) {
                $isaccredited = ['error' => $err];
            }

            $isaccredited = ['is_accredited' => $result[0]];
        });

        return $isaccredited;
    }


    /**
     * Create a new certifier in the blockchain.
     *
     * @param  string  $address
     * @return Response
     */
    function getInstitution($address) {
        $institution = [];

        $contractschema = Controller::get_identity_contract();
        $contractabi = Controller::get_contract_abi($contractschema);
        $contractadress = Controller::get_contract_address($contractschema);
        $url = Controller::get_node();

        $web3 = new Web3(new HttpProvider(new HttpRequestManager($url, 30)));
        $contract = new Contract($web3->provider, $contractabi);
        $contract->at($contractadress);

        $contract->call('getInstitutionFromCertifier', $address, function ($err, $result) use (&$institution) {
            if (isset($err)) {
                $institution = ['error' => $err];
            }

            $institution = ['address' => $result[0]];
        });

        if (
            is_array($institution) &&
            (
                array_key_exists('error', $institution) ||
                $institution['address'] === '0x0000000000000000000000000000000000000000'
            )
        ) {
            return response()->json($institution, 404);
        }
        return response()->json($institution);
    }

    /**
     * Create a new certifier in the blockchain.
     *
     * @param Request $request
     * @return Response
     */
    function create(Request $request)
    {
        if (!($request->has(['address', 'pk']))) {
            return response()->json([
                'error' => 'Missing post parameters.',
                'request' => $request->all(),
            ], 406);
        }

        $pk = $request->input('pk');
        $address = $request->input('address');

        $contract_schema = Controller::get_identity_contract();
        $account = Controller::get_address_from_pk($pk);
        $contractabi = Controller::get_contract_abi($contract_schema);
        $contractadress = Controller::get_contract_address($contract_schema);
        $chainid = config('chain_id', 10);
        $url = Controller::get_node();

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

        $functiondata = $contract->getData('registerCertifier', $address);

        $transaction = new Transaction(array(
            'from' => $account,
            'nonce' => '0x' . dechex($nonce),
            'to' => $contractadress,
            'gas' => dechex(450),
            'data' => '0x' . $functiondata,
            'chainId' => $chainid
        ));

        $signedtransaction = $transaction->sign($pk);

        $eth->sendRawTransaction('0x' . $signedtransaction, function ($err, $tx) {
            if ($err !== null) {
                return response()->json([
                    'error' => $err
                ], 500);
            }
        });

        // Check if certifier exists on blockchain.
        $start = time();
        do {
            $now = time();
            $isaccredited = $this->isAccredited($address);
            if (isset($isaccredited) &&
                array_key_exists('is_accredited', $isaccredited) &&
                $isaccredited['is_accredited'] == true) {

                return response('', 204);
            }
        } while ($now - $start < 30);

        return response()->json([
            'error' => 'Certifier creation timed out.'
        ], 500);
    }

    /**
     * Remove a certifier identified by a blockchain address.
     *
     * @param string  $address
     * @return Response
     */
    function remove(Request $request, $address)
    {
        if (!$request->has('pk')) {
            return response()->json([
                'error' => 'Missing post parameter: pk',
                'request' => $request->all(),
                'address' => $address,
            ], 406);
        }

        $pk = $request->input('pk');

        $contract_schema = Controller::get_identity_contract();
        $account = Controller::get_address_from_pk($pk);
        $contractabi = Controller::get_contract_abi($contract_schema);
        $contractadress = Controller::get_contract_address($contract_schema);
        $chainid = config('chain_id', 10);
        $url = Controller::get_node();

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

        $functiondata = $contract->getData('removeCertifier', $address);

        return response()->json([
            'node' => $url,
            'contract_address' => $contractadress,
            'account' => $account,
            'address' => $address,
            'pk' => $pk,
            'nonce' => $nonce,
        ]);
        $transaction = new Transaction(array(
            'from' => $account,
            'nonce' => '0x' . dechex($nonce),
            'to' => $contractadress,
            'gas' => dechex(450),
            'data' => '0x' . $functiondata,
            'chainId' => $chainid
        ));
        $signedtransaction = $transaction->sign($pk);


        return response()->json([
            'node' => $url,
            'contract_address' => $contractadress,
            'account' => $account,
            'address' => $address,
            'pk' => $pk,
            'nonce' => $nonce,
            'signedtransaction' => $signedtransaction,
        ]);

        $eth->sendRawTransaction('0x' . $signedtransaction, function ($err, $tx) {
            if ($err !== null) {
                return response()->json([
                    'error' => $err
                ], 500);
            }
        });

        // Check if certifier exists on blockchain no more.
        $start = time();
        do {
            $now = time();
            $isaccredited = $this->isAccredited($address);
            if (isset($isaccredited) &&
                array_key_exists('is_accredited', $isaccredited) &&
                $isaccredited['is_accredited'] == false) {

                return response('', 204);
            }
        } while ($now - $start < 30);

        return response()->json([
            'error' => 'Time out during certifier deletion.'
        ], 500);
    }
}
