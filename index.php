<?php
session_start();

require_once "db.php";
require_once "functions.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    $user = getUserByUsername($conn, $username);

    // One generic message so attackers can't tell which usernames exist
    if ($user && password_verify($password, $user["password"])) {
        session_regenerate_id(true);
        $_SESSION["username"] = $user["username"];
        header("Location: dashboard.php");
        exit();
    }
    $message = "Invalid username or password!";
}
?>
<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
    <h2>Login</h2>
    <form method="POST">
        <label>Username:</label><br>
        <input type="text" name="username" required>
        <br><br>
        <label>Password:</label><br>
        <input type="password" name="password" required>
        <br><br>
        <button type="submit">Login</button>
    </form>
    <p style="color: red;"><?php echo e($message); ?></p>
    <p>Don't have an account? <a href="register.php">Register here</a></p>
</body>
</html>