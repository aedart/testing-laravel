<?php namespace Aedart\Testing\Laravel\TestCases\Integration;

use Codeception\TestCase\Test;

/**
 * <h1>Interface And Trait Compatibility TestCase</h1>
 *
 * Base class for a special kind of integration tests, in which we
 * wish to make sure that all the traits that have been developed,
 * actually do implement its corresponding interface-required methods!
 *
 * <h2>Reason</h2>
 *
 * The main reason why this kind of tests are required, is due to some
 * incompatibility issues that I have experienced, between a created
 * `interface` and a `trait` implementation of those method that the
 * given interface requires.
 *
 * <br />
 *
 * Normally, such a test should be needed at all - however, when working
 * with many trait-implementations of certain interfaces, it can become
 * difficult to ensure that those traits are 100% compatible; you only
 * find out when actually using the traits in some class, that also
 * implements the desired interface.
 *
 * <h2>Future version (PHP 7)</h2>
 *
 * In future version of this base class (in PHP 7), it might be possible
 * to fully automate this, by dynamically creating classes, that implements
 * the given interface, uses the desired trait and also catches any given
 * fatal errors... However, for the time being, we have to create dummy
 * instances manually!
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\Testing\Laravel\TestCases\Integration
 */
abstract class InterfaceAndTraitCompatibilityTestCase extends Test
{
    /**
     * @var \IntegrationTester
     */
    protected $tester;

    /***********************************************************
     * Helpers and utilities
     **********************************************************/

    /***********************************************************
     * Abstract methods
     **********************************************************/

    /**
     * Returns the class path to a class that implements the
     * given `interface` in question, and that uses its
     * corresponding `trait` implementation.
     *
     * @return string
     */
    abstract public function dummyClassPath();

    /**
     * Returns the class path of the `interface` in question
     *
     * @return string
     */
    abstract public function mustImplementInterface();

    /**
     * Returns the class path of the `trait` in question
     *
     * @return string
     */
    abstract public function mustUseTrait();

    /***********************************************************
     * Actual tests
     **********************************************************/

    /**
     * This test is very simple - if we can create a new instance
     * of a class, that implements a given interface, and uses
     * the given trait, then it passes.
     *
     * @test
     */
    public function isTraitImplementationCompatibleWithInterface()
    {
        // Get the class path to some dummy class
        $class = $this->dummyClassPath();

        // A) Here, we simply rely on PHP's engine to handle incompatibility
        // checks - if the trait implements the methods exactly as the
        // interface requires it, then an instance will be created. If
        // not, then PHP will throw a FATAL ERROR - which in this current
        // version of PHP we cannot catch.
        $instance = new $class();

        // While part (A) is sufficient, we will perform an additional set
        // of tests - we wish to make sure that a specific interface was
        // implemented by that given class, and that it uses a specific
        // trait. This is done so, only to ensure 100% that the correct
        // set of interfaces and traits have been used for this given
        // test.

        // Does it implement the correct / specified interface
        $this->assertInstanceOf($this->mustImplementInterface(), $instance,
            sprintf('Incorrect interface implemented by %s', $this->dummyClassPath()));

        // Does it use the correct / specified trait
        $traits = class_uses($instance);
        $this->assertContains($this->mustUseTrait(), $traits,
            sprintf('Incorrect trait used by %s', $this->dummyClassPath()));
    }
}