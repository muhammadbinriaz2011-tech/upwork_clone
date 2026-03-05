<?php
register_shutdown_function(function() { $err = error_get_last(); if ($err && in_array($err['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) { while (ob_get_level() > 0) ob_end_clean(); echo "<div style='background:#020617;color:#f87171;padding:30px;font-family:monospace;'>Fatal Anomaly: " . htmlspecialchars($err['message']) . " in " . basename($err['file']) . ":" . $err['line'] . "</div>"; } elseif (ob_get_level() > 0) { ob_end_flush(); } });
 
session_start();
session_destroy();
header("Location: index.php");
exit;
