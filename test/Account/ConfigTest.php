<?php

declare(strict_types=1);

namespace VonageTest\Account;

use VonageTest\VonageTestCase;
use Vonage\Account\Config;

class ConfigTest extends VonageTestCase
{
    /**
     * @var Config
     */
    private $config;

    public function setUp(): void
    {
        $this->config = new Config(
            "https://example.com/webhooks/inbound-sms",
            "https://example.com/webhooks/delivery-receipt",
            30, // different values so we can check if we reversed one anywhere
            31,
            32
        );
    }

    public function testObjectAccess(): void
    {
        $this->assertEquals("https://example.com/webhooks/inbound-sms", $this->config->getSmsCallbackUrl());
        $this->assertEquals("https://example.com/webhooks/delivery-receipt", $this->config->getDrCallbackUrl());
        $this->assertEquals(30, $this->config->getMaxOutboundRequest());
        $this->assertEquals(31, $this->config->getMaxInboundRequest());
        $this->assertEquals(32, $this->config->getMaxCallsPerSecond());
    }
}
