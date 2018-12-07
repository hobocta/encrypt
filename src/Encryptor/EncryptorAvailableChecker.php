<?php

namespace Hobocta\Encrypt\Encryptor;

class EncryptorAvailableChecker
{
    public static function isOpenSSLAvailable()
    {
        return function_exists('openssl_encrypt')
            && function_exists('openssl_decrypt')
            && function_exists('openssl_cipher_iv_length')
            && function_exists('openssl_random_pseudo_bytes');
    }

    public static function isMcryptAvailable()
    {
        return function_exists('mcrypt_encrypt')
            && function_exists('mcrypt_decrypt')
            && function_exists('mcrypt_get_iv_size')
            && function_exists('mcrypt_create_iv');
    }
}
