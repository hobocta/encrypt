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

        $iv = $this->getBinarySubstring($encrypted, 0, $ivSize);

        $data = $this->getBinarySubstring($encrypted, $ivSize, $this->getBinaryLength($encrypted) - $ivSize);

        $decrypted = openssl_decrypt(
            $data,
            $this->options['method'],
            $this->key,
            $this->options['options'],
            $iv
        );

        return $decrypted;
    }

    protected function getIvSize()
    {
        return openssl_cipher_iv_length($this->options['method']);
    }

    protected function getIv()
    {
        $ivSize = $this->getIvSize();

        $iv = openssl_random_pseudo_bytes($ivSize);

        return $iv;
    }

    protected function getBinaryEncoding()
    {
        return '8bit';
    }
}
