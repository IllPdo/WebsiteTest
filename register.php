<?php
require_once "db.php";
require_once "functions.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirm_password = $_POST["confirm_password"] ?? "";

    if ($username === "" || strlen($password) < 8) {
        $message = "Username is required and password must be at least 8 characters.";
    } elseif ($password !== $confirm_password) {
        $message = "Confirming password failed!";
    } elseif (checkUsername($conn, $username)) {
        $message = "Username already exists!";
    } else {
        createUser($conn, $username, password_hash($password, PASSWORD_DEFAULT));
        $message = "Registration successful!";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<body>
    <h2>Register</h2>
    <form method="POST">
        <label>Username:</label><br>
        <input type="text" name="username" required value="<?php echo e($_POST["username"] ?? ""); ?>">
        <br><br>
        <label>Password:</label><br>
        <input type="password" name="password" required>
        <br><br>
        <label>Confirm Password:</label><br>
        <input type="password" name="confirm_password" required>
        <br><br>
        <button type="submit">Register</button>
    </form>
    <p><?php echo e($message); ?></p>
    <a href="index.php">Go to Login</a>
</body>
</html>