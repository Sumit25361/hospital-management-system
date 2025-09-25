<?php
// Database configuration
$servername = "localhost"; // Database host (use localhost for XAMPP)
$username = "root";        // Default username for XAMPP
$password = "";            // Default password for XAMPP
$dbname = "hospital_management"; // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch patient records
$sql = "SELECT * FROM patients";
$result = $conn->query($sql);

// Close connection after fetching the data
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Information</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h2 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 10px; text-align: center; }
        th { background-color: #4CAF50; color: white; }
        a { text-decoration: none; color: #007BFF; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h2>Patient Information</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Number</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Disease</th>
            <th>Room</th>
            <th>Time</th>
            <th>Deposit</th>
            <th>Actions</th>
        </tr>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['number']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['disease']; ?></td>
                    <td><?php echo $row['room']; ?></td>
                    <td><?php echo $row['time']; ?></td>
                    <td><?php echo $row['deposit']; ?></td>
                    <td>
                        <a href="update_patient.php?id=<?php echo $row['id']; ?>">Update</a>
                    </td>
                    
                </tr>
               
            <?php endwhile; ?>
            <button type="button" onclick="window.location.href='index.html'">Back</button>
        <?php else: ?>
            <tr>
                <td colspan="9">No patients found.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
