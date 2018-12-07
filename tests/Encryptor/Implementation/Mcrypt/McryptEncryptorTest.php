<?php

use Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptAvailableChecker;
use Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptEncryptor;
use Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptEncryptorFabric;
use Hobocta\Encrypt\Exception\EncryptException;
use PHPUnit\Framework\TestCase;

final class McryptEncryptorTest extends TestCase
{
    /**
     * @throws EncryptException
     */
    public function testInstanceOf()
    {
        if (!McryptAvailableChecker::isAvailable()) {
            $this->assertFalse(false);
            return;
        }

        $mcryptEncryptor = new McryptEncryptor(
            uniqid(true),
            array(
                'cipher' => uniqid(true),
                'mode' => uniqid(true),
                'ivSource' => uniqid(true)
            )
        );

        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\AbstractEncryptor',
            $mcryptEncryptor
        );

        $this->assertInstanceOf(
            '\Hobocta\Encrypt\Encryptor\EncryptorInterface',
            $mcryptEncryptor
        );
    }

    /**
     * @throws EncryptException
     */
    public function testEncryptAndDecrypt()
    {
        if (!McryptAvailableChecker::isAvailable()) {
            $this->assertFalse(false);
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
