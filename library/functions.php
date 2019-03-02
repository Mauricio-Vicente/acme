<?php
/*
 * Custom Functions Library
 */
/*
 * server side validation for email inputs 
*/
function checkEmail($clientEmail){
  $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
  return $valEmail;
} 
/*
 * server side validation for password inputs 
 */

function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])[[:print:]]{8,}$/';
    return preg_match($pattern, $clientPassword);
}








