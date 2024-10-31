<?php
include 'connect.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $totalAmount = isset($_POST['totalAmount']) ? $_POST['totalAmount'] : 0; // Get the total amount
    $discount = isset($_POST['discount']) ? $_POST['discount'] : 0; // Default to 0 if not provided
    $amountPaid = $_POST['amountpaid'];
    $amountDue = $_POST['amountdue'];
    $grandTotal = isset($_POST['grandTotal']) ? $_POST['grandTotal'] : 0; // Get the grand total

    // Prepare the SQL statement to insert the data into the Budgets table
    $stmt = $conn->prepare("INSERT INTO Budget (totalamount, discount, amountpaid, amountdue, grandtotal) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ddddd", $totalAmount, $discount, $amountPaid, $amountDue, $grandTotal);

    // Execute the insert query
    if ($stmt->execute()) {
        // Redirect to a success page or another relevant page after successful insertion
        echo "Event added successfully."; // Change this to your success page
        header("Location: index.html");
        exit();
        
    } else {
        echo "Error: " . $stmt->error; // Display an error message if the query fails
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
