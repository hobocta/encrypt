<?php

use Hobocta\Encrypt\Encryptor\Implementation\OpenSsl\OpenSslAvailableChecker;
use PHPUnit\Framework\TestCase;

final class OpenSslAvailableCheckerTest extends TestCase
{
    public function testInstanceOf()
    {
        $this->assertInstanceOf('\Hobocta\Encrypt\Encryptor\Checker\AvailableCheckerInterface', new OpenSslAvailableChecker);
    }

    public function isAvailableTest()
    {
        $this->assertInternalType('boolean', OpenSslAvailableChecker::isAvailable());
    }
}
