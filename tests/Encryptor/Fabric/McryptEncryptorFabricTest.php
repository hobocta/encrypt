<?php

use Hobocta\Encrypt\Encryptor\Fabric\AbstractEncryptorFabric;
use Hobocta\Encrypt\Encryptor\Fabric\EncryptorFabricInterface;
use Hobocta\Encrypt\Encryptor\Fabric\McryptEncryptorFabric;
use Hobocta\Encrypt\Encryptor\McryptEncryptor;
use PHPUnit\Framework\TestCase;

final class McryptEncryptorFabricTest extends TestCase
{
    public function testInstanceOf()
    {
        if (version_compare(PHP_VERSION, '7.1.0') >= 0) {
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
