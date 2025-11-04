<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital_management";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid patient ID.");
}

$id = (int)$_GET['id'];

// Fetch current patient data
$sql = "SELECT * FROM patients WHERE id = $id";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    die("Patient not found.");
}
$patient = $result->fetch_assoc();

// Handle form submission
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
        echo "<script>alert('Patient updated successfully!'); window.location.href='patient.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Patient</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 40px; }
        h2 { text-align: center; color: #333; }
        form {
            width: 50%;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input[type=text], input[type=number], input[type=datetime-local], textarea {
            width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px; margin-top: 5px;
        }
        input[type=radio] { margin-right: 5px; }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover { background-color: #45a049; }
        .back-btn {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #007BFF;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h2>Update Patient Information</h2>
    <form method="POST">
        <label>Number:</label>
        <input type="text" name="number" value="<?php echo $patient['number']; ?>" required>

        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $patient['name']; ?>" required>

        <label>Gender:</label>
        <input type="radio" name="gender" value="Male" <?php echo ($patient['gender']=='Male')?'checked':''; ?>> Male
        <input type="radio" name="gender" value="Female" <?php echo ($patient['gender']=='Female')?'checked':''; ?>> Female

        <label>Disease and Symptoms:</label>
        <textarea name="disease" required><?php echo $patient['disease']; ?></textarea>

        <label>Room Number:</label>
        <input type="number" name="room" value="<?php echo $patient['room']; ?>" required>

        <label>Time:</label>
        <input type="datetime-local" name="time" value="<?php echo $patient['time']; ?>" required>

        <label>Deposit:</label>
        <input type="number" name="deposit" value="<?php echo $patient['deposit']; ?>" required>

        <button type="submit">Update Patient</button>
    </form>
    <a href="patient.php" class="back-btn">← Back to Patients</a>
</body>
</html>
