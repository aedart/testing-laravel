<?php  namespace Aedart\Testing\Laravel\Traits; 

use Aedart\Testing\Laravel\Traits\ApplicationInitiatorTrait;
use Illuminate\Foundation\Testing\Concerns\ImpersonatesUsers;
use Illuminate\Foundation\Testing\Concerns\InteractsWithConsole;
use Illuminate\Foundation\Testing\Concerns\InteractsWithContainer;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithSession;
use Illuminate\Foundation\Testing\Concerns\MakesHttpRequests;
use Illuminate\Foundation\Testing\Concerns\MocksApplicationServices;
use Orchestra\Testbench\Traits\WithFactories;

/**
 * Trait Test Helper
 *
 * @see \Aedart\Testing\Laravel\Interfaces\ITestHelper
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\Testing\Laravel\Traits
 */
trait TestHelperTrait {

    use ApplicationInitiatorTrait,
        InteractsWithContainer,
        MakesHttpRequests,
        ImpersonatesUsers,
        InteractsWithConsole,
        InteractsWithDatabase,
        InteractsWithSession,
        MocksApplicationServices,
        WithFactories;

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