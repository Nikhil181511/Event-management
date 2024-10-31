<?php
include 'connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Start session and retrieve form data
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the statement to check user credentials
    $stmt = $conn->prepare("SELECT * FROM Organizer WHERE ofname = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a matching record was found
    if ($result->num_rows > 0) {
        // If login is successful, store user info in session
        $_SESSION['username'] = $username;
        $_SESSION['oid'] = session_id(); // Store session ID if needed

        // Redirect to event.html
        header("Location: eve.html");

        exit();
    } else {
        echo "Invalid credentials. Please try again.";
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
