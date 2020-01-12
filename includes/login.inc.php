<?php

if (isset($_POST['login-submit'])) {
    require "dbh.inc.php";

    $email = $_POST["email"];
    $password = $_POST["pwd"];

    if (empty($email) || empty($password)) {
        header("Location: ../index.php?error=emptyfields&email=".$email);
        exit();
    } else {
        $sql = "SELECT * FROM coaches WHERE email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $results = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($results)) {
                $pwdcheck = password_verify($password, $row["pwd"]);
                if ($pwdcheck == False) {
                    header("Location: ../index.php?error=wrongpassword");
                    exit();
                } elseif ($pwdcheck == True) {
                    session_start();
                    $_SESSION["coach_id"] = $row["id"];
                    $_SESSION["email"] = $row["email"];
                    $_SESSION["fname"] = $row["fname"];
                    $_SESSION["lname"] = $row["lname"];
                    header("Location: ../dashboard.php");
                    exit();
                } else {
                    header("Location: ../index.php?error=wrongpassword");
                    exit();
                }
            } else {
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }

    }
mysqli_stmt_close($stmt);
mysqli_close($conn);
} else {
    header("Location: ../index.php");
    exit();
}
