<?php
/**
 * Created by PhpStorm.
 * User: anghergh
 * Date: 17/04/16
 * Time: 12:38
 */

include ("sql.php");

$sql = "SELECT p1, id FROM games WHERE state = 0";
$query = $conn->query($sql);

while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
    $arr[] = $row;
}

echo json_encode($arr);

$conn->close();

?>