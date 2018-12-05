<?php

namespace Hobocta\Encrypt\Encryptor;

class McryptEncryptor extends AbstractEncryptor implements EncryptorInterface
{
    public function encrypt($data)
    {
        $iv = $this->getIv();

        /** @noinspection PhpDeprecationInspection */
        $encrypted = mcrypt_encrypt(
            $this->options['cipher'],
            $this->key,
            $data,
            $this->options['mode'],
            $iv
        );

        return $iv . $encrypted;
    }

    public function decrypt($encrypted)
    {
        $ivSize = $this->getIvSize();

        $iv = $this->getBinarySubstring($encrypted, 0, $ivSize);

        $data = $this->getBinarySubstring($encrypted, $ivSize, $this->getBinaryLength($encrypted) - $ivSize);

        /** @noinspection PhpDeprecationInspection */
        $decrypted = mcrypt_decrypt(
            $this->options['cipher'],
            $this->key,
            $data,
            $this->options['mode'],
            $iv
        );

        $decrypted = rtrim($decrypted, "\0\4");

        return $decrypted;
    }

    protected function getIvSize()
    {
        /** @noinspection PhpDeprecationInspection */
        return mcrypt_get_iv_size($this->options['cipher'], $this->options['mode']);
    }

    protected function getIv()
    {
        $ivSize = $this->getIvSize();

        /** @noinspection PhpDeprecationInspection */
        $iv = mcrypt_create_iv($ivSize, $this->options['ivSource']);

        return $iv;
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
}
