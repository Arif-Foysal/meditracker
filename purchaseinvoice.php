<!-- 
    ToDo
    -[x ] save & gen new button functionality. save = purchaseinvoice(status)=complete, gen new=create a purchaseinvoice table with status=draft
    -[ x] show purchaseinvoiceID beginning of the page
 -->
<!-- Employee verification -->
<?php
     require_once ('connect3.php');
     session_start();
     if(!isset($_SESSION['id']) || !isset($_SESSION['role'])){
      header("Location:patientlogin.php");
      exit();
  }
  $empID = $_SESSION['id']; // Replace with the actual EmpID you're looking for
  $totalprice=0;
  $purchaseinvID=null;
    $sql = "SELECT *
        FROM purchaseinvoice
        WHERE EmpID = $empID AND status = 'draft' AND type='purchase'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $purchaseinvID=$row['purchaseInvoiceID'];}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Purchase Invoice</title>
  </head>
  <body>
  <?php require '_nav.php'?>
  
    <h1>Purchase Invoice</h1>
    <hr>


    

<!-- Buttons -->
    <form action="" method="post">
    <button type="submit" name="addtoinv" class="btn btn-success" id="addtoinv">Add To Invoice</button>
    </form>
    <form action="" method="post">
    <button type="save" name="save" class="btn btn-secondary" id="save">Save & Generate New</button>
</form>
   
<?php
    echo "<div class=\"card\" style=\"width: 18rem;\">
        <div class=\"card-header\">
        Invoice ID: {$purchaseinvID}
        </div>
    </div>";
?>

    <?php
  
  
    if($purchaseinvID){
    //add to invoice functionality
    //variable passing
if(isset($_POST['addtoinv'])){
    
    $url="onpurchase.php?purchaseinvID=" . $purchaseinvID;
    header('Location: ' . $url);
    header(Location: index.php);
}

    //show the draft table
    echo '  <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Drug ID</th>
                            <th>Drug Name</th>
                            <th>Scientific Name</th>
                            <th>Category</th>
                            <th>Manufacturer</th>
                            <th>Unit Price</th>
                            <th>Total Quantity</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody> ';
                    $query = "
                    SELECT o.drugID, d.drugName,d.scientificName,d.drugCategory,d.manufacturer,d.unitPrice, o.drugQuantity, o.drug_price_total
FROM onpurchaseInvoice o
JOIN drug d ON o.drugID = d.drugID
WHERE o.purchaseInvoiceID = $purchaseinvID;

                ";
                $result = mysqli_query($conn, $query);

                // Step 5: Fetch and display data
                
                if (mysqli_num_rows($result) > 0) {
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$row['drugID']."</td>";
                        echo "<td>".$row['drugName']."</td>";
                        echo "<td>".$row['scientificName']."</td>";
                        echo "<td>".$row['drugCategory']."</td>";
                        echo "<td>".$row['manufacturer']."</td>";
                        echo "<td>".$row['unitPrice']."</td>";
                        echo "<td>".$row['drugQuantity']."</td>";
                        echo "<td>".$row['drug_price_total']."</td>";
                        echo "</tr>";
                        //totalprice
                        $currentPrice=$row['drug_price_total'];
                        $totalprice+=$currentPrice;
                       
                    }
                    echo "<tr>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td><strong>Total Price:</strong></td>";
                    echo "<td>$totalprice</td>";
                    echo "</tr>";
                    //save button function
                    

  if($purchaseinvID){
    if(isset($_POST['save'])){
        //update purchaseinvoice
        $updatestatus="UPDATE purchaseinvoice
        SET status = 'completed', newPrice=$totalprice
        WHERE purchaseinvoiceID = $purchaseinvID;
        ";
        $updateres=mysqli_query($conn, $updatestatus);
        //update storeddrug
        $updatestored="INSERT INTO storedDrug (purchaseInvoiceID, drugID, quantity)
        SELECT opi.purchaseInvoiceID, opi.drugID, opi.drugQuantity
        FROM onpurchaseInvoice opi
        WHERE opi.purchaseInvoiceID = $purchaseinvID;
        ";
        $updatestoredres=mysqli_query($conn, $updatestored);
        //show alert
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Invoice Saved Successfully
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }

  }
  
  //save function end
                }
                // echo $totalprice;
} else {
    //if there's no purchaseinv with status=draft, create one
    $createinv="INSERT INTO purchaseinvoice (type,date,status, empID)
    VALUES ('purchase',CURDATE(),'draft', $empID);
    ";
    $createinvres=mysqli_query($conn,$createinv);
}
?>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    
    </form>
  </body>
</html>
