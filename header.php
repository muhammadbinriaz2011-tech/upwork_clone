<?php
register_shutdown_function(function() { $err = error_get_last(); if ($err && in_array($err['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) { while (ob_get_level() > 0) ob_end_clean(); echo "<div style='background:#020617;color:#f87171;padding:30px;font-family:monospace;'>Fatal Anomaly: " . htmlspecialchars($err['message']) . " in " . basename($err['file']) . ":" . $err['line'] . "</div>"; } elseif (ob_get_level() > 0) { ob_end_flush(); } });
 
if (session_status() === PHP_SESSION_NONE) { session_start(); }
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upwork - Work Marketplace</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
<header>
    <div class="container">
        <nav>
            <a href="index.php" class="logo">
                <i data-lucide="zap" style="fill: var(--primary)"></i> Upwork
            </a>
            <div class="nav-links">
                <a href="index.php">Find Work</a>
                <a href="categories.php">Find Talent</a>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="dashboard.php">Dashboard</a>
                    <a href="logout.php" class="btn btn-outline">Logout</a>
                <?php else: ?>
                    <a href="login.php">Log In</a>
                    <a href="signup.php" class="btn btn-primary">Sign Up</a>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</header>
<script>lucide.createIcons();</script>
