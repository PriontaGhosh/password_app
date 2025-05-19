<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION["user"];
?>
$passwordOutput = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // For now just show the input values back
    $length = $_POST["length"];
    $upper = $_POST["upper"];
    $lower = $_POST["lower"];
    $numbers = $_POST["numbers"];
    $special = $_POST["special"];

    $passwordOutput = "Length: $length, Upper: $upper, Lower: $lower, Numbers: $numbers, Special: $special";
}

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($user["username"]); ?>!</h2>
      <p>This is your password manager.</p>

    <p><a href="logout.php">Logout</a></p>
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
<?php if (!empty($passwordOutput)): ?>
    <p><strong>Test Output:</strong> <?php echo $passwordOutput; ?></p>
<?php endif; ?>

  
</body>
</html>
