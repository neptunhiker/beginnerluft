<?php

// function test_input($data) {
//   $data = trim($data);
//   $data = stripslashes($data);
//   $data = htmlspecialchars($data);
//   return $data;
// }

function alert_message($message) {
    echo '<script language="javascript">';
    echo 'alert("message successfully sent")';
    echo '</script>';
}


function checktime($hour, $min) {
     if ($hour < 0 || $hour > 23 || !is_numeric($hour)) {
         return false;
     }
     if ($min < 0 || $min > 59 || !is_numeric($min)) {
         return false;
     }
     return true;
}
