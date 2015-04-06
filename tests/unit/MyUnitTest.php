<?php

use Aedart\Testing\Laravel\Traits\TestHelperTrait;

/**
 * Class MyUnitTest
 *
 * Example tests...
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 */
class MyUnitTest extends \Codeception\TestCase\Test
{
    use TestHelperTrait;

    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before(){
        // Start the Laravel application
        $this->startApplication();
    }

    protected function _after(){
        // Stop the Laravel application
        $this->stopApplication();
    }

    /**
     * @test
     */
    public function readSomethingFromConfig(){
        // Calling config, using Laravel defined helper method
        $defaultDbDriver = config('database.default');

        $this->assertSame('mysql', $defaultDbDriver);
    }

    /**
     * @test
     */
    public function readSomethingElseFromConfig(){
        // Get the application instance
        $app = $this->getApplication();

        $queueDriver = $app['config']['queue.default'];

        $this->assertSame('sync', $queueDriver);
    }

    /**
     * @test
     *
     * NB: Only available, when using TestHelperTrait
     */
    public function usingOrchestralSpecificAssertions(){
        $data = [
            'myKey' => 'superSecretStuff'
        ];

        $this->session($data);

        $this->assertSessionHasAll($data);
        $this->flushSession();
    }

    // ... Remaining not shown ... //
}