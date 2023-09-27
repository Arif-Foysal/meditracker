<?php
//fdfkdjslkfj
    $success=false;
    $emailExists=false;
if(isset($_POST['submit'])){

    include 'connect3.php';
    $fname= $_POST["firstName"];
    $lname= $_POST["lastName"];
    $email= $_POST["email"];
    $dob= $_POST["dob"];
    $bloodtype= $_POST["bloodType"];
    $gender= $_POST["gender"];
    $password= $_POST["password"];

    $emailCheck= "SELECT * FROM patient  WHERE email='$email'";
    $checkRes=mysqli_query($conn, $emailCheck);
    $num = mysqli_num_rows($checkRes);
    if($num){
        // echo "email already exists.";
        $emailExists=true;
    }
    else{
        $sql = "INSERT INTO patient (fname, lname, dob, bloodtype, gender, `password`,email)
        VALUES ('$fname', '$lname', '$dob', '$bloodtype', '$gender', '$password','$email')";
$result=mysqli_query($conn, $sql);
if($result){
    $success=true;
}
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="navbar.css"> -->
</head>
<body>
<?php require '_nav.php'?>

<?php
if($emailExists){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Sign Up Failed!</strong> Email already exists in Database
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';

}
if($success){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your account is now created.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    
}


?>



<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h2>Sign Up</h2>
        </div>
        <div class="card-body">
          <form method="post" action="#">
            <div class="form-group">
              <label for="firstName">First Name</label>
              <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter first name">
            </div>
            <div class="form-group">
              <label for="lastName">Last Name</label>
              <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter last name">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
            </div>
            <div class="form-group">
              <label for="dob">Date of Birth</label>
              <input type="date" class="form-control" id="dob" name="dob">
            </div>
            <div class="form-group">
              <label for="gender">Gender</label>
              <select class="form-control" id="gender" name="gender">
              <option value="male">Male</option>
                <option value="female">Female</option>
               
                <!-- Add other blood types here -->
              </select>
            </div>
            <div class="form-group">
              <label for="bloodType">Blood Type</label>
              <select class="form-control" id="bloodType" name="bloodType">
              <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <!-- Add other blood types here -->
              </select>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Password"required>
            </div>
            <br>
            <div class="d-grid gap-2 col-6 mx-auto">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Signup</button>
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