<?php
// Include database connection
include 'connect.php';

// Check if 'eid' is provided in the URL
if (!isset($_GET['eid'])) {
    die("Event ID not specified.");
}

$eid = $_GET['eid'];

// Fetch the current event details
$sql = "SELECT eid, ename, timestart, timeend FROM Event WHERE eid = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Statement preparation failed: " . $conn->error);
}

$stmt->bind_param("i", $eid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Event not found.");
}

$event = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Event</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            height: 100vh;
            background-image: url("11.jpg");
            background-repeat: no-repeat;
            background-size: cover; 
        }
        form {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 5px;
        }
        label {
            margin-bottom: 10px;
            display: block;
            font-weight: bold;
        }
        input[type="text"], input[type="time"] {
            width: 80%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .navbar-container {
    top: 0; /* Aligns it to the top */
    left: 0;
    right: 0;
    margin: 5px 5px;
    position: fixed;
    z-index: 1;
    width: 100%;
    background-color: #f8f9fa;
    display: flex;
    justify-content: center;
    padding: 10px;
    margin-bottom: 10%;
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.1);
    margin: 0; /* Remove margins */
}

        .navbar {
            display: flex;
        }
        .navbar ul {
            display: flex;
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .navbar li {
            margin: 0 20px;
        }
        .navbar a {
            text-decoration: none;
            font-size: 18px;
            color: #007BFF;
            font-weight: bold;
            transition: color 0.3s ease-in-out;
            padding: 8px 15px;
            border-radius: 5px;
        }
        .navbar a:hover {
            color: #fff;
            background-color: #007BFF;
            box-shadow: 0px 4px 15px rgba(0, 123, 255, 0.4);
        }
        .navbar a:active {
            background-color: #0056b3;
            color: #fff;
            box-shadow: inset 0px 4px 10px rgba(0, 123, 255, 0.3);
        }
        /* Responsive design */
        @media (max-width: 600px) {
            .navbar ul {
                flex-direction: column;
                text-align: center;
            }
            .navbar li {
                margin: 10px 0;
            }
        }
        .full{
            margin-top: 10%;
        }
        h1{
            color:white;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="navbar-container">
        <nav class="navbar">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="ask.html">Book</a></li>
                <li><a href="Userinterface.php">Events</a></li>
            </ul>
        </nav>
    </div>
    <div class="full">
    <h1>Edit Event</h1>
       <form action="evup.php" method="POST">
        <input type="hidden" name="eid" value="<?php echo htmlspecialchars($event['eid']); ?>">
        <label for="etype">Event Type:</label>
            <input type="text" id="etype" name="etype" required><br>

        <label for="ename">Event Name:</label>
        <input type="text" id="ename" name="ename" value="<?php echo htmlspecialchars($event['ename']); ?>" required>

        
        <label for="timestart">Start Time:</label>
        <input type="datetime-local" id="timestart" name="timestart" value="<?php echo htmlspecialchars($event['timestart']); ?>" required>

        <label for="timeend">End Time:</label>
        <input type="datetime-local" id="timeend" name="timeend" value="<?php echo htmlspecialchars($event['timeend']); ?>" required>
        <input type="hidden" name="oid" value="<?php echo $_GET['oid']; ?>">

        <input type="submit" value="Update Event">
    </form>  
    </div>
   
   
</body>
</html>

<?php
// Close the prepared statement and database connection
$stmt->close();
$conn->close();
?>
