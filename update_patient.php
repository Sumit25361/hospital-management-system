<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital_management";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM patients WHERE id = $id";
    $result = $conn->query($sql);
    $patient = $result->fetch_assoc();
} else {
    die("Invalid patient ID.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number = $_POST['number'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $disease = $_POST['disease'];
    $room = $_POST['room'];
    $time = $_POST['time'];
    $deposit = $_POST['deposit'];
    $update_sql = "UPDATE patients SET 
                    number='$number', 
                    name='$name', 
                    gender='$gender', 
                    disease='$disease', 
                    room='$room', 
                    time='$time', 
                    deposit='$deposit' 
                    WHERE id = $id";

    if ($conn->query($update_sql) === TRUE) {
        echo "Patient updated successfully!";
        echo "<br><a href='patient.php'>Go Back</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Patient</title>
</head>
<body>
    <h2>Update Patient Information</h2>
    <form action="update_patient.php?id=<?php echo $id; ?>" method="POST">
        <label for="number">Number:</label>
        <input type="text" id="number" name="number" value="<?php echo $patient['number']; ?>" required />

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $patient['name']; ?>" required />

        <label for="gender">Gender:</label>
        <input type="radio" name="gender" value="Male" <?php echo ($patient['gender'] == 'Male') ? 'checked' : ''; ?> /> Male
        <input type="radio" name="gender" value="Female" <?php echo ($patient['gender'] == 'Female') ? 'checked' : ''; ?> /> Female

        <label for="disease">Disease and Symptoms:</label>
        <textarea id="disease" name="disease" required><?php echo $patient['disease']; ?></textarea>

        <label for="room">Room Number:</label>
        <input type="number" id="room" name="room" value="<?php echo $patient['room']; ?>" required />

        <label for="time">Time:</label>
        <input type="datetime-local" id="time" name="time" value="<?php echo $patient['time']; ?>" required />

        <label for="deposit">Deposit:</label>
        <input type="number" id="deposit" name="deposit" value="<?php echo $patient['deposit']; ?>" required />

        <button type="submit">Update Patient</button>
    </form>
</body>
</html>
