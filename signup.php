<?php
register_shutdown_function(function() { $err = error_get_last(); if ($err && in_array($err['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) { while (ob_get_level() > 0) ob_end_clean(); echo "<div style='background:#020617;color:#f87171;padding:30px;font-family:monospace;'>Fatal Anomaly: " . htmlspecialchars($err['message']) . " in " . basename($err['file']) . ":" . $err['line'] . "</div>"; } elseif (ob_get_level() > 0) { ob_end_flush(); } });
 
include 'header.php'; 
 
 $error = "";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
 
    // Check if email exists
    $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute([$email]);
 
    if($check->rowCount() > 0) {
        $error = "Email is already registered.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        if($stmt->execute([$name, $email, $password, $role])) {
            header("Location: login.php?success=1");
            exit;
        } else {
            $error = "Something went wrong.";
        }
    }
}
?>
 
<div class="container">
    <div class="auth-card">
        <h2 style="margin-bottom: 10px;">Create Account</h2>
        <p style="color: var(--text-muted); margin-bottom: 25px;">Join the world's work marketplace.</p>
 
        <?php if($error): ?>
            <div style="background: #fee2e2; color: #dc2626; padding: 10px; border-radius: 8px; margin-bottom: 20px; font-size: 0.9rem;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
 
        <form method="POST">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" required placeholder="John Doe">
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" required placeholder="john@example.com">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="Min. 8 characters">
            </div>
            <div class="form-group">
                <label>I want to...</label>
                <select name="role">
                    <option value="freelancer">Work as a Freelancer</option>
                    <option value="client">Hire for a Project</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 14px;">Create Account</button>
        </form>
    </div>
</div>
