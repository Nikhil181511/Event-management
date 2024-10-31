<?php
include 'connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $city = $_POST['city'];
    $state = $_POST['state'];
    $area = isset($_POST['area']) ? $_POST['area'] : ''; // Area can be optional
    $ofname = $_POST['ofname'];
    $omname = isset($_POST['omname']) ? $_POST['omname'] : ''; // Middle name can be optional
    $olname = $_POST['olname'];
    $pass = $_POST['password'];

    // Prepare the SQL statement to check if the ofname, olname, and password already exist
    $checkStmt = $conn->prepare("SELECT * FROM Organizer WHERE ofname = ? AND olname = ? AND password = ?");
    $checkStmt->bind_param("sss", $ofname, $olname, $pass);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        echo "Error: A record with the same first name, last name, and password already exists.";
    } else {
        // Prepare the SQL statement to insert the data into the Organizer table
        $stmt = $conn->prepare("INSERT INTO Organizer (city, state, area, ofname, omname, olname, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $city, $state, $area, $ofname, $omname, $olname, $pass);

        // Execute the insertion query
        if ($stmt->execute()) {
            // Redirect to a success page or another relevant page after successful insertion
            header("Location: event.html");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    }

    // Close the check statement
    $checkStmt->close();
}

// Close the database connection
$conn->close();
?>
