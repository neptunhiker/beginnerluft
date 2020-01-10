<?php

if (isset($_POST['signup-submit'])) {
    require "dbh.inc.php";

    $email = $_POST["email"];
    $password = $_POST["pwd"];
    $passwordrepeat = $_POST["pwd-repeat"];


    if (empty($email) || empty($password) || empty($passwordrepeat)) {
        header("Location: ../signup.php?error=emptyfields&email=".$email);
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidemail");
        exit();
    } elseif ($password !== $passwordrepeat) {
        header("Location: ../signup.php?error=passwordcheck&email=".$email);
        exit();
    } else {
        $sql = "SELECT emailUsers FROM users WHERE emailUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultcheck = mysqli_stmt_num_rows($stmt);
            if ($resultcheck > 0) {
                header("Location: ../signup.php?error=emailalreadyexists");
                exit();
            } else {
                $sql = "INSERT INTO users (emailUsers, pwdUsers) VALUES (?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                } else {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "ss", $email, $hashedPwd);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../index.php?signup=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: ../signup.php");
    exit();
}
