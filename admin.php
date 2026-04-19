<?php
/**
 * Aaryn Gill, Gurbaz Sogi, Eli Wood
 * 2026-04-07
 * Admin dashboard page for viewing messages, filtering by status, and marking messages as resolved or unresolved.
 */

require_once "backend/admin_config.php";
requireAdmin();

require_once "backend/connect.php";

$filter = $_GET["filter"] ?? "all";

$sql = "SELECT id, content, email, name, phone_number, resolved, created_at, resolved_at, category
        FROM messages";

if ($filter === "resolved") {
    $sql .= " WHERE resolved = 1";
}
else if ($filter === "unresolved") {
    $sql .= " WHERE resolved = 0";
}

$sql .= " ORDER BY created_at DESC";

$stmt = $pdo->query($sql);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard | 4S Excavating Services</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="js/admin.js" defer></script>
    <script src="js/mobileMenu.js" defer></script>
    <script src="js/script.js" defer></script>

    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <header class="header">
        <div class="container nav-container">
            <a href="index.php" class="logo">4S Excavating Services</a>

            <nav class="nav">
                <ul class="nav-list">
                    <li>
                        <a href="index.php" class="nav-link">
                            <span class="link-text">Home</span>
                            <span class="mobile-arrow">&rsaquo;</span>
                        </a>
                    </li>
                    <li>
                        <a href="scheduling.php" class="nav-link">
                            <span class="link-text">Scheduling</span>
                            <span class="mobile-arrow">&rsaquo;</span>
                        </a>
                    </li>
                    <li>
                        <a href="message.php" class="nav-link">
                            <span class="link-text">Contact Us</span>
                            <span class="mobile-arrow">&rsaquo;</span>
                        </a>
                    </li>
                    <li>
                        <a href="admin.php" class="nav-link active">
                            <span class="link-text">Admin</span>
                            <span class="mobile-arrow">&rsaquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <button class="mobile-menu-btn" aria-label="Toggle menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </div>
    </header>

    <main class="admin-page">
        <section class="admin-dashboard-section">
            <div class="container">
                <div class="section-tag">
                    <span class="line"></span> ADMIN DASHBOARD
                </div>

                <div class="admin-top-row">
                    <div>
                        <h1 class="admin-title">Messages</h1>
                        <p class="admin-subtitle">
                            Logged in as <?php echo htmlspecialchars($_SESSION["admin_username"] ?? "admin"); ?>
                        </p>
                    </div>

                    <div class="admin-actions">
                        <a class="admin-link-btn" href="backend/logout.php" onclick="localStorage.removeItem('adminLoggedIn')">Log Out</a>
                    </div>
                </div>

                <div class="admin-filter-card">
                    <h2 class="admin-filter-title">Filter Messages</h2>

                    <div class="admin-filter-buttons">
                        <a href="admin.php?filter=all"
                           class="filter-btn <?php echo ($filter === 'all') ? 'active-filter' : ''; ?>">
                            All
                        </a>

                        <a href="admin.php?filter=unresolved"
                           class="filter-btn <?php echo ($filter === 'unresolved') ? 'active-filter' : ''; ?>">
                            Unresolved
                        </a>

                        <a href="admin.php?filter=resolved"
                           class="filter-btn <?php echo ($filter === 'resolved') ? 'active-filter' : ''; ?>">
                            Resolved
                        </a>
                    </div>
                </div>

                <?php if (count($messages) === 0): ?>
                    <div class="no-messages">
                        No messages found for this filter.
                    </div>
                <?php else: ?>
                    <div class="admin-message-list">
                        <?php foreach ($messages as $message): ?>
                            <article
                                class="admin-message-card <?php echo ((int)$message["resolved"] === 1) ? "resolved-card" : "unresolved-card"; ?>"
                                id="message-<?php echo (int)$message["id"]; ?>"
                            >
                                <div class="admin-message-header">
                                    <h2><?php echo htmlspecialchars($message["name"] ?? ""); ?></h2>

                                    <span
                                        class="status-badge <?php echo ((int)$message["resolved"] === 1) ? "status-resolved" : "status-unresolved"; ?>"
                                        id="status-<?php echo (int)$message["id"]; ?>"
                                    >
                                        <?php echo ((int)$message["resolved"] === 1) ? "Resolved" : "Unresolved"; ?>
                                    </span>
                                </div>

                                <p><strong>Email:</strong> <?php echo htmlspecialchars($message["email"] ?? ""); ?></p>
                                <p><strong>Phone:</strong> <?php echo htmlspecialchars($message["phone_number"] ?? ""); ?></p>
                                <p><strong>Category:</strong> <?php echo htmlspecialchars($message["category"] ?? ""); ?></p>
                                <p><strong>Created:</strong> <?php echo htmlspecialchars($message["created_at"] ?? ""); ?></p>

                                <?php if (!empty($message["resolved_at"])): ?>
                                    <p id="resolved-at-<?php echo (int)$message["id"]; ?>">
                                        <strong>Resolved At:</strong>
                                        <?php echo htmlspecialchars($message["resolved_at"]); ?>
                                    </p>
                                <?php else: ?>
                                    <p id="resolved-at-<?php echo (int)$message["id"]; ?>" class="hidden-resolved-at">
                                        <strong>Resolved At:</strong> Not resolved yet
                                    </p>
                                <?php endif; ?>

                                <div class="admin-message-body">
                                    <strong>Message:</strong>
                                    <p><?php echo nl2br(htmlspecialchars($message["content"] ?? "")); ?></p>
                                </div>

                                <label class="resolve-checkbox-row">
                                    <input
                                        type="checkbox"
                                        class="resolve-checkbox"
                                        id="checkbox-<?php echo (int)$message["id"]; ?>"
                                        onchange="toggleResolved(<?php echo (int)$message['id']; ?>)"
                                        <?php echo ((int)$message["resolved"] === 1) ? "checked" : ""; ?>
                                    >
                                    <span>Mark as resolved</span>
                                </label>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        
    </main>
    <footer class="footer">
        <div class="container">
            <div class="footer-top">
                <div class="footer-brand">
                    <a href="index.php" class="footer-logo">
                        4S Excavating
                    </a>
                    <p class="footer-desc">Professional excavation services to mobilize the right people and deliver
                        unique solutions for your dream project.</p>
                    <div class="footer-socials">
                        <a href="#" aria-label="X">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z" />
                            </svg>
                        </a>
                        <a href="#" aria-label="Instagram">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </a>
                        <a href="#" aria-label="LinkedIn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z">
                                </path>
                                <rect x="2" y="9" width="4" height="12"></rect>
                                <circle cx="4" cy="4" r="2"></circle>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="footer-links-container">
                    <div class="footer-col">
                        <h4>Company</h4>
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="scheduling.php">Scheduling</a></li>
                            <li><a href="message.php">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 4S Excavating Services. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>