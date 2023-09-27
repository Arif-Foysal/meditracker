<!-- User verification -->
<?php
     require_once ('connect3.php');
     session_start();
     if(!isset($_SESSION['id'])){
      header("Location:patientlogin.php");
      exit();  
  } 
  $id=$_SESSION['id'];
?>
<!DOCTYPE html>
<html>
<head>
<title>Patient Profile</title>
    <!-- Include Bootstrap CDN links for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="navbar.css">
</head>
<body>
<?php require '_nav.php'?>
<!-- Fetch Data -->
<?php
$query = "
SELECT fname
from patient
where patientID=$id;
";
$result = mysqli_query($conn, $query);
if ($result->num_rows > 0) {
    // Fetch the data
    $row = $result->fetch_assoc();
    $fname = $row["fname"];
    echo "<h1>Welcome $fname</h1>";
}


    
?>

<hr>
<div class="col-md-6 container">
  <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Patient ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Date of Birth</th>
                            <th>Gender</th>
                            <th>Blood Type</th>
                        </tr>
                    </thead>
                    <tbody> 
                <?php 
                
                $query = "
                    SELECT fname, lname, email, dob, gender, bloodtype
                    from patient
                    where patientID=$id;
                ";
                $result = mysqli_query($conn, $query);
                

                // Step 5: Fetch and display data
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$id."</td>";
                        echo "<td>".$row['fname']."</td>";
                        
                        echo "<td>".$row['lname']."</td>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td>".$row['dob']."</td>";
                        echo "<td>".$row['gender']."</td>";
                        echo "<td>".$row['bloodtype']."</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<td colspan='7'>No data found.</td>";
                    echo "</tr>";
                }

                // Step 7: Close the database connection
                mysqli_close($conn);
?>
                </div>
            
                    <a href="patientupdateprofile.php">
                    <button type="submit" name="check" class="btn btn-success" id="checkAvailability">Update Profile</button>
                    </a>
               
             
                
              
</body>
</html>
