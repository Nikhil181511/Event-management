<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $etype = $_POST['etype'];
    $ename = $_POST['ename'];
    $timestart = $_POST['timestart'];
    $timeend = $_POST['timeend'];
    $noofguests = $_POST['noofguests'];
    // Check if the combination of event name, type, and start time already exists
    $stmt = $conn->prepare("SELECT * FROM Event WHERE ename = ? AND etype = ? AND timestart = ?");
    $stmt->bind_param("sss", $ename, $etype, $timestart);
    $stmt->execute();
    $result = $stmt->get_result();

    // If no matching event is found, proceed to insert
    if ($result->num_rows === 0) {
        // Prepare and bind SQL statement to insert the event data
        $stmt_insert = $conn->prepare("INSERT INTO Event (etype, ename, timestart, timeend, noofguests) VALUES (?, ?, ?, ?, ?)");
        // Correct bind_param types: "ssssi" where "i" is for the integer
        $stmt_insert->bind_param("ssssi", $etype, $ename, $timestart, $timeend, $noofguests);

        // Execute the insert query
        if ($stmt_insert->execute()) {
            // Redirect to book.php after successful insertion
            header("Location: new.php");
            exit();
        } else {
            echo "Error: " . $stmt_insert->error;
        }

        $stmt_insert->close();
    } else {
        echo "An event with the same name, type, and start time already exists.";
    }

    $stmt->close();
}

$conn->close();
?>
