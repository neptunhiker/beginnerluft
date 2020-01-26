<?php

$servername = "dd44728.kasserver.com";
$dBUsername = "d030beea";
$dBPassword = "FRYxeAoN5EwrRcsz";
$dBName = "d030beea";

$pdo = new PDO(
    'mysql:host='.$servername.';dbname='.$dBName,
    $dBUsername,
    $dBPassword
    );

