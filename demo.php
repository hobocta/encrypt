<?php

use Hobocta\Encrypt\Encryptor\Fabric\McryptEncryptorFabric;
use Hobocta\Encrypt\Encryptor\Fabric\OpenSslEncryptorFabric;
use Hobocta\Encrypt\EncryptService;
use Hobocta\Encrypt\Stringify\Base64Stringify;

require __DIR__ . '/vendor/autoload.php';

$password = '1234';
$data = 'My secret data!';

echo 'PHP version: ' . PHP_VERSION . PHP_EOL;

// see more algorithms: hash_algos()
$key = hash('sha1', $password);

if (version_compare(PHP_VERSION, '7.1.0') >= 0) {
    echo 'Encryptor: OpenSSL' . PHP_EOL;

    $fabric = new OpenSslEncryptorFabric($key);
} else {
    echo 'Encryptor: Mcrypt' . PHP_EOL;

    $fabric = new McryptEncryptorFabric($key);
}

//$encryptor = $fabric->createEncryptorVariantA();
//$encryptor = $fabric->createEncryptorVariantB();
$encryptor = $fabric->createEncryptorVariantC();

$encryptService = new EncryptService($encryptor, new Base64Stringify());

echo 'Data: ' . var_export($data, true) . PHP_EOL;

$encrypted = $encryptService->encrypt($data);
echo 'Encrypted: ' . var_export($encrypted, true) . PHP_EOL;

$decrypted = $encryptService->decrypt($encrypted);
echo 'Decrypted: ' . var_export($decrypted, true) . PHP_EOL;

echo 'Result: ' . ($data === $decrypted ? 'Equals' : 'Failure') . PHP_EOL;
