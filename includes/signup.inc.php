<?php

// require "functions.inc.php";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (isset($_POST['signup-submit'])) {
    require "dbh.inc.php";

    $title = test_input($_POST["title"]);
    $fname = test_input($_POST["fname"]);
    $lname =  test_input($_POST["lname"]);
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["pwd"]);
    $passwordrepeat = test_input($_POST["pwd-repeat"]);


    if (empty($title) ||empty($fname) ||empty($lname) ||empty($email) || empty($password) || empty($passwordrepeat)) {
        header("Location: ../signup.php?error=emptyfields&title=".$title."&fname=".$fname."&lname=".$lname."&email=".$email);
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidemail");
        exit();
    } elseif ($password !== $passwordrepeat) {
        header("Location: ../signup.php?error=passwordcheck&email=".$email);
        exit();
    } else {
        $sql = "SELECT email FROM coaches WHERE email=?";
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
                $sql = "INSERT INTO coaches (title, fname, lname, email, pwd) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                } else {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sssss", $title, $fname, $lname, $email, $hashedPwd);
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



