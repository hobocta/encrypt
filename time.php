<?php

use Hobocta\Encrypt\Encryptor\Fabric\McryptEncryptorFabric;
use Hobocta\Encrypt\Encryptor\Fabric\OpenSslEncryptorFabric;
use Hobocta\Encrypt\EncryptService;
use Hobocta\Encrypt\Stringify\Base64Stringify;

require __DIR__ . '/vendor/autoload.php';

$password = '1234';
$data = 'My secret data!';

// see more algorithms: hash_algos()
$key = hash('sha1', $password);

if (version_compare(PHP_VERSION, '7.1.0') >= 0) {
    $fabric = new OpenSslEncryptorFabric($key);
} else {
    $fabric = new McryptEncryptorFabric($key);
}

$encryptor = $fabric->createSimpleEncryptor();
//$encryptor = $fabric->createMediumEncryptor();
//$encryptor = $fabric->createStrongEncryptor();

$encryptService = new EncryptService($encryptor, new Base64Stringify());

echo 'Time test begin...' . PHP_EOL;

$time = microtime(true);

$count = 1000;

for ($i = 0; $i < $count; $i++) {
    $dataTmp = $data . uniqid();
    $encrypted = $encryptService->encrypt($dataTmp);
    $decrypted = $encryptService->decrypt($encrypted);
    if ($dataTmp !== $decrypted) {
        echo 'Failure' . PHP_EOL;
    }
}

echo 'Time test end' . PHP_EOL;

echo 'Time: ' . $count . ' encryption and decryption at ' . (microtime(true) - $time) . ' s' . PHP_EOL;
