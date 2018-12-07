<?php

namespace Hobocta\Encrypt\Encryptor\Implementation\OpenSsl;

use Hobocta\Encrypt\Encryptor\AbstractEncryptor;
use Hobocta\Encrypt\Encryptor\EncryptorInterface;
use Hobocta\Encrypt\Exception\EncryptException;

class OpenSslEncryptor extends AbstractEncryptor implements EncryptorInterface
{
    /**
     * OpenSslEncryptor constructor.
     * @param $key
     * @param array $options
     * @throws EncryptException
     */
    public function __construct($key, array $options)
    {
        parent::__construct($key, $options);

        $this->validateOptions();
    }
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

    public function decrypt($encrypted)
    {
        $ivSize = $this->getIvSize();

        $iv = $this->getBinarySubstring($encrypted, 0, $ivSize);

        $data = $this->getBinarySubstring($encrypted, $ivSize, $this->getBinaryLength($encrypted) - $ivSize);

        $decrypted = openssl_decrypt(
            $data,
            $this->options['method'],
            $this->key,
            $this->options['options'],
            $iv
        );

        return $decrypted;
    }

    protected function getIvSize()
    {
        return openssl_cipher_iv_length($this->options['method']);
    }

    protected function getIv()
    {
        $ivSize = $this->getIvSize();

        $iv = openssl_random_pseudo_bytes($ivSize);

        return $iv;
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
        foreach (array('method', 'options') as $option) {
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
