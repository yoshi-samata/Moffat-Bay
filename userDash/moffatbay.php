<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Moffatbay";



$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$boatname = $_POST['boatname'];
$boatlength = $_POST['boatlength'];
$userpass = password_hash($_POST['password'], PASSWORD_DEFAULT);
$sql = "INSERT INTO user_account (email, fname, lname, boatname, boatlength, userpass)
        VALUES ('$email', '$fname', '$lname', '$boatname', '$boatlength', '$userpass')";


//$password = password_hash($_POST['password']);



if ($conn->query($sql) === TRUE) {
    echo "New record created";

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}