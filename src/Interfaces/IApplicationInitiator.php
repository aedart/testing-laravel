<?php

namespace Aedart\Testing\Laravel\Interfaces;

use Aedart\Testing\Laravel\Contracts\ApplicationInitiator;

/**
 * @deprecated Since 3.0, use \Aedart\Testing\Laravel\Contracts\ApplicationInitiator instead
 *
 * Interface Application Initiator
 *
 * Components that implement this, promise that an Illuminate-Foundation-Application (Laravel application)
 * can be initialised, retrieved and destroyed, when it is needed.
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\Testing\Laravel\Interfaces
 */
interface IApplicationInitiator extends ApplicationInitiator
{

}