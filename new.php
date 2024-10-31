<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url("d7.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }

        form {
            background: rgba(255, 255, 255, 0.178);
            /* Adjust opacity for transparency */
            backdrop-filter: blur(10px);
            /* Add blur effect */
            padding: 40px;
            /* Increased padding for the form */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(246, 246, 246, 0.767);
            /* Adjusted shadow for depth */
            width: 300px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        select,
        input[type="submit"] {
            padding: 10px;
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 100%;
            box-sizing: border-box;
        }

        select:focus,
        input[type="submit"]:focus {
            outline: none;
            border-color: #0056b3;
            box-shadow: 0px 0px 4px rgba(0, 86, 179, 0.4);
        }

        input[type="submit"] {
            background-color: #0056b3;
            color: #ffffff;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #004080;
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
    <form action="used_check.php" method="POST">
        <label for="eid">Select Event:</label>
        <select id="eid" name="eid" required>
            <?php
            include 'connect.php';
            $events = $conn->query("SELECT eid, ename FROM Event");
            while ($event = $events->fetch_assoc()) {
                echo "<option value='" . $event['eid'] . "'>" . $event['ename'] . "</option>";
            }
            ?>
        </select>

        <label for="oid">Select Organizer:</label>
        <select id="oid" name="oid" required>
            <?php
            $organizers = $conn->query("SELECT oid, ofname FROM Organizer");
            while ($organizer = $organizers->fetch_assoc()) {
                echo "<option value='" . $organizer['oid'] . "'>" . $organizer['ofname'] . "</option>";
            }
            ?>
        </select>

        <input type="submit" value="Submit">
    </form>
</body>