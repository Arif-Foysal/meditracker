<!-- todo -->
<!-- - [ ] Finish this -->



<!-- admin verification -->
<?php
     require_once ('connect3.php');
     session_start();
     if(!isset($_SESSION['id']) || !isset($_SESSION['role']) || $_SESSION['role']!='admin'){
      header("Location:patientlogin.php");
      exit();
  }

  if (isset($_GET['purchaseinvID'])) {
    $id = $_GET['purchaseinvID'];}
  $success=false;
  $emailcount=null;//change if doesnt work
  $emailExists=false;
  
  //fetched variables
  
  
  
  
  //fill the form with data
  if (isset($_POST['firstname'])) {
      $_fname = $_POST['firstname'];
  } else {
      // Default value to pre-fill if form is not submitted
      // $_fname = $fname;
}



if(isset($_POST['submit'])){
    
    $fname= $_POST["firstName"];
    $lname= $_POST["lastName"];
    $dob= $_POST["dob"];
    $phone= $_POST["phone"];
    $email= $_POST["email"];
    $salary= $_POST["salary"];
    $role= $_POST["role"];
    
    
    
    //check email exists or not in database excluding user
    $sql = "SELECT COUNT(*) AS email_count
        FROM employee
        WHERE email = '$email'
        AND empID <> '$id'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $emailcount= $row['email_count'];
    //    echo $emailcount;
    if($emailcount){
        $emailExists=true;

    }
    else{
        //update job here
        $sql = "
    UPDATE employee
    SET fname = '$fname',
        lname = '$lname',
        date_of_birth = '$dob',
        mobilePhone = '$phone',
        email = '$email',
        salary = '$salary',
        role = '$role'
    WHERE empID = $id;
";

if ($conn->query($sql) === TRUE) {
    $success=true;
} else {
    echo "Error updating record: " . $conn->error;
}
        
    }
} 
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Profile</title>
        <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- <link rel="stylesheet" href="navbar.css"> -->
    </head>
    <body>
        <?php require '_nav.php'?>
        
<?php
if($emailExists){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Email already exists in Database
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';

}
if($success){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your account is updated.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    
}


?>

<?php 

//fetch data
$query = "
SELECT fname, lname,date_of_birth, mobilePhone, email, salary, role
FROM employee
WHERE empID = $id;
";

$result = mysqli_query($conn, $query);
// $fname='';
// Step 5: Fetch and display data
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);  // Fetch the row data
    
    $fname = $row['fname'];
    $lname = $row['lname'];
    $dob = $row['date_of_birth'];
    $phone = $row['mobilePhone'];
    $email = $row['email'];
    $salary = $row['salary'];
    $role = $row['role'];
    
    // Now you can use these variables to display the data or further process it
} else {
    echo "No records found...................";
}
// Check if form was submitted and username is set in the POST data
if (isset($_POST['firstname'])) {
    $_fname = $_POST['firstname'];
} else {
    // Default value to pre-fill if form is not submitted
    $_fname = $fname;
}

if (isset($_POST['lastname'])) {
    $_lname = $_POST['lastname'];
} else {
    // Default value to pre-fill if form is not submitted
    $_lname = $lname;
}
if (isset($_POST['dob'])) {
  $_dob = $_POST['dob'];
} else {
  // Default value to pre-fill if form is not submitted
  $_dob = $dob;
}

if (isset($_POST['phone'])) {
    $_phone = $_POST['phone'];
} else {
    // Default value to pre-fill if form is not submitted
    $_phone = $phone;
}

if (isset($_POST['email'])) {
  $_email = $_POST['email'];
} else {
  // Default value to pre-fill if form is not submitted
  $_email = $email;
}

if (isset($_POST['salary'])) {
  $_salary = $_POST['salary'];
} else {
  // Default value to pre-fill if form is not submitted
  $_salary = $salary;
}

if (isset($_POST['role'])) {
  $_role = $_POST['role'];
} else {
  // Default value to pre-fill if form is not submitted
  $_role = $role;
}
?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h2>Update Profile</h2>
        </div>
        <div class="card-body">
          <form method="post" action="#">
            <div class="form-group">
              <label for="firstName">First Name</label>
              <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $_fname; ?>">
            </div>
       
            <div class="form-group">
              <label for="lastName">Last Name</label>
              <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter last name" value="<?php echo $_lname; ?>">
            </div>
            <div class="form-group">
              <label for="dob">Date of Birth</label>
              <input type="date" class="form-control" id="dob" name="dob" required >
            </div>
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="text" class="form-control" id="phone" name="phone" required >
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo $_email; ?>" required>
            </div>
            <div class="form-group">
              <label for="salary">salary</label>
              <input type="text" class="form-control" id="salary" name="salary" placeholder="Enter salary" value="<?php echo $_salary; ?>" required>
            </div>

            <div class="form-group">
              <label for="role">role</label>
              <input type="text" class="form-control" id="role" name="role" placeholder="Enter role" value="<?php echo $_role; ?>" required>
            </div>
              
               
              
           
            <br>
            <div class="d-grid gap-2 col-6 mx-auto">
            <button type="submit" name="submit" class="btn btn-danger btn-block">Update Profile</button>
</div>
            
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>


?>
