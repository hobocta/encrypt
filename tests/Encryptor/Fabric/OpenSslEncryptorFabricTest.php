<?php

use Hobocta\Encrypt\Encryptor\EncryptorAvailableChecker;
use Hobocta\Encrypt\Encryptor\Fabric\OpenSslEncryptorFabric;
use PHPUnit\Framework\TestCase;

final class OpenSslEncryptorFabricTest extends TestCase
{
    public function testInstanceOf()
    {
        if (!EncryptorAvailableChecker::isOpenSSLAvailable()) {
            $this->assertEmpty('');
            return;
        }

        $fabric = new OpenSslEncryptorFabric('');
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\Fabric\AbstractEncryptorFabric', $fabric);
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\Fabric\EncryptorFabricInterface', $fabric);
        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\OpenSslEncryptor',
            $fabric->createEncryptor128()
        );
        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\OpenSslEncryptor',
            $fabric->createEncryptor192()
        );
        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\OpenSslEncryptor',
            $fabric->createEncryptor256()
        );
    }
}
