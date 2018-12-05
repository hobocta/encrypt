<?php

namespace Hobocta\Encrypt\Encryptor\Fabric;

interface EncryptorFabricInterface
{
    public function createSimpleEncryptor();

    public function createMediumEncryptor();

    public function createStrongEncryptor();
}
