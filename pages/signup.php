<?php
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    
    if (!empty($username) && !empty($password)) {
        require_once "../database/connect.php";
require_once "../classes/User.php";

$user = new User($conn);
if ($user->register($username, $password)) {
    $message = "Signup successful. You can now login.";
} else {
    $message = "Something went wrong. Try again.";
}
        $message = "Form received.";
    } else {
        $message = "Please fill all fields.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
<body>
    <h2>Create an Account</h2>
    <form method="POST">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <input type="submit" value="Sign Up">
    </form>
</body>
</html>
<p style="color: red;"><?php echo $message ?? ''; ?></p>
