<?php

use Hobocta\Encrypt\Encryptor\EncryptorAvailableChecker;
use Hobocta\Encrypt\Encryptor\Fabric\McryptEncryptorFabric;
use Hobocta\Encrypt\Encryptor\McryptEncryptor;
use PHPUnit\Framework\TestCase;

final class McryptEncryptorTest extends TestCase
{
    public function testInstanceOf()
    {
        if (!EncryptorAvailableChecker::isMcryptAvailable()) {
            $this->assertEmpty('');
            return;
        }

        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\AbstractEncryptor', new McryptEncryptor('', array()));
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\EncryptorInterface', new McryptEncryptor('', array()));
    }

    public function testEncryptAndDecrypt()
    {
        if (!EncryptorAvailableChecker::isMcryptAvailable()) {
            $this->assertEmpty('');
            return;
        }

        $key = hash('sha1', uniqid(true));

        $fabric = new McryptEncryptorFabric($key);

        foreach (
            array(
                $fabric->createEncryptor128(),
                $fabric->createEncryptor192(),
                $fabric->createEncryptor256(),
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
