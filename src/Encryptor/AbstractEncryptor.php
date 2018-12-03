<?php

namespace Hobocta\Encrypt\Encryptor;

abstract class AbstractEncryptor
{
    protected $key;

    public function __construct($key)
    {
        $this->key = $key;
    }
}
