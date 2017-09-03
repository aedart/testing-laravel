<?php  namespace Aedart\Testing\Laravel\Traits; 

use Illuminate\Foundation\Testing\Concerns\InteractsWithAuthentication;
use Illuminate\Foundation\Testing\Concerns\InteractsWithConsole;
use Illuminate\Foundation\Testing\Concerns\InteractsWithContainer;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithExceptionHandling;
use Illuminate\Foundation\Testing\Concerns\InteractsWithSession;
use Illuminate\Foundation\Testing\Concerns\MakesHttpRequests;
use Illuminate\Foundation\Testing\Concerns\MocksApplicationServices;
use Orchestra\Testbench\Traits\WithFactories;
use Orchestra\Testbench\Traits\WithLaravelMigrations;
use Orchestra\Testbench\Traits\WithLoadMigrationsFrom;

/**
 * Trait Test Helper
 *
 * @see \Aedart\Testing\Laravel\Contracts\TestCase
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\Testing\Laravel\Traits
 */
trait TestHelperTrait
{
    use ApplicationInitiatorTrait;
    use InteractsWithContainer;
    use MakesHttpRequests;
    use InteractsWithAuthentication;
    use InteractsWithConsole;
    use InteractsWithExceptionHandling;
    use InteractsWithDatabase;
    use InteractsWithSession;
    use MocksApplicationServices;
    use WithFactories;
    use WithLaravelMigrations;
    use WithLoadMigrationsFrom;
}