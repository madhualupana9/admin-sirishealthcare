<?php
echo "Test file - admins directory is accessible!";
echo "<br>";
echo "Current directory: " . __DIR__;
echo "<br>";
echo "Public directory exists: " . (is_dir(__DIR__ . '/public') ? 'YES' : 'NO');
echo "<br>";
echo "Index.php exists: " . (file_exists(__DIR__ . '/public/index.php') ? 'YES' : 'NO');
?>

