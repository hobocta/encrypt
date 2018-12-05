<?php

namespace Hobocta\Encrypt\Encryptor\Fabric;

interface EncryptorFabricInterface
{
    public function createEncryptorVariantA();

    public function createEncryptorVariantB();

    public function createEncryptorVariantC();
}
