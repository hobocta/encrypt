<?php

namespace Hobocta\Encrypt\Encryptor\Fabric;

use Hobocta\Encrypt\Encryptor\McryptEncryptor;

class McryptEncryptorFabric extends AbstractEncryptorFabric
{
    public function createEncryptorVariantA()
    {
        $cipher = MCRYPT_3DES;
        $mode = MCRYPT_MODE_CBC;

        /** @noinspection PhpDeprecationInspection */
        $key = substr($this->key, 0, mcrypt_get_key_size($cipher, $mode));

        return new McryptEncryptor(
            $key,
            array(
                'cipher' => $cipher, // see more ciphers: http://php.net/manual/ru/mcrypt.ciphers.php
                'mode' => $mode, // see more modes: http://php.net/manual/ru/mcrypt.constants.php
                'ivSource' => MCRYPT_RAND, // see more sources: http://php.net/manual/ru/mcrypt.constants.php
            )
        );
    }

    public function createEncryptorVariantB()
    {
        return new McryptEncryptor(
            $this->key,
            array(
                'cipher' => MCRYPT_BLOWFISH, // see more ciphers: http://php.net/manual/ru/mcrypt.ciphers.php
                'mode' => MCRYPT_MODE_CBC, // see more modes: http://php.net/manual/ru/mcrypt.constants.php
                'ivSource' => MCRYPT_RAND, // see more sources: http://php.net/manual/ru/mcrypt.constants.php
            )
        );
    }

    // recommended for mcrypt
    public function createEncryptorVariantC()
    {
        $cipher = MCRYPT_TWOFISH;
        $mode = MCRYPT_MODE_CBC;

        /** @noinspection PhpDeprecationInspection */
        $key = substr($this->key, 0, mcrypt_get_key_size($cipher, $mode));

        return new McryptEncryptor(
            $key,
            array(
                'cipher' => $cipher, // see more ciphers: http://php.net/manual/ru/mcrypt.ciphers.php
                'mode' => $mode, // see more modes: http://php.net/manual/ru/mcrypt.constants.php
                'ivSource' => MCRYPT_RAND, // see more sources: http://php.net/manual/ru/mcrypt.constants.php
            )
        );
    }
}
