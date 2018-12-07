<?php

use Hobocta\Encrypt\Encryptor\Fabric\EncryptorFabric;
use Hobocta\Encrypt\Exception\EncryptException;
use PHPUnit\Framework\TestCase;

class EncryptorFabricTest extends TestCase
{
    /**
     * @throws EncryptException
     */
    public function testInstanceOf()
    {
        $encryptorFabric = new EncryptorFabric(uniqid(true));

        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\Fabric\EncryptorFabricInterface',
            $encryptorFabric
        );
        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\Fabric\AbstractEncryptorFabric',
            $encryptorFabric
        );

        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\EncryptorInterface',
            $encryptorFabric->createEncryptor128()
        );
        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\EncryptorInterface',
            $encryptorFabric->createEncryptor192()
        );
        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\EncryptorInterface',
            $encryptorFabric->createEncryptor256()
        );
    }

    public function testValidate()
    {
        try {
            new EncryptorFabric('');
            $this->fail('Expected exception not thrown');
        } catch (EncryptException $e) {
        }

        try {
            new EncryptorFabric(1);
            $this->fail('Expected exception not thrown');
        } catch (EncryptException $e) {
        }

        try {
            new EncryptorFabric(array());
            $this->fail('Expected exception not thrown');
        } catch (EncryptException $e) {
        }
    }
}
