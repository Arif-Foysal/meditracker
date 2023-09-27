<!-- User verification -->
<?php
     require_once ('connect3.php');
     session_start();
     if(!isset($_SESSION['id'])){
      header("Location:patientlogin.php");
      exit();
  }
?>
<!DOCTYPE html>
<html>
<head>
<title>Stored Drugs</title>
    <!-- Include Bootstrap CDN links for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="navbar.css">
</head>
<body>
<?php require '_nav.php'?>

    <div class="container">
        <h1>Available Drugs</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Drug ID</th>
                    <th>Drug Name</th>
                    <th>Scientific Name</th>
                    <th>Category</th>
                    <th>Manufacturer</th>
                    <th>Unit Price</th>
                    <th>Total Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Step 2: Establish a connection to the database
                
                // $connection = mysqli_connect("localhost", "root", "", "pharmacytest4"); uncomment if connection fails

                // Step 3: Execute the SQL query
                //old query(before merging sale and purchase)
                $query = "
                    SELECT
                        sd.drugID,
                        d.drugName,
                        d.scientificName,
                        d.drugCategory,
                        d.manufacturer,
                        d.unitPrice,
                        SUM(sd.quantity) AS totalQuantity
                    FROM
                        storedDrug sd
                    JOIN
                        drug d ON sd.drugID = d.drugID
                    GROUP BY
                        sd.drugID, d.drugName, d.scientificName, d.drugCategory, d.manufacturer, d.unitPrice
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
                        echo "<td>".$row['totalQuantity']."</td>";
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
    </div>
</body>
</html>




