<?php
session_start();
require_once "functions.php";

// Only logged-in users can open this page.
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}

// Get the logged-in user's current information.
$stmt = $conn->prepare(
    "SELECT username, cellphone, gender
     FROM public.users
     WHERE username = :username"
);

$stmt->execute([
    ":username" => $_SESSION["username"]
]);

$user = $stmt->fetch();

if (!$user) {
    exit("Account not found.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
</head>
<body>
    <h2>Edit Profile</h2>

    <form method="POST">
        <label>Username:</label><br>
        <input
            type="text"
            name="username"
            value="<?php echo e($user["username"]); ?>"
            required
        >
        <br><br>

        <label>Cellphone Number:</label><br>
        <input
            type="tel"
            name="cellphone"
            maxlength="20"
            value="<?php echo e($user["cellphone"] ?? ""); ?>"
        >
        <br><br>

        <label>Gender:</label><br>
        <select name="gender" required>
            <option value="">Select gender</option>

            <option value="male"
                <?php if ($user["gender"] === "male") echo "selected"; ?>>
                Male
            </option>

            <option value="female"
                <?php if ($user["gender"] === "female") echo "selected"; ?>>
                Female
            </option>

            <option value="other"
                <?php if ($user["gender"] === "other") echo "selected"; ?>>
                Other
            </option>
        </select>
        <br><br>

        <button type="submit">Save Changes</button>
    </form>

    <p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>