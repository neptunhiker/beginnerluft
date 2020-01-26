<?php
require_once "includes/pdo.inc.php";
require "header.php";

if (isset($_POST['delete']) && isset($_POST['id'])) {
    $sql = "DELETE FROM coachings WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':id' => $_POST['id']));
    $_SESSION['success'] = 'Coaching Eintrag gelöscht';
    header('Location: timesheet-overview.php');
    return;
}


// Guardian: make sure that id of coaching is present
if (!isset($_GET['id'])) {
    $_SESSION["error"] = "Coaching existiert nicht";
    header("Location: timesheet-overview.php");
    return;
}




$sql = "SELECT * FROM coachings WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(":id" => $_GET['id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row === false) {
    $_SESSION["error"] = "Coaching mit ID ".$_GET['id']." unbekannt";
    header("Location: timesheet-overview.php");
    return;
} else {
    $client = $row["client"];
    $date = $row["coaching_date"];
    $date_arr = explode('-', $date);
    $month = $date_arr[1];
    $year = $date_arr[0];
    $day = $date_arr[2];
    $date_formatted = $day.".".$month.".".$year;
}

?>


<div class="frame">
    <a href="https://www.beginnerluft.de" target="_blank">
        <img src="images/BL logo schwarz.png" alt="BeginnerLuft Logo" class="logo">
    </a>
    <button class="logout" onclick="location.href = 'includes/logout.inc.php'">Logout
    </button>

    <h1>Coaching Eintrag löschen</h1>
    <?php
        echo "<h2>für ".$client." am ".$date_formatted."?</h2>";
    ?>
    <form method="post">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <input type="submit" name="delete" value="Löschen">
    <a href="timesheet-overview.php">Abbrechen</a>
</form>
</div>

