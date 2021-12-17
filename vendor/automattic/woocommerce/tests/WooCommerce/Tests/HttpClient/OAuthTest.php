<?php

namespace Automattic\WooCommerce\Tests;

use \PHPUnit\Framework\TestCase as TestCase;

class OAuthTest extends TestCase
{

    protected $oAuth;

    public function setUp()
    {
        $url = 'http://webprograming.devv';
        $consumerKey = 'ck_0e204788ad55774bc84aff9a9e6142a5aa7c4741';
        $consumerSecret = 'cs_50baee606533b1748cfcc83d2435a81c544609ee';
        $this->oAuth = new \Automattic\WooCommerce\HttpClient\OAuth($url, $consumerKey, $consumerSecret, 'v3', 'POST');
    }

    public function testGetParameters()
    {
        $parameters = $this->oAuth->getParameters();
        $keys = [
            'oauth_consumer_key',
            'oauth_nonce',
            'oauth_signature',
            'oauth_signature_method',
            'oauth_timestamp',
        ];

        $this->assertEquals($keys, array_keys($parameters));
        $this->assertEquals('ck_xxx', $parameters['oauth_consumer_key']);
        $this->assertEquals('HMAC-SHA256', $parameters['oauth_signature_method']);
    }
}
