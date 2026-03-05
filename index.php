<?php
register_shutdown_function(function() { $err = error_get_last(); if ($err && in_array($err['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) { while (ob_get_level() > 0) ob_end_clean(); echo "<div style='background:#020617;color:#f87171;padding:30px;font-family:monospace;'>Fatal Anomaly: " . htmlspecialchars($err['message']) . " in " . basename($err['file']) . ":" . $err['line'] . "</div>"; } elseif (ob_get_level() > 0) { ob_end_flush(); } });
 
include 'header.php'; 
 
// Check karein koi category select ki hai ya nahi
 $category = isset($_GET['category']) ? $_GET['category'] : null;
?>
 
<section class="hero">
    <div class="container">
        <?php if($category): ?>
            <h1>Jobs in <br><span style="color: var(--primary)"><?php echo htmlspecialchars($category); ?></span></h1>
        <?php else: ?>
            <h1>Work with the world's <br><span style="color: var(--primary)">best talent.</span></h1>
        <?php endif; ?>
 
        <p style="color: var(--text-muted); font-size: 1.2rem; margin-bottom: 2rem;">
            The world's work marketplace. Post a job and hire a pro.
        </p>
        <div style="display: flex; gap: 12px; justify-content: center;">
            <a href="signup.php" class="btn btn-primary">Get Started</a>
            <a href="#jobs" class="btn btn-outline">Browse Jobs</a>
        </div>
    </div>
</section>
 
<section class="container" id="jobs" style="padding: 60px 0;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2>
            <?php if($category): ?>
                <?php echo htmlspecialchars($category); ?> Jobs
            <?php else: ?>
                Recent Opportunities
            <?php endif; ?>
        </h2>
 
        <?php if($category): ?>
            <a href="index.php" style="color: var(--primary); font-weight: 600; text-decoration: none;">Show All Jobs</a>
        <?php else: ?>
            <a href="#" style="color: var(--primary); font-weight: 600; text-decoration: none;">View all</a>
        <?php endif; ?>
    </div>
 
    <div class="job-grid">
        <?php
        // SQL Query Logic for Filtering
        $sql = "SELECT jobs.*, users.name as client_name FROM jobs JOIN users ON jobs.client_id = users.id";
 
        if ($category) {
            $sql .= " WHERE jobs.category = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$category]);
        } else {
            $sql .= " ORDER BY created_at DESC LIMIT 6";
            $stmt = $pdo->query($sql);
        }
 
        $has_jobs = false;
        while($job = $stmt->fetch()):
            $has_jobs = true;
        ?>
        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                <span class="badge"><?php echo htmlspecialchars($job['category']); ?></span>
                <span style="font-weight: 700; color: var(--primary)">$<?php echo number_format($job['budget']); ?></span>
            </div>
            <h3 style="margin-bottom: 0.5rem;"><?php echo htmlspecialchars($job['title']); ?></h3>
            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.5rem;">
                <?php echo substr(htmlspecialchars($job['description']), 0, 100); ?>...
            </p>
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <span style="font-size: 0.8rem; color: var(--text-muted)">
                    <i data-lucide="user" style="width:12px; vertical-align: middle"></i> <?php echo htmlspecialchars($job['client_name']); ?>
                </span>
                <a href="job-details.php?id=<?php echo $job['id']; ?>" class="btn btn-outline" style="padding: 6px 12px; font-size: 0.85rem;">Details</a>
            </div>
        </div>
        <?php endwhile; ?>
 
        <?php if(!$has_jobs): ?>
            <p style="grid-column: 1/-1; text-align: center; color: var(--text-muted);">
                <?php if($category): ?>
                    No jobs found in <?php echo htmlspecialchars($category); ?>. Try another category!
                <?php else: ?>
                    No jobs posted yet. Be the first!
                <?php endif; ?>
            </p>
        <?php endif; ?>
    </div>
</section>
 
<script>lucide.createIcons();</script>
</body>
</html>
