<?php
/**
 * Created by PhpStorm.
 * User: anghergh
 * Date: 17/04/16
 * Time: 04:20
 */

include ("sql.php");

$email = '"' . $_POST['email'] . '"';
$pwd = '"' . hash("whirlpool", $_POST['pwd']) . '"';

$sql = "SELECT email FROM users WHERE email = $email AND password = $pwd; ";
$query = $conn->query($sql);

if ($query->num_rows != 0)
    $_SESSION['loggedUser'] = $_POST['email'];

$conn->close();

header("Location: ../index.php");
?>