<?php
/**
 * Created by PhpStorm.
 * User: anghergh
 * Date: 17/04/16
 * Time: 10:45
 */

include ("sql.php");

$sql = "
SELECT u.nick, c.message, c.timestamp FROM chat c
INNER JOIN users u
ON c.email = u.email
ORDER BY c.timestamp DESC
LIMIT 50;
";
$query = $conn->query($sql);

while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
    $arr[] = $row;
}

echo json_encode($arr);

$conn->close();

?>