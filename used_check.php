<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eid = $_POST['eid'];
    $oid = $_POST['oid'];

    // Prepare the SQL statement to insert into the Used table
    $stmt = $conn->prepare("INSERT INTO Used (eid, oid) VALUES (?, ?)");
    $stmt->bind_param("ii", $eid, $oid);

    // Execute the insert query
    if ($stmt->execute()) {
        echo "Data successfully inserted into Used table!";
        header("Location: services.html");

    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
}

$conn->close();
?>
