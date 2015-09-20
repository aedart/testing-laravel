<?php  namespace Aedart\Testing\Laravel\Traits; 

use Aedart\Testing\Laravel\Exceptions\ApplicationRunningException;
use Illuminate\Support\Facades\Facade;
use Orchestra\Testbench\Traits\ApplicationTrait;
use Illuminate\Foundation\Testing\ApplicationTrait as FoundationTrait;

/**
 * Trait Application Initiator
 *
 * @see \Aedart\Testing\Laravel\Interfaces\IApplicationInitiator
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\Testing\Laravel\Traits
 */
trait ApplicationInitiatorTrait {

    use ApplicationTrait, FoundationTrait;

    /**
     * Start the application
     *
     * @return void
     *
     * @throws ApplicationRunningException If an application has already been started / initialised and running
     */
    public function startApplication(){
        if($this->hasApplicationBeenStarted()){
            throw new ApplicationRunningException(sprintf('Application has already been started. Please stop the application, before invoking start!'));
        }
        $this->refreshApplication();
    }

    /**
     * Stop the application
     *
     * @return void
     */
    public function stopApplication(){
        if($this->hasApplicationBeenStarted()){
            $this->app->flush();
            $this->app = null;

            Facade::clearResolvedInstances();
            Facade::setFacadeApplication(null);
        }
    }

    /**
     * Get the application instance
     *
     * @return \Illuminate\Foundation\Application|null Instance of the application Or null if none has been started
     */
    public function getApplication(){
        return $this->app;
    }

    /**
     * Check if the application has been started
     *
     * @return bool True if an application instance has been created, initialised and running. False if not.
     */
    public function hasApplicationBeenStarted(){
        if(!is_null($this->app)){
            return true;
        }
        return false;
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application   $app
     *
     * @return void
     *
     * @see \Orchestra\Testbench\Traits\ApplicationTrait
     */
    protected function getEnvironmentSetUp($app){
        // Define your environment setup.
    }
}