<?php

$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "hospital_management"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = !empty($_POST['id']) ? intval($_POST['id']) : null; 
    $number = $_POST['number'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $disease = $_POST['disease'];
    $room = intval($_POST['room']);
    $time = $_POST['time'];
    $deposit = floatval($_POST['deposit']);

    
    if ($id) {
        $sql = "INSERT INTO patients (id, number, name, gender, disease, room, time, deposit) 
                VALUES ($id, '$number', '$name', '$gender', '$disease', $room, '$time', $deposit)";
    } else {
        $sql = "INSERT INTO patients (number, name, gender, disease, room, time, deposit) 
                VALUES ('$number', '$name', '$gender', '$disease', $room, '$time', $deposit)";
    }

    
    if ($conn->query($sql) === TRUE) {
        echo "New patient added successfully!";
        echo "<br><a href='add_patient.html'>Add Another Patient</a>";
        echo "<br><a href='patient.php'>View All Patients</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
