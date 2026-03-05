<?php
register_shutdown_function(function() { $err = error_get_last(); if ($err && in_array($err['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) { while (ob_get_level() > 0) ob_end_clean(); echo "<div style='background:#020617;color:#f87171;padding:30px;font-family:monospace;'>Fatal Anomaly: " . htmlspecialchars($err['message']) . " in " . basename($err['file']) . ":" . $err['line'] . "</div>"; } elseif (ob_get_level() > 0) { ob_end_flush(); } });
 
if (session_status() === PHP_SESSION_NONE) { session_start(); }
 
include 'header.php'; 
 
// Check if ID exists
if(!isset($_GET['id'])) {
    echo "Job not found.";
    exit;
}
 
 $job_id = $_GET['id'];
 $stmt = $pdo->prepare("SELECT jobs.*, users.name as client_name FROM jobs JOIN users ON jobs.client_id = users.id WHERE jobs.id = ?");
 $stmt->execute([$job_id]);
 $job = $stmt->fetch();
 
if(!$job) {
    echo "Job not found.";
    exit;
}
 
 $msg = "";
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id']) && $_SESSION['role'] == 'freelancer') {
    $bid = $_POST['bid_amount'];
    $cover = $_POST['cover_letter'];
    $f_id = $_SESSION['user_id'];
 
    $stmt = $pdo->prepare("INSERT INTO proposals (job_id, freelancer_id, bid_amount, cover_letter) VALUES (?, ?, ?, ?)");
    if($stmt->execute([$job_id, $f_id, $bid, $cover])) {
        $msg = "Proposal submitted successfully!";
    }
}
?>
 
<div class="container" style="padding: 40px 0;">
    <div class="dashboard-layout">
        <div class="main-content">
            <div class="card" style="margin-bottom: 30px;">
                <span class="card-tag"><?php echo htmlspecialchars($job['category']); ?></span>
                <h1 style="margin: 15px 0;"><?php echo htmlspecialchars($job['title']); ?></h1>
                <div class="card-meta">
                    <span><i data-lucide="user"></i> Posted by <?php echo htmlspecialchars($job['client_name']); ?></span>
                    <span><i data-lucide="calendar"></i> <?php echo date('M d, Y', strtotime($job['created_at'])); ?></span>
                </div>
                <hr style="border: 0; border-top: 1px solid var(--border); margin: 20px 0;">
                <div style="font-size: 1.1rem; color: #444;">
                    <?php echo nl2br(htmlspecialchars($job['description'])); ?>
                </div>
            </div>
        </div>
 
        <div class="sidebar">
            <div style="margin-bottom: 20px;">
                <h3 style="margin-bottom: 10px;">Job Details</h3>
                <p><strong>Budget:</strong> $<?php echo number_format($job['budget']); ?></p>
                <p><strong>Type:</strong> <?php echo ucfirst($job['type']); ?></p>
            </div>
 
            <?php if(isset($_SESSION['user_id']) && $_SESSION['role'] == 'freelancer'): ?>
                <?php if($msg): ?>
                    <div style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 8px; margin-bottom: 15px;">
                        <?php echo $msg; ?>
                    </div>
                <?php else: ?>
                    <form method="POST">
                        <div class="form-group">
                            <label>Your Bid ($)</label>
                            <input type="number" name="bid_amount" required>
                        </div>
                        <div class="form-group">
                            <label>Cover Letter</label>
                            <textarea name="cover_letter" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">Submit Proposal</button>
                    </form>
                <?php endif; ?>
            <?php elseif(!isset($_SESSION['user_id'])): ?>
                <a href="login.php" class="btn btn-primary" style="width: 100%; justify-content: center;">Login to Apply</a>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>lucide.createIcons();</script>
