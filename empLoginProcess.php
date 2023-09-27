<?php
     require_once ('connect3.php');
     session_start();
     if(!isset($_SESSION['id']) || !isset($_SESSION['role'])){
      header("Location:patientlogin.php");
      exit();
  }
    if($_SESSION['role']=='admin'){
        header("Location:adminDashboard.php");
    }
    if($_SESSION['role']=='driver'){
        header("Location:driverDashboard.php");
    }
    if($_SESSION['role']=='pharmacist'){
        header("Location:pharmaDashboard.php");
    }
    
?>

