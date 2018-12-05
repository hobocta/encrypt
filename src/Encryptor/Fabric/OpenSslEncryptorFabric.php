<?php

namespace Hobocta\Encrypt\Encryptor\Fabric;

use Hobocta\Encrypt\Encryptor\OpenSslEncryptor;

class OpenSslEncryptorFabric extends AbstractEncryptorFabric
{
    public function createEncryptorVariantA()
    {
        return new OpenSslEncryptor(
            $this->key,
            array(
                'method' => 'AES-128-CBC', // see more methods: openssl_get_cipher_methods()
                'options' => OPENSSL_RAW_DATA, // disable base64 encode in openssl_encrypt to get raw data
            )
        );
    }

    public function createEncryptorVariantB()
    {
        return new OpenSslEncryptor(
            $this->key,
            array(
                'method' => 'AES-192-CBC', // see more methods: openssl_get_cipher_methods()
                'options' => OPENSSL_RAW_DATA, // disable base64 encode in openssl_encrypt to get raw data
            )
        );
    }

    public function createEncryptorVariantC()
    {
        return new OpenSslEncryptor(
            $this->key,
            array(
                'method' => 'AES-256-CBC', // see more methods: openssl_get_cipher_methods()
                'options' => OPENSSL_RAW_DATA, // disable base64 encode in openssl_encrypt to get raw data
            )
        );
    }
}
