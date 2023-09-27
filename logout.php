<?php

@include 'connect3.php';
echo "logout";
session_start();
session_unset();
session_destroy();
header('location:patientlogin.php');
?>
