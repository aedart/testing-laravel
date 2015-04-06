<?php  namespace Aedart\Testing\Laravel\Traits; 

use Aedart\Testing\Laravel\Exceptions\ApplicationRunningException;
use Orchestra\Testbench\Traits\ApplicationTrait;

/**
 * Trait Application Initiator
 *
 * @see IApplicationInitiator
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\Testing\Laravel\Traits
 */
trait ApplicationInitiatorTrait {

    use ApplicationTrait;

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