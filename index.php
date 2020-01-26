<?php
    require "header.php";
    if (isset($_SESSION["email"])) {
        header("Location: dashboard.php");
    }
?>

<main>

    <div class=frame>

        <a href="https://www.beginnerluft.de">
            <img class=logo src="images/BL logo schwarz.png">
        </a>
        <h1>Herzlich Willkommen</h1>
        <div class="innerframe">
            <form action="includes/login.inc.php" method="post">
                <input type="email" name="email" placeholder="E-Mail Adresse" class="input-fields">
                <p id="email-message"></p>
                <input type="password" name="pwd" placeholder="Passwort" class="input-fields">

                <button type="submit" name="login-submit">
                    Login
                </button>
                <p id="login-message"></p>
            </form>

            <a href="signup.php" id="signup">signup</a>
        </div>


    </div>

</main>


<?php
    require "footer.php";
?>
