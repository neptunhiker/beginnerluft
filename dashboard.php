<?php

    require "header.php";
    if (!isset($_SESSION['email'])) {
        header("Location: index.php");
    }

?>



<link rel="stylesheet" type="text/css" href="css/style-dashboard.css">
<title>BeginnerLuft Dashboard</title>

<main>



	<div id="frame">
		<a href="https://beginnerluft.de">
			<img src="images/BL logo schwarz.png">
		</a>
        <a href="includes/logout.inc.php">
            <button class="logout">Logout</button>
        </a>
        <h2><?php echo $_SESSION['fname']?>'s Dashboard</h2>


	<button onclick="location.href = 'timesheet.php'">Zeiterfassung</button>
	<button>Vorlagen</button>
	<button>Starter Kit</button>
    <button>Profil</button>

	</div>
</main>

