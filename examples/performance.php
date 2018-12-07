<?php

use Hobocta\Encrypt\Encryptor\Fabric\EncryptorFabric;
use Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptAvailableChecker;
use Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptEncryptorFabric;
use Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslAvailableChecker;
use Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslEncryptorFabric;
use Hobocta\Encrypt\EncryptService;
use Hobocta\Encrypt\Exception\EncryptException;
use Hobocta\Encrypt\Stringify\Base64Stringify;

require __DIR__ . '/../vendor/autoload.php';

$password = '1234';
$data = 'My secret data!';

$encryptorFabrics = array();

try {
    $key = hash('sha1', $password);

    if (OpenSslAvailableChecker::isAvailable()) {
        $encryptorFabrics['OpenSSL'] = new OpenSslEncryptorFabric($key);
    }

    if (McryptAvailableChecker::isAvailable()) {
        $encryptorFabrics['Mcrypt'] =  new McryptEncryptorFabric($key);
    }
} catch (EncryptException $e) {
    die(sprintf('Exception message: %s (%s:%s)', $e->getMessage(), $e->getFile(), $e->getLine()) . PHP_EOL);
}

foreach ($encryptorFabrics as $name => $encryptorFabric) {
    echo $name . ':' . PHP_EOL;

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
}
