<?php

use Hobocta\Encrypt\Encryptor\EncryptorAvailableChecker;
use Hobocta\Encrypt\Encryptor\Fabric\EncryptorFabric;
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

try {
    $fabric = new EncryptorFabric($key);
} catch (Exception $e) {
    die(sprintf('Exception message: %s (%s:%s)', $e->getMessage(), $e->getFile(), $e->getLine()) . PHP_EOL);
}

$encryptors = array(
    'VariantA' => $fabric->createEncryptorVariantA(),
    'VariantB' => $fabric->createEncryptorVariantB(),
    'VariantC' => $fabric->createEncryptorVariantC(),
);

foreach ($encryptors as $encryptorName => $encryptor) {
    echo PHP_EOL;
    echo $encryptorName . ':' . PHP_EOL;

    $encryptService = new EncryptService($encryptor, new Base64Stringify());

    echo 'Data: ' . var_export($data, true) . PHP_EOL;

    $encrypted = $encryptService->encrypt($data);
    echo 'Encrypted: ' . var_export($encrypted, true) . PHP_EOL;

    $decrypted = $encryptService->decrypt($encrypted);
    echo 'Decrypted: ' . var_export($decrypted, true) . PHP_EOL;

    echo 'Result: ' . ($data === $decrypted ? 'Equals' : 'Failure') . PHP_EOL;
}
