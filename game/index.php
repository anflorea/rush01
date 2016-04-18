<?php
require_once ("Game.class.php");
include ("../sql/sql.php");

$user = '"' . $_SESSION['loggedUser'] . '"';

$sql = "SELECT game_object FROM games WHERE state = 1 AND (p1 = " . $user." OR p2 = ".$user." );";

$query = $conn->query($sql);
if ($query->num_rows == 0)
{
    echo "no game session active!\n";
    header("Location: ../index.php");
}
else
{
    $game = unserialize(base64_decode($query->fetch_row()[0]));
}

//reset game
if ($_POST['nuke'] == "Reset session")
{
    $sql = "UPDATE games SET state = 2 WHERE state = 1 AND (p1 = " . $user." OR p2 = ".$user." );";
    $query = $conn->query($sql);
    header("Location: ../index.php");
}

//activate ship if selected and game phase is 0
if ($_GET['activate'] && $game->getPhase() == 0)
{
    $game->activate($_GET['activate'] - 1);
}

switch ($_POST['action'])
{
    case 'speed':
        if ($_POST['pp'] <= $_SESSION['pp'])
            $game->addSpeed($_POST['pp']);
        break;
    case 'shield':
        if ($_POST['pp'] <= $_SESSION['pp'])
            $game->addShield($_POST['pp']);
        break;
    case 'weapon':
        if ($_POST['pp'] <= $_SESSION['pp'])
            $game->addWeapon($_POST['pp']);
        break;
    case 'skip':
        $game->skip();
        break;
    case 'move':
    {
        if ($_POST['dist'] >= $_SESSION['maneuver'] && $_POST['dist'] <= $_SESSION['speed'] && $game->getPhase() == 2)
        $game->moveShip($_POST['dist']);
        break;
    }
    case 'FIRE':
    {
        if ($_SESSION['projectiles'] > 0)
        {
            $colliders = $game->getCollision();
            $game->fire($colliders);
            break;
        }
    }
}
//save game state in session

$saved_game = '"' .base64_encode(serialize($game)) . '"';
$sql = "UPDATE games SET game_object = " . $saved_game . " WHERE state = 1 AND (p1 = " . $user." OR p2 = ".$user." );";
$query = $conn->query($sql);
?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css" />
</head>
<body>
    <div id="tile"></div>

    <div id="ships">
        <?php
            $game->printAllShips();
        ?>
    </div>

    <div id="panel">
        <form action="index.php" method="POST">
            <input type="submit" name="nuke" value="Reset session" class="submit" />
        </form>
        <div id = "info">
            Player: <?php echo $game->getPlayer(); $_SESSION['player'] = $game->getPlayer();?> <br /><br />
            <span style="<?php if($game->getPhase() == 1) echo 'color: red;'?>">Command phase</span><br />
            <span style="<?php if($game->getPhase() == 2) echo 'color: red;'?>">Movement phase</span><br />
            <span style="<?php if($game->getPhase() == 3) echo 'color: red;'?>">Shooting phase</span><br />
            <br />
            <?php
            if ($game->getPhase() == 0)
                echo '<span style ="color: red;">Activate a ship!</span>';
            if ($game->getPhase() == 1)
            {
                echo '<span style ="color: red;">PP Available: ' . $_SESSION['pp'] . '</span><br/>';
                echo '<span style ="color: red;">Speed: ' . $_SESSION['speed'] . '</span><br/>';
                echo '<span style ="color: red;">Projectiles: ' . $_SESSION['projectiles'] . '</span><br/>';
                echo '<span style ="color: red;">Shield: ' . $_SESSION['shield'] . '</span><br/>';
                echo '<span style ="color: red;">Maneuver: ' . $_SESSION['maneuver'] . '</span>';
                echo '
            <form action="index.php" method="POST">
                PP to spend: <input type="text" name="pp" size="2"><br>
                <input type="submit" name="action" value="speed" class="submit" /><br>
                <input type="submit" name="action" value="shield" class="submit" /><br>
                <input type="submit" name="action" value="weapon" class="submit" /><br>
                <input type="submit" name="action" value="skip" class="submit" /><br>
            </form>
                ';
            }
            if ($game->getPhase() == 2)
            {
                echo 'Move between '.$_SESSION['maneuver'].' and '.$_SESSION['speed'].'<br />';
                echo '
                <form action="index.php" method="post">
                Distance to move: <input type="text" name="dist" size="3"><br>
                <input type="submit" name="action" value="move" class="submit" /><br>
                <input type="submit" name="action" value="skip" class="submit" /><br>
                </form>
                ';
            }
            if ($game->getPhase() == 3)
            {
                echo '
                    <span style ="color: red;">Projectiles: ' . $_SESSION['projectiles'] . '</span><br/>
                <form action="index.php" method="post">
                <input type="submit" name="action" value="FIRE" class="submit" /><br>
                <input type="submit" name="action" value="skip" class="submit" /><br>
                </form>
                    ';
            }
            ?>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.js" ></script>
    <?php
    $player = $game->getPlayer();
    $user = '"' . $_SESSION['loggedUser'] . '"';
    $sql = "SELECT * FROM games WHERE p" . $player . " = " . $user . " AND state = 1;";
    echo $sql;
    echo $conn->query($sql)->num_rows;
    if ($conn->query($sql)->num_rows == 0)
        echo '<script type="text/javascript" src="../js/theGame.js" ></script>';
    ?>
</body>
</html>
