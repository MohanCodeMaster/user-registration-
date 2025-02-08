<?php
$servername = "localhost";  // Change if necessary
$username = "root";  // Change to your MySQL username
$password = "";  // Change to your MySQL password
$dbname = "persons_info";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $pinCode = $_POST['pincode'];

    $sql = "INSERT INTO persons (first_name, last_name, age, address, pincode) 
            VALUES ('$first_name', '$last_name', $age, '$address', '$pinCode')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully!<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Personal Information Form</title>
</head>
<body>
    <h2>Enter Your Personal Information</h2>
    <form action="index.php" method="post">
        First Name: <input type="text" name="first_name" required><br><br>
        Last Name: <input type="text" name="last_name" required><br><br>
        Age: <input type="number" name="age" required><br><br>
        Address: <input type="text" name="address" required><br><br>
        Pin Code: <input type="text" name="pincode" required><br><br>
        <input type="submit" value="Submit">
    </form>

    <h2>Stored Data</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th>
            <th>Address</th>
            <th>Pin Code</th>
        </tr>
        <?php
        $sql = "SELECT * FROM persons";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['first_name']}</td>
                        <td>{$row['last_name']}</td>
                        <td>{$row['age']}</td>
                        <td>{$row['address']}</td>
                        <td>{$row['pincode']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No records found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>