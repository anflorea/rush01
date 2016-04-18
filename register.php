<html>
<head>
    <title>
        Register
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
    <div class="main-container">
        <form role="form" id="identicalForm" style="margin-top: 170px;" method="post" action="sql/create.php">
            <?php if ($_GET['error'] == 'exists') echo "<h3 style='color: red;'>User already exists!</h3>"; ?>
            <h2>Create new account:</h2> <br /> <br />
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="nick">Nickname:</label>
                <input type="text" class="form-control" id="nick" name="nick" required>
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwdd" name="pwd" required>
            </div>
            <div class="form-group">
                <label for="pwd-conf">Confirm password:</label>
                <input type="password" class="form-control" id="pwd-conf" name="pwd-conf" required>
            </div>
            <button type="submit" class="btn btn-default">Register</button>
        </form>
    </div>

<?PHP
include('fragments/footer.php');
?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.js" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!--    <script type="text/javascript" src="js/script.js" ></script>-->

<script>
    var password = document.getElementById("pwdd")
        , confirm_password = document.getElementById("pwd-conf");

    function validatePassword(){
        if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>


</body>
</html>