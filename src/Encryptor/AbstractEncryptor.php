<?php

namespace Hobocta\Encrypt\Encryptor;

use Hobocta\Encrypt\Exception\EncryptException;

abstract class AbstractEncryptor implements EncryptorInterface
{
    protected $key;
    protected $options;

    /**
     * AbstractEncryptor constructor.
     * @param $key
     * @param array $options
     * @throws EncryptException
     */
    public function __construct($key, array $options)
    {
        $this->key = $key;
        $this->validateKey();

        $this->options = $options;
        $this->validateOptions();
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

    /**
     * @throws EncryptException
     */
    protected function validateKey()
    {
        if (!is_string($this->key)) {
            throw new EncryptException('Incorrect key, key must be a string');
        }

        if (empty($this->key)) {
            throw new EncryptException('Key is empty');
        }
    }

    /**
     * @throws EncryptException
     */
    protected function validateOptions()
    {
        foreach ($this->getOptionKeys() as $option) {
            if (empty($this->options[$option])) {
                throw new EncryptException(sprintf('Option "%s" is not set', $option));
            }
        }
    }

    abstract protected function getOptionKeys();
}
