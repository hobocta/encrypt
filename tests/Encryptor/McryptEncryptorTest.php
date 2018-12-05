<?php

use Hobocta\Encrypt\Encryptor\AbstractEncryptor;
use Hobocta\Encrypt\Encryptor\EncryptorInterface;
use Hobocta\Encrypt\Encryptor\Fabric\McryptEncryptorFabric;
use Hobocta\Encrypt\Encryptor\McryptEncryptor;
use PHPUnit\Framework\TestCase;

final class McryptEncryptorTest extends TestCase
{
    public function testInstanceOf()
    {
        if (version_compare(PHP_VERSION, '7.1.0') >= 0) {
            $this->assertEmpty('');
            return;
        }

        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\AbstractEncryptor', new McryptEncryptor('', array()));
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\EncryptorInterface', new McryptEncryptor('', array()));
    }

    public function testEncryptAndDecrypt()
    {
        if (version_compare(PHP_VERSION, '7.1.0') >= 0) {
            $this->assertEmpty('');
            return;
        }

        $key = hash('sha1', uniqid(true));

        $fabric = new McryptEncryptorFabric($key);

        foreach (
            array(
                $fabric->createEncryptorVariantA(),
                $fabric->createEncryptorVariantB(),
                $fabric->createEncryptorVariantC(),
            ) as $encryptor
        ) {
            $data = uniqid(true);

            $encrypted = $encryptor->encrypt($data);

            $this->assertNotEmpty($encrypted);

            $decrypted = $encryptor->decrypt($encrypted);

            $this->assertEquals($data, $decrypted);
        }
    }
}
