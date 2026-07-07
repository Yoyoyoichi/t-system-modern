<?php
require_once 'db_wrapper.php';
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');

header('Content-Type: application/json');

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data || !isset($data['questionnumber']) || !isset($data['db_name']) || !isset($data['hint'])) {
    echo json_encode(['success' => false, 'error' => 'Missing required parameters']);
    exit;
}

$questionnumber = $data['questionnumber'];
$db_name = $data['db_name'];
$hint = $data['hint'];

$mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');

if ($mysqli->connect_errno) {
    echo json_encode(['success' => false, 'error' => 'Database connection failed']);
    exit;
}

$mysqli->set_charset("utf8");

// Escape data
$safe_questionnumber = $mysqli->real_escape_string($questionnumber);
$safe_db_name = $mysqli->real_escape_string($db_name);
$safe_hint = $mysqli->real_escape_string($hint);

// Allow any table, but enforce basic safety (table names shouldn't have quotes/spaces)
if (!preg_match('/^[a-zA-Z0-9_-]+$/', $safe_db_name)) {
    echo json_encode(['success' => false, 'error' => 'Invalid database name format']);
    exit;
}

$sql = "UPDATE `$safe_db_name` SET hint = '$safe_hint' WHERE questionnumber = '$safe_questionnumber'";

if ($mysqli->query($sql)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $mysqli->error]);
}
