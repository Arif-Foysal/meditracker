<?php
// pharmacytest
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pharmacytest2";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: \n" . $conn->connect_error);
    }
    else{
        echo "Connected successfully.....\n";
        echo "\n";
   }



?>