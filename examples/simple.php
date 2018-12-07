<?php

use Hobocta\Encrypt\Encryptor\Fabric\EncryptorFabric;
use Hobocta\Encrypt\EncryptService;
use Hobocta\Encrypt\Exception\EncryptException;
use Hobocta\Encrypt\Stringify\Base64Stringify;

require __DIR__ . '/../vendor/autoload.php';

$password = '1234';
$data = 'My secret data!';

try {
    $key = hash('sha1', $password);

    $encryptorFabric = new EncryptorFabric($key);

    $encryptService = new EncryptService($encryptorFabric->createEncryptor128(), new Base64Stringify());
} catch (EncryptException $e) {
    die(sprintf('Exception message: %s (%s:%s)', $e->getMessage(), $e->getFile(), $e->getLine()) . PHP_EOL);
}

echo 'Data: ' . var_export($data, true) . PHP_EOL;

$encrypted = $encryptService->encrypt($data);
echo 'Encrypted: ' . var_export($encrypted, true) . PHP_EOL;

$decrypted = $encryptService->decrypt($encrypted);
echo 'Decrypted: ' . var_export($decrypted, true) . PHP_EOL;

echo 'Result: ' . ($data === $decrypted ? 'Equals' : 'Failure') . PHP_EOL;
