<?php

/**
 * Load QR codes from player table.
 * @param $db PDO connection object
 * @return Array of QR codes
 */
function load_qr_codes($db) {
	$statement = $db->prepare('SELECT stands FROM player WHERE mac_address=?');
	$statement->bindValue(1, get_mac_address(), PDO::PARAM_STR);
	$statement->execute();

	//Get array of primary keys
	$res_str = $statement->fetchColumn();
	$stands = ($res_str !== '' ? explode(';', $res_str) : array());

	//Build array of QR codes
	$qr_codes = array();
	foreach ($stands as $stand) {
		$statement = $db->prepare('SELECT qrcode FROM stand WHERE stand_id=?');
		$statement->bindValue(1, $stand, PDO::PARAM_INT);
		$statement->execute();

		$qr_codes[] = $statement->fetchColumn();
	}

	return $qr_codes;
}

/**
 * Save QR codes to player table.
 * @param $db PDO connection object
 * @param $qr_codes Array of QR codes
 * @return Boolean showing success of operation
 */
function save_qr_codes($db, $qr_codes) {
	//Build array of primary keys
	$stands = array();
	foreach ($qr_codes as $qr_code) {
		$statement = $db->prepare('SELECT stand_id FROM stand WHERE qrcode=?');
		$statement->bindValue(1, $qr_code, PDO::PARAM_STR);
		$statement->execute();

		$stands[] = $statement->fetchColumn();
	}

	//Get string of concatenated stands
	$stands_str = implode(';', $stands);

	$statement = $db->prepare('UPDATE player SET stands=? WHERE mac_address=?');
	$statement->bindValue(1, $stands_str, PDO::PARAM_STR);
	$statement->bindValue(2, get_mac_address(), PDO::PARAM_STR);
	return $statement->execute();
}