<?php  namespace Aedart\Testing\Laravel\Exceptions; 

/**
 * Class Application Running Exception
 *
 * Throw this exception when an application is running, but should not be!
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\Testing\Laravel\Exceptions
 */
class ApplicationRunningException extends \RuntimeException{

}