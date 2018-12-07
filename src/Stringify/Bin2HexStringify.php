<?php

namespace Hobocta\Encrypt\Stringify;

final class Bin2HexStringify implements StringifyInterface
{
    public function toString($data)
    {
        return bin2hex($data);
    }

    public function fromString($string)
    {
        if (function_exists('hex2bin')) {
            return hex2bin($string);
        } else {
            return $this->hexToBin($string);
        }
    }

    private function hexToBin($hexString)
    {
        $length = strlen($hexString);

        $bin = '';

        $i = 0;

        while ($i < $length) {
            $a = substr($hexString, $i, 2);

            $c = pack("H*", $a);

            if ($i == 0) {
                $bin = $c;
            } else {
                $bin .= $c;
            }

            $i += 2;
        }

        return $bin;
    }
}
