<?php namespace Aedart\Testing\Laravel\TestCases\unit;

use Codeception\Util\Debug;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @deprecated Since 2.0, use aedart/testing-gst package instead
 *
 * <h1>Getter / Setter Trait TestCase</h1>
 *
 * Highly specialised test-case for so called "getter-setter" traits,
 * which can be found in the "aedart/model" package.
 *
 * <h2>Usage</h2>
 *
 * The given trait in question must contain the following methods,
 * where the `[xxxx]` corresponds to any given property name (camel-case),
 * that the trait in question is processing;
 *
 * <ul>
 *      <li>set[xxxx](mixed [xxxx]): void</li>
 *      <li>get[xxxx](): mixed</li>
 *      <li>has[xxxx](): bool</li>
 *      <li>hasDefault[xxxx](): bool</li>
 *      <li>getDefault[xxxx](): null (by default)</li>
 * </ul>
 *
 * Provided that the above stated requirements are meet, then you can
 * simply invoke the `assertGetterSetterTraitMethods(...)` method, and
 * all of the methods are automatically asserted.
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\Testing\Laravel\TestCases\unit
 */
abstract class GetterSetterTraitTestCase extends UnitTestCase{

    /***********************************************************
     * Helpers and utilities
     **********************************************************/

    /**
     * Returns a mock for the trait in question
     *
     * @see getTraitClassPath()
     *
     * @param null $traitClassPath [optional]
     * @param array $mockedMethods [optional]
     *
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    public function getTraitMock($traitClassPath = null, array $mockedMethods = []){
        if(is_null($traitClassPath)){
            $traitClassPath = $this->getTraitClassPath();
        }

        return $this->getMockForTrait(
            $traitClassPath,
            [],
            '',
            true,
            true,
            true,
            $mockedMethods,
            false
        );
    }

    /**
     * Returns the property name, camel-cased
     *
     * @see propertyName()
     *
     * @return string
     */
    public function getPropertyName(){
        return ucwords($this->propertyName());
    }

    /**
     * Returns the name of a 'set-property' method
     *
     * @see getPropertyName()
     *
     * @return string E.g. setDescription, setName, setId
     */
    public function setPropertyMethodName() {
        return 'set' . $this->getPropertyName();
    }

    /**
     * Returns the name of a 'get-property' method
     *
     * @see getPropertyName()
     *
     * @return string E.g. getDescription, getName, getId
     */
    public function getPropertyMethodName() {
        return 'get' . $this->getPropertyName();
    }

    /**
     * Returns the name of a 'has-property' method
     *
     * @see getPropertyName()
     *
     * @return string E.g. hasDescription, hasName, hasId
     */
    public function hasPropertyMethodName() {
        return 'has' . $this->getPropertyName();
    }

    /**
     * Returns the name of a 'get-default-property' method
     *
     * @see getPropertyName()
     *
     * @return string E.g. getDefaultDescription, getDefaultName, getDefaultId
     */
    public function getDefaultPropertyMethodName() {
        return 'getDefault' . $this->getPropertyName();
    }

    /**
     * Returns the name of a 'has-default-property' method
     *
     * @see getPropertyName()
     *
     * @return string E.g. hasDefaultDescription, hasDefaultName, hasDefaultId
     */
    public function hasDefaultPropertyMethodName() {
        return 'hasDefault' . $this->getPropertyName();
    }

    /***********************************************************
     * Assertions
     **********************************************************/

    /**
     * Assert all methods in the given `getter-setter` trait, by invoking
     * all methods, specifying and retrieving the given value, as well as
     * mocking a custom value return.
     *
     * @param mixed $valueToSetAndObtain
     * @param mixed $customDefaultValue
     */
    public function assertGetterSetterTraitMethods($valueToSetAndObtain, $customDefaultValue) {
        Debug::debug('Asserting ' . $this->getTraitClassPath());

        $traitMock = $this->getTraitMock();

        // Ensures that no default value has been set (by default)
        $this->assertHasNoDefaultValue($traitMock, $this->hasDefaultPropertyMethodName());

        // Ensures that the default value is null (by default)
        $this->assertDefaultValueIsNull($traitMock, $this->getDefaultPropertyMethodName());

        // Ensures that no value is set (by default)
        $this->assertHasNoValue($traitMock, $this->hasPropertyMethodName());

        // Ensures that a value can be set and retrieved
        $this->assertCanSpecifyAndObtainValue($traitMock, $this->setPropertyMethodName(), $this->getPropertyMethodName(), $valueToSetAndObtain);

        // Ensure that a custom defined default value is returned by default,
        // if no other value has been set prior to invoking the `get-property`
        // method.
        $this->assertReturnsCustomDefaultValue($this->getTraitClassPath(), $this->getDefaultPropertyMethodName(), $this->getPropertyMethodName(), $customDefaultValue);
    }

    /**
     * Assert that the there is no default value, by invoking the trait's
     * `has-default-property` method
     *
     * @param PHPUnit_Framework_MockObject_MockObject $traitMock
     * @param string $hasDefaultPropertyMethodName
     * @param string $failMessage
     */
    public function assertHasNoDefaultValue(PHPUnit_Framework_MockObject_MockObject $traitMock, $hasDefaultPropertyMethodName, $failMessage = 'Should not contain default value') {
        Debug::debug(' - ' . $hasDefaultPropertyMethodName . '()');

        $this->assertFalse($traitMock->$hasDefaultPropertyMethodName(), $failMessage);
    }

    /**
     * Assert that the default value is `null`, by invoking the trait's
     * `get-default-property` method
     *
     * @param PHPUnit_Framework_MockObject_MockObject $traitMock
     * @param string $getDefaultPropertyMethodName
     * @param string $failMessage
     */
    public function assertDefaultValueIsNull(PHPUnit_Framework_MockObject_MockObject $traitMock, $getDefaultPropertyMethodName, $failMessage = 'Default value should be null') {
        Debug::debug(' - ' . $getDefaultPropertyMethodName . '()');

        $this->assertNull($traitMock->$getDefaultPropertyMethodName(), $failMessage);
    }

    /**
     * Assert that no value is set, by invoking the trait's
     * `has-property` method
     *
     * @param PHPUnit_Framework_MockObject_MockObject $traitMock
     * @param string $hasPropertyMethodName
     * @param string $failMessage
     */
    public function assertHasNoValue(PHPUnit_Framework_MockObject_MockObject $traitMock, $hasPropertyMethodName, $failMessage = 'Should not have a value set') {
        Debug::debug(' - ' . $hasPropertyMethodName . '()');

        $this->assertFalse($traitMock->$hasPropertyMethodName(), $failMessage);
    }

    /**
     * Assert that the given value can be set and retrieved again,
     * by invoking the trait's `set-property` and `get-property`
     * methods
     *
     * @param PHPUnit_Framework_MockObject_MockObject $traitMock
     * @param string $setPropertyMethodName
     * @param string $getPropertyMethodName
     * @param mixed $value
     * @param string $failMessage
     */
    public function assertCanSpecifyAndObtainValue(
        PHPUnit_Framework_MockObject_MockObject $traitMock,
        $setPropertyMethodName,
        $getPropertyMethodName,
        $value,
        $failMessage = 'Incorrect value obtained'
    ){
        if(is_object($value)){
            Debug::debug(' - ' . $setPropertyMethodName . '(' . get_class($value) .')');
        } else {
            Debug::debug(' - ' . $setPropertyMethodName . '(' . var_export($value, true) .')');
        }

        $traitMock->$setPropertyMethodName($value);

        Debug::debug(' - ' . $getPropertyMethodName . '()');

        $this->assertSame($value, $traitMock->$getPropertyMethodName(), $failMessage);
    }

    /**
     * Assert that a custom defined default value is returned,
     * when nothing else has been specified, by invoking
     * the `get-default-property` and `get-property` methods
     *
     * @param string $traitClassPath
     * @param string $getDefaultPropertyMethodName
     * @param string $getPropertyMethodName
     * @param mixed $defaultValue
     * @param string $failMessage
     */
    public function assertReturnsCustomDefaultValue(
        $traitClassPath,
        $getDefaultPropertyMethodName,
        $getPropertyMethodName,
        $defaultValue,
        $failMessage = 'Incorrect default value returned'
    ){
        if(is_object($defaultValue)){
            Debug::debug(' - mocking ' . $getDefaultPropertyMethodName  . '(), must return; ' . get_class($defaultValue));
        } else {
            Debug::debug(' - mocking ' . $getDefaultPropertyMethodName  . '(), must return; ' . var_export($defaultValue, true));
        }

        $traitMock = $this->getTraitMock($traitClassPath, [
            $getDefaultPropertyMethodName
        ]);

        $traitMock->expects($this->any())
            ->method($getDefaultPropertyMethodName)
            ->willReturn($defaultValue);

        Debug::debug(' - ' . $getPropertyMethodName . '()');

        $this->assertSame($defaultValue, $traitMock->$getPropertyMethodName(), $failMessage);
    }

    /***********************************************************
     * Abstract methods
     **********************************************************/

    /**
     * Returns the class path to the trait in question
     *
     * @return string
     */
    abstract public function getTraitClassPath();

    /**
     * Returns the name of the property, which the given
     * trait has implemented its getter and setter methods
     *
     * @return string
     */
    abstract public function propertyName();
}