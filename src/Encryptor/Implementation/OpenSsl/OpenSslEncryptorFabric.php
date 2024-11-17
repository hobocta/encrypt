<?php

/** @noinspection PhpComposerExtensionStubsInspection */

namespace Hobocta\Encrypt\Encryptor\Implementation\OpenSsl;

use Hobocta\Encrypt\Encryptor\Fabric\AbstractEncryptorFabric;
use Hobocta\Encrypt\Encryptor\Fabric\EncryptorFabricInterface;
use Hobocta\Encrypt\Exception\EncryptException;

final class OpenSslEncryptorFabric extends AbstractEncryptorFabric implements EncryptorFabricInterface
{
    /**
     * @return OpenSslEncryptor
     * @throws EncryptException
     */
    public function createEncryptor128()
    {
        return new OpenSslEncryptor(
            $this->key,
            array(
                'method' => 'aes-128-cbc', // see more methods: openssl_get_cipher_methods()
                'options' => OPENSSL_RAW_DATA, // disable base64 encode in openssl_encrypt to get raw data
            )
        );
    }

    /**
     * @return OpenSslEncryptor
     * @throws EncryptException
     */
    public function createEncryptor192()
    {
        return new OpenSslEncryptor(
            $this->key,
            array(
                'method' => 'aes-192-cbc', // see more methods: openssl_get_cipher_methods()
                'options' => OPENSSL_RAW_DATA, // disable base64 encode in openssl_encrypt to get raw data
            )
        );
    }

    /**
     * @return OpenSslEncryptor
     * @throws EncryptException
     */
    public function createEncryptor256()
    {
        return new OpenSslEncryptor(
            $this->key,
            array(
                'method' => 'aes-256-cbc', // see more methods: openssl_get_cipher_methods()
                'options' => OPENSSL_RAW_DATA, // disable base64 encode in openssl_encrypt to get raw data
            )
        );
    }
}
