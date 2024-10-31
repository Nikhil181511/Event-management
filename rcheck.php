<?php
include 'connect.php'; // Connect to the database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form values
    $cfname = $_POST['fname'];
    $cmname = $_POST['mname'];
    $clname = $_POST['lname'];
    $phnno = $_POST['no'];
    $eid = $_POST['eid']; // Event ID if needed

    // Prepare the SQL statement to insert data into the Customer table
    $stmt = $conn->prepare("INSERT INTO customer (cfname, cmname, clname, phnno, eid) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $cfname, $cmname, $clname, $phnno, $eid);

    // Execute the query
    if ($stmt->execute()) {
        echo "Customer registration successful!";
        header("Location: Userinterface.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
