<!-- Employee verification -->
<?php
     require_once ('connect3.php');
     session_start();
     if(!isset($_SESSION['id']) || !isset($_SESSION['role'])){
      header("Location:patientlogin.php");
      exit();
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pharmacy Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .wrapper {
    display: flex;
    justify-content: center;
    align-items:baseline;
    min-height: 100vh;
    margin: 0;
    background-color: #F6F6F6;
  }
  a{
    text-decoration: none;
    color: black;
  }
  .card-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content:center;
    background-color: #2A363B;
    
  }
  .card-container img{
    width: 80px; /* Adjust as needed */
    height: auto;
  }
  .card {
    width: 300px;
    height: 300px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    /* background-color: #ffffff;
     */
     background-color:  #cf4647;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s, box-shadow 0.2s;
  }
  .card p{
    font-family:monospace;
    /* font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; */
    font-size: 2rem;
  }
  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 8px 12px rgba(0, 0, 0, 0.15);
    /* background-color: ; */
    background-color: #F5D061;
  }
  .card button{
    height: auto;
    width: 100%;
    background-color: #a6ceee;
  }
  .dashtitle{
    background-color: #4592AF;
    text-align:center;
    color:white;
    font-family:monospace;
  }
</style>
</head>
<body>
<?php require '_nav.php'?>

<?php>
    <div class="dashtitle">
    <h1>Pharmacy Dashboard</h1>
</div>
    <div class="wrapper">
        <div class="card-container">
            <a href="showstock.php"><div class="card"><img src="assets/products.png" alt="products logo"> <p>Products</p></div> </a>
            <a href="index.php"><div class="card"><img src="assets/employee.png" alt=""><p>Employee</p></div> </a>
            <a href="index.php"><div class="card"><img src="assets/supply.png" alt=""> <p>Suppliers</p></div> </a>
            <a href="saleinvoice.php"><div class="card"><img src="assets/saleinvoice.png" alt=""> <p>Sale Invoice</p></div> </a>
            <a href="purchaseinvoice.php"><div class="card"><img src="assets/purchaseinvoice.png" alt=""><p>Purchase Invoice</p></div> </a>
            <a href="index.php"><div class="card"><img src="assets/expired.png" alt=""><p>Expiration</p></div> </a>
            <a href="index.php"><div class="card"><img src="assets/returned.png" alt=""><p>Returned Drugs</p></div> </a>
            
            
          </div>
    </div>
 
</body>
</html>
