<?php
require_once "backend/admin_config.php";
require_once "backend/connect.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");

    $stmt = $pdo->prepare("SELECT * FROM 4susers WHERE email = ? LIMIT 1");
    $success = $stmt->execute([$email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($success && $result && $password === $result["password"]) {
        $_SESSION["admin_logged_in"] = true;
        $_SESSION["admin_username"] = $result["name"];
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
            <label for="email">Email</label><br>
            <input type="text" id="email" name="email" required>
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