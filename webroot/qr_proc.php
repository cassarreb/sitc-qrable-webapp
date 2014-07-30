<?php

session_start();

if (!isset($_SESSION['qr_ref'])) {
	$_SESSION['qr_ref'] = 2;
}

$db = new PDO('mysql:host=localhost;dbname=sitc', 'root', '');

$statement = $db->prepare('SELECT * FROM qr WHERE qr=? AND ref=?');
$statement->bindValue('qr', $_POST['qr'], PDO::PARAM_STR);
$statement->bindValue('ref', $_SESSION['qr_ref'], PDO::PARAM_INT);
$statement->execute();

if ($statement->rowCount()) {
	$_SESSION['qr_ref']++;
}

if ($statement->fetchColumn(2) === '100') {
	echo 1;
} else {
	
}