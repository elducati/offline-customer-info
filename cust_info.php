<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">

    <title>Offline Customer Information</title>
</head>

<body>
    <div>
        <img src="logo.gif" alt="logo" width="130px" height="39">
        <h1>Offline Customer Information</h1>
    </div>
    <div>
    <form action="cust_info.php" method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="name" class="form-control" id="name" placeholder="Enter name" name="name">
        </div>
        <div class="form-group">
            <label for="number">Mobile Number:</label>
            <input type="text" class="form-control" id="phonenumber" required placeholder="Enter Phone Number" name="phonenumber">
        </div>
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" required class="form-control" id="email" placeholder="Enter e-mail" name="email">
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" class="form-control" id="date" placeholder="Enter date" name="date">            
        </div>

        <div class="form-group">
            <label for="amount">Amount:</label>
            <input type="text" class="form-control" id="amount" placeholder="Enter amount" name="amount">

        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>


</body>

</html>



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


// search email ID
/** */
$query = "SELECT * FROM `customer_record` WHERE `email` = '$email'";
$sqlsearch = mysqli_query($con, $query);
$resultcount = mysqli_num_rows($sqlsearch);

mysqli_query($con, "INSERT INTO `customer_record` (name, email, phonenumber, date, amount)
VALUES ('$name', '$email', '$phonenumber', '$date', '$amount') ")
    or die(mysqli_error($con));


?>