<?php

namespace Hobocta\Encrypt\Encryptor;

class OpenSslEncryptor extends AbstractEncryptor implements EncryptorInterface
{
    private $method = 'AES-256-CBC';

    public function encrypt($data)
    {
        $ivSize = openssl_cipher_iv_length($this->method);

        $iv = openssl_random_pseudo_bytes($ivSize);

        $encrypted = openssl_encrypt($data, $this->method, $this->key, OPENSSL_RAW_DATA, $iv);

        return $iv . $encrypted;
    }

    public function decrypt($data)
    {
        $ivSize = openssl_cipher_iv_length($this->method);

        $iv = substr($data, 0, $ivSize);

        $data = openssl_decrypt(substr($data, $ivSize), $this->method, $this->key, OPENSSL_RAW_DATA, $iv);

        return $data;
    }
}
