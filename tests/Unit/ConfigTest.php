<?php

declare(strict_types = 1);

namespace Tests\Unit;

use App\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function testCheckBeAbleToGetNestedSetting(): void
    {
        $config = [
            'doctrine' => [
                'connection' => [
                    'user' => 'root'
                ]
            ]
        ];

        $config = new Config($config);

        $this->assertEquals('root', $config->get('doctrine.connection.user'));
        $this->assertEquals(['user' => 'root'], $config->get('doctrine.connection'));
    }

    public function testGetDefaultValueWhenItIsNotDefine(): void
    {
        $config = [
            'doctrine' => [
                'connection' => [
                    'user' => 'root'
                ]
            ]
        ];

        $config = new Config($config);

        $this->assertEquals('pdo_mysql', $config->get('doctrine.connection.driver', 'pdo_mysql'));
        $this->assertEquals('bar', $config->get('foo', 'bar'));
        $this->assertEquals('baz', $config->get('foo.bar', 'baz'));
    }

    public function testItReturnsNullByDefaultWhenSettingIsNotFound(): void
    {
        $config = [
            'doctrine' => [
                'connection' => [
                    'user' => 'root'
                ]
            ]
        ];

        $config = new Config($config);

        $this->assertNull($config->get('doctrine.connection.driver'));
        $this->assertNull($config->get('foo.bar'));
    }
}
