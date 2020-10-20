<?php

namespace M4riachi\LaravelImageIntervention\Tests;

use Orchestra\Testbench\TestCase;
use M4riachi\LaravelImageIntervention\LaravelImageInterventionServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [LaravelImageInterventionServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
