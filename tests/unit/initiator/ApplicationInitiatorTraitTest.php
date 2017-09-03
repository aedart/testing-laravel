<?php

use Aedart\Testing\Laravel\Contracts\ApplicationInitiator;
use Aedart\Testing\Laravel\Traits\ApplicationInitiatorTrait;

/**
 * Class ApplicationInitiatorTraitTest
 *
 * @coversDefaultClass Aedart\Testing\Laravel\Traits\ApplicationInitiatorTrait
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 */
class ApplicationInitiatorTraitTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    /******************************************************************************
     * Providers
     *****************************************************************************/

    /**
     * Get mock for given trait
     * @return PHPUnit_Framework_MockObject_MockObject|ApplicationInitiator
     */
    protected function getTraitMock(){
        $m = $this->getMockForTrait(ApplicationInitiatorTrait::class);
        return $m;
    }

    /******************************************************************************
     * Tests
     *****************************************************************************/

    /**
     * @test
     */
    public function startApplication(){
        $trait = $this->getTraitMock();
        $trait->startApplication();

        $this->assertTrue($trait->hasApplicationBeenStarted());
        $this->assertInstanceOf('Illuminate\Foundation\Application', $trait->getApplication());
    }

    /**
     * @test
     *
     * @expectedException \Aedart\Testing\Laravel\Exceptions\ApplicationRunningException
     */
    public function attemptDualStartApplication(){
        $trait = $this->getTraitMock();
        $trait->startApplication();
        $trait->startApplication();
    }

    /**
     * @test
     */
    public function stopApplication(){
        $trait = $this->getTraitMock();

        $trait->startApplication();
        $trait->stopApplication();

        $this->assertFalse($trait->hasApplicationBeenStarted());
        $this->assertNull($trait->getApplication());
    }
}