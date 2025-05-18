<?php
session_start();
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    
    if (!empty($username) && !empty($password)) {
     require_once "../database/connect.php";
require_once "../classes/User.php";

$user = new User($conn);
$loginData = $user->login($username, $password);

if ($loginData) {
    $_SESSION["user"] = $loginData;
    header("Location: dashboard.php");
    exit();
} else {
    $message = "Invalid username or password.";
}

        $message = "Login info received.";
    } else {
        $message = "Please fill all fields.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <input type="submit" value="Login">
    </form>
</body>
</html>
<p style="color: red;"><?php echo $message ?? ''; ?></p>