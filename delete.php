<?php
// Include database connection
include 'connect.php';

// Check if 'eid' is provided in the URL
if (!isset($_GET['eid'])) {
    die("Event ID not specified.");
}

$eid = $_GET['eid'];

// Prepare the SQL statement to delete the event
$stmt = $conn->prepare("DELETE FROM Event WHERE eid = ?");

if (!$stmt) {
    die("Statement preparation failed: " . $conn->error);
}

// Bind the parameter
$stmt->bind_param("i", $eid);

// Execute the delete query
if ($stmt->execute()) {
    // Redirect to the update page or display a success message
    header("Location: update.php?oid=" . $_GET['oid']); // Adjust as needed for the organizer ID
    exit();
} else {
    echo "Error deleting event: " . $stmt->error;
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();
?>
