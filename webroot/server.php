<?php

if (!isset($_POST['submit'])) {
	die();
}

session_start();

if (!isset($_SESSION['qr_codes'])) {
	$_SESSION['qr_codes'] = array();
}

$db = new PDO('mysql:host=localhost;dbname=sitc', 'root', '');

$qr = $_POST['qr'];

$statement = $db->prepare('SELECT * FROM stand WHERE qr=?');
$statement->bindValue('qr', $qr, PDO::PARAM_STR);
$statement->execute();

if (array_search($_SESSION['qr_codes']) === FALSE) {
	?>{"found":1}<?php
	die();
}

$_SESSION['qr_codes'][] = $qr;

$qr_count = count($_SESSION['qr_codes']);

?>
{"qr_remaining":<? echo 10 - $qr_count; ?>}