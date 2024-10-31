<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event List</title>
    <style>
        body{
            background-image: url("d4.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-attachment: fixed; /* Make the background fixed */
            padding-top: 10px;
            color: #f8f9fa;
            position: relative;
        }
table {
    background-color: #ffffffd2;
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 3px solid #ddd;
}

th, td {
    color:black;
    padding: 12px;
    text-align: left;
}

th {
    color:black;
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #f1f1f1;
}
.navbar-container {
            position: fixed;
            z-index: 1;
            width: 100%;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            padding: 10px;
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.1);
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
        .hi{
            margin-top:50px;
        }
        button.action-btn {
    background-color: #007BFF;
    color: white;
    border: none;
    padding: 8px 16px;
    cursor: pointer;
    border-radius: 5px;
    font-size: 16px;
    margin-right: 10px;
    transition: background-color 0.3s ease-in-out;
}

button.action-btn:hover {
    background-color: #0056b3;
}

button.action-btn:focus {
    outline: none;
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
    <div class="hi">
    <center>
    <h1 style="color:black";>Event List</h1>
</center>
    <table>
        <tr>
            <th>Event ID</th>
            <th>Type</th>
            <th>Name</th>
            <th>Starts</th>
            <th>Ends</th>
            <th>Number of Guests</th>
        </tr>
        <?php
        include 'connect.php';

        $sql = "SELECT eid, etype, ename, timestart, timeend, noofguests FROM event";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["eid"] . "</td>
                        <td>" . $row["etype"] . "</td>
                        <td>" . $row["ename"] . "</td>
                        <td>" . $row["timestart"] . "</td>
                        <td>" . $row["timeend"] . "</td>
                        <td>" . $row["noofguests"] . "</td>
                        <td>
                    <a href='register.php?eid=" . $row["eid"] . "'><button class='action-btn'>Register</button></a>
                    <a href='feedback.html?eid=" . $row["eid"] . "'><button class='action-btn'>Feedback</button></a>
                </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No events found</td></tr>";
        }

        $conn->close();
        ?>
    </table>
    </div>
    
</body>
</html>
