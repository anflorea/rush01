<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>
        Battle
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
<?PHP
    include('fragments/header.php');
?>
<?PHP
    include('fragments/login.html');
?>

<?php if ($_GET['state'] == 'success') echo "<br /><br /><h2 style='color: lime;'>User created successfully!</h2>"; ?>
<div class="lobby-wrapper">

<div id="game-lobby">

</div>
<input type="button" class="btn btn-default" value="Create new game" id="create_game" style="margin-top: 20px;" />
</div>
<div class="another-wrapper">

<div class="chat-wrapper">
    <div class="chat-container" id="the-chat">

    </div>
</div>
<?PHP
if (strlen($_SESSION['loggedUser']) > 0)
    echo '
<div class="message-wrapper">
    <input type="text" class="form-group" style="width: 60%; margin-left: 30px;" id="the-message"/>
    <input type="button" class="btn btn-default" value="Send" id="send-message"/>
</div>

';

?>
</div>
<?PHP
    include('fragments/footer.php');
?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.js" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/script.js" ></script>
</body>
</html>

