<?php
/**
 * Created by PhpStorm.
 * User: anghergh
 * Date: 17/04/16
 * Time: 12:12
 */

require_once("../game/Game.class.php");
include ("sql.php");

$mail = '"' . $_SESSION['loggedUser'] . '"';
$sql = "SELECT * FROM games WHERE state = 0 AND p1 = " . $mail . ";";
$query = $conn->query($sql);

if ($_SESSION['loggedUser'] && $query->num_rows == 0) {
    $id = $_POST['id'];
    $user = '"' . $_SESSION['loggedUser'] . '"';
    $game = '"' . base64_encode(serialize(new Game())) . '"';

    $sql = "UPDATE games SET p2 = " . $user . ", state = 1, game_object = " . $game . " WHERE id = " . $id . ";";
    echo $sql . "\n";
    $query = $conn->query($sql);

    $conn->close();
}

?>