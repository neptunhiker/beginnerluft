<?php
    require "header.php";
?>

<main>
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
            <input type="password" name="pw" placeholder="Passwort" class="input-fields">
            <p id="password-message"></p>
            <p id="forgot-password"></p>
            <button id="login" type="submit" name="login-submit">
                Login
            </button>
            <p id="login-message"></p>
        </form>
        <a href="signup.php">Sign-up</a>
        <form action="includes/logout.inc.php" method="get">
            <button type="submit" name="logout-submit">Logout</button>
        </form>
    </div>

    <p>You are logged out</p>
    <p>You are logged in</p>
</main>


<?php
    require "footer.php";
?>
