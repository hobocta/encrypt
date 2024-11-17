<?php

/** @noinspection PhpComposerExtensionStubsInspection */

namespace Hobocta\Encrypt\Encryptor\Implementation\OpenSsl;

use Hobocta\Encrypt\Encryptor\AbstractEncryptor;
use Hobocta\Encrypt\Encryptor\EncryptorInterface;
use Hobocta\Encrypt\Exception\EncryptException;

final class OpenSslEncryptor extends AbstractEncryptor implements EncryptorInterface
{
    public function encrypt($data)
    {
        $iv = $this->getIv();

        $encrypted = openssl_encrypt(
            $data,
            $this->options['method'],
            $this->key,
            $this->options['options'],
            $iv
        );

        return $iv . $encrypted;
    }

    protected function getIv()
    {
        $ivSize = $this->getIvSize();

        return openssl_random_pseudo_bytes($ivSize);
    }

    protected function getIvSize()
    {
        return openssl_cipher_iv_length($this->options['method']);
    }

    public function decrypt($encrypted)
    {
        $ivSize = $this->getIvSize();

        $iv = $this->getBinarySubstring($encrypted, 0, $ivSize);

        $encrypted = $this->getBinarySubstring($encrypted, $ivSize, $this->getBinaryLength($encrypted) - $ivSize);

        return openssl_decrypt(
            $encrypted,
            $this->options['method'],
            $this->key,
            $this->options['options'],
            $iv
        );
    }

    protected function getBinaryEncoding()
    {
        return '8bit';
    }

    /**
     * @throws EncryptException
     */
    protected function validateOptions()
    {
        foreach ($this->getOptionKeys() as $option) {
            if (!isset($this->options[$option])) {
                throw new EncryptException(sprintf('Option "%s" is not set', $option));
            }
        }
    }

    protected function getOptionKeys()
    {
        return array('method', 'options');
    }
}
