<?php
$servername = "10.20.0.113";
$username = "rush01";
$password = "42cluj";
$db = "rush01";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection to DB failed: " . $conn->connect_error);
} ?>