<?php
register_shutdown_function(function() { $err = error_get_last(); if ($err && in_array($err['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) { while (ob_get_level() > 0) ob_end_clean(); echo "<div style='background:#020617;color:#f87171;padding:30px;font-family:monospace;'>Fatal Anomaly: " . htmlspecialchars($err['message']) . " in " . basename($err['file']) . ":" . $err['line'] . "</div>"; } elseif (ob_get_level() > 0) { ob_end_flush(); } });
 
if (session_status() === PHP_SESSION_NONE) { session_start(); }
 
include 'header.php'; 
 
 $error = "";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
 
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
 
    if($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid credentials.";
    }
}
?>
 
<div class="container">
    <div class="auth-card">
        <h2 style="margin-bottom: 10px;">Welcome Back</h2>
        <p style="color: var(--text-muted); margin-bottom: 25px;">Log in to your AgentR account.</p>
 
        <?php if($error): ?>
            <div style="background: #fee2e2; color: #dc2626; padding: 10px; border-radius: 8px; margin-bottom: 20px; font-size: 0.9rem;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
 
        <form method="POST">
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" required placeholder="name@company.com">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="••••••••">
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 14px;">Log In</button>
        </form>
        <p style="text-align: center; margin-top: 20px; font-size: 0.9rem;">
            Don't have an account? <a href="signup.php" style="color: var(--primary); font-weight: 600;">Sign up</a>
        </p>
    </div>
</div>
