
<?php
     require_once ('connect3.php');
     
     ?>

<style>
  .navbar-brand img{
    width: 80px; /* Adjust as needed */
    height: auto;
  }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">MediTracker</a>
    <!-- <a class="navbar-brand" href="#"><img src="./assets/logo/mtlogo.png" alt="mt logo"></a> -->

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>

        <?php
// show this section when not signed in
        if(!isset($_SESSION['id'])){
          echo '   <li class="nav-item">
          <a class="nav-link" href="signup3.php"> Sign Up</a>
        </li> 
        <li class="nav-item">
          <a class="nav-link" href="patientlogin.php"> Patient Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="employeelogin.php"> Staff Login</a>
        </li>  ';
        
          
        }
        ?>


<!-- Admin Special nav links adminDashboard.php -->
<?php
    if(isset($_SESSION['role']) &&  $_SESSION['role']=='admin'){
      echo ' 
      <li class="nav-item">
      <a class="nav-link" href="adminDashboard.php"> Admin Dashboard</a>
    </li>
      <li class="nav-item">
      <a class="nav-link" href="pharmaDashboard.php">Pharmacy Dashboard</a>
    </li> 
     ';

    }
?>
      <!-- Patient Special nav links adminDashboard.php -->
  <?php
 if(!isset($_SESSION['role'])&&isset($_SESSION['id'])){
  echo ' 
  <li class="nav-item">
  <a class="nav-link" href="patientprofile.php"> Profile</a>
</li>
   ';

 }
//pharmacist nav
if(isset($_SESSION['role']) && $_SESSION['role']=='pharmacist' ){
    echo ' <li class="nav-item">
    <a class="nav-link" href="pharmaDashboard.php">Pharmacy Dashboard</a>
  </li> ';
}


    ?>



      <?php
// show logout button only when signed in
        if(isset($_SESSION['id'])){
          echo ' <li class="nav-item">
          <a class="nav-link" href="logout.php"> Log Out</a>
        </li>  ';
        }
        ?>

      </ul>
      <!-- <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> -->
    </div>
  </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
