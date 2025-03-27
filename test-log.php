<?php
// Plaats dit bestand in je WordPress root
$log_file = __DIR__ . '/wp-content/test.log';
file_put_contents($log_file, date('[Y-m-d H:i:s] ') . "Test write\n", FILE_APPEND);
echo "Attempted to write to: " . $log_file; 