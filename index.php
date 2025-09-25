<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.html');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['user']['username']; ?></h1>
    <div class="navbar">
    </div>
    <div id="main-content">
        <h2>Dashboard</h2>
        <p>Select an option to manage hospital tasks.</p>
    </div>
</body>
</html>
