<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register for Event</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #000;
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url("0.jpg");
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
        }
        .container {
            width: 50%;
            margin: 100px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.178); /* Adjust opacity for transparency */
            backdrop-filter: blur(10px); /* Add blur effect */
            padding: 40px; /* Increased padding for the form */
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            
        }
        h1 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label, input {
            margin: 10px 0;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Register for Event</h1>
        <form action="rcheck.php" method="POST">
            <label for="name">First Name:</label>
            <input type="text" id="fname" name="fname" required>

            <label for="name">Middle Name:</label>
            <input type="text" id="mname" name="mname" >

            <label for="name">Last Name:</label>
            <input type="text" id="lname" name="lname" required>

            <label for="name">Phone no:</label>
            <input type="text" id="no" name="no" required>

            <input type="hidden" name="eid" value="<?php echo $_GET['eid']; ?>">

            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>
