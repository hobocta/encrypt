<?php

namespace Hobocta\Encrypt\Encryptor;

abstract class AbstractEncryptor implements EncryptorInterface
{
    protected $key;
    protected $options;

    public function __construct($key, array $options)
    {
        $this->key = $key;
        $this->options = $options;
    }

    abstract protected function getBinaryEncoding();

    protected function getBinaryLength($string)
    {
        return function_exists('mb_strlen')
            ? mb_strlen($string, $this->getBinaryEncoding())
            : strlen($string);
    }

    protected function getBinarySubstring($string, $start, $length)
    {
        if (function_exists('mb_substr')) {
            return mb_substr($string, $start, $length, $this->getBinaryEncoding());
        } else {
            return substr($string, $start, $length);
        }
    }
}
