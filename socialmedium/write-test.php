<?php
$log_file = 'C:/xampp/htdocs/ikbenlit/wp-content/test.log';

try {
    if (!is_dir(dirname($log_file))) {
        mkdir(dirname($log_file), 0777, true);
    }
    
    $result = file_put_contents($log_file, date('[Y-m-d H:i:s] ') . "Test write\n", FILE_APPEND);
    
    echo "Write result: " . ($result !== false ? 'Success' : 'Failed') . "<br>";
    echo "Last error: " . print_r(error_get_last(), true) . "<br>";
    echo "File exists: " . (file_exists($log_file) ? 'Yes' : 'No') . "<br>";
    echo "File permissions: " . substr(sprintf('%o', fileperms($log_file)), -4) . "<br>";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} 