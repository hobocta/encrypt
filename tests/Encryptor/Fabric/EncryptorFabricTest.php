<?php

use Hobocta\Encrypt\Encryptor\Fabric\EncryptorFabric;
use PHPUnit\Framework\TestCase;

class EncryptorFabricTest extends TestCase
{
    public function testInstanceOf()
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        $encryptorFabric = new EncryptorFabric('');

        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\Fabric\EncryptorFabricInterface', $encryptorFabric);
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\Fabric\AbstractEncryptorFabric', $encryptorFabric);

        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\EncryptorInterface', $encryptorFabric->createEncryptor128());
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\EncryptorInterface', $encryptorFabric->createEncryptor192());
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\EncryptorInterface', $encryptorFabric->createEncryptor256());
    }
}
