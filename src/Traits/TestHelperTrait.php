<?php  namespace Aedart\Testing\Laravel\Traits; 

use Aedart\Testing\Laravel\Traits\ApplicationInitiatorTrait;
use Illuminate\Foundation\Testing\CrawlerTrait;
use Illuminate\Foundation\Testing\AssertionsTrait;

/**
 * Trait Test Helper
 *
 * @see \Aedart\Testing\Laravel\Interfaces\ITestHelper
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\Testing\Laravel\Traits
 */
trait TestHelperTrait {

    use ApplicationInitiatorTrait, CrawlerTrait, AssertionsTrait;

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