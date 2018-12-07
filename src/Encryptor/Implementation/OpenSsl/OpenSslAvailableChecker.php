<?php

namespace Hobocta\Encrypt\Encryptor\Implementation\OpenSsl;

use Hobocta\Encrypt\Encryptor\Checker\AvailableCheckerInterface;

class OpenSslAvailableChecker implements AvailableCheckerInterface
{
    public static function isAvailable()
    {
        return function_exists('openssl_encrypt')
            && function_exists('openssl_decrypt')
            && function_exists('openssl_cipher_iv_length')
            && function_exists('openssl_random_pseudo_bytes');
    }
}
