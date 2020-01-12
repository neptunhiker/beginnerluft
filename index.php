<?php
    require "header.php";
    if (isset($_SESSION["email"])) {
        header("Location: dashboard.php");
    }
?>

<main>
    <link rel="stylesheet" type="text/css" href="css/style-login.css">
    <div id="login-form">
        <a href="https://www.beginnerluft.de">
            <img src="images/BL logo schwarz.png">
        </a>
        <div id="welcome">
            Hallo Beginner
        </div>
        <div id="subtitle">
            Login für personlisierte Funktionen
        </div>

        <form action="includes/login.inc.php" method="post">
            <input type="email" name="email" placeholder="E-Mail Adresse" class="input-fields">
            <p id="email-message"></p>
            <input type="password" name="pwd" placeholder="Passwort" class="input-fields">

            <button type="submit" name="login-submit">
                Login
            </button>
            <p id="login-message"></p>
        </form>
        <form action="signup.php" method="post">
            <button type="submit" class="subtle">Signup</button>
        </form>';

    </div>

</main>


<?php
    require "footer.php";
?>
