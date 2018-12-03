<?php

namespace Hobocta\Encrypt\Encryptor;

class McryptEncryptor extends AbstractEncryptor implements EncryptorInterface
{
    public function encrypt($data)
    {
        $iv = $this->getIv();

        /** @noinspection PhpDeprecationInspection */
        $encrypted = mcrypt_encrypt(
            MCRYPT_BLOWFISH,
            $this->key,
            $data,
            MCRYPT_MODE_ECB,
            $iv
        );

        return $encrypted;
    }

    public function decrypt($string)
    {
        $iv = $this->getIv();

        /** @noinspection PhpDeprecationInspection */
        $decrypted = mcrypt_decrypt(
            MCRYPT_BLOWFISH,
            $this->key,
            $string,
            MCRYPT_MODE_ECB,
            $iv
        );

        $decrypted = rtrim($decrypted, "\0\4");

        return $decrypted;
    }

    private function getIv()
    {
        /** @noinspection PhpDeprecationInspection */
        $ivSize = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);

        /** @noinspection PhpDeprecationInspection */
        return mcrypt_create_iv($ivSize, MCRYPT_RAND);
    }
}
