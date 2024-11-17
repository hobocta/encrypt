<?php

/** @noinspection PhpComposerExtensionStubsInspection */

namespace Hobocta\Encrypt\Encryptor\Implementation\Mcrypt;

use Hobocta\Encrypt\Encryptor\AbstractEncryptor;
use Hobocta\Encrypt\Encryptor\EncryptorInterface;

final class McryptEncryptor extends AbstractEncryptor implements EncryptorInterface
{
    public function encrypt($data)
    {
        $iv = $this->getIv();

        $encrypted = mcrypt_encrypt(
            $this->options['cipher'],
            $this->key,
            $data,
            $this->options['mode'],
            $iv
        );

        return $iv . $encrypted;
    }

    protected function getIv()
    {
        $ivSize = $this->getIvSize();

        return mcrypt_create_iv($ivSize, $this->options['ivSource']);
    }

    protected function getIvSize()
    {
        return mcrypt_get_iv_size($this->options['cipher'], $this->options['mode']);
    }

    public function decrypt($encrypted)
    {
        $ivSize = $this->getIvSize();

        $iv = $this->getBinarySubstring($encrypted, 0, $ivSize);

        $data = $this->getBinarySubstring($encrypted, $ivSize, $this->getBinaryLength($encrypted) - $ivSize);

        $decrypted = mcrypt_decrypt(
            $this->options['cipher'],
            $this->key,
            $data,
            $this->options['mode'],
            $iv
        );

        return rtrim($decrypted, "\0\4");
    }

    /**
     * Mcrypt returns iso-8859-1 encoded string,
     * so we should use mb_* function on decryption with this encoding.
     *
     * @return string
     */
    protected function getBinaryEncoding()
    {
        return 'iso-8859-1';
    }

    protected function getOptionKeys()
    {
        return array('cipher', 'mode', 'ivSource');
    }
}
