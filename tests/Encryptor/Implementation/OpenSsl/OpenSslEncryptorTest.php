<?php

use Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslAvailableChecker;
use Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslEncryptor;
use Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslEncryptorFabric;
use PHPUnit\Framework\TestCase;

final class OpenSslEncryptorTest extends TestCase
{
    public function testInstanceOf()
    {
        if (!OpenSslAvailableChecker::isAvailable()) {
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
        if (!OpenSslAvailableChecker::isAvailable()) {
            $this->assertEmpty('');
            return;
        }

        $key = hash('sha1', uniqid(true));

        $encryptorFabric = new OpenSslEncryptorFabric($key);

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
