?<?php
require_once 'db_wrapper.php';
\ = new db_wrapper();
\ = \->query("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'");
while (\ = \->fetch_assoc()) {
    echo \['table_name'] . "\n";
}
?>
