<div class="header">
    <?PHP
        $user = $_SESSION['loggedUser'];
        if (strlen($user) == 0) {
            echo '
		        <div class="menu-div" data-toggle="modal" data-target="#loginModal">
		        Login
		        </div>
		        ';
        }
        else
        {
            echo '
			<a href="../sql/logout.php"><div class="menu-div">
			Logout
			</div></a>
			';
        }
    ?>
</div>