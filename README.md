Easy way to use data encryption in php
======================================

[![Build Status](https://travis-ci.org/hobocta/encrypt.svg?branch=master)](https://travis-ci.org/hobocta/encrypt)
[![codecov](https://codecov.io/gh/hobocta/encrypt/branch/master/graph/badge.svg)](https://codecov.io/gh/hobocta/encrypt)
[![Latest Stable Version](https://poser.pugx.org/hobocta/encrypt/v/stable)](https://packagist.org/packages/hobocta/encrypt)
[![Latest Unstable Version](https://poser.pugx.org/hobocta/encrypt/v/unstable)](https://packagist.org/packages/hobocta/encrypt)
[![License](https://poser.pugx.org/hobocta/encrypt/license)](https://packagist.org/packages/hobocta/encrypt)
[![Downloads](https://img.shields.io/packagist/dt/hobocta/encrypt.svg)](https://packagist.org/packages/hobocta/encrypt)

## Requirements
php `^5.3.3` or `^7.0` or `^8.0` with extension OpenSSL or Mcrypt

## Install
`composer require hobocta/encrypt`

## Usage
```php
use Hobocta\Encrypt\Encryptor\Fabric\EncryptorFabric;
use Hobocta\Encrypt\EncryptService;
use Hobocta\Encrypt\Stringify\Base64Stringify;

$data = 'My secret data!';

$password = '1234';

$encryptService = new EncryptService(
    (new EncryptorFabric(sha1($password)))->createEncryptor128(),
    new Base64Stringify()
);

$encrypted = $encryptService->encrypt($data); // 'fxVrDEtIb/krb8fHW6hhVDbH9VeV1Lwbs3hM35ITtc8='

$decrypted = $encryptService->decrypt($encrypted); // 'My secret data!'
```

## Run simple example
`php examples/simple.php` [code](examples/simple.php)

## Run example with all variants

`php examples/all.php`

## Run performance test for all variants
`php examples/performance.php`

## Run unit tests

Make sure to install PHPUnit separately before running the tests

`phpunit`
