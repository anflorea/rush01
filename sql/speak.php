<?php
/**
 * Created by PhpStorm.
 * User: anghergh
 * Date: 17/04/16
 * Time: 11:08
 */

include ("sql.php");

if ($_POST['message'] == "" || $_SESSION['loggedUser'] == "")
    exit();

$email = '"' . $_SESSION["loggedUser"] . '"';
$message = '"' . $_POST["message"] . '"';
$timestamp = "now()";

$sql = "INSERT INTO chat (email, message, timestamp) VALUES ($email, $message, $timestamp)";
$query = $conn->query($sql);

$conn->close();

?>