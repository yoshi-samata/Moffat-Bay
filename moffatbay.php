<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Moffatbay";

$conn = new mysqli($servername,$username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['Email'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$boatname = $_POST['boatname'];
$boatlength = $_POST['boatlength'];
$password = password_hash($_POST['password']);

if ($conn->query ($sql=== TRUE)) {
    echo "New record created";
}else{
    echo "Error: " .$sql . "<br>" .$conn->error;
}