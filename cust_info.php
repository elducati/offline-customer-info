<?php

// This function will run within each post array including multi-dimensional arrays
function ExtendedAddslash(&$params)
{
    foreach ($params as &$var) {
        // check if $var is an array. If yes, it will start another ExtendedAddslash() function to loop to each key inside.
        is_array($var) ? ExtendedAddslash($var) : $var = addslashes($var);
        unset($var);
    }
}

// Initialize ExtendedAddslash() function for every $_POST variable
if(!empty($_POST['submit'])) {
ExtendedAddslash($_POST);
$name = $_POST['name'];
$email = $_POST['email'];
$phonenumber = $_POST['phonenumber'];
$date = $_POST['date'];
$amount = $_POST['amount'];



$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'al_offline_data';

$con = mysqli_connect($db_host, $db_username, $db_password, $db_name);
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

// search 

$query = "SELECT count(*) FROM `customer_record` WHERE `email` = '.$email.'";
$sqlsearch = mysqli_query($con, $query);
$resultcount = mysqli_num_rows($sqlsearch);



mysqli_query($con, "INSERT INTO `customer_record` (name, email, phonenumber, date, amount)
VALUES ('$name', '$email', '$phonenumber', '$date', '$amount') ")
    or die(mysqli_error($con));
echo 'submit successful';
}

?>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
