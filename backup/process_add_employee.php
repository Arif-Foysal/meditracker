<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //connect to DB
require_once('connect.php');
 // Get data from the form
 $fname = $_POST["fname"];
 $lname = $_POST["lname"];
 $dob = $_POST["dob"];
 $date_of_work = $_POST["date_of_work"];
 $mobilePhone = $_POST["mobilePhone"];
 $email = $_POST["email"];
 $address = $_POST["address"];
 $salary = $_POST["salary"];
 $role = $_POST["role"];

 // SQL query to insert data into the employee table
 $sql = "INSERT INTO employee (fname, lname, date_of_birth, date_of_work, mobilePhone, email, address, salary, role)
         VALUES ('$fname', '$lname', '$dob', '$date_of_work', '$mobilePhone', '$email', '$address', $salary, '$role')";

 if ($conn->query($sql) === TRUE) {
     echo "New employee added successfully!";
 } else {
     echo "Error: " . $sql . "<br>" . $conn->error;
 }

 // Close the connection
 $conn->close();
}

?>

