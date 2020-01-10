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

        <?php
            if (isset($_SESSION["UserEmail"])) {
                echo    '<form action="includes/logout.inc.php" method="get">
                        <button type="submit" name="logout-submit">Logout</button>
                    </form>';
            } else {
                echo    '<form action="includes/login.inc.php" method="post">
                    <input type="email" name="email" placeholder="E-Mail Adresse" class="input-fields">
                    <p id="email-message"></p>
                    <input type="password" name="pwd" placeholder="Passwort" class="input-fields">

                    <button id="login" type="submit" name="login-submit">
                        Login
                    </button>
                    <p id="login-message"></p>
                </form>
                <a href="signup.php">
                    <button>Signup</button>
                </a>';
            }
        ?>


    </div>

    <?php
        if (isset($_SESSION["UserEmail"])) {
            echo "<p class='login-status'>You are logged in</p>";
        } else {
            echo "<p class='login-status'>You are logged out</p>";
        }
    ?>

</main>


<?php
    require "footer.php";
?>
