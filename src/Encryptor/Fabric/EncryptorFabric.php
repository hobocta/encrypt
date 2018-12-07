<?php

namespace Hobocta\Encrypt\Encryptor\Fabric;

use Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptAvailableChecker;
use Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptEncryptor;
use Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptEncryptorFabric;
use Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslAvailableChecker;
use Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslEncryptorFabric;
use Hobocta\Encrypt\Exception\EncryptException;

final class EncryptorFabric extends AbstractEncryptorFabric implements EncryptorFabricInterface
{
    private $fabric;

    /**
     * EncryptorFabric constructor.
     * @param $key
     * @throws EncryptException
     */
    public function __construct($key)
    {
        parent::__construct($key);

        if (OpenSslAvailableChecker::isAvailable()) {
            $this->fabric = new OpenSslEncryptorFabric($this->key);
        } elseif (McryptAvailableChecker::isAvailable()) {
            $this->fabric = new McryptEncryptorFabric($this->key);
        } else {
            throw new EncryptException('Not found available encryptor');
        }
    }

    /**
     * @return McryptEncryptor
     * @throws EncryptException
     */
    public function createEncryptor128()
    {
        return $this->fabric->createEncryptor128();
    }

    /**
     * @return McryptEncryptor
     * @throws EncryptException
     */
    public function createEncryptor192()
    {
        return $this->fabric->createEncryptor192();
    }

    /**
     * @return McryptEncryptor
     * @throws EncryptException
     */
    public function createEncryptor256()
    {
        return $this->fabric->createEncryptor256();
    }
}
