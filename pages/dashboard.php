<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION["user"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($user["username"]); ?>!</h2>
    <p>This is your password manager.</p>

    <p><a href="logout.php">Logout</a></p>
</body>
</html>
