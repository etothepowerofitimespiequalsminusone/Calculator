<?php

/**
 * This is the main file which receives and analyzes data, 
 * generates response data and finally calls the template.
 */

// show all warnings and errors on the screen
error_reporting(E_ALL);
ini_set('display_errors', 1);

$available_periods = array('1 month', '2 months', '3 months', '6 months', '9 months', '12 months');
// DO NOT EDIT BEFORE THIS LINE

/* Functions and classes You might want to use (you have to study function descriptions and examples)
 * Note: You can easily solve this task without using any regular expressions
file_get_contents() http://lv1.php.net/file_get_contents
file_put_contents() http://lv1.php.net/file_put_contents
file_exists() http://lv1.php.net/file_exists
round() http://lv1.php.net/round
pow() http://lv1.php.net/pow
SimpleXMLElement http://php.net/manual/en/simplexml.examples-basic.php http://php.net/manual/en/class.simplexmlelement.php 
date() http://lv1.php.net/manual/en/function.date.php or Date http://lv1.php.net/manual/en/class.datetime.php
Multiple string functions (choose by studying descriptions) http://lv1.php.net/manual/en/ref.strings.php
Multiple variable handling functions (choose by studying descriptions) http://lv1.php.net/manual/en/ref.var.php
Optionally you can use some array functions (with $_GET, $available_periods) http://lv1.php.net/manual/en/ref.array.php
*/

// Your code goes here

session_start();
$result_status = "";
$cost = 
    $down = "";
    $period = "";
    $interest = "";
    $residual = "";
    $euribor = "";

    
$fields = array('cost','down','period','interest','residual');
$error = false;
foreach($fields as $get_item) { //Loop trough each field
  if(!isset($_GET[$get_item]) || !is_float($_GET[$get_item])) {
    $result_message = 'Field '.$get_item.' not valid!<br />'; //Display error with field
    $result_status = "ERROR";
    $error = true;
  }
}
if(!$error)
{
    $result_status = "OK";
    $result_message = "all good, soon this will work like a charm";
}
    
    
//if(!isset($_GET['cost'])||!isset($_GET['down'])||!isset($_GET['period'])||!isset($_GET['interest'])||!isset($_GET['residual']))
//{   
//    $result_status = "ERROR";
//    $result_message = "not all variables are set";
//}
//else
//{
//    $cost = $_GET['cost'];
//    $down = $_GET['down'];
//    $period = $_GET['period'];
//    $interest = $_GET['interest'];
//    $residual = $_GET['residual'];
//    $euribor = 1;
//    
//    $result = calculate_pay($cost, $residual, $period,$euribor, $interest,$down);
//    $result_status = "OK";
//    $result_message = "the result is $result";
//}

    $cost = $_GET['cost'];
    $down = $_GET['down'];
    $period = $_GET['period'];
    $interest = $_GET['interest'];
    $residual = $_GET['residual'];
    $euribor = 1;
    
    
    echo "variables are<br> $cost<br>$down<br>$period<br>$interest<br>$residual<br>";
//    $result = calculate_pay($cost, $residual, $period, $euribor, $interest,$down);
//    $result_message = $result;
//    echo "The result is $result";

//$result_status = "ERROR";
$_SESSION['result'] = $result_status;
$_SESSION['message'] = $result_message;    
function calculate_pay($cost,$residual,$period,$interest,$down,$euribor)
{
    $netcost = $cost - $down;
    $pay = depreciation($netcost, $residual, $period) + finance($netcost, $residual, $euribor, $interest);
    return $pay;
}

function depreciation($netcost,$residual,$period)
{
    $fee = ($netcost - $residual)/$period;
    return $fee;
}

function finance($netcost,$residual,$euribor,$interest)
{
    $fee = ($netcost + $residual) *($euribor + $interest);
    $fee = $fee/(2*12*100);
}
echo "result status is $result_status";





$result_status = ""; //valid values: empty string, "OK", "ERROR"
$result_message = "";



// DO NOT EDIT AFTER THIS LINE

require("view.php");