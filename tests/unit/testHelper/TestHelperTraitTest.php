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
     *
     * @return PHPUnit_Framework_MockObject_MockObject|TestHelperTrait
     */
    protected function getTraitMock(){
        $m = $this->getMockForTrait(TestHelperTrait::class);
        return $m;
    }

    /******************************************************************************
     * Tests
     *****************************************************************************/

    /**
     * @test
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

        $app = $trait->getApplication();
        foreach ($data as $key => $value){
            $this->assertTrue($app['session']->has($key), $key . ' does not exist');
            $this->assertSame($value, $app['session']->get($key));
        }

        $trait->flushSession();
        $trait->stopApplication();
    }

}