[![Build Status](https://travis-ci.org/aedart/testing-laravel.svg?branch=master)](https://travis-ci.org/aedart/testing-laravel)
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
    + [For Orchestral Testbench version 3.4.x / Laravel 5.4.x](#for-orchestral-testbench-version-34x---laravel-54x)
    + [For Orchestral Testbench version 3.3.x / Laravel 5.3.x](#for-orchestral-testbench-version-33x---laravel-53x)
    + [For Orchestral Testbench version 3.2.x / Laravel 5.2.x](#for-orchestral-testbench-version-32x---laravel-52x)
    + [For Laravel 5.1 and previous versions](#for-laravel-51-and-previous-versions)
  * [Quick start](#quick-start)
    + [Assumptions / Prerequisite](#assumptions---prerequisite)
    + [Helper](#helper)
  * [Contribution](#contribution)
    + [Bug Report](#bug-report)
    + [Fork, code and send pull-request](#fork--code-and-send-pull-request)
  * [Acknowledgement](#acknowledgement)
  * [Versioning](#versioning)
  * [License](#license)

## When to use this

When you wish to test Laravel specific components and packages

## How to install

### For Orchestral Testbench version 3.4.x / Laravel 5.4.x

```console
composer require aedart/testing-laravel 2.*
```

### For Orchestral Testbench version 3.3.x / Laravel 5.3.x

```console
composer require aedart/testing-laravel 1.8.*
```

### For Orchestral Testbench version 3.2.x / Laravel 5.2.x

```console
composer require aedart/testing-laravel 1.7.*
```

### For Laravel 5.1 and previous versions

Not supported

-----------------

This package uses [composer](https://getcomposer.org/). If you do not know what that is or how it works, I recommend that you read a little about, before attempting to use this package.

## Quick start

### Assumptions / Prerequisite

You have some experience using [Laravel](http://laravel.com/)

You are using some kind of PHP unit test framework, e.g. [PHPUnit](https://phpunit.de/), [Codeception](http://codeception.com/), ...etc

### Helper

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
    
    // ... Remaining not shown ... //
}
```

## Contribution

Have you found a defect ( [bug or design flaw](https://en.wikipedia.org/wiki/Software_bug) ), or do you wish improvements? In the following sections, you might find some useful information
on how you can help this project. In any case, I thank you for taking the time to help me improve this project's deliverables and overall quality.

### Bug Report

If you are convinced that you have found a bug, then at the very least you should create a new issue. In that given issue, you should as a minimum describe the following;

* Where is the defect located
* A good, short and precise description of the defect (Why is it a defect)
* How to replicate the defect
* (_A possible solution for how to resolve the defect_)

When time permits it, I will review your issue and take action upon it.

### Fork, code and send pull-request

A good and well written bug report can help me a lot. Nevertheless, if you can or wish to resolve the defect by yourself, here is how you can do so;

* Fork this project
* Create a new local development branch for the given defect-fix
* Write your code / changes
* Create executable test-cases (prove that your changes are solid!)
* Commit and push your changes to your fork-repository
* Send a pull-request with your changes
* _Drink a [Beer](https://en.wikipedia.org/wiki/Beer) - you earned it_ :)

As soon as I receive the pull-request (_and have time for it_), I will review your changes and merge them into this project. If not, I will inform you why I choose not to.

## Acknowledgement

[Mior Muhammad Zaki](https://github.com/orchestral/testbench) for a good alternative way of testing Laravel specific components and packages. 

[Taylor Otwell et al.](http://laravel.com/) for one of the best PHP frameworks ever created.

## Versioning

This package follows [Semantic Versioning 2.0.0](http://semver.org/)

## License

[BSD-3-Clause](http://spdx.org/licenses/BSD-3-Clause), Read the LICENSE file included in this package