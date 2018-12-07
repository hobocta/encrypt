<?php

use Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptAvailableChecker;
use Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptEncryptorFabric;
use PHPUnit\Framework\TestCase;

final class McryptEncryptorFabricTest extends TestCase
{
    public function testInstanceOf()
    {
        if (!McryptAvailableChecker::isAvailable()) {
            $this->assertEmpty('');
            return;
        }

        $encryptorFabric = new McryptEncryptorFabric('');
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\Fabric\AbstractEncryptorFabric', $encryptorFabric);
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\Fabric\EncryptorFabricInterface', $encryptorFabric);

        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptEncryptor', $encryptorFabric->createEncryptor128());
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptEncryptor', $encryptorFabric->createEncryptor192());
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptEncryptor', $encryptorFabric->createEncryptor256());
    }
}
