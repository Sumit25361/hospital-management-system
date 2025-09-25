<?php
$host = 'localhost';
$db = 'hospital_db';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerId = $_POST['customerId'];
    $outTime = $_POST['outTime'];

    $sql = "UPDATE patients SET out_time = ?, status = 'discharged' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $outTime, $customerId);

    if ($stmt->execute()) {
        echo "Patient discharged successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
