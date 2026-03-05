<?php
register_shutdown_function(function() { $err = error_get_last(); if ($err && in_array($err['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) { while (ob_get_level() > 0) ob_end_clean(); echo "<div style='background:#020617;color:#f87171;padding:30px;font-family:monospace;'>Fatal Anomaly: " . htmlspecialchars($err['message']) . " in " . basename($err['file']) . ":" . $err['line'] . "</div>"; } elseif (ob_get_level() > 0) { ob_end_flush(); } });
 
if (session_status() === PHP_SESSION_NONE) { session_start(); }
 
include 'header.php'; 
if(!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
 
 $user_id = $_SESSION['user_id'];
 $role = $_SESSION['role'];
?>
 
<div class="container" style="padding: 40px 0;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
        <div>
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h1>
            <p style="color: var(--text-muted)">You are logged in as a <?php echo ucfirst($role); ?></p>
        </div>
        <?php if($role == 'client'): ?>
            <a href="post-job.php" class="btn btn-primary"><i data-lucide="plus"></i> Post a Job</a>
        <?php endif; ?>
    </div>
 
    <div style="display: grid; grid-template-columns: 1fr 300px; gap: 30px;">
        <main>
            <div class="card" style="margin-bottom: 20px;">
                <h3>Your Active Projects</h3>
                <p style="color: var(--text-muted); margin-top: 10px;">No active projects found.</p>
            </div>
        </main>
        <aside>
            <div class="card">
                <h3>Profile Stats</h3>
                <div style="margin-top: 20px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span>Earnings</span>
                        <span style="font-weight: 700;">$0.00</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span>Jobs Done</span>
                        <span style="font-weight: 700;">0</span>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>
<script>lucide.createIcons();</script>
