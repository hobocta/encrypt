<?php

namespace Hobocta\Encrypt\Encryptor\Implementation\Mcrypt;

use Hobocta\Encrypt\Encryptor\Fabric\AbstractEncryptorFabric;
use Hobocta\Encrypt\Encryptor\Fabric\EncryptorFabricInterface;
use Hobocta\Encrypt\Exception\EncryptException;

class McryptEncryptorFabric extends AbstractEncryptorFabric implements EncryptorFabricInterface
{
    /**
     * @return McryptEncryptor
     * @throws EncryptException
     */
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

    /**
     * @return McryptEncryptor
     * @throws EncryptException
     */
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

    /**
     * @return McryptEncryptor
     * @throws EncryptException
     */
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
