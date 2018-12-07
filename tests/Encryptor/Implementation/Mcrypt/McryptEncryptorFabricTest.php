<?php

use Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptAvailableChecker;
use Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptEncryptorFabric;
use Hobocta\Encrypt\Exception\EncryptException;
use PHPUnit\Framework\TestCase;

final class McryptEncryptorFabricTest extends TestCase
{
    /**
     * @throws EncryptException
     */
    public function testInstanceOf()
    {
        if (!McryptAvailableChecker::isAvailable()) {
            $this->assertFalse(false);
            return;
        }

        /** @noinspection PhpUnhandledExceptionInspection */
        $encryptorFabric = new McryptEncryptorFabric(uniqid(true));
        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\Fabric\AbstractEncryptorFabric',
            $encryptorFabric
        );
        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\Fabric\EncryptorFabricInterface',
            $encryptorFabric
        );

        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptEncryptor',
            $encryptorFabric->createEncryptor128()
        );
        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptEncryptor',
            $encryptorFabric->createEncryptor192()
        );
        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptEncryptor',
            $encryptorFabric->createEncryptor256()
        );
    }

    public function testValidate()
    {
        foreach (array('', 1, array()) as $argument) {
            try {
                new McryptEncryptorFabric($argument);

                $this->fail('Expected exception not thrown');
            } catch (EncryptException $e) {
            }
        }
    }
}
