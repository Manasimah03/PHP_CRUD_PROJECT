<!DOCTYPE html>
<html>
<head>
    <title>Update Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"], input[type="submit"] {
            padding: 10px;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .message {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Details</h2>

        <?php
        $id = $_POST['id'];

        $conn = new mysqli('localhost', 'root', 'wshop');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM students WHERE id='$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        ?>
        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            Name: <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>
            USN: <input type="text" name="usn" value="<?php echo $row['usn']; ?>" required><br>
            Phone Number: <input type="text" name="phone" value="<?php echo $row['phone']; ?>" required><br>
            <input type="submit" name="submit" value="Update">
        </form>
        <?php
        } else {
            echo "<div class='message error'>No record found</div>";
        }
        $conn->close();

        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $usn = $_POST['usn'];
            $phone = $_POST['phone'];

            $conn = new mysqli('localhost', 'root', '', 'wshop');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "UPDATE students SET name='$name', usn='$usn', phone='$phone' WHERE id='$id'";
            if ($conn->query($sql) === TRUE) {
                echo "<div class='message success'>Record updated successfully</div>";
            } else {
                echo "<div class='message error'>Error updating record: " . $conn->error . "</div>";
            }

            $conn->close();
            header("refresh:2; url=view_details.php"); // Redirect after 2 seconds
        }
        ?>
    </div>
</body>
</html>