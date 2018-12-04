<?php

use Hobocta\Encrypt\Encryptor\OpenSslEncryptor;
use Hobocta\Encrypt\EncryptService;
use Hobocta\Encrypt\Stringify\Base64Stringify;

require __DIR__ . '/vendor/autoload.php';

$password = '1234';
$data = 'My secret data!';

echo 'PHP version: ' . PHP_VERSION . PHP_EOL;

if (version_compare(PHP_VERSION, '7.1.0') >= 0) {
    echo 'Encryptor: OpenSSL' . PHP_EOL;

    $encryptService = new EncryptService(
        new OpenSslEncryptor(
            hash('sha256', $password), // see more algorithms: hash_algos()
            array(
                'method' => 'AES-256-CBC', // see more methods: openssl_get_cipher_methods()
                'options' => OPENSSL_RAW_DATA,
            )
        ),
        new Base64Stringify
    );
} else {
    echo 'Encryptor: Mcrypt' . PHP_EOL;

    $encryptService = new EncryptService(
        new \Hobocta\Encrypt\Encryptor\McryptEncryptor(
            hash('sha1', $password), // see more algorithms: hash_algos()
            array(
                'cipher' => MCRYPT_BLOWFISH, // see more ciphers: http://php.net/manual/ru/mcrypt.ciphers.php
                'mode' => MCRYPT_MODE_CBC, // see more modes: http://php.net/manual/ru/mcrypt.constants.php
                'ivSource' => MCRYPT_RAND, // see more sources: http://php.net/manual/ru/mcrypt.constants.php
            )
        ),
        new Base64Stringify
    );
}

echo 'Data: ' . var_export($data, true) . PHP_EOL;

$encrypted = $encryptService->encrypt($data);
echo 'Encrypted: ' . var_export($encrypted, true) . PHP_EOL;

$decrypted = $encryptService->decrypt($encrypted);
echo 'Decrypted: ' . var_export($decrypted, true) . PHP_EOL;

echo 'Result: ' . ($data === $decrypted ? 'Equals' : 'Failure') . PHP_EOL;
