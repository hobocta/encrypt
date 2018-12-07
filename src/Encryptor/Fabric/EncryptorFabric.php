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

    public function createEncryptor128()
    {
        return $this->fabric->createEncryptor128();
    }

    public function createEncryptor192()
    {
        return $this->fabric->createEncryptor192();
    }

    public function createEncryptor256()
    {
        return $this->fabric->createEncryptor256();
    }
}
