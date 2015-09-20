<?php namespace Aedart\Testing\Laravel\TestCases\unit;

use Codeception\TestCase\Test;
use Faker\Factory;
use \Mockery as m;

/**
 * <h1>Unit TestCase</h1>
 *
 * Base test-case for codeception unit tests.
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\Testing\Laravel\TestCases\unit
 */
abstract class UnitTestCase extends Test{

    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var \Faker\Generator
     */
    protected $faker = null;

    protected function _before()
    {
        $this->faker = Factory::create();
    }

    protected function _after()
    {
        m::close();
    }

    /***********************************************************
     * Helpers and utilities
     **********************************************************/
}