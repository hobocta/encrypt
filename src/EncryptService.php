<?php

namespace Hobocta\Encrypt;

use Hobocta\Encrypt\Encryptor\EncryptorInterface;
use Hobocta\Encrypt\Stringify\StringifyInterface;

final class EncryptService
{
    /**
     * @var EncryptorInterface
     */
    private $encryptor;

    /**
     * @var StringifyInterface
     */
    private $stringify;

    /**
     * EncryptService constructor.
     * @param EncryptorInterface $encryptor
     * @param StringifyInterface $stringify
     */
    public function __construct(EncryptorInterface $encryptor, StringifyInterface $stringify)
    {
        $this->encryptor = $encryptor;
        $this->stringify = $stringify;
    }

    public function encrypt($data)
    {
        $encrypted = $this->encryptor->encrypt($data);

        return $this->stringify->toString($encrypted);
    }

    public function decrypt($data)
    {
        $data = $this->stringify->fromString($data);

        return $this->encryptor->decrypt($data);
    }
}
