CREATE TABLE `patient` (
  `patientID` int PRIMARY KEY,
  `fname` varchar(255),
  `lname` varchar(255),
  `dob` date,
  `bloodtype` varchar(255),
  `gender` varchar(255),
  `phoneNumber` varchar(255),
  `emergencyContact` varchar(255)
);

CREATE TABLE `driver` (
  `driverID` int PRIMARY KEY,
  `EmpID` int
);

CREATE TABLE `ambulance` (
  `ambulanceID` int PRIMARY KEY,
  `driverID` int,
  `regNo` varchar(255),
  `locID` int,
  `status` varchar(255)
);

CREATE TABLE `location` (
  `locID` int PRIMARY KEY,
  `ambulanceID` int,
  `lastUpdated` time,
  `coordinates` point
);

CREATE TABLE `trip` (
  `tripID` int PRIMARY KEY,
  `patientID` int,
  `driverID` int,
  `paymentID` int,
  `status` varchar(255),
  `source` varchar(255),
  `destination` varchar(255),
  `startedAt` datetime
);

CREATE TABLE `payment` (
  `paymentID` int PRIMARY KEY,
  `tripID` int,
  `amount` int,
  `createdAt` datetime
);

CREATE TABLE `ratings` (
  `ratingsID` int PRIMARY KEY,
  `patientID` int,
  `driverID` int,
  `tripID` int,
  `rating` int,
  `feedback` varchar(255)
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
  `role` varchar(255)
);

CREATE TABLE `customer` (
  `customerID` int PRIMARY KEY,
  `fname` varchar(255),
  `lname` varchar(255),
  `mobilePhone` varchar(255),
  `email` varchar(255),
  `pharmacyName` varchar(255),
  `address` varchar(255),
  `city` varchar(255)
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
  `drugID` int PRIMARY KEY,
  `batchNo` int,
  `manufactureDate` DATE,
  `expiryDate` DATE,
  `quantity` int
);

CREATE TABLE `saleInvoice` (
  `saleInvoiceID` int PRIMARY KEY,
  `EmpID` int,
  `customerID` int,
  `date` DATE,
  `totalAmount` int,
  `paymentType` varchar(255),
  `discount` int,
  `newPrice` int
);

CREATE TABLE `purchaseInvoice` (
  `purchaseInvoiceID` int PRIMARY KEY,
  `date` DATE,
  `paymentType` varchar(255),
  `totalAmount` int,
  `EmpID` int,
  `supplierID` int,
  `discount` int,
  `newPrice` int,
  `payedAmount` int,
  `remainingAmount` int
);

CREATE TABLE `onpurchaseInvoice` (
  `drugID` int,
  `purchaseInvoiceID` int,
  `drugQuantity` int,
  `drug_price_total` int,
  `batchNo` int,
  `manufactureDate` DATE,
  `expiryDate` DATE,
  `date_of_entry` DATE,
  PRIMARY KEY (`drugID`, `purchaseInvoiceID`)
);

CREATE TABLE `onSaleInvoice` (
  `drugID` int,
  `saleInvoiceID` int,
  `drugQuantity` int,
  `drug_price_total` int,
  PRIMARY KEY (`drugID`, `saleInvoiceID`)
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

CREATE TABLE `donor` (
  `DonorID` int PRIMARY KEY,
  `fname` varchar(255),
  `lname` varchar(255),
  `dob` date,
  `gender` varchar(255),
  `bloodtype` varchar(255),
  `phoneNumber` varchar(255)
);

CREATE TABLE `donation` (
  `donationID` int PRIMARY KEY,
  `DonorID` int,
  `donationDate` date,
  `amount` int
);

CREATE TABLE `bloodBag` (
  `bagID` int PRIMARY KEY,
  `donationID` int,
  `bloodtype` varchar(255),
  `storageLocation` varchar(255)
);

CREATE TABLE `recipient` (
  `recipientID` int PRIMARY KEY,
  `patientID` int,
  `fname` varchar(255),
  `lname` varchar(255),
  `dob` date,
  `bloodtype` varchar(255),
  `gender` varchar(255),
  `phoneNumber` varchar(255)
);

CREATE TABLE `transfusion` (
  `transfusionID` int PRIMARY KEY,
  `recipientID` int,
  `donationID` int,
  `transfusionDate` date,
  `bloodtype` varchar(255),
  `amount` int
);

ALTER TABLE `trip` ADD FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`);

ALTER TABLE `trip` ADD FOREIGN KEY (`driverID`) REFERENCES `driver` (`driverID`);

ALTER TABLE `trip` ADD FOREIGN KEY (`paymentID`) REFERENCES `payment` (`paymentID`);

ALTER TABLE `ratings` ADD FOREIGN KEY (`tripID`) REFERENCES `trip` (`tripID`);

ALTER TABLE `ratings` ADD FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`);

ALTER TABLE `ratings` ADD FOREIGN KEY (`driverID`) REFERENCES `driver` (`driverID`);

ALTER TABLE `ambulance` ADD FOREIGN KEY (`locID`) REFERENCES `location` (`locID`);

ALTER TABLE `driver` ADD FOREIGN KEY (`EmpID`) REFERENCES `employee` (`EmpID`);

ALTER TABLE `ambulance` ADD FOREIGN KEY (`driverID`) REFERENCES `driver` (`driverID`);

ALTER TABLE `saleInvoice` ADD FOREIGN KEY (`EmpID`) REFERENCES `employee` (`EmpID`);

ALTER TABLE `purchaseInvoice` ADD FOREIGN KEY (`EmpID`) REFERENCES `employee` (`EmpID`);

ALTER TABLE `saleInvoice` ADD FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`);

ALTER TABLE `purchaseInvoice` ADD FOREIGN KEY (`supplierID`) REFERENCES `supplier` (`supplierID`);

ALTER TABLE `onSaleInvoice` ADD FOREIGN KEY (`saleInvoiceID`) REFERENCES `saleInvoice` (`saleInvoiceID`);

ALTER TABLE `onSaleInvoice` ADD FOREIGN KEY (`drugID`) REFERENCES `drug` (`drugID`);

ALTER TABLE `onpurchaseInvoice` ADD FOREIGN KEY (`drugID`) REFERENCES `drug` (`drugID`);

ALTER TABLE `storedDrug` ADD FOREIGN KEY (`drugID`) REFERENCES `drug` (`drugID`);

ALTER TABLE `onpurchaseInvoice` ADD FOREIGN KEY (`purchaseInvoiceID`) REFERENCES `purchaseInvoice` (`purchaseInvoiceID`);

ALTER TABLE `donation` ADD FOREIGN KEY (`DonorID`) REFERENCES `donor` (`DonorID`);

ALTER TABLE `bloodBag` ADD FOREIGN KEY (`donationID`) REFERENCES `donation` (`donationID`);

ALTER TABLE `transfusion` ADD FOREIGN KEY (`recipientID`) REFERENCES `recipient` (`recipientID`);

ALTER TABLE `transfusion` ADD FOREIGN KEY (`donationID`) REFERENCES `donation` (`donationID`);

ALTER TABLE `recipient` ADD FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`);
