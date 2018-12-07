<?php

use Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslAvailableChecker;
use Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslEncryptorFabric;
use Hobocta\Encrypt\Exception\EncryptException;
use PHPUnit\Framework\TestCase;

final class OpenSslEncryptorFabricTest extends TestCase
{
    /**
     * @throws EncryptException
     */
    public function testInstanceOf()
    {
        if (!OpenSslAvailableChecker::isAvailable()) {
            $this->assertFalse(false);
            return;
        }

        $encryptorFabric = new OpenSslEncryptorFabric(uniqid(true));

        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\Fabric\AbstractEncryptorFabric',
            $encryptorFabric
        );
        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\Fabric\EncryptorFabricInterface',
            $encryptorFabric
        );

        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslEncryptor',
            $encryptorFabric->createEncryptor128()
        );
        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslEncryptor',
            $encryptorFabric->createEncryptor192()
        );
        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslEncryptor',
            $encryptorFabric->createEncryptor256()
        );
    }

    public function testValidate()
    {
        foreach (array('', 1, array()) as $argument) {
            try {
                new OpenSslEncryptorFabric($argument);

                $this->fail('Expected exception not thrown');
            } catch (EncryptException $e) {
            }
        }

        $this->assertTrue(true);
    }
}
