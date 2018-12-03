<?php

namespace Hobocta\Encrypt\Stringify;

interface StringifyInterface
{
    public function toString($data);

    public function fromString($string);
}
