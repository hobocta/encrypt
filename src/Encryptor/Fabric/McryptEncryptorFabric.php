<?php

namespace Hobocta\Encrypt\Encryptor\Fabric;

use Hobocta\Encrypt\Encryptor\McryptEncryptor;

class McryptEncryptorFabric extends AbstractEncryptorFabric
{
    public function createEncryptor128()
    {
        $cipher = MCRYPT_RIJNDAEL_128;
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

    public function createEncryptor192()
    {
        $cipher = MCRYPT_RIJNDAEL_192;
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

    public function createEncryptor256()
    {
        $cipher = MCRYPT_RIJNDAEL_256;
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
