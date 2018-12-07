<?php

namespace Hobocta\Encrypt\Encryptor\Fabric;

interface EncryptorFabricInterface
{
    public function createEncryptor128();

    public function createEncryptor192();

    public function createEncryptor256();
}
