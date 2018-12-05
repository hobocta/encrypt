<?php

use Hobocta\Encrypt\Encryptor\Fabric\OpenSslEncryptorFabric;
use Hobocta\Encrypt\Encryptor\OpenSslEncryptor;
use PHPUnit\Framework\TestCase;

final class OpenSslEncryptorTest extends TestCase
{
    public function testInstanceOf()
    {
        if (version_compare(PHP_VERSION, '7.1.0') < 0) {
            $this->assertEmpty('');
            return;
        }

        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\AbstractEncryptor',
            new OpenSslEncryptor('', array())
        );
        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\EncryptorInterface',
            new OpenSslEncryptor('', array())
        );
    }

    public function testEncryptAndDecrypt()
    {
        if (version_compare(PHP_VERSION, '7.1.0') < 0) {
            $this->assertEmpty('');
            return;
        }

        $key = hash('sha1', uniqid(true));

        $fabric = new OpenSslEncryptorFabric($key);

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
