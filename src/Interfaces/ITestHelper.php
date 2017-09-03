<?php

namespace Aedart\Testing\Laravel\Interfaces;

use Aedart\Testing\Laravel\Contracts\TestCase;

/**
 * @deprecated Since 3.0, use \Aedart\Testing\Laravel\Contracts\TestCase instead
 *
 * Interface Test Helper
 *
 * A test helper is basically a wrapper for the utility methods offered by Orchestral Testbench.
 * However, the application (Laravel) itself, is not automatically started - this has to be done
 * manually, when it is desired to be used.
 *
 * @see \Orchestra\Testbench\TestCase
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\Testing\Laravel\Interfaces
 */
interface ITestHelper extends TestCase
{

}