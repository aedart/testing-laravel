<?php

namespace Aedart\Testing\Laravel\Interfaces;

use Aedart\Testing\Laravel\Exceptions\ApplicationRunningException;

/**
 * Interface Application Initiator
 *
 * Components that implement this, promise that an Illuminate-Foundation-Application (Laravel application)
 * can be initialised, retrieved and destroyed, when it is needed.
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\Testing\Laravel\Interfaces
 */
interface IApplicationInitiator
{

    /**
     * Start the application
     *
     * @return void
     *
     * @throws ApplicationRunningException If an application has already been started / initialised and running
     */
    public function startApplication();

    /**
     * Stop the application
     *
     * @return void
     */
    public function stopApplication();

    /**
     * Get the application instance
     *
     * @return \Illuminate\Foundation\Application|null Instance of the application Or null if none has been started
     */
    public function getApplication();

    /**
     * Check if the application has been started
     *
     * @return bool True if an application instance has been created, initialised and running. False if not.
     */
    public function hasApplicationBeenStarted();
}