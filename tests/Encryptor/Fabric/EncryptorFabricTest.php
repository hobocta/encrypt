<?php

use Hobocta\Encrypt\Encryptor\Fabric\EncryptorFabric;
use PHPUnit\Framework\TestCase;

class EncryptorFabricTest extends TestCase
{
    public function testInstanceOf()
    {
        $fabric = new EncryptorFabric('');

        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\Fabric\EncryptorFabricInterface', $fabric);

        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\EncryptorInterface', $fabric->createEncryptorVariantA());
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\EncryptorInterface', $fabric->createEncryptorVariantB());
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\EncryptorInterface', $fabric->createEncryptorVariantC());
    }
}
