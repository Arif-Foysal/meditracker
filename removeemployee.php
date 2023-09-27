
<!-- admin verification -->
<?php
     require_once ('connect3.php');
     session_start();
     if(!isset($_SESSION['id']) || !isset($_SESSION['role']) || $_SESSION['role']!='admin'){
      header("Location:patientlogin.php");
      exit();
  }



  if (isset($_GET['purchaseinvID'])) {
    $empID = $_GET['purchaseinvID'];

    // Now you can use $purchaseinvID in your code
    // ...
    
$query = "DELETE FROM employee
WHERE EmpID = $empID";

if (mysqli_query($conn, $query)) {
mysqli_close($conn); // Close the database connection
// header("Location: showemployee.php"); // Redirect to showemployee.php
echo ' <div class="alert alert-warning" role="alert">
Employee Deleted!
</div>  ';


echo '  <a href="showemployee.php"><button type="button" class="btn btn-danger">Go Back</button></a>  ';

} else {
echo "Error deleting record: " . mysqli_error($conn);
}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
 
</body>
</html>