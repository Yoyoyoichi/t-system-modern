?<?php
header('Content-Type: text/plain');
\ = [];
\ = 0;
exec('php -l sample020.php 2>&1', \, \);
echo "Return var: " . \ . "\n";
echo implode("\n", \);
?>
