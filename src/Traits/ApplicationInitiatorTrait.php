<?php namespace Aedart\Testing\Laravel\Traits;

use Aedart\Testing\Laravel\Exceptions\ApplicationRunningException;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Facade;
use Orchestra\Testbench\Concerns\CreatesApplication;

/**
 * @deprecated Use \Aedart\Tests\Integration\Laravel\ApplicationInitiatorTest, in aedart/athenaeum package
 *
 * Trait Application Initiator
 *
 * @see \Aedart\Testing\Laravel\Contracts\ApplicationInitiator
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\Testing\Laravel\Traits
 */
trait ApplicationInitiatorTrait
{
    use CreatesApplication;

    /**
     * Instance of the Laravel Application
     *
     * @var Application
     */
    protected $app = null;

    /**
     * The base URL to use while testing the application.
     *
     * @see \Orchestra\Testbench\TestCase
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * The Eloquent factory instance.
     *
     * @see \Orchestra\Testbench\TestCase
     *
     * @var \Illuminate\Database\Eloquent\Factory
     */
    protected $factory;

    /**
     * The callbacks that should be run before the application is destroyed.
     *
     * @see \Orchestra\Testbench\TestCase
     *
     * @var array
     */
    protected $beforeApplicationDestroyedCallbacks = [];

    /**
     * Start the application
     *
     * @return void
     *
     * @throws ApplicationRunningException If an application has already been started / initialised and running
     */
    public function startApplication() : void
    {
        if ($this->hasApplicationBeenStarted()) {
            throw new ApplicationRunningException(sprintf('Application has already been started. Please stop the application, before invoking start!'));
        }

        $this->refreshApplication();

        if (!$this->factory) {
            $this->factory = $this->app->make(Factory::class);
        }
    }

    /**
     * Stop the application
     *
     * @return void
     */
    public function stopApplication() : void
    {
        if ($this->hasApplicationBeenStarted()) {
            foreach ($this->beforeApplicationDestroyedCallbacks as $callback) {
                call_user_func($callback);
            }

            $this->app->flush();
            $this->app = null;

            Facade::clearResolvedInstances();
            Facade::setFacadeApplication(null);
        }
    }

    /**
     * Refresh the application instance.
     *
     * @return void
     */
    protected function refreshApplication() : void
    {
        putenv('APP_ENV=testing');

        $this->app = $this->createApplication();
    }

    /**
     * Get the application instance
     *
     * @return Application|null Instance of the application Or null if none has been started
     */
    public function getApplication() : ?Application
    {
        return $this->app;
    }

    /**
     * Check if the application has been started
     *
     * @return bool True if an application instance has been created, initialised and running. False if not.
     */
    public function hasApplicationBeenStarted() : bool
    {
        if (!is_null($this->app)) {
            return true;
        }
        return false;
    }

    /**
     * Define environment setup.
     *
     * @param  Application $app
     *
     * @return void
     *
     * @see \Orchestra\Testbench\TestCase
     */
    protected function getEnvironmentSetUp(Application $app) : void
    {
        // Define your environment setup.
    }

    /**
     * Register a callback to be run before the application is destroyed.
     *
     * @see \Orchestra\Testbench\TestCase
     *
     * @param  callable $callback
     *
     * @return void
     */
    protected function beforeApplicationDestroyed(callable $callback) : void
    {
        $this->beforeApplicationDestroyedCallbacks[] = $callback;
    }
}
