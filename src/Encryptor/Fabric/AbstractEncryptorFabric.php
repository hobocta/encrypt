<?php

namespace Hobocta\Encrypt\Encryptor\Fabric;

use Hobocta\Encrypt\Exception\EncryptException;

abstract class AbstractEncryptorFabric implements EncryptorFabricInterface
{
    protected $key;

    /**
     * AbstractEncryptorFabric constructor.
     * @param $key
     * @throws EncryptException
     */
    public function __construct($key)
    {
        $this->key = $key;

        $this->validateKey();
    }

    /**
     * @throws EncryptException
     */
    private function validateKey()
    {
        if (!is_string($this->key)) {
            throw new EncryptException('Incorrect key, key must be a string');
        }

        if (empty($this->key)) {
            throw new EncryptException('Key is empty');
        }
    }
}
