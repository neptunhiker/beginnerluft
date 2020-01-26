<?php

    require "header.php";
    if (!isset($_SESSION['email'])) {
        header("Location: index.php");
    }

?>

<link rel="stylesheet" type="text/css" href="css/style.css">

<main>



	<div class="frame">
		<a href="https://beginnerluft.de">
			<img src="images/BL logo schwarz.png" class=logo>
		</a>

        <button class="logout" onclick="location.href = 'includes/logout.inc.php'">Logout
        </button>

        <h1 class="headerwithlogout"><?php echo $_SESSION['fname']?>'s Dashboard</h2>

        <div class="innerframe">
            <button class="dashboardbutton" onclick="location.href = 'timesheet-overview.php'">Zeiterfassung</button>
            <button class="dashboardbutton">Vorlagen</button>
            <button class="dashboardbutton">Starter Kit</button>
            <button class="dashboardbutton">Profil</button>
        </div>
	</div>
</main>

<?php
    require "footer.php";
?>

