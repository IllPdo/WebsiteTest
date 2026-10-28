<?php
session_start();

include "db.php";
include "functions.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // $sql = "SELECT * FROM users WHERE username = '$username'";

    // checking the database with the sql command that we have
    $result = myQuery($conn, "SELECT * FROM users WHERE username = '$username'");

    if (pg_num_rows($result)> 0) {
        $user = pg_fetch_assoc($result); // this will fetch the whole row (that would include, username, password, and other user information)

        if (password_verify($password, $user["password"])) {
            $_SESSION["username"] = $user["username"];
            header("Location: dashboard.php");
            exit();
        } else {
            $message = "Invalid password!";
        }
    } else {
        $message = "Username not found!";
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
        <input type="text" name="username" required>
        <br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required>
        <br><br>

        <button type="submit">Login</button>

    </form>

    <p style="color: red;">
        <?php echo $message; ?>
    </p>

    <p>
        Don't have an account?
        <a href="register.php">Register here</a>
    </p>

    <?php
    $mypass = "testing";
    echo md5($mypass);
    echo "<br>";
    echo sha1($mypass);
    echo "<br>";
    echo password_hash($mypass, PASSWORD_DEFAULT);
    echo "<br>";
    $mysalt = "$%*&#(*";
    echo $mysalt . sha1(md5($mypass));
    echo "<br>";

    ?>

    <a href="test.com">Testing</a>

</body>

</html>