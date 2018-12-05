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

$encryptors = array(
    'VariantA' => $fabric->createEncryptorVariantA(),
    'VariantB' => $fabric->createEncryptorVariantB(),
    'VariantC' => $fabric->createEncryptorVariantC(),
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
