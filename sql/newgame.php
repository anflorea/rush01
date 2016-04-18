<?php
/**
 * Created by PhpStorm.
 * User: anghergh
 * Date: 17/04/16
 * Time: 12:03
 */

include ("sql.php");

$user = '"'. $_SESSION['loggedUser'] . '"';

$sql = "SELECT * FROM games WHERE p1 = " .$user . " AND state <= 1;";
$query = $conn->query($sql);

if ($query->num_rows == 0 && $_SESSION['loggedUser'] != "") {
    $sql = "INSERT INTO games (p1, state) VALUES ($user, 0)";
    $query = $conn->query($sql);
}
$conn->close();

?>