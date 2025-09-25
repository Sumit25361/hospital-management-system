<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital_management";


if (isset($_POST['customerId'])) {
    $patient_id = $_POST['customerId'];
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "DELETE FROM patients WHERE id = $patient_id";

    if ($conn->query($sql) === TRUE) {
        echo "Patient discharged successfully!";
        header("Location: patient.php");
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
} else {
    echo "No patient ID provided.";
}
?>
