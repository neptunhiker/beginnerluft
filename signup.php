<?php
    require "header.php";
?>

<main>
    <div id="login-form">
        <a href="https://www.beginnerluft.de">
            <img src="images/BL logo schwarz.png">
        </a>
        <form action="includes/signup.inc.php" method="post">
            <input type="text" name="title" placeholder="Anrede" class="input-fields">
            <input type="text" name="fname" placeholder="Vorname" class="input-fields">
            <input type="text" name="lname" placeholder="Nachname" class="input-fields">
            <input type="email" name="email" placeholder="E-Mail Adresse" class="input-fields">
            <input type="password" name="pwd" placeholder="Passwort" class="input-fields">
            <input type="password" name="pwd-repeat" placeholder="Passwort wiederholen" class="input-fields">
            <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "passwordcheck") {
                        echo  "<p class='signuperror'>Passwörter nicht identisch</p>";
                    }
                }
            ?>
            <button id="login" type="submit" name="signup-submit">
                Signup
            </button>
            <p id="login-message"></p>
        </form>
    </div>
</main>


<?php
    require "footer.php";
?>
