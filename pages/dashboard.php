<link rel="stylesheet" href="../css/style.css">
<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

require_once "../database/connect.php";
require_once "../classes/PasswordGenerator.php";
require_once "../classes/PasswordManager.php";

$user = $_SESSION["user"];
$passwordOutput = "";

// Load saved passwords for current user (only if 'show' is clicked)
$savedPasswords = [];
if (isset($_GET['show']) && $_GET['show'] === '1') {
    $query = $conn->prepare("SELECT platform, created_at FROM passwords WHERE user_id = ?");
    $query->bind_param("i", $user["id"]);
    $query->execute();
    $result = $query->get_result();
    while ($row = $result->fetch_assoc()) {
        $savedPasswords[] = $row;
    }
}

// Handle password generation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $platform = $_POST["platform"];
    $length = $_POST["length"];
    $upper = $_POST["upper"];
    $lower = $_POST["lower"];
    $numbers = $_POST["numbers"];
    $special = $_POST["special"];

    $generator = new PasswordGenerator();
    $generatedPassword = $generator->generate($length, $upper, $lower, $numbers, $special);

    $manager = new PasswordManager($conn, $user["aes_key"]);
    $saved = $manager->savePassword($user["id"], $platform, $generatedPassword);

    if ($saved) {
        $passwordOutput = "Password for $platform saved successfully: <strong>$generatedPassword</strong>";
    } else {
        $passwordOutput = "Something went wrong while saving the password.";
    }
}
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

    <h3>Generate New Password</h3>
    <form method="POST">
        <label>Platform (e.g. Gmail, Facebook):</label>
        <input type="text" name="platform" required><br><br>

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

    <!-- ✅ Success message after generation -->
    <?php if (!empty($passwordOutput)): ?>
        <div style="padding: 10px; background-color: #e0ffe0; margin-top: 10px;">
            <?php echo $passwordOutput; ?>
        </div>
    <?php endif; ?>

    <hr>

    <!-- ✅ Button to show saved passwords -->
    <form method="GET">
        <button type="submit" name="show" value="1">Show Saved Passwords</button>
    </form>

    <!-- ✅ Display saved passwords table only if requested -->
    <?php if (!empty($savedPasswords)): ?>
        <h3>Saved Passwords</h3>
        <table border="1" cellpadding="6">
            <tr>
                <th>Platform</th>
                <th>Saved At</th>
            </tr>
            <?php foreach ($savedPasswords as $entry): ?>
                <tr>
                    <td><?php echo htmlspecialchars($entry["platform"]); ?></td>
                    <td><?php echo $entry["created_at"]; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif (isset($_GET['show'])): ?>
        <p>No passwords saved yet.</p>
    <?php endif; ?>
</body>
</html>
