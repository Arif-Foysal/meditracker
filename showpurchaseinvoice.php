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
<title>PurchaseInvoice Management</title>
    <!-- Include Bootstrap CDN links for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="navbar.css">
</head>
<body>
<?php require '_nav.php'?>

    <div class="container">
        <h1>Purchase Invoices</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Invoice ID</th>
                    <th>Date Created</th>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Total Price</th>
                    <th></th>
                   
                </tr>
            </thead>
            <tbody>
                <?php
                // Step 2: Establish a connection to the database
                // $connection = mysqli_connect("localhost", "root", "", "pharmacytest4"); uncomment if connection fails
                // Step 3: Execute the SQL query
                //old query(before merging sale and purchase)
                $query = "
                    SELECT * from sinvoice
                    ORDER BY purchaseinvoiceID DESC;
                ";
                $result = mysqli_query($conn, $query);

                // Step 5: Fetch and display data
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id=$row['purchaseInvoiceID'];
                        echo "<tr>";
                        echo "<td>".$row['purchaseInvoiceID']."</td>";
                        echo "<td>".$row['date']."</td>";
                        echo "<td>".$row['EmpID']."</td>";
                        echo "<td>".$row['fname']."</td>";
                        echo "<td>".$row['newPrice']."</td>";
                        

                        echo '<td>
        <form action="invoicedetails.php" method="get">
            <input type="hidden" name="purchaseinvID" value="' . $id . '">
            <button type="submit" class="btn btn-primary" name="view">View</button>
        </form>
     </td>';
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




