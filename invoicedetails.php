
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
<title>Invoice Details</title>
    <!-- Include Bootstrap CDN links for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="navbar.css">
</head>
<body>
<?php
if (isset($_GET['purchaseinvID'])) {
    $purchaseinvID = $_GET['purchaseinvID'];

    // Now you can use $purchaseinvID in your code
    // ...
}
?>
<?php require '_nav.php'?>

    <div class="container">
 <?php   echo '  <table class="table table-striped">
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

                // Fetch and display data
                
    echo "<div class=\"card\" style=\"width: 18rem;\">
        <div class=\"card-header\">
        Invoice ID: {$purchaseinvID}
        </div>
    </div>";
    
                if (mysqli_num_rows($result) > 0) {
                    $totalprice=0;
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
                    echo "</tr>";}?>
    </div>
            <a href="showsaleinvoice.php"><button type="button" class="btn btn-danger">Go Back</button></a>
</body>

</html>




