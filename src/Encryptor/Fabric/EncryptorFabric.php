<?php

namespace Hobocta\Encrypt\Encryptor\Fabric;

use Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptAvailableChecker;
use Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptEncryptorFabric;
use Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslAvailableChecker;
use Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslEncryptorFabric;

class EncryptorFabric extends AbstractEncryptorFabric implements EncryptorFabricInterface
{
    private $fabric;

    /**
     * EncryptorFabric constructor.
     * @param $key
     * @throws \Exception
     */
    public function __construct($key)
    {
        parent::__construct($key);

        if (OpenSslAvailableChecker::isAvailable()) {
            $this->fabric = new OpenSslEncryptorFabric($this->key);
        } elseif (McryptAvailableChecker::isAvailable()) {
            $this->fabric = new McryptEncryptorFabric($this->key);
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
