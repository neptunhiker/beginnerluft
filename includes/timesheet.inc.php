<?php

echo isset($_POST['timesheet-submit']);
if (isset($_POST['timesheet-submit'])) {
    require "dbh.inc.php";
    include "functions.inc.php";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
    session_start();

    $coach = $_SESSION["fname"]." ".$_SESSION["lname"];
    $coach_id = $_SESSION["coach_id"];
    $client = test_input($_POST["client"]);
    $date = test_input($_POST["date"]);
    $date_arr = explode('-', $date);
    $month = $date_arr[1];
    $year = $date_arr[0];
    $day = $date_arr[2];
    $starttime = test_input($_POST["starttime"]);
    $starttime_arr = explode(':', $starttime);
    $hour = $starttime_arr[0];
    $minute = $starttime_arr[1];
    $UE = test_input($_POST["UE"]);
    $module = test_input($_POST["module"]);
    $commentary = test_input($_POST["commentary"]);

    if (empty($client) || empty($date) ||  empty($starttime) || empty($UE) || empty($module) || empty($commentary)) {
        header("Location: ../timesheet.php?error=emptyfields&client=".$client."&date=".$date."&starttime=".$starttime."&UE=".$UE."&module=".$module."&commentary=".$commentary);
        exit();
    } elseif (!checkdate($month, $day, $year)) {
        header("Location: ../timesheet.php?error=invaliddate&client=".$client."&starttime=".$starttime."&UE=".$UE."&module=".$module."&commentary=".$commentary.$day.$month.$year);
        exit();
    } elseif (!checktime($hour, $minute)) {
        header("Location: ../timesheet.php?error=invalidtime&client=".$client."&date=".$date."&UE=".$UE."&module=".$module."&commentary=".$commentary.$day.$month.$year);
        exit();
    } else {
        $sql = "INSERT INTO coachings (coach_id, coach, client, coaching_date, starttime, ue, module, commentary) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ssssssss", $coach_id, $coach, $client, $date, $starttime, $UE, $module, $commentary);
            mysqli_stmt_execute($stmt);
            header("Location: ../timesheet.php");
            exit();
        }
    }

mysqli_stmt_close($stmt);
mysqli_close($conn);

} else {
    header("Location: ../index.php");
    exit();
}
