<?php  namespace Aedart\Testing\Laravel\Traits; 

use Aedart\Testing\Laravel\Traits\ApplicationInitiatorTrait;
use Orchestra\Testbench\Traits\ClientTrait;
use Orchestra\Testbench\Traits\PHPUnitAssertionsTrait;

/**
 * Trait Test Helper
 *
 * @see \Aedart\Testing\Laravel\Interfaces\ITestHelper
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\Testing\Laravel\Traits
 */
trait TestHelperTrait {

    use ApplicationInitiatorTrait, ClientTrait, PHPUnitAssertionsTrait;

    /**
     * <b>DEFECT</b> - if used with codeception, this method should already be
     * implemented
     *
     * <b>Override</b>
     *
     * Setup the test environment.
     *
     * <i>Does not do anything in this trait implementation. Use
     * 'startApplication' to do actual initialisation of the Laravel
     * application</i>
     *
     * @return void
     *
     * @see startApplication()
     */
//    public function setUp(){
//        // N/A - Does nothing in this implementation...
//    }

}