<?php

namespace Hobocta\Encrypt\Encryptor\Fabric;

use Hobocta\Encrypt\Encryptor\EncryptorAvailableChecker;

class EncryptorFabric implements EncryptorFabricInterface
{
    private $fabric;

    /**
     * EncryptorFabric constructor.
     * @param $key
     * @throws \Exception
     */
    public function __construct($key)
    {
        if (EncryptorAvailableChecker::isOpenSSLAvailable()) {
            $this->fabric = new OpenSslEncryptorFabric($key);
        } elseif (EncryptorAvailableChecker::isMcryptAvailable()) {
            $this->fabric = new McryptEncryptorFabric($key);
        } else {
            throw new \Exception('Not found available encryptor');
        }
    }

    public function createEncryptorVariantA()
    {
        return $this->fabric->createEncryptorVariantA();
    }

    public function createEncryptorVariantB()
    {
        return $this->fabric->createEncryptorVariantB();
    }

    public function createEncryptorVariantC()
    {
        return $this->fabric->createEncryptorVariantC();
    }
}
