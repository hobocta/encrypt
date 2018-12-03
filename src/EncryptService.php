<?php

namespace Hobocta\Encrypt;

use Hobocta\Encrypt\Encryptor\McryptEncryptor;
use Hobocta\Encrypt\Encryptor\OpenSslEncryptor;
use Hobocta\Encrypt\Stringify\Base64Stringify;
use Hobocta\Encrypt\Stringify\Bin2HexStringify;

class EncryptService
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
     * @param $password
     * @param string $stringifyMethod
     * @throws \Exception
     */
    public function __construct($password, $stringifyMethod = 'base64')
    {
        if (version_compare(PHP_VERSION, '7.1.0') >= 0) {
            $key = hash('sha256', $password);
            $this->encryptor = new OpenSslEncryptor($key);
        } else {
            $key = hash('sha1', $password);
            $this->encryptor = new McryptEncryptor($key);
        }

        if ($stringifyMethod === 'base64') {
            $this->stringify = new Base64Stringify;
        } elseif ($stringifyMethod === 'bin2hex') {
            $this->stringify = new Bin2HexStringify;
        } else {
            throw new \Exception('Incorrect stringifyMethod');
        }
    }

    function encrypt($data)
    {
        $encrypted = $this->encryptor->encrypt($data);

        return $this->stringify->toString($encrypted);
    }

    function decrypt($data)
    {
        $data = $this->stringify->fromString($data);

        return $this->encryptor->decrypt($data);
    }
}
