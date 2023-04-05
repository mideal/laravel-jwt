<?php

namespace Mideal\Jwt\Tests;

use Orchestra\Testbench\TestCase;

class GuardTest extends TestCase
{
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testbench');

        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    public function test_authentication_with_jwt_succeeds()
    {

    }

}
