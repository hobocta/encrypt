<?php

use Hobocta\Encrypt\Encryptor\Fabric\OpenSslEncryptorFabric;
use PHPUnit\Framework\TestCase;

final class OpenSslEncryptorFabricTest extends TestCase
{
    public function testInstanceOf()
    {
        if (version_compare(PHP_VERSION, '7.1.0') < 0) {
            $this->assertEmpty('');
            return;
        }

        $fabric = new OpenSslEncryptorFabric('');
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\Fabric\AbstractEncryptorFabric', $fabric);
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\Fabric\EncryptorFabricInterface', $fabric);
        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\OpenSslEncryptor',
            $fabric->createEncryptorVariantA()
        );
        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\OpenSslEncryptor',
            $fabric->createEncryptorVariantB()
        );
        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\OpenSslEncryptor',
            $fabric->createEncryptorVariantC()
        );
    }
}
