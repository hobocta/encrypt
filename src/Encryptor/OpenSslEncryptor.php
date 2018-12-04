<?php

namespace Hobocta\Encrypt\Encryptor;

class OpenSslEncryptor extends AbstractEncryptor implements EncryptorInterface
{
    public function encrypt($data)
    {
        $ivSize = openssl_cipher_iv_length($this->options['method']);

        $iv = openssl_random_pseudo_bytes($ivSize);

        $encrypted = openssl_encrypt(
            $data,
            $this->options['method'],
            $this->key,
            $this->options['options'],
            $iv
        );

        return $iv . $encrypted;
    }

    public function decrypt($data)
    {
        $ivSize = openssl_cipher_iv_length($this->options['method']);

        $iv = substr($data, 0, $ivSize);

        $data = openssl_decrypt(
            substr($data, $ivSize),
            $this->options['method'],
            $this->key,
            $this->options['options'],
            $iv
        );

        return $data;
    }
}
