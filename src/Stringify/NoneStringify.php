<?php

namespace Hobocta\Encrypt\Stringify;

final class NoneStringify implements StringifyInterface
{
    public function toString($data)
    {
        return $data;
    }

    public function fromString($string)
    {
        return $string;
    }
}
