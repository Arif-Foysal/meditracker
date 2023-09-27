<?php
    $success=false;
    $emailExists=true;
    $passwordMatch=true;
if(isset($_POST['submit'])){

    include 'connect3.php';

    $email= $_POST["email"];
    $password= $_POST["password"];

    $emailCheck= "SELECT * FROM employee  WHERE email='$email'";
    $checkRes=mysqli_query($conn, $emailCheck);
    $num = mysqli_num_rows($checkRes);
    if($num==0){
        // email doesn't exists
        $emailExists=false;
      
    }
    else{
        $sql = "select * from employee where email='$email' and password='$password'";
$result=mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
if ($num == 1) {
  $row = mysqli_fetch_assoc($result);
  session_start();
  $_SESSION['id'] = $row['EmpID'];
  $_SESSION['email'] = $row['email'];
  $_SESSION['role'] = $row['role'];
  header("Location:empLoginProcess.php");
  exit();
} else {
  $passwordMatch=false;
  echo "Invalid password";
}

 }
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Log In</title>
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="navbar.css"> -->
</head>
<body>
<?php require '_nav.php'?>

<?php
if($emailExists==false){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Alert!</strong> Email doesnot exist in database
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';

}
if($passwordMatch==false){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Invalid Password!</strong> Please enter the correct password
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    
}


?>



<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h2>Staff Log In</h2>
        </div>
        <div class="card-body">
          <form method="post" action="#">
         
          

            
          
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
            </div>

           
            
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Password"required>
            </div>
            <br>
            <button type="submit" name="submit" class="btn btn-primary">Log In</button>
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