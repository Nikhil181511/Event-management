<?php
// Include database connection
include 'connect.php';

// Ensure 'oid' is set from the previous form or query
if (!isset($_GET['oid'])) {
    die("Organizer ID not specified.");
}

$oid = $_GET['oid'];

// Fetch events organized by the specific organizer
$sql = "SELECT e.eid, e.ename, e.timestart, e.timeend 
        FROM Event e 
        JOIN Used u ON e.eid = u.eid 
        WHERE u.oid = ?";
$stmt = $conn->prepare($sql);

// Check if the statement preparation was successful
if (!$stmt) {
    die("Statement preparation failed: " . $conn->error);
}

$stmt->bind_param("i", $oid);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Events</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url("8.jpg");
            background-repeat: no-repeat;
            background-size: cover; 

        }
        table {
            width: 100%;
            background-color: white;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: wheat;
            color:black;
        }
        .btn{
            background-color: blue;
            padding: 10px 20px;
            text-decoration: none;
            color: black;
        }
        .btn:hover {
            background-color: black;
            color:white;
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
            margin-top: -5%;
        }
        h2{
            color: black;
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
    <h2>Events Organized by Organizer ID: <?php echo htmlspecialchars($oid); ?></h2>
    <table>
        <tr>
            <th>Event ID</th>
            <th>Event Name</th>
            <th>Event Start</th>
            <th>Event End</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['eid']); ?></td>
                <td><?php echo htmlspecialchars($row['ename']); ?></td>
                <td><?php echo htmlspecialchars($row['timestart']); ?></td>
                <td><?php echo htmlspecialchars($row['timeend']); ?></td>
                <td>
                    <a href="edit.php?eid=<?php echo $row['eid']; ?>&oid=<?php echo $oid; ?>">Edit</a> |
                    <a href="delete.php?eid=<?php echo $row['eid']; ?>&oid=<?php echo $oid; ?>" onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <a href="event.html?oid=<?php echo $oid; ?>">
        <button class="btn"><b>Add New Event</b></button>
    </a>
    </div>
</body>
</html>

<?php
// Close the prepared statement and database connection
$stmt->close();
$conn->close();
?>
