<?php

namespace Hobocta\Encrypt\Encryptor;

class OpenSslEncryptor extends AbstractEncryptor implements EncryptorInterface
{
    public function encrypt($data)
    {
        $iv = $this->getIv();

        $encrypted = openssl_encrypt(
            $data,
            $this->options['method'],
            $this->key,
            $this->options['options'],
            $iv
        );

        return $iv . $encrypted;
    }

    public function decrypt($encrypted)
    {
        $ivSize = $this->getIvSize();

        $iv = substr($encrypted, 0, $ivSize);

        $data = substr($encrypted, $ivSize);

        $decrypted = openssl_decrypt(
            $data,
            $this->options['method'],
            $this->key,
            $this->options['options'],
            $iv
        );

        return $decrypted;
    }

    private function getIvSize()
    {
        return openssl_cipher_iv_length($this->options['method']);
    }

    private function getIv()
    {
        $ivSize = $this->getIvSize();

        $iv = openssl_random_pseudo_bytes($ivSize);

        if ((int)ini_get('mbstring.func_overload') !== 0) {
            $iv = substr(hash('sha1', $iv), 0, $ivSize);
        }

        return $iv;
    }
}
