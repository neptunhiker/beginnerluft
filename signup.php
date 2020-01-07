<?php
    require "header.php";
?>

<main>
    <div id="login-form">
        <a href="https://www.beginnerluft.de">
            <img src="images/BL logo schwarz.png">
        </a>
        <form action="includes/signup.inc.php" method="post">
            <input type="email" name="email" placeholder="E-Mail Adresse" class="input-fields">
            <input type="password" name="pw" placeholder="Passwort" class="input-fields">
            <input type="password" name="pw-repeat" placeholder="Passwort wiederholen" class="input-fields">
            <button id="login" type="submit" name="signup-submit">
                Sign up
            </button>
            <p id="login-message"></p>
        </form>
    </div>
</main>


<?php
    require "footer.php";
?>
