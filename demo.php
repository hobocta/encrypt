<?php

require __DIR__ . '/vendor/autoload.php';

$password = '1234';
$data = 'My secret data!';

/** @noinspection PhpUnhandledExceptionInspection */
$encryptService = new Hobocta\Encrypt\EncryptService($password);

$encrypted = $encryptService->encrypt($data);
echo var_export($encrypted, true) . PHP_EOL;

$decrypted = $encryptService->decrypt($encrypted);
echo var_export($decrypted, true) . PHP_EOL;

echo ($data === $decrypted ? 'Equals' : 'Failure') . PHP_EOL;

