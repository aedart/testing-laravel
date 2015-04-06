<?php

use Aedart\Testing\Laravel\Interfaces\ITestHelper;
use Aedart\Testing\Laravel\Traits\TestHelperTrait;
use Faker\Factory as FakerFactory;

/**
 * Class TestHelperTraitTest
 *
 * These tests is more a "proof of concept", rather than anything - just need to
 * see if Orchestra's utilities do work. By no means are all methods covered / tested.
 *
 * @coversDefaultClass Aedart\Testing\Laravel\Traits\TestHelperTrait
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 */
class TestHelperTraitTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * Faker
     *
     * @var \Faker\Generator
     */
    protected $faker = null;

    protected function _before()
    {
        $this->faker = FakerFactory::create();
    }

    protected function _after()
    {
    }

    /******************************************************************************
     * Providers
     *****************************************************************************/

    /**
     * Get mock for given trait
     * @return PHPUnit_Framework_MockObject_MockObject|Aedart\Testing\Laravel\Interfaces\ITestHelper
     */
    protected function getTraitMock(){
        $m = $this->getMockForTrait('Aedart\Testing\Laravel\Traits\TestHelperTrait');
        return $m;
    }

    /******************************************************************************
     * Tests
     *****************************************************************************/

    /**
     * @test
     *
     * NOTE: the setUp covered here doesn't do anything at all!
     *
     * @covers ::setUp
     */
    public function storeSomethingInSession(){
        $trait = $this->getTraitMock();
        $trait->startApplication();

        $data = [
            $this->faker->unique()->word => $this->faker->address,
            $this->faker->unique()->word => $this->faker->address,
            $this->faker->unique()->word => $this->faker->address,
        ];
        $trait->session($data);

        $trait->assertSessionHasAll($data);

        $trait->flushSession();
        $trait->stopApplication();
    }

}