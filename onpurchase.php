<!-- 
ToDo
-[ x ] id&quantity both fields should be filled, otherwise send alert
-[ ] 

 -->


<!-- Employee verification -->
<?php
     require_once ('connect3.php');
     session_start();
     if(!isset($_SESSION['id']) || !isset($_SESSION['role'])){
      header("Location:patientlogin.php");
      exit();
  }
  // if(!isset($_GET['purchaseinvID'])){
  //   header('Location: purchaseinvoice.php');
  // }
 
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>On Purchase</title>
  </head>
  <body>
  <?php require '_nav.php'?>


  <div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h2>Add to Purchase Invoice</h2>
        </div>
        <div class="card-body">
   
          <form method="post" action="#">
            <div class="form-group">
              <label for="drugid">Drug ID</label>
              <input type="text" class="form-control" id="drugid" name="drugid" placeholder="Enter Drug ID">
            </div>
            <div class="form-group">
              <label for="drugName">Drug Name</label>
              <input type="text" class="form-control" id="drugname" name="drugname" placeholder="Enter Drug Name">
            </div>
            <div class="form-group">
              <label for="quantity">Quantity</label>
              <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity">
            </div>

            <br>
            <button type="submit" name="check" class="btn btn-warning" id="checkAvailability">Check Availability</button>
            <button type="submit" name="submit" class="btn btn-success">Add To Purchase Invoice</button>
          </form>
        </div>
      </div>
      <?php
            // Check availability
            if(isset($_POST['check'])){
                $id=  $_POST["drugid"];
                $name= $_POST["drugname"];
              if($id){
                $sql= "SELECT * FROM stock  WHERE drugID='$id'";
                $result=mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                  $row = mysqli_fetch_assoc($result);
                  $drugid= $row['drugID'];
                  $drugName = $row['drugName'];
                  $scientificName = $row['scientificName'];
                  $manufacturer = $row['manufacturer'];
                  $unitPrice =  $row['unitPrice'];	
                  $totalQuantity 	=  $row['totalQuantity'];	
                  echo ' <table class="table">
                  <thead class="table-success">
                    <tr>
                      <th scope="col">Drug Name</th>
                      <th scope="col">Drug ID</th>
                      <th scope="col">Scientific Name</th>
                      <th scope="col">Manufacturer</th>
                      <th scope="col">Unit Price</th>
                      <th scope="col">Quantity Available</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                  
                      <td>' .$drugName. '</td>
                      <td>' .$drugid. '</td>
                      <td>' .$scientificName. '</td>
                      <td>' .$manufacturer. '</td>
                      <td>' .$unitPrice. '</td>
                      <td>' .$totalQuantity. '</td>
                    </tr>
                  
                  </tbody>
                </table> ';
              }
              
            }
            elseif($name){
                    
        // Check availability based on drugName
        $sql = "SELECT * FROM stock WHERE drugName LIKE '%$name%'";
        $result = mysqli_query($conn, $sql);

        echo '<table class="table">
              <thead class="table-success">
                <tr>
                <th scope="col">Drug ID</th>
                  <th scope="col">Drug Name</th>
                  <th scope="col">Scientific Name</th>
                  <th scope="col">Manufacturer</th>
                  <th scope="col">Unit Price</th>
                  <th scope="col">Quantity Available</th>
                </tr>
              </thead>
              <tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
            $drugid=$row['drugID'];
            $drugName = $row['drugName'];
            $scientificName = $row['scientificName'];
            $manufacturer = $row['manufacturer'];
            $unitPrice = $row['unitPrice'];
            $totalQuantity = $row['totalQuantity'];

            echo '<tr>
            <td>' . $drugid . '</td>
                  <td>' . $drugName . '</td>
                  <td>' . $scientificName . '</td>
                  <td>' . $manufacturer . '</td>
                  <td>' . $unitPrice . '</td>
                  <td>' . $totalQuantity . '</td>
                </tr>';
        }

        echo '</tbody></table>';
    
            }
          }
         
          ?>
          <!-- Purchase button functionality -->
          <?php
          
          if(isset($_POST['submit'])){
            $purchaseinvoiceID=$_GET['purchaseinvID'];
            $drugid= $_POST["drugid"];
            $totalQuantity=$_POST["quantity"];
            //calculating total price
            $totquery="SELECT unitPrice
            FROM drug
            WHERE drugID = $drugid;
            ";
            $totresult=mysqli_query($conn, $totquery);
            if (mysqli_num_rows($totresult) > 0) {
              $row = mysqli_fetch_assoc($totresult);
              $price=$row['unitPrice'];
            }

              $totalprice= $price*$totalQuantity;
            $query="INSERT INTO onpurchaseInvoice (drugID, purchaseInvoiceID, drugQuantity, drug_price_total, batchNo, manufactureDate, expiryDate, date_of_entry)
            VALUES ($drugid, $purchaseinvoiceID, $totalQuantity,$totalprice , 123, '2023-08-26', '2024-08-26', CURDATE());";
            
            echo '<script>window.location.href = "purchaseinvoice.php";</script>';
          $res= mysqli_query($conn, $query);

          //redirect back to purchaceinvoice page
          echo '<script>window.location.href = "purchaseinvoice.php";</script>';
      exit();
        }
          ?>
          <br>
          <a href="purchaseinvoice.php"> <button type="submit" name="submit" class="btn btn-danger">Go Back</button></a>
         
          
         
    </div>
    
  </div>
  
</div>










    <!-- Optional JavaScript; choose one of the two! -->


    

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

  </body>
</html>

