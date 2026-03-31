<?php
require_once "backend/admin_config.php";
requireAdmin();

require_once "backend/connect.php";

$messages = [];

$sql = "SELECT id, content, email, name, phone_number, resolved, created_at, resolved_at, category
        FROM `messages`
        ORDER BY created_at DESC";
$stmt = $pdo->query($sql);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/admin.js" defer></script>
    <script src="js/mobileMenu.js"></script>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="styles/style.css">
    <style>
        .message-card {
            border: 1px solid #ccc;
            padding: 16px;
            margin-bottom: 16px;
            border-radius: 8px;
        }

        .resolved {
            background-color: #f3f3f3;
            opacity: 0.8;
        }

        .status-text {
            font-weight: bold;
        }

        .no-messages {
            padding: 20px;
            border: 1px dashed #999;
        }
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <p>Logged in as <?php echo htmlspecialchars($_SESSION["admin_username"] ?? "admin"); ?></p>
    <p><a href="logout.php">Log Out</a></p>

    <h2>Messages</h2>

    <?php if (count($messages) === 0): ?>
        <div class="no-messages">No messages found.</div>
    <?php else: ?>
        <?php foreach ($messages as $message): ?>
            <div
                class="message-card <?php echo ((int)$message["resolved"] === 1) ? 'resolved' : ''; ?>"
                id="message-<?php echo (int)$message["id"]; ?>"
            >
                <p><strong>Name:</strong> <?php echo htmlspecialchars($message["name"] ?? ""); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($message["email"] ?? ""); ?></p>
                <p><strong>Phone:</strong> <?php echo htmlspecialchars($message["phone_number"] ?? ""); ?></p>
                <p><strong>Category:</strong> <?php echo htmlspecialchars($message["category"] ?? ""); ?></p>
                <p><strong>Message:</strong> <?php echo htmlspecialchars($message["content"] ?? ""); ?></p>
                <p><strong>Created:</strong> <?php echo htmlspecialchars($message["created_at"] ?? ""); ?></p>
                <p>
                    <strong>Status:</strong>
                    <span class="status-text" id="status-<?php echo (int)$message["id"]; ?>">
                        <?php echo ((int)$message["resolved"] === 1) ? "Resolved" : "Unresolved"; ?>
                    </span>
                </p>

                <button
                    type="button"
                    onclick="toggleResolved(<?php echo (int)$message['id']; ?>)"
                    id="button-<?php echo (int)$message["id"]; ?>"
                >
                    <?php echo ((int)$message["resolved"] === 1) ? "Mark Unresolved" : "Mark Resolved"; ?>
                </button>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>