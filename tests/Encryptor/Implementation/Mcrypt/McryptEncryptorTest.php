<?php

use Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptAvailableChecker;
use Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptEncryptor;
use Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptEncryptorFabric;
use PHPUnit\Framework\TestCase;

final class McryptEncryptorTest extends TestCase
{
    public function testInstanceOf()
    {
        if (!McryptAvailableChecker::isAvailable()) {
            $this->assertEmpty('');
            return;
        }

        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\AbstractEncryptor', new McryptEncryptor('', array()));
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\EncryptorInterface', new McryptEncryptor('', array()));
    }

    public function testEncryptAndDecrypt()
    {
        if (!McryptAvailableChecker::isAvailable()) {
            $this->assertEmpty('');
            return;
        }

        $key = hash('sha1', uniqid(true));

        $encryptorFabric = new McryptEncryptorFabric($key);

        foreach (
            array(
                $encryptorFabric->createEncryptor128(),
                $encryptorFabric->createEncryptor192(),
                $encryptorFabric->createEncryptor256(),
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
