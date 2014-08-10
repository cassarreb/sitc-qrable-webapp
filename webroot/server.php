<?php

if (! isset($_POST['submit'])) {
	die();
}

session_start();

if (! isset($_SESSION['qr_codes'])) {
	$_SESSION['qr_codes'] = array();
}

$db = new PDO('mysql:host=localhost;dbname=sitc', 'root', '');

$qr = $_POST['qr'];

if (array_search($qr, $_SESSION['qr_codes']) !== FALSE) {
	?>{"found":1}<?php
	die();
}

$statement = $db->prepare('SELECT COUNT(*), funfact FROM stand WHERE qrcode=?');
$statement->bindValue(1, $qr, PDO::PARAM_STR);
$statement->execute();

if (! $statement->fetchColumn(0)) {
	?>{"non_occuring":1}<?php
	die();
}

$_SESSION['qr_codes'][] = $qr;

$qr_remaining = 10 - count($_SESSION['qr_codes']);var_dump($statement->fetchColumn(1));

?>
{"qr_remaining":<?php echo $qr_remaining; ?>,"funfact":"<?php echo $statement->fetchColumn(1); ?>"}
<?php

if (! $qr_remaining) {
	$current_code_id = $db->query('SELECT code_id FROM current_code', PDO::FETCH_COLUMN, 0);
	$current_code = $db->query('SELECT code FROM codes WHERE code_id=' . $current_code_id, PDO::FETCH_COLUMN, 0);
	?>{"token_code":<?php echo $current_code !== 5 ? $current_code : -1; ?>}<?php
	$current_code_id++;
	$db->query('UPDATE current_code SET code_id=' . $current_code_id);
}

?>