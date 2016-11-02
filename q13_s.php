<?php
/**
 * This file is a part of speroteck.tst project.
 * Author: Mykola Danylov (n.danylov@gmail.com)
 * Date: 30.10.2016
 * Time: 11:50
 */

define('MAX_PARAM_LEN', 255);
define('PARAM_NAME', 'n');
$number = getopt(PARAM_NAME . ":")[PARAM_NAME];

/** @var App $application */
$application = App::getInstance();
$application->run($number);
$application->echoResult();

// This class you can use in one line, SEE:
// App::getInstance()->run($number)->echoResult();

// ----- End. -----

class App
{
    private static $instance;
    private $outputResult = '';

    /**
     * Start point to use the class (singleton)
     * @return App
     */
    public static function getInstance()
    {
        if (!isset(static::$instance)){
            static::$instance = new static;
        };
        return static::$instance;
    }

    /**
     * Initialize and run application
     * @param string $number - an parameter string which user inputs
     * @return App $this
     */
    public function run($number)
    {
        if(strlen($number) > MAX_PARAM_LEN){
            $this->outputResult .= "Too long input number. Max length is: " . MAX_PARAM_LEN . "\n";
            return $this;
        }

        if(is_null($number)){
            $this->outputResult .= "This application checks is sum of first N/2"
                                   . " digits equals to sum of last N/2 digits.\n";
            $this->outputResult .= "If the number of digits is odd, a digit in"
                                   . " the center of the parameter does not belong to any side.\n";
            $this->outputResult .= "Max parameter length is " . MAX_PARAM_LEN . " digits.\n";
            $this->outputResult .= self::getExample();
            return $this;
        }

        $inputArray = str_split($number);
        $paramLen = strlen($number);
        $halfLen = $paramLen >> 1;

        if(!self::validateChars($inputArray)){
            $this->outputResult .= "An parameter must contains numbers only.\n";
            return $this;
        }

        if ($paramLen === 1){
            $this->outputResult .= "Quick bingo!\n";
            return $this;
        }

        $leftSum = 0;
        $rightSum = 0;
        for ($i = 0; $i < $halfLen; $i++) {
            $leftSum += $inputArray[$i];
            $rightSum += $inputArray[$paramLen - 1 - $i];
        }
        if($leftSum === $rightSum){
            $this->outputResult .= "Real bingo!\n";
            $this->outputResult .= "The sum of each side is: " . $leftSum . "\n";
            return $this;
        }

        $this->outputResult .= 'This number does not win.' . "\n";
        return $this;
    }

    /**
     * Outputs string result in console/browser
     * @return App $this
     */
    public function echoResult()
    {
        echo $this->outputResult;
        return $this;
    }

    /**
     * Returns an example (text), how to use the application
     * @return string
     */
    private static function getExample()
    {
        $thisAppName = pathinfo(__FILE__, PATHINFO_FILENAME);
        $thisAppExt = pathinfo(__FILE__, PATHINFO_EXTENSION);
        $result = "Example:\n";
        $result .= 'php ' . $thisAppName . '.' . $thisAppExt . " -". PARAM_NAME . "123321\n";
        return $result;
    }

    /**
     * Checks each element of input array to be single numeric one
     * @param array $inputStringArray - array of chars
     * @return bool - true if input array contents digital chars only
     */
    private static function validateChars(array &$inputStringArray)
    {
        foreach($inputStringArray as $char){
            if(!is_string($char) || strlen($char) > 1){
                return false;
            }
            if(!is_numeric($char)){
                return false;
            }
        }
        return true;
    }

    protected function __construct()
    {
    }

    final private function __sleep()
    {
    }

    final private function __wakeup()
    {
    }

    final private function __clone()
    {
    }
}