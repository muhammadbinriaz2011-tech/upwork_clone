<?php
register_shutdown_function(function() { $err = error_get_last(); if ($err && in_array($err['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) { while (ob_get_level() > 0) ob_end_clean(); echo "<div style='background:#020617;color:#f87171;padding:30px;font-family:monospace;'>Fatal Anomaly: " . htmlspecialchars($err['message']) . " in " . basename($err['file']) . ":" . $err['line'] . "</div>"; } elseif (ob_get_level() > 0) { ob_end_flush(); } });
 
if (session_status() === PHP_SESSION_NONE) { session_start(); }
 
include 'header.php'; 
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'client') {
    header("Location: login.php");
    exit;
}
 
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $cat = $_POST['category'];
    $budget = $_POST['budget'];
    $type = $_POST['type'];
    $client_id = $_SESSION['user_id'];
 
    $stmt = $pdo->prepare("INSERT INTO jobs (client_id, title, description, category, budget, type) VALUES (?, ?, ?, ?, ?, ?)");
    if($stmt->execute([$client_id, $title, $desc, $cat, $budget, $type])) {
        header("Location: dashboard.php");
        exit;
    }
}
?>
 
<div class="container">
    <div class="auth-form" style="max-width: 800px;">
        <h2 style="margin-bottom: 25px;">Post a New Job</h2>
        <form method="POST">
            <div class="form-group">
                <label>Job Title</label>
                <input type="text" name="title" required placeholder="e.g. Build a Modern PHP Website">
            </div>
            <div class="form-group">
                <label>Category</label>
                <select name="category">
                    <option>Web Development</option>
                    <option>Mobile Apps</option>
                    <option>Design</option>
                    <option>Writing</option>
                </select>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="6" required></textarea>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label>Budget ($)</label>
                    <input type="number" name="budget" required>
                </div>
                <div class="form-group">
                    <label>Payment Type</label>
                    <select name="type">
                        <option value="fixed">Fixed Price</option>
                        <option value="hourly">Hourly Rate</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 15px;">Post Job Now</button>
        </form>
    </div>
</div>
<script>lucide.createIcons();</script>
