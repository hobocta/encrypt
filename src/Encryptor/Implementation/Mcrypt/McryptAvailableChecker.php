<?php

namespace Hobocta\Encrypt\Encryptor\Implementation\Mcrypt;

use Hobocta\Encrypt\Encryptor\Checker\AvailableCheckerInterface;

final class McryptAvailableChecker implements AvailableCheckerInterface
{
    public static function isAvailable()
    {
        return version_compare(PHP_VERSION, '7.1.0') < 0
            && function_exists('mcrypt_encrypt')
            && function_exists('mcrypt_decrypt')
            && function_exists('mcrypt_get_iv_size')
            && function_exists('mcrypt_create_iv');
    }
}
