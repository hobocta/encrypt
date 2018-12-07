<?php

use Hobocta\Encrypt\Encryptor\EncryptorAvailableChecker;
use Hobocta\Encrypt\Encryptor\Fabric\McryptEncryptorFabric;
use Hobocta\Encrypt\Encryptor\Fabric\OpenSslEncryptorFabric;
use Hobocta\Encrypt\EncryptService;
use Hobocta\Encrypt\Stringify\Base64Stringify;
use Hobocta\Encrypt\Stringify\Bin2HexStringify;
use Hobocta\Encrypt\Stringify\NoneStringify;
use PHPUnit\Framework\TestCase;

final class EncryptServiceTest extends TestCase
{
    public function testConvert()
    {
        $key = hash('sha1', uniqid(true));

        if (EncryptorAvailableChecker::isOpenSSLAvailable()) {
            $fabric = new OpenSslEncryptorFabric($key);
        } elseif (EncryptorAvailableChecker::isMcryptAvailable()) {
            $fabric = new McryptEncryptorFabric($key);
        }

        /** @noinspection PhpUndefinedVariableInspection */
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\Fabric\EncryptorFabricInterface', $fabric);

        foreach (
            array(
                $fabric->createEncryptor128(),
                $fabric->createEncryptor192(),
                $fabric->createEncryptor256(),
            ) as $encryptor
        ) {
            foreach (
                array(
                    new Base64Stringify(),
                    new Bin2HexStringify(),
                    new NoneStringify(),
                ) as $stringify
            ) {
                $data = uniqid(true);

                $encryptService = new EncryptService($encryptor, $stringify);

                $encrypted = $encryptService->encrypt($data);

                $decrypted = $encryptService->decrypt($encrypted);

                $this->assertEquals($data, $decrypted);
            }
        }
    }
}
