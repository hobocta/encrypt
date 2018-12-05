<?php

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

        if (version_compare(PHP_VERSION, '7.1.0') >= 0) {
            $fabric = new OpenSslEncryptorFabric($key);
        } else {
            $fabric = new McryptEncryptorFabric($key);
        }

        foreach (
            array(
                $fabric->createEncryptorVariantA(),
                $fabric->createEncryptorVariantB(),
                $fabric->createEncryptorVariantC(),
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