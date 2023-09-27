<!-- <?php
require_once('connect3.php')
?> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="submit" name="submit" value="Execute PHP">
</form>

<?php
// Check if the button is clicked
if(isset($_POST['submit'])) {
    // Your PHP code here
    $drugID = 1;
    $batchNo = 12345;
    $decreaseBy = 15;
    $sql = "SELECT `purchaseInvoiceID`
            FROM `onpurchaseInvoice`
            WHERE `drugID` = $drugID AND `batchNo` = $batchNo";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $purchaseInvoiceID = $row["purchaseInvoiceID"];
        echo "Purchase Invoice ID: " . $purchaseInvoiceID . "<br>";
                // Update the `storedDrug` table
                $updateSql = "UPDATE `storedDrug`
                SET `quantity` = `quantity` - $decreaseBy
                WHERE `purchaseInvoiceID` = $purchaseInvoiceID
                AND `drugID` = $drugID";

   if ($conn->query($updateSql) === TRUE) {
       echo "Quantity updated successfully!";
   } else {
       echo "Error updating quantity: " . $conn->error;
   }
} else {
   echo "No records found.";
}
}
?>

</body>
</html>