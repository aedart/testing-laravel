<?php namespace Aedart\Testing\Laravel\TestCases\unit;

use Aedart\Testing\Laravel\Traits\TestHelperTrait;
use Aedart\Testing\TestCases\Unit\UnitTestCase;

/**
 * <h1>Unit TestCase - With Laravel</h1>
 *
 * Starts and stop a Laravel application
 *
 * @see UnitTestCase
 * @see TestHelperTrait
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\Testing\Laravel\TestCases\unit
 */
abstract class UnitWithLaravelTestCase extends UnitTestCase
{
    use TestHelperTrait;

    protected function _before()
    {
        parent::_before();

        $this->startApplication();
    }

    protected function _after()
    {
        $this->stopApplication();

        parent::_after();
    }
}