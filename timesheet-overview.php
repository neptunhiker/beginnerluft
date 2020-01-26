<?php
    require "header.php";
    require_once "includes/pdo.inc.php";
?>

<main>


<!-- Check whether user had signed in before -->
<?php
    if (!isset($_SESSION['email'])) {
        header("Location: index.php");
    }
?>

<div class="frame">
    <a href="https://www.beginnerluft.de" target="_blank">
        <img src="images/BL logo schwarz.png" alt="BeginnerLuft Logo" class="logo">
    </a>
    <button class="logout" onclick="location.href = 'includes/logout.inc.php'">Logout
    </button>

    <h1>Coaching Überblick</h1>
    <h2>für <?php echo $_SESSION['fname']?></h2>

    <button  onclick="location.href='timesheet-add.php'">Coaching hinzufügen</button>

    <?php
        if (isset($_SESSION["success"])) {
            echo "<p class='success-message'>".$_SESSION["success"]."</p>";
            unset($_SESSION["success"]);
        }
    ?>

    <?php
        if (isset($_SESSION["error"])) {
            echo "<p class='error-message'>".$_SESSION["error"]."</p>";
            unset($_SESSION["error"]);
        }
    ?>

    <table>
        <tr>
            <th>Klient</th>
            <th>Datum</th>
            <th>Uhrzeit</th>
            <th>Löschen</th>
            <th>Bearbeiten</th>
        </tr>
        <?php
        $stmt = $pdo->query("SELECT * FROM coachings ORDER BY coaching_date DESC");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            $coaching_id = $row['id'];
            $client = $row['client'];
            $client_short = str_replace(array('Herr ', 'Frau '), array('',''), $client);
            $name_pieces = explode(' ', $client_short);
            $client_first = $name_pieces[0];
            $client_last = array_pop($name_pieces);
            $client_last = substr($client_last, 0, 1);
            $client_show = $client_first." ".$client_last.".";
            $date = $row['coaching_date'];
            $time = $row['starttime'];
            echo "<tr>";
                echo "<td>$client_show</td>";
                echo "<td>$date</td>";
                echo "<td>$time</td>";
                echo "<td><a href='timesheet-delete.php?id=".$coaching_id."'>Löschen</a></td>";
                echo "<td><a href='timesheet-edit.php?id=".$coaching_id."'>Bearbeiten</a></td>";
                echo "</tr>";
        }
    ?>
    </table>

</div>

    <!-- jQuery (Bootstrap JS plugin depend on it) -->
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

</main>

<?php
    require "footer.php";
?>
