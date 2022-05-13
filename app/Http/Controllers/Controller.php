<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Web3\Web3;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;
use Web3p\EthereumUtil\Util;

class Controller extends BaseController
{


    /**
     * Get the the smart contract for certificates.
     *
     * @return string
     */
    protected static function get_certificate_contract()
    {
        if (app()->environment('local, staging, demo')) {
            return json_decode(file_get_contents(storage_path() . "/contracts/CertificateManagement.json"));
        }

        return json_decode(file_get_contents(storage_path() . "/contracts/CertificateManagement_prod.json"));
    }

    /**
     * Get the smart contract for identities.
     *
     * @param string $contractname
     * @return string
     */
    protected static function get_identity_contract()
    {
        if (app()->environment('local, staging, demo')) {
            return json_decode(file_get_contents(storage_path() . "/contracts/IdentityManagement.json"));
        }

        return json_decode(file_get_contents(storage_path() . "/contracts/IdentityManagement_prod.json"));
    }

    /**
     * Get the logic of a smart contract as json string.
     *
     * @return string
     */
    protected static function get_contract_abi($contract)
    {
        return json_encode($contract->contract_abi);
    }

    /**
     * Get the address of a smart contract as json string.
     *
     * @param mixed $contract
     * @return string
     */
    protected static function get_contract_address($contract)
    {
        return json_encode($contract->contract_address);
    }

    /**
     * Get the url of an currently active blockchain node.
     *
     * @return string
     */
    protected static function get_blockchain_node()
    {
        $nodes = config('app.blockchain_nodes');
        foreach ($nodes as $node) {
            if (SELF::check_node($node)) {
                return $node;
            }
        }

        return null;
    }

    /**
     * Checks if the blockchain node identified by the given $url is active.
     *
     * @param string $url
     * @return boolean True if the node is active, else false;
     */
    protected static function check_node($url)
    {
        $web3 = new Web3(new HttpProvider(new HttpRequestManager($url, 30)));
        $success = false;
        $web3->eth->blockNumber(function ($err, $blocknumber) use (&$success) {
            if ($err === null) {
                $block = $blocknumber->value;
                if ($block > 0) {
                    $success = true;
                }
            }
        });

        return $success;
    }

    /**
     * Get the blockchain address belonging to a given privatekey $pk.
     *
     * @param string $pk
     * @return string
     */
    function get_address_from_pk($pk)
    {
        $util = new Util();
        $publickey = $util->privateKeyToPublicKey($pk);
        $address = $util->publicKeyToAddress($publickey);
        return $address;
    }
}
