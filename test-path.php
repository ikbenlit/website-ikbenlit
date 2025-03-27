<?php
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";
echo "Script Filename: " . $_SERVER['SCRIPT_FILENAME'] . "<br>";
echo "Current Dir: " . __DIR__ . "<br>";
echo "ABSPATH: " . (defined('ABSPATH') ? ABSPATH : 'Not defined') . "<br>"; 