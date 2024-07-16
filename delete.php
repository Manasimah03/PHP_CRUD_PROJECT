<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
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
        <h2>Delete Record</h2>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];

            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'wshop');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL to delete record
            $sql = "DELETE FROM students WHERE id='$id'";
            if ($conn->query($sql) === TRUE) {
                echo '<div class="message success">Record deleted successfully</div>';
            } else {
                echo '<div class="message error">Error deleting record: ' . $conn->error . '</div>';
            }

            $conn->close();
            header("refresh:2; url=view_details.php"); // Redirect after 2 seconds
        }
        ?>
    </div>
</body>
</html>