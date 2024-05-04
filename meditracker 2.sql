CREATE TABLE `patient` (
  `patientID` int PRIMARY KEY,
  `fname` varchar(255),
  `lname` varchar(255),
  `dob` date,
  `bloodtype` varchar(255),
  `gender` varchar(255),
  `phoneNumber` varchar(255),
  `emergencyContact` varchar(255),
  `password` varchar(255)
);

CREATE TABLE `employee` (
  `EmpID` int PRIMARY KEY,
  `fname` varchar(255),
  `lname` varchar(255),
  `date_of_birth` DATE,
  `date_of_work` DATE,
  `mobilePhone` varchar(255),
  `email` varchar(255),
  `address` varchar(255),
  `salary` int,
  `role` varchar(255),
  `password` varchar(255)
);

CREATE TABLE `supplier` (
  `supplierID` int PRIMARY KEY,
  `companyName` varchar(255),
  `mobilePhone` varchar(255),
  `email` varchar(255),
  `address` varchar(255),
  `city` varchar(255)
);

CREATE TABLE `storedDrug` (
  `id` int PRIMARY KEY,
  `InvoiceID` int,
  `drugID` int,
  `quantity` int
);

CREATE TABLE `Invoice` (
  `InvoiceID` int PRIMARY KEY,
  `patientID` int,
  `date` DATE,
  `paymentType` varchar(255),
  `totalAmount` int,
  `EmpID` int,
  `supplierID` int,
  `discount` int,
  `newPrice` int,
  `payedAmount` int,
  `remainingAmount` int,
  `status` varchar(255),
  `type` varchar(255)
);

CREATE TABLE `onInvoice` (
  `id` int PRIMARY KEY,
  `drugID` int,
  `InvoiceID` int,
  `drugQuantity` int,
  `drug_price_total` int,
  `batchNo` int,
  `manufactureDate` DATE,
  `expiryDate` DATE,
  `date_of_entry` DATE,
  `supplierID` int
);

CREATE TABLE `drug` (
  `drugID` int PRIMARY KEY,
  `drugName` varchar(255),
  `scientificName` varchar(255),
  `drugCategory` varchar(255),
  `manufacturer` varchar(255),
  `unitPrice` int,
  `no_of_units_in_Package` int,
  `storageTempereture` int,
  `dangerousLevel` int,
  `storageLocation` varchar(255)
);

ALTER TABLE `Invoice` ADD FOREIGN KEY (`EmpID`) REFERENCES `employee` (`EmpID`);

ALTER TABLE `onInvoice` ADD FOREIGN KEY (`drugID`) REFERENCES `drug` (`drugID`);

ALTER TABLE `storedDrug` ADD FOREIGN KEY (`drugID`) REFERENCES `drug` (`drugID`);

ALTER TABLE `onInvoice` ADD FOREIGN KEY (`InvoiceID`) REFERENCES `Invoice` (`InvoiceID`);

ALTER TABLE `storedDrug` ADD FOREIGN KEY (`InvoiceID`) REFERENCES `Invoice` (`InvoiceID`);

ALTER TABLE `Invoice` ADD FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`);

ALTER TABLE `onInvoice` ADD FOREIGN KEY (`supplierID`) REFERENCES `supplier` (`supplierID`);
