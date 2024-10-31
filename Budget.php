<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Details Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
            background-image: url("13.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }
        .form-container {
            margin-top: 20%;
            max-width: 500px;
            margin: auto;
            background: rgba(255, 255, 255, 0.386);
            backdrop-filter: blur(2px);
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        h2 {
            text-align: center;
            color: #000;
        }
        label {
            margin-bottom: 10px;
            font-weight: bold;
            display: block;
            color: #555;
        }
        input[type="number"], p {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #5cb85c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        #grandTotal {
            font-weight: bold;
            font-size: 1.2em;
            color: #333;
        }
        .navbar-container {
    top: 0; /* Aligns it to the top */
    left: 0;
    right: 0;
    margin: 5px 5px;
    position: fixed;
    z-index: 1;
    width: 100%;
    background-color: #f8f9fa;
    display: flex;
    justify-content: center;
    padding: 10px;
    margin-bottom: 5%;
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.1);
    margin: 0; /* Remove margins */
}

        .navbar {
            display: flex;
        }
        .navbar ul {
            display: flex;
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .navbar li {
            margin: 0 20px;
        }
        .navbar a {
            text-decoration: none;
            font-size: 18px;
            color: #007BFF;
            font-weight: bold;
            transition: color 0.3s ease-in-out;
            padding: 8px 15px;
            border-radius: 5px;
        }
        .navbar a:hover {
            color: #fff;
            background-color: #007BFF;
            box-shadow: 0px 4px 15px rgba(0, 123, 255, 0.4);
        }
        .navbar a:active {
            background-color: #0056b3;
            color: #fff;
            box-shadow: inset 0px 4px 10px rgba(0, 123, 255, 0.3);
        }
        /* Responsive design */
        @media (max-width: 600px) {
            .navbar ul {
                flex-direction: column;
                text-align: center;
            }
            .navbar li {
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>
<div class="navbar-container">
        <nav class="navbar">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="ask.html">Book</a></li>
                <li><a href="Userinterface.php">Events</a></li>
            </ul>
        </nav>
    </div>
    <?php
    include 'connect.php';

    $sql = "SELECT total_price FROM service";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalAmount = $row['total_price'];
    } else {
        $totalAmount = 0;
    }

    $conn->close();
    ?>
    <div class="form-container">
        <h2>Budget Details</h2>
        <form action="Bjcheck.php" method="POST" onsubmit="return calculateGrandTotal()">
            <label for="totalamount">Total Amount:</label>
            <p id="totalamount"><?php echo htmlspecialchars($totalAmount); ?></p>

            <label for="discount">Discount (10%):</label>
            <input type="number" id="discount" name="discount" value="10" readonly>

            <label for="amountpaid">Amount Paid:</label>
            <input type="number" id="amountpaid" name="amountpaid" step="100.0" required>

            <label for="amountdue">Amount Due:</label>
            <input type="number" id="amountdue" name="amountdue" value="5000" readonly>

            <div id="grandTotal">Grand Total: $<span id="totalDisplay">0.00</span></div>

            <input type="submit" value="Submit">
        </form>
    </div>
    <script>
        function calculateGrandTotal() {
            // Get the total amount
            const totalAmount = parseFloat(document.getElementById("totalamount").innerText);
            const discountPercentage = 10; // Fixed 10% discount
            const amountPaid = parseFloat(document.getElementById("amountpaid").value);
            const amountDue = parseFloat(document.getElementById("amountdue").value); // Defaulted to 5000

            // Calculate the discount amount
            const discountAmount = (totalAmount * discountPercentage) / 100;

            // Calculate the new total after applying discount and amount due
            const grandTotal = totalAmount - discountAmount - amountPaid;

            // Display the grand total
            document.getElementById("totalDisplay").innerText = grandTotal.toFixed(2);

            // Create hidden inputs to send grand total and total amount to the backend
            const hiddenGrandTotal = document.createElement('input');
            hiddenGrandTotal.type = 'hidden';
            hiddenGrandTotal.name = 'grandTotal';
            hiddenGrandTotal.value = grandTotal.toFixed(2);
            document.forms[0].appendChild(hiddenGrandTotal);

            const hiddenTotalAmount = document.createElement('input');
            hiddenTotalAmount.type = 'hidden';
            hiddenTotalAmount.name = 'totalAmount';
            hiddenTotalAmount.value = totalAmount.toFixed(2);
            document.forms[0].appendChild(hiddenTotalAmount);

            return true; // Allow form submission
        }
    </script>
</body>
</html>
