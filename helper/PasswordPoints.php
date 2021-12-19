<?php

// Parse password validation into bits

function RegEx($pattern, $str)
{
    global $passwordPoint;
    preg_match($pattern, $str, $match);
    if (count($match) > 0) {
        // Return if pattern matches
        return $passwordPoint += 1;
    }
}


function PasswordLength($str)
{
    global $passwordPoint;

    // Return if string contains more than 8 chars
    if (strlen($str) > 8) {
        return $passwordPoint += 1;
    }
}
