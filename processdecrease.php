<?php
require_once('connect3.php');
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
    echo "Purchase Invoice ID: " . $purchaseInvoiceID;
}

UPDATE `storedDrug`
SET `quantity` = `quantity` - $decreaseBy
WHERE `purchaseInvoiceID` = $purchaseInvoiceID
  AND `drugID` = $drugID;
  $conn->close();
?>