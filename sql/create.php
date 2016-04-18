<?php
/**
 * Created by PhpStorm.
 * User: anghergh
 * Date: 17/04/16
 * Time: 03:49
 */
include("sql.php");

$email = '"' . $_POST['email'] . '"';
$nick = '"' . $_POST['nick'] . '"';
$pwd = '"' . hash("whirlpool", $_POST['pwd']) . '"';


$sql = "SELECT email FROM users WHERE email = $email; ";
$query = $conn->query($sql);

if ($query->num_rows != 0)
    header("Location: ../register.php?error=exists");
else {
    $sql = "INSERT INTO users (email, password, nick) VALUES ($email, $pwd, $nick);";
    $query = $conn->query($sql);
    if (!$query)
        die('Could not enter user into db: ' . $conn->error);
    header("Location: ../index.php?state=success");
}

$conn->close();

?>