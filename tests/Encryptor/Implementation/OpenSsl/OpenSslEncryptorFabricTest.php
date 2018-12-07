<?php

use Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslAvailableChecker;
use Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslEncryptorFabric;
use PHPUnit\Framework\TestCase;

final class OpenSslEncryptorFabricTest extends TestCase
{
    public function testInstanceOf()
    {
        if (!OpenSslAvailableChecker::isAvailable()) {
            $this->assertEmpty('');
            return;
        }

        $encryptorFabric = new OpenSslEncryptorFabric('');
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\Fabric\AbstractEncryptorFabric', $encryptorFabric);
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\Fabric\EncryptorFabricInterface', $encryptorFabric);
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslEncryptor', $encryptorFabric->createEncryptor128());
        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslEncryptor',
            $encryptorFabric->createEncryptor192()
        );
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslEncryptor', $encryptorFabric->createEncryptor256());
    }
}
