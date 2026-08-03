<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

header('Content-Type: application/json');

include_once '../connection.php';
include_once '../model.php';
include_once '../auth/user.php'; // provides $id for the logged-in user
include_once '../etegram_helper.php';

$reference = trim($_POST['reference'] ?? '');
$action    = $_POST['action'] ?? 'verify'; // 'verify' | 'expire'

if (!$reference) {
    echo json_encode(['outcome' => 'error', 'message' => 'Missing reference.']);
    exit;
}

$result = $action === 'expire'
    ? etegram_expire_deposit($connection, $id, $reference)
    : etegram_verify_deposit($connection, $id, $reference);

echo json_encode([
    'outcome' => $result['outcome'],
    'message' => $result['message'],
    'status'  => $result['deposit']['status'] ?? null,
]);
