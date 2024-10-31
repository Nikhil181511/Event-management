<?php
include 'connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $feedback = $_POST['feedback'];
    $eid = $_POST['eid']; 

    $stmt = $conn->prepare("INSERT INTO Feedback (name, feedback, eid) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $feedback, $eid);

    if ($stmt->execute()) {
        header("Location: Userinterface.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
