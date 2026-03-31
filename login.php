<?php
require_once "backend/admin_config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = trim($_POST["password"] ?? "");

    //for now until it gets put in a db
    if ($username === ADMIN_USERNAME && password_verify($password, ADMIN_PASSWORD)) {
        $_SESSION["admin_logged_in"] = true;
        $_SESSION["admin_username"] = $username;
        header("Location: admin.php");
        exit();
    } else {
        $error = "Invalid login credentials.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <h1>Admin Login</h1>

    <?php if ($error !== ""): ?>
        <p><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="post" action="login.php">
        <div>
            <label for="username">Username</label><br>
            <input type="text" id="username" name="username" required>
        </div>
        <br>

        <div>
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" required>
        </div>
        <br>

        <button type="submit">Log In</button>
    </form>

    <p><a href="index.html">Back to Home</a></p>
</body>
</html>