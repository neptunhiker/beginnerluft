<?php
if (isset($_POST['timesheet-edit-submit'])) {
    session_start();
    require "pdo.inc.php";


    $sql = "UPDATE coachings SET client = :client, coaching_date = :coaching_date, starttime = :starttime, ue = :ue, module = :module, commentary = :commentary WHERE id=:coaching_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ":coaching_id" => $_POST["coaching_id"],
        ":client" => $_POST["client"],
        ":coaching_date" => $_POST["coaching_date"],
        ":starttime" => $_POST["starttime"],
        ":ue" => $_POST["ue"],
        ":module" => $_POST["module"],
        ":commentary" => $_POST["commentary"]
    ));
    $_SESSION["success"] = "Coaching-Daten aktualisiert";
    header("Location: ../timesheet-overview.php");
    return;
}
