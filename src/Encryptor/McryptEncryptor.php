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

    public function decrypt($data)
    {
        $ivSize = $this->getIvSize();

        $iv = $this->getBinarySubstring($data, 0, $ivSize);

        $data = $this->getBinarySubstring($data, $ivSize, $this->getBinaryLength($data) - $ivSize);

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

    private function getIvSize()
    {
        /** @noinspection PhpDeprecationInspection */
        return mcrypt_get_iv_size($this->options['cipher'], $this->options['mode']);
    }

    private function getIv()
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
    private function getBinaryEncoding()
    {
        return 'iso-8859-1';
    }

    private function getBinaryLength($string)
    {
        return function_exists('mb_strlen')
            ? mb_strlen($string, self::getBinaryEncoding())
            : strlen($string);
    }

    private function getBinarySubstring($string, $start, $length)
    {
        if (function_exists('mb_substr')) {
            return mb_substr($string, $start, $length, self::getBinaryEncoding());
        } else {
            return substr($string, $start, $length);
        }
    }
}
