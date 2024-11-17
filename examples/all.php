<?php

/** @noinspection DuplicatedCode */

use Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptAvailableChecker;
use Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptEncryptorFabric;
use Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslAvailableChecker;
use Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslEncryptorFabric;
use Hobocta\Encrypt\EncryptService;
use Hobocta\Encrypt\Exception\EncryptException;
use Hobocta\Encrypt\Stringify\Base64Stringify;

require __DIR__ . '/../vendor/autoload.php';

$data = 'My secret data!';

$password = '1234';

$encryptorFabrics = array();

try {
    $key = sha1($password);

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
    echo PHP_EOL;
    echo $name . ':' . PHP_EOL;

    try {
        $encryptors = array(
            '128 bit' => $encryptorFabric->createEncryptor128(),
            '192 bit' => $encryptorFabric->createEncryptor192(),
            '256 bit' => $encryptorFabric->createEncryptor256(),
        );
    } catch (EncryptException $e) {
        echo sprintf(
            '%s: %s at %s:%s%s',
            get_class($e),
            $e->getMessage(),
            $e->getFile(),
            $e->getLine(),
            PHP_EOL
        );

        continue;
    }

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
}
