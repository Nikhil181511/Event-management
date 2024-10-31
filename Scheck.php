<?php
include 'connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $catering = $_POST['catering'];
    $music = $_POST['music'];
    $decoration = $_POST['decoration'];
    $photography = $_POST['photography'];
    $venue = $_POST['venue'];

    $total = $catering + $music + $decoration + $photography + $venue;

    $stmt = $conn->prepare("INSERT INTO Service(catering, music, decoration, photography, venue, total_price) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $catering, $music, $decoration, $photography, $venue, $total);

    if ($stmt->execute()) {
        header("Location: Budget.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>