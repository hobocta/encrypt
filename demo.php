<?php

use Hobocta\Encrypt\Encryptor\Fabric\EncryptorFabric;
use Hobocta\Encrypt\EncryptService;
use Hobocta\Encrypt\Stringify\Base64Stringify;

require __DIR__ . '/vendor/autoload.php';

$password = '1234';
$data = 'My secret data!';

// see more algorithms: hash_algos()
$key = hash('sha1', $password);

try {
    $fabric = new EncryptorFabric($key);
} catch (Exception $e) {
    die(sprintf('Exception message: %s (%s:%s)', $e->getMessage(), $e->getFile(), $e->getLine()) . PHP_EOL);
}

$encryptors = array(
    '128 bit' => $fabric->createEncryptor128(),
    '192 bit' => $fabric->createEncryptor192(),
    '256 bit' => $fabric->createEncryptor256(),
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
