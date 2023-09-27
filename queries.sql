-- stock drugs join view
CREATE view stock AS
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
JOIN
    purchaseInvoice pi ON sd.purchaseInvoiceID = pi.purchaseInvoiceID
WHERE
    pi.type = 'purchase'
GROUP BY
    sd.drugID, d.drugName, d.scientificName, d.drugCategory, d.manufacturer, d.unitPrice;
-- purchaseinvoice join view
create view pinvoice AS
SELECT pi.purchaseInvoiceID, pi.date, pi.EmpID, e.fname, pi.newPrice
FROM purchaseinvoice pi
JOIN employee e ON pi.EmpID = e.EmpID
WHERE pi.status = 'completed' AND pi.type = 'sale';
-- saleinvoice join view
create view sinvoice AS
SELECT pi.purchaseInvoiceID, pi.date, pi.EmpID, e.fname, pi.newPrice
FROM purchaseinvoice pi
JOIN employee e ON pi.EmpID = e.EmpID
WHERE pi.status = 'completed' AND pi.type = 'purchase';




-- update storedDrug info for a particular purchaseInvoiceID
    INSERT INTO `storedDrug` (
    `purchaseInvoiceID`,
    `drugID`,
    `quantity`
    )
    SELECT
    pi.`purchaseInvoiceID`,
    opi.`drugID`,
    opi.`drugQuantity`
    FROM
    `purchaseInvoice` AS pi
    JOIN
    `onpurchaseInvoice` AS opi ON pi.`purchaseInvoiceID` = opi.`purchaseInvoiceID`
    WHERE
    pi.`purchaseInvoiceID` = 1;
-- show what drug available in what quantity(medicines page)
SELECT
    sd.`drugID`,
    d.`drugName`,
    d.`scientificName`,
    d.`drugCategory`,
    d.`manufacturer`,
    d.`unitPrice`,
    SUM(sd.`quantity`) AS totalQuantity
FROM
    `storedDrug` sd
JOIN
    `drug` d ON sd.`drugID` = d.`drugID`
GROUP BY
    sd.`drugID`, d.`drugName`, d.`scientificName`, d.`drugCategory`, d.`manufacturer`, d.`unitPrice`;

--# Selling Mechanism
--Required parameters- drugid,batchno //which batch of the drug you're sellin from
-- grab the purchaseinvoiceID from onpurchaseinvoice table with matching drugID and batchNo
SELECT `purchaseInvoiceID`
FROM `onpurchaseInvoice`
WHERE `drugID` = 1 AND `batchNo` = 12345;
--decrease value of quantity in storeddrug table with the matching purchaseInvoiceID and drugID
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
echo "quantity updated"





