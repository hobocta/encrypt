<?php

namespace Hobocta\Encrypt\Encryptor;

abstract class AbstractEncryptor
{
    protected $key;
    protected $options;

    public function __construct($key, array $options)
    {
        $this->key = $key;
        $this->options = $options;
    }
}
