<?php
/**
 * Created by PhpStorm.
 * User: anghergh
 * Date: 17/04/16
 * Time: 16:13
 */

include("sql.php");

$user = '"' . $_SESSION['loggedUser'] . '"';
$sql = "SELECT * FROM games WHERE state = 1 AND (p1 = " . $user." OR p2 = ".$user." );";
$query = $conn->query($sql);

if ($query->num_rows != 0)
    echo true;
else
    echo false;

?>