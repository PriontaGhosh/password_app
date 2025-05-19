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
    <h3>Generate New Password</h3>
<form method="POST">
    <label>Length:</label>
    <input type="number" name="length" min="4" required><br><br>

    <label>Uppercase letters:</label>
    <input type="number" name="upper" min="0"><br><br>

    <label>Lowercase letters:</label>
    <input type="number" name="lower" min="0"><br><br>

    <label>Numbers:</label>
    <input type="number" name="numbers" min="0"><br><br>

    <label>Special characters:</label>
    <input type="number" name="special" min="0"><br><br>

    <input type="submit" value="Generate Password">
</form>

    <p>This is your password manager.</p>

    <p><a href="logout.php">Logout</a></p>
</body>
</html>
