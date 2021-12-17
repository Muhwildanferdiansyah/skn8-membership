<?php

namespace Automattic\WooCommerce\Tests;

use \PHPUnit\Framework\TestCase as TestCase;

class BasicAuthTest extends TestCase
{

    protected $basicAuth;

    public function setUp()
    {
        $this->basicAuth = new \Automattic\WooCommerce\HttpClient\BasicAuth(null, 'ck_xxx', 'cs_xxx', true);
    }

    public function testGetParameters()
    {
        $default = [
            'consumer_key'    => 'ck_0e204788ad55774bc84aff9a9e6142a5aa7c4741',
            'consumer_secret' => 'cs_50baee606533b1748cfcc83d2435a81c544609ee',
        ];

        $this->assertEquals($default, $this->basicAuth->getParameters());
    }
}
