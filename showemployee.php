<!-- admin verification -->

<?php
     require_once ('connect3.php');
     session_start();
     if(!isset($_SESSION['id']) || !isset($_SESSION['role']) || $_SESSION['role']!='admin'){
      header("Location:patientlogin.php");
      exit();
  }
?>
  <!DOCTYPE html>
<html>
<head>
<title>Show Employee</title>
    <!-- Include Bootstrap CDN links for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="navbar.css">
</head>
<body>
<?php require '_nav.php'?>

   
        <h1>Show Employee</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date of Birth</th>
                    <th>Date of Joining</th>
                    <th>Phone no.</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Salary</th>
                    <th>Role</th>
                    <th>Action</th>
                   
                </tr>
            </thead>
            <tbody>
                <?php
                // Step 2: Establish a connection to the database
                // $connection = mysqli_connect("localhost", "root", "", "pharmacytest4"); uncomment if connection fails
                // Step 3: Execute the SQL query
                //old query(before merging sale and purchase)
                $query = "
                SELECT EmpID, fname, lname, date_of_birth, date_of_work, mobilePhone, email, address, salary, role
                FROM employee;
                
                ";
                $result = mysqli_query($conn, $query);

                // Step 5: Fetch and display data
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id=$row['EmpID'];
                        echo "<tr>";
                        echo "<td>".$row['EmpID']."</td>";
                        echo "<td>".$row['fname']."</td>";
                        echo "<td>".$row['lname']."</td>";
                        echo "<td>".$row['date_of_birth']."</td>";
                        echo "<td>".$row['date_of_work']."</td>";
                        echo "<td>".$row['mobilePhone']."</td>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td>".$row['address']."</td>";
                        echo "<td>".$row['salary']."</td>";
                        echo "<td>".$row['role']."</td>";

                        echo '<td>
        <form action="editemployee.php" method="get">
            <input type="hidden" name="purchaseinvID" value="' . $id . '">
            <button type="submit" class="btn btn-success" name="view">Edit</button>
        </form>
     </td>';
     echo '<td>
        <form action="removeemployee.php" method="get">
            <input type="hidden" name="purchaseinvID" value="' . $id . '">
            <button type="submit" class="btn btn-danger" name="view">Delete</button>
        </form>
     </td>';
     
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
            </tbody>
        </table>
  
</body>
</html>




