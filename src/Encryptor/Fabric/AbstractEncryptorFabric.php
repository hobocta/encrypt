<?php

namespace Hobocta\Encrypt\Encryptor\Fabric;

abstract class AbstractEncryptorFabric implements EncryptorFabricInterface
{
    protected $key;

    public function __construct($key)
    {
        $this->key = $key;
    }
}
