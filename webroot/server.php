<?php

require_once 'includes/mac_address.php';
require_once 'includes/progress.php';

if (! isset($_POST['submit'])) {
	die();
}

$db = new PDO('mysql:host=localhost;dbname=sitc', 'root', '');

$qr = $_POST['qr'];

if (! mac_found($db)) {
	record_mac($db);
}

$qr_codes = load_qr_codes($db);

if (count($qr_codes) === 10) {
	?>{"already_won":1}<?php
	die();
}

if (array_search($qr, $qr_codes) !== FALSE) {
	?>{"found":1}<?php
	die();
}

$statement = $db->prepare('SELECT COUNT(*) AS qr_count, funfact FROM stand WHERE qrcode=?');
$statement->bindValue(1, $qr, PDO::PARAM_STR);
$statement->execute();
$qr_row = $statement->fetch(PDO::FETCH_ASSOC);

if (! $qr_row['qr_count']) {
	?>{"non_occuring":1}<?php
	die();
}

$qr_codes[] = $qr;

save_qr_codes($db, $qr_codes);

$qr_remaining = 10 - count($qr_codes);

$response_obj = array();

$response_obj['qr_remaining'] = $qr_remaining;
$response_obj['funfact'] = $qr_row['funfact'];

if (! $qr_remaining) {
	$statement = $db->query('SELECT code_id FROM current_code');
	$current_code_id = $statement->fetch(PDO::FETCH_COLUMN);
	$statement = $db->query('SELECT code FROM codes WHERE code_id=' . $current_code_id);
	$current_code = $statement->fetch(PDO::FETCH_COLUMN);
	
	$response_obj['token_code'] = ($current_code !== 5 ? $current_code : -1);
	
	$current_code_id++;
	$db->query('UPDATE current_code SET code_id=' . $current_code_id);
}

echo json_encode($response_obj);
