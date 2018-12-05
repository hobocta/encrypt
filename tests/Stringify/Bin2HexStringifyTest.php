<?php

use Hobocta\Encrypt\Stringify\Bin2HexStringify;
use Hobocta\Encrypt\Stringify\StringifyInterface;
use PHPUnit\Framework\TestCase;

final class Bin2HexStringifyTest extends TestCase
{
    public function testInstanceOf()
    {
        $this->assertInstanceOf('\Hobocta\Encrypt\Stringify\StringifyInterface', new Bin2HexStringify());
    }

    public function testConvert()
    {
        $stringify = new Bin2HexStringify();

        $data = '12qwASzxER!@';
        $dataEncoded = '3132717741537a7845522140';

        $this->assertEquals($stringify->toString($data), $dataEncoded);

        $this->assertEquals($stringify->fromString($dataEncoded), $data);
    }
}
