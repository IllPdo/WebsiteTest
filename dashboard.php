<?php
session_start();
require_once "functions.php";
 
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
    <h2>Welcome, <?php echo e($_SESSION["username"]); ?>!</h2>
    <p>You are successfully logged in.</p>
    <a href="editprofile.php">Edit Profile</a> | <a href="logout.php">Logout</a> | <a href="DeleteProfile.php">Delete Account</a> | <a href="DisableProfile.php">Disable Profile</a>
</body>
</html>
 