<?php

namespace Tests;

use RedisClient\ClientFactory;
use SmoothyCloud\ApplicationTemplateValidator\Testing\TemplateTest;

class Test extends TemplateTest
{
    /** @test */
    public function the_syntax_of_the_template_is_correct()
    {
        $this->validateTemplate();
    }

    /** @test */
    public function the_redis_5_0_application_works_correctly_when_deployed()
    {
        $variables = [
            'redis_version' => '5.0',
            'redis_password' => 'secret',
            'memory' => '2048',
            'cpus' => '1',
        ];

        $this->deployApplication($variables);

        $redis = ClientFactory::create([
            'server' => '127.0.0.1:50000',
            'version' => '5.0',
            'password' => 'secret',
        ]);

        $redis->executeRaw(['SET', 'foo', 'bar']);
        $this->assertEquals('bar', $redis->executeRaw(['GET', 'foo']));
    }

    /** @test */
    public function the_redis_6_0_application_works_correctly_when_deployed()
    {
        $variables = [
            'redis_version' => '6.0',
            'redis_password' => 'secret',
            'memory' => '2048',
            'cpus' => '1',
        ];

        $this->deployApplication($variables);

        $redis = ClientFactory::create([
            'server' => '127.0.0.1:50000',
            'version' => '6.0',
            'password' => 'secret',
        ]);

        $redis->executeRaw(['SET', 'foo', 'bar']);
        $this->assertEquals('bar', $redis->executeRaw(['GET', 'foo']));
    }
}
