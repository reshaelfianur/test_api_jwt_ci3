<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function countUniqueChars($str)
{
    return count(array_unique(str_split($str)));
}
function textHasConsecutive($string, $max)
{
    return !preg_match('/(?!.*(.)\1{' . $max . '})^[a-zA-Z0-9.,()-]*$/', $string);
}
function hasUppercase($string)
{
    return preg_match('/[A-Z]/', $string) ? true : false;
}
function hasLowercase($string)
{
    return preg_match('/[a-z]/', $string) ? true : false;
}
function hasNumber($string)
{
    return preg_match('#[\d]#', $string) ? true : false;
}
function hasSymbol($string)
{
    return preg_match('/\W/', $string) ? true : false;
}
function masking($char, $loc = 'after', $notMasked = 4, $atLeast = 8, $maskChar = 'x')
{
    $count = strlen($char);
    $atLeast = ($notMasked >= $atLeast) ? $count : $atLeast;

    if ($loc == 'after') {
        $char = substr($char, 0, $notMasked);
    } else {
        $char = substr($char, -$notMasked);
    }

    $atL = null;
    for ($x = 0; $x < ($atLeast - $notMasked); $x++) {
        $atL .= $maskChar;
    }

    return ($loc == 'after' ? ($char . $atL) : ($atL . $char));
}
