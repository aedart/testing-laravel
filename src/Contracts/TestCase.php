<?php

namespace Aedart\Testing\Laravel\Contracts;
use Orchestra\Testbench\Contracts\TestCase as TestCaseBase;

/**
 * TestCase
 *
 * <br />
 *
 * Allows you to start and stop a full laravel application.
 * Offers various support methods.
 *
 * @see \Orchestra\Testbench\Contracts\TestCase
 * @see \Aedart\Testing\Laravel\Contracts\ApplicationInitiator
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\Testing\Laravel\Contracts
 */
interface TestCase extends ApplicationInitiator,
    TestCaseBase
{

}