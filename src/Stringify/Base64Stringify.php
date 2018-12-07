<?php

namespace Hobocta\Encrypt\Stringify;

final class Base64Stringify implements StringifyInterface
{
    public function toString($data)
    {
        return base64_encode($data);
    }

    public function fromString($string)
    {
        return base64_decode($string);
    }
}
