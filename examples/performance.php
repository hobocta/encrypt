<?php

use Hobocta\Encrypt\Encryptor\Fabric\EncryptorFabric;
use Hobocta\Encrypt\EncryptService;
use Hobocta\Encrypt\Stringify\Base64Stringify;

require __DIR__ . '/../vendor/autoload.php';

$password = '1234';
$data = 'My secret data!';

try {
    $key = hash('sha1', $password);

    $encryptorFabric = new EncryptorFabric($key);
} catch (Exception $e) {
    die(sprintf('Exception message: %s (%s:%s)', $e->getMessage(), $e->getFile(), $e->getLine()) . PHP_EOL);
}

$encryptors = array(
    '128 bit' => $encryptorFabric->createEncryptor128(),
    '192 bit' => $encryptorFabric->createEncryptor192(),
    '256 bit' => $encryptorFabric->createEncryptor256(),
);

$count = 10000;

foreach ($encryptors as $encryptorName => $encryptor) {
    $encryptService = new EncryptService($encryptor, new Base64Stringify());

    echo $encryptorName . ': ';

    $time = microtime(true);

    for ($i = 0; $i < $count; $i++) {
        $dataTmp = $data . uniqid();
        $encrypted = $encryptService->encrypt($dataTmp);
        $decrypted = $encryptService->decrypt($encrypted);
        if ($dataTmp !== $decrypted) {
            die('Failure');
        }
    }

    echo '' . $count . ' encryptions and decryptions at ' . (microtime(true) - $time) . ' s' . PHP_EOL;
}
