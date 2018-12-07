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

        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\McryptEncryptor', $fabric->createEncryptorVariantA());
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\McryptEncryptor', $fabric->createEncryptorVariantB());
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\McryptEncryptor', $fabric->createEncryptorVariantC());
    }
}
