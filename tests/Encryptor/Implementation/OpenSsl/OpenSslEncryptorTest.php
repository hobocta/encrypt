<?php

use Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslAvailableChecker;
use Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslEncryptor;
use Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslEncryptorFabric;
use Hobocta\Encrypt\Exception\EncryptException;
use PHPUnit\Framework\TestCase;

final class OpenSslEncryptorTest extends TestCase
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

        $openSslEncryptor = new OpenSslEncryptor(
            uniqid(true),
            array(
                'method' => uniqid(true),
                'options' => uniqid(true),
            )
        );

        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\AbstractEncryptor',
            $openSslEncryptor
        );
        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\EncryptorInterface',
            $openSslEncryptor
        );
    }

    /**
     * @throws EncryptException
     */
    public function testEncryptAndDecrypt()
    {
        if (!OpenSslAvailableChecker::isAvailable()) {
            $this->assertFalse(false);
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
