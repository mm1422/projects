<?php
$host = 'localhost';
$username = 'root';
$password = '';  
$dbname = 'saapalvelu';  

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Yhteys epäonnistui: " . $conn->connect_error);
}

?>