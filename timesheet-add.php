<?php
    require "header.php";
    // require "includes/dbh.inc.php";
    require_once "includes/pdo.inc.php";


// <!-- Check whether user had signed in before -->
    if (isset($_SESSION['email'])) {

        $stmt = $pdo->query("SELECT * FROM clients ORDER BY title ASC, fname ASC");
    } else {
        header("Location: index.php");
    }
?>
<main>
<div class="frame">
    <a href="https://www.beginnerluft.de" target="_blank">
        <img src="images/BL logo schwarz.png" alt="BeginnerLuft Logo" class="logo">
    </a>
    <button class="logout" onclick="location.href = 'includes/logout.inc.php'">Logout
    </button>

    <h1 class="headerwithlogout">Coaching hinzufügen</h1>
    <h2>für <?php echo $_SESSION['fname']?></h2>

    <form action="includes/timesheet.inc.php" method="post">

        <p class="normalheader">Klient</p>

        <?php
            echo "<select name='client'>";
            echo "<option hidden disabled selected value> -- bitte auswählen -- </option>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
               $client = $row['title']." ".$row['fname']." ".$row['lname'];
                echo "<option>".$client."</option>";
            }

            echo "</select>";
        ?>

        <p class="normalheader">Datum</p>
        <input type="date" id="datepicker" name="date"/>

        <p class="normalheader">Beginn</p>
        <input type="time" name="starttime"/>

        <p class="normalheader">Anzahl an Unterrichtseinheiten</p>
        <select name="UE">
            <option hidden disabled selected value> -- bitte auswählen -- </option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
        </select>

        <p class="normalheader">Modul</p>
        <select  name="module">
            <option hidden disabled selected value> -- bitte auswählen -- </option>
            <option>Modul 01: Profiling</option>
            <option>Modul 02: Zielformulierung und Strategiebildung</option>
            <option>Modul 03: Kompetenzen und Ressourcen</option>
            <option>Modul 04: Arbeitsmark und Bildungssystem in Deutschland</option>
            <option>Modul 05: Entwicklungscoaching</option>
            <option>Modul 06: Bewerbungsmanagement</option>
            <option>Modul 07: Networking</option>
            <option">Modul 08: Abschluss</option>
        </select>

        <p class="normalheader">Kommentar</p>
        <textarea id="commentary" name="commentary" placeholder="Bitte Inhalte des Coachings kurz und knapp beschreiben."></textarea>

        <button id="submit" type="submit" name="timesheet-submit"/>Daten speichern</button>
        <div id="successmessage"></div>

    </form>
</div>

    <!-- jQuery (Bootstrap JS plugin depend on it) -->
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
<!--     <script type="text/javascript" src="js/script-timesheet.js"></script> -->

</main>

<?php
    require "footer.php";
?>
