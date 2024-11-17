<?php

namespace Hobocta\Encrypt\Encryptor;

interface EncryptorInterface
{
    public function encrypt($data);

    public function decrypt($encrypted);
}
