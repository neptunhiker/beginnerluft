<?php
    require "header.php";
    // require "includes/dbh.inc.php";
    require_once "includes/pdo.inc.php";


// <!-- Check whether user had signed in before -->
    if (isset($_SESSION['email'])) {

        $stmt_clients = $pdo->query("SELECT * FROM clients");
        $stmt_modules = $pdo->query("SELECT * FROM modules");
        $stmt = $pdo->prepare("SELECT * FROM coachings WHERE id = :id");
        $stmt->execute(array(":id" => $_GET['id']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row === false) {
            $_SESSION['error'] = "Coaching mit ID ".$_GET['id']." unbekannt";
            header("Location: timesheet-overview.php");
            return;
        }
    } else {
        header("Location: index.php");
    }

    $coaching_id = htmlentities($row["id"]);
    $coach_id = htmlentities($row["coach_id"]);
    $client = htmlentities($row["client"]);
    $coaching_date = $row["coaching_date"];
    $time = htmlentities($row["starttime"]);
    $ue = htmlentities($row["ue"]);
    $module = htmlentities($row["module"]);
    $commentary = htmlentities($row["commentary"]);
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

    <form action="includes/timesheet-edit.inc.php" method="post">

        <input type="hidden" name="coaching_id" value="<?= $coaching_id ?>">
        <input type="hidden" name="coach_id" value="<?= $coach_id ?>">

        <p class="normalheader">Klient</p>
        <?php
            echo "<select name='client'>";
            echo "<option hidden disabled selected value> -- bitte auswählen -- </option>";
            while ($row = $stmt_clients->fetch(PDO::FETCH_ASSOC)){
                $client_choice = $row['title']." ".$row['fname']." ".$row['lname'];
                if ($client_choice == $client) {
                   echo "<option selected>".$client_choice."</option>";
                } else {
                    echo "<option>".$client_choice."</option>";
                }
            }

            echo "</select>";
        ?>

        <p class="normalheader">Datum</p>
        <input type="date" id="datepicker" name="coaching_date" value="<?= $coaching_date ?>"/>

        <p class="normalheader">Beginn</p>
        <input type="time" name="starttime" value="<?= $time ?>"/>

        <p class="normalheader">Anzahl an Unterrichtseinheiten</p>
        <select name="ue">
            <option hidden disabled selected value> -- bitte auswählen -- </option>
            <?php
                for ($i = 1; $i<5; $i++) {
                    if ($i == $ue) {
                        echo "<option selected>".$i."</option>";
                    } else {
                        echo "<option>".$i."</option>";
                    }
                }
            ?>
        </select>

        <p class="normalheader">Modul</p>
        <select  name="module">
            <option hidden disabled selected value> -- bitte auswählen -- </option>
            <?php
                while ($row = $stmt_modules->fetch(PDO::FETCH_ASSOC)){
                    if ($row["name"] == $module) {
                        echo "<option selected>".$row["name"]."</option>";
                    } else {
                        echo "<option>".$row["name"]."</option>";
                    }
                }
            ?>
        </select>

        <p class="normalheader">Kommentar</p>
        <textarea id="commentary" name="commentary"><?= $commentary ?></textarea>

        <button id="submit" type="submit" name="timesheet-edit-submit"/>Daten aktualisieren</button>
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
