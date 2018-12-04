<?php

namespace Hobocta\Encrypt\Encryptor;

class McryptEncryptor extends AbstractEncryptor implements EncryptorInterface
{
    public function encrypt($data)
    {
        $iv = $this->getIv();

        /** @noinspection PhpDeprecationInspection */
        $encrypted = mcrypt_encrypt(
            $this->options['cipher'],
            $this->key,
            $data,
            $this->options['mode'],
            $iv
        );

        return $iv . $encrypted;
    }

    public function decrypt($data)
    {
        $ivSize = $this->getIvSize();

        $iv = substr($data, 0, $ivSize);

        $data = substr($data, $ivSize);

        /** @noinspection PhpDeprecationInspection */
        $decrypted = mcrypt_decrypt(
            $this->options['cipher'],
            $this->key,
            $data,
            $this->options['mode'],
            $iv
        );

        $decrypted = rtrim($decrypted, "\0\4");

        return $decrypted;
    }

    private function getIvSize()
    {
        /** @noinspection PhpDeprecationInspection */
        return mcrypt_get_iv_size($this->options['cipher'], $this->options['mode']);
    }

    private function getIv()
    {
        $ivSize = $this->getIvSize();

        /** @noinspection PhpDeprecationInspection */
        return mcrypt_create_iv($ivSize, $this->options['ivSource']);
    }
}
