<?php
require('bcrypt.php');

$bcrypt = new Bcrypt(15);

//this is the string/password to hash
$testPassword = "test";

// you can store the hashed string/password in a database
$hashedpassword = $wachtwoord = $bcrypt->hash($testPassword);

//check if strings/passwords match
$checkPassword = $bcrypt->verify($testPassword, $hashedpassword); //true or false
if ($checkPassword){
	echo "strins/passwords match";
}else{
	echo "strins/passwords don't match";
}

?>