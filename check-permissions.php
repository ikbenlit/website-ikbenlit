<?php
// Plaats dit bestand in je WordPress root
$wp_content = __DIR__ . '/wp-content';
echo "WP Content directory: " . $wp_content . "\n";
echo "Exists: " . (file_exists($wp_content) ? 'Yes' : 'No') . "\n";
echo "Is writable: " . (is_writable($wp_content) ? 'Yes' : 'No') . "\n";
echo "Permissions: " . substr(sprintf('%o', fileperms($wp_content)), -4) . "\n"; 