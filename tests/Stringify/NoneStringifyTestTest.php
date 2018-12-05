<?php

use Hobocta\Encrypt\Stringify\NoneStringify;
use PHPUnit\Framework\TestCase;

final class NoneStringifyTest extends TestCase
{
    public function testInstanceOf()
    {
        $this->assertInstanceOf('\Hobocta\Encrypt\Stringify\StringifyInterface', new NoneStringify());
    }

    public function testConvert()
    {
        $stringify = new NoneStringify();

        $data = '12qwASzxER!@';
        $dataEncoded = '12qwASzxER!@';

        $this->assertEquals($stringify->toString($data), $dataEncoded);

        $this->assertEquals($stringify->fromString($dataEncoded), $data);
    }
}
