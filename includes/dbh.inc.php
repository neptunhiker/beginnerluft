<?php

// $servername = "localhost";
// $dBUsername =  "root";
// $dBPassword = "";
// $dBName = "beginnerlufttest";

// $conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

// if (!$conn) {
//     die("Connection failed: ".mysqli_connect_error());
// }


$servername = "dd44728.kasserver.com";
$dBUsername = "d030beea";
$dBPassword = "AeXHJ6f42DKDb5Xm";
$dBName = "d030beea";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}
