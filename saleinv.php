<!-- 
    TODO
    -[x] Add Totalprice Functionality
    -[ ] Style Totalprice
    - jkjk



 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale Invoice</title>
    <link rel="stylesheet" href="saleinvStyle.css">
</head>
<body>
    <div class="left">
        <div class="date&id">
            <label for="invoiceId">Invoice ID:</label>
            <input type="text" id="invoiceId" >
            <br>
            <label for="date">Date:</label>
            <input type="text" id="date" >
        </div>
        <div class="productDetails">
            <label for="productID">Product ID</label>
            <input type="number" id="productID">
            <br>
            <label for="productName">Product Name:</label>
            <input type="text" id="productName">
            <br>
            <label for="unitPrice">Unit Price:</label>
            <input type="text" id="unitPrice">
            <br>
            <label for="manufacturer">Manufacturer:</label>
            <input type="text" id="manufacturer">
            <br>
            <label for="numOfUnits">Number of Units:</label>
            <input type="number" id="numOfUnits">
            <br>
            <label for="discounts">Discounts:</label>
            <input type="number" id="discounts">
        </div>
        <div class="buttons">
            <button id="addToInvoice">Add to Invoice</button>
        </div>
    </div>
    <div class="right">
        <table class="invoicetable">
            <tr>
                <th>Item no.</th>
                <!-- <th>drug id</th> -->
                <th>drug Name</th>
                <th>unit price</th>
                <th>quantity</th>
                <th>discount</th>
                <th>amount</th>
            </tr>
            <!-- Table rows for invoice items will be added here -->
        </table>
        <div class="totalPriceContainer">
            <div>
            <label for="totalPrice">Total Price: </label>
            &nbsp;
            &nbsp;
            &nbsp;
            &nbsp;
            &nbsp;
            &nbsp;
            <span id="totalPrice"></span>
            </div>
            
        </div>
    </div>
  
        <script>
            let totprice=0;
//document.getElementById("totalPrice").innerHTML = "Hello JavaScript"; 
        document.addEventListener("DOMContentLoaded", function () {
            const addToInvoiceButton = document.getElementById("addToInvoice");
            const tableBody = document.querySelector(".right table tbody");
            addToInvoiceButton.addEventListener("click", function () {
                const productName = document.getElementById("productName").value;
                const unitPrice = document.getElementById("unitPrice").value;
                const manufacturer = document.getElementById("manufacturer").value;
                const numOfUnits = document.getElementById("numOfUnits").value;
                const discounts = document.getElementById("discounts").value;
                const newRow = document.createElement("tr");
                let subtotal= (unitPrice * numOfUnits)-discounts;
                newRow.innerHTML = `
                    <td>${tableBody.children.length}</td>
                    <td>${productName}</td>
                    <td>${unitPrice}</td>
                    <td>${numOfUnits}</td>
                    <td>${discounts}</td>
                    <td>${(subtotal).toFixed(2)}</td>
                `;
                totprice+=subtotal;
                document.getElementById("totalPrice").innerHTML = totprice;
                tableBody.appendChild(newRow);

                // Clear input fields after adding to invoice
                // document.getElementById("productName").value = "";
                // document.getElementById("unitPrice").value = "";
                // document.getElementById("manufacturer").value = "";
                // document.getElementById("numOfUnits").value = "";
                // document.getElementById("discounts").value = "";
                

         
        });


    });
    
    </script>
  
</body>
</html>
