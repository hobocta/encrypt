<?php

use Hobocta\Encrypt\Encryptor\Implementation\Mcrypt\McryptAvailableChecker;
use PHPUnit\Framework\TestCase;

final class McryptAvailableCheckerTest extends TestCase
{
    public function testInstanceOf()
    {
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\Checker\AvailableCheckerInterface', new McryptAvailableChecker);
    }

    public function isAvailableTest()
    {
        $this->assertInternalType('boolean', McryptAvailableChecker::isAvailable());
    }
}
