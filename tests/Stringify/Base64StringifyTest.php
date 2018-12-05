<?php

use Hobocta\Encrypt\Stringify\Base64Stringify;
use Hobocta\Encrypt\Stringify\StringifyInterface;
use PHPUnit\Framework\TestCase;

final class Base64StringifyTest extends TestCase
{
    public function testInstanceOf()
    {
        $this->assertInstanceOf('\Hobocta\Encrypt\Stringify\StringifyInterface', new Base64Stringify());
    }

    public function testConvert()
    {
        $stringify = new Base64Stringify();

        $data = '12qwASzxER!@';
        $dataEncoded = 'MTJxd0FTenhFUiFA';

        $this->assertEquals($stringify->toString($data), $dataEncoded);

        $this->assertEquals($stringify->fromString($dataEncoded), $data);
    }
}
