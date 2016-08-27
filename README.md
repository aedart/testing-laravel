[![Latest Stable Version](https://poser.pugx.org/aedart/testing-laravel/v/stable)](https://packagist.org/packages/aedart/testing-laravel)
[![Total Downloads](https://poser.pugx.org/aedart/testing-laravel/downloads)](https://packagist.org/packages/aedart/testing-laravel)
[![Latest Unstable Version](https://poser.pugx.org/aedart/testing-laravel/v/unstable)](https://packagist.org/packages/aedart/testing-laravel)
[![License](https://poser.pugx.org/aedart/testing-laravel/license)](https://packagist.org/packages/aedart/testing-laravel)

# Testing-Laravel

Utilities that allows you to test Laravel dependent packages. At its core, this package is a wrapper for the Orchestral Testbench.
However, you can make use of this with whatever testing framework you wish; it does not force you to use neither Orchestral's nor Laravel's TestCase classes.

# Contents

* [When to use this](#when-to-use-this)
* [How to install](#how-to-install)
* [Quick start](#quick-start)
* [Acknowledgement](#acknowledgement)
* [License](#license)

## When to use this

When you wish to test Laravel specific components and packages

## How to install

### For Orchestral Testbench version 3.3.x / Laravel 5.3.x

```console
composer require aedart/testing-laravel 1.8.*
```

### For Orchestral Testbench version 3.2.x / Laravel 5.2.x

```console
composer require aedart/testing-laravel 1.7.*
```

### For Laravel 5.1 and 5.0

Not supported

-----------------

This package uses [composer](https://getcomposer.org/). If you do not know what that is or how it works, I recommend that you read a little about, before attempting to use this package.

## Quick start

### Assumptions / Prerequisite

You have some experience using [Laravel](http://laravel.com/)

You are using some kind of PHP unit test framework, e.g. [PHPUnit](https://phpunit.de/), [Codeception](http://codeception.com/), ...etc

### Using TestHelperTrait (Full Orchestral implementation)

In the below stated example, a codeception's unit test (extends PHP Unit) is being used

```php
<?php
use Aedart\Testing\Laravel\Traits\TestHelperTrait;

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
```

When using the `TestHelperTrait`, all of the Orchestral's TestCase methods are available

### Using ApplicationInitiatorTrait (minimal implementation)

```php
<?php
use Aedart\Testing\Laravel\Traits\ApplicationInitiatorTrait;

class MyUnitTest extends \Codeception\TestCase\Test
{
    use ApplicationInitiatorTrait;

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

    // ... Remaining not shown ... //
}
```

When using the `ApplicationInitiatorTrait`, __none__ of Orchestral's TestCase methods are available

## Acknowledgement

[Mior Muhammad Zaki](https://github.com/orchestral/testbench) for a good alternative way of testing Laravel specific components and packages. 

[Taylor Otwell et al.](http://laravel.com/) for one of the best PHP frameworks ever created.

## License

[BSD-3-Clause](http://spdx.org/licenses/BSD-3-Clause), Read the LICENSE file included in this package