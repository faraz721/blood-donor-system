<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood_donor_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>