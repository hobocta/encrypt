<?php

use Hobocta\Encrypt\Encryptor\Fabric\EncryptorFabric;
use PHPUnit\Framework\TestCase;

class EncryptorFabricTest extends TestCase
{
    public function testInstanceOf()
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        $fabric = new EncryptorFabric('');

        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\Fabric\EncryptorFabricInterface', $fabric);

        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\EncryptorInterface', $fabric->createEncryptor128());
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\EncryptorInterface', $fabric->createEncryptor192());
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\EncryptorInterface', $fabric->createEncryptor256());
    }
}
