<?php
/**
 * This file is a part of speroteck.tst project.
 * Author: Mykola Danylov (n.danylov@gmail.com)
 * Date: 30.10.2016
 * Time: 12:40
 */

/** @var array $rawArr. Do not use empty array. Do not use array with repeated values. */
$rawArr = ["a", "b", "foo" => "c"];
$rawArr = ["0", "1"];
// Check is the array acceptable
if($rawArr === [] || array_unique($rawArr) !== $rawArr){
    throw new Exception('Improper input array detected.');
}
/** @var array $inputArr (source) array of any values without keys manually defined */
$inputArr = array_values($rawArr);
/** @var integer $scaleOfNotation - we treat each element as value of N number system */
$scaleOfNotation = count($rawArr);

// Main
$outputArr = makeCombination($scaleOfNotation);
// Next function call can be used if source $rawArr consists strings only
printArr($outputArr, $inputArr);
// ---- End ----

/**
 * Main function to make array of combinations from list of available non-repeated elements.
 * @param integer $scaleOfNotation - number of (N) of N-ary number system
 * @return array of arrays with all combinations
 */
function makeCombination($scaleOfNotation)
{
    /** @var array $resultArr array of arrays */
    $resultArr = [];
    /** @var array $incrementArr - one element for output array */
    $incrementArr = [];
    /** @var integer $maxDigitValue  */
    $maxDigitValue = $scaleOfNotation - 1;

    $i = 0;
    do {
        incrementArray($incrementArr, $maxDigitValue);
        if(count($incrementArr) <= $scaleOfNotation) {
            //Condition: we need skip results with repeated elements
            if(array_unique($incrementArr) === $incrementArr) {
                $resultArr[$i] = $incrementArr;
            }
            $completed = false;
        } else {
            $completed = true;
        }
        $i++;
    } while(!$completed);

    return $resultArr;
}

/**
 * We treat array with integers as a N-ary number. One element is a digit of number.
 * This function adds 1 to a number represented as array of digits.
 * @param array $arr - array to incrementing
 * @param $maxValue - maximal value for a digit
 */
function incrementArray(array &$arr, $maxValue)
{
        $i = 0;
        do {
            if ($i > count($arr) - 1) {
                $arr[$i] = 0;
            } else {
                $arr[$i]++;
            }
            if ($arr[$i] > ($maxValue)) {
                $arr[$i] = 0;
                $overflow = true;
            } else {
                $overflow = false;
            }
            $i++;
        } while ($overflow);
}

/**
 * @author Mykola Danylov (n.danylov@gmail.com)
 * @param array $arr
 * @param $digitsArr
 */
function printArr(array &$arr, &$digitsArr)
{
    echo "Output counter | Decimal value | Results \n";
    echo "_________________________________________ \n";
    $counter = 0;
    foreach($arr as $key => $subArr){
        //This (reverse) makes output result to looks like positional number system
        $subArr = array_reverse($subArr);
        echo str_pad('(' . ++$counter, 13, ' ', STR_PAD_LEFT) . ") | ";
        echo str_pad($key, 13, ' ', STR_PAD_LEFT) . " | ";
        foreach($subArr as $value){
//            echo '[' . $value . "] "; // uncomment this echo to see number equivalent of output
            echo $digitsArr[$value] . " ";
        }
        echo "\n";
    }
}

// array_reverse, array_pop, array_unique



















