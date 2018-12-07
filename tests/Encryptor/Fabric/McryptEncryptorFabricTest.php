<?php

use Hobocta\Encrypt\Encryptor\EncryptorAvailableChecker;
use Hobocta\Encrypt\Encryptor\Fabric\McryptEncryptorFabric;
use PHPUnit\Framework\TestCase;

final class McryptEncryptorFabricTest extends TestCase
{
    public function testInstanceOf()
    {
        if (!EncryptorAvailableChecker::isMcryptAvailable()) {
            $this->assertEmpty('');
            return;
        }

        $fabric = new McryptEncryptorFabric('');
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\Fabric\AbstractEncryptorFabric', $fabric);
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\Fabric\EncryptorFabricInterface', $fabric);

        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\McryptEncryptor', $fabric->createEncryptor128());
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\McryptEncryptor', $fabric->createEncryptor192());
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\McryptEncryptor', $fabric->createEncryptor256());
    }
}
