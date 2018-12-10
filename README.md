Easy way to use data encryption in php
======================================

[![Build Status](https://travis-ci.org/hobocta/encrypt.svg?branch=master)](https://travis-ci.org/hobocta/encrypt)
[![codecov](https://codecov.io/gh/hobocta/encrypt/branch/master/graph/badge.svg)](https://codecov.io/gh/hobocta/encrypt)
[![Latest Stable Version](https://poser.pugx.org/hobocta/encrypt/v/stable)](https://packagist.org/packages/hobocta/encrypt)
[![Latest Unstable Version](https://poser.pugx.org/hobocta/encrypt/v/unstable)](https://packagist.org/packages/hobocta/encrypt)
[![License](https://poser.pugx.org/hobocta/encrypt/license)](https://packagist.org/packages/hobocta/encrypt)
[![Downloads](https://img.shields.io/packagist/dt/hobocta/encrypt.svg)](https://packagist.org/packages/hobocta/encrypt)

## Install
`composer require hobocta/encrypt`

## Usage
```
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
`php examples/simple.php`

See code [examples/simple.php](examples/simple.php)

## Run example with all variants

`php examples/all.php`

## Run performance test for all variants
`php examples/performance.php`

## Run unit tests
`phpunit`
