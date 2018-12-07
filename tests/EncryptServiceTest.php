<?php

use Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptAvailableChecker;
use Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptEncryptorFabric;
use Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslAvailableChecker;
use Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslEncryptorFabric;
use Hobocta\Encrypt\EncryptService;
use Hobocta\Encrypt\Exception\EncryptException;
use Hobocta\Encrypt\Stringify\Base64Stringify;
use Hobocta\Encrypt\Stringify\Bin2HexStringify;
use Hobocta\Encrypt\Stringify\NoneStringify;
use PHPUnit\Framework\TestCase;

final class EncryptServiceTest extends TestCase
{
    /**
     * @throws EncryptException
     */
    public function testConvert()
    {
        $key = hash('sha1', uniqid(true));

        $encryptorFabrics = array();

        if (OpenSslAvailableChecker::isAvailable()) {
            $encryptorFabrics[] = new OpenSslEncryptorFabric($key);
        }

        if (McryptAvailableChecker::isAvailable()) {
            $encryptorFabrics[] =  new McryptEncryptorFabric($key);
        }

        foreach ($encryptorFabrics as $encryptorFabric) {
            $this->assertInstanceOf(
                '\Hobocta\Encrypt\Encryptor\Fabric\EncryptorFabricInterface',
                $encryptorFabric
            );

            foreach (
                array(
                    $encryptorFabric->createEncryptor128(),
                    $encryptorFabric->createEncryptor192(),
                    $encryptorFabric->createEncryptor256(),
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

    public function testAvailable()
    {
        if (!OpenSslAvailableChecker::isAvailable() && !McryptAvailableChecker::isAvailable()) {
            $this->fail('OpenSSL and Mcrypt are not available both');
        } else {
            $this->assertTrue(true);
        }
    }
}
