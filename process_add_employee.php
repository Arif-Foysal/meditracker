<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //connect to DB
require_once('connect3.php');
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
 $password = $_POST["password"];
// check if email already exists
$sqlCheck= "SELECT * FROM employee  WHERE email='$email'";
        $result = mysqli_query($conn,$sqlCheck);
        $num = mysqli_num_rows($result);
        if($num){
            echo "\nEmail already exists";
        }
        else{
                // SQL query to insert data into the employee table
                $sql = "INSERT INTO employee (fname, lname, date_of_birth, date_of_work, mobilePhone, email, address, salary, role,password)
                 VALUES ('$fname', '$lname', '$dob', '$date_of_work', '$mobilePhone', '$email', '$address', $salary, '$role','$password')";
                 $result = mysqli_query($conn,$sql);
                 if($result){
                    echo "Data inserted successfully";
                }
                else{
                    echo "Data not inserted";
                }
        }
//  if ($conn->query($sql) === TRUE) {
//      echo "New employee added successfully!";
//  } else {
//      echo "Error: " . $sql . "<br>" . $conn->error;
//  }

 // Close the connection
 $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Entry</title>
</head>
<body>
    <div></div>
    <br>
    <br>
    <a href="add_employee.php"><button>Enter another employee</button></a>
    <a href="index.php"><button>Go Home</button></a>
</body>
</html>