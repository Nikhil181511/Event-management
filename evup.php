<?php
// Include database connection
include 'connect.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $eid = $_POST['eid'];
    $ename = $_POST['ename'];
    $etype = $_POST['etype'];
    $timestart = $_POST['timestart'];
    $timeend = $_POST['timeend'];
    if (!isset($_GET['oid'])) {
        echo"Event updated";
        header("Location: eve.html");
    }
    
    $oid = $_GET['oid'];
    // Prepare the SQL statement to update the event details
    $stmt = $conn->prepare("UPDATE event SET ename = ?, etype = ?, timestart = ?, timeend = ? WHERE eid = ?");
    
    if (!$stmt) {
        die("Statement preparation failed: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssssi", $ename, $etype, $timestart, $timeend, $eid);
    
    // Execute the update query
    if ($stmt->execute()) {
        // Redirect to the update page or display a success message
        header("Location: Userinterface.php");
        exit();
    } else {
        echo "Error updating event: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
