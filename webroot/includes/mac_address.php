<?php

/**
 * Finds MAC address of client.
 * Taken from http://www.webinfopedia.com/php-get-system-mac-address.html
 * @return MAC address string
 */
function get_mac_address() {
	ob_start();
	system('ipconfig /all');
	$output = ob_get_contents();
	ob_clean();

	return substr($output, strpos($output, 'Physical') + 36, 17);
}

/**
 * Looks up MAC address in database
 * @param $db PDO connection object
 * @return Boolean value whether MAC address is found
 */
function mac_found($db) {
	$statement = $db->prepare('SELECT COUNT(*) FROM player WHERE mac_address=?');
	$statement->bindValue(1, get_mac_address(), PDO::PARAM_STR);
	$statement->execute();

	return $statement->fetchColumn() > 0;
}

/**
 * Adds a new MAC address to database
 * @param $db PDO connection object
 * @return Boolean value whether operation was suceessful
 */
function record_mac($db) {
	$statement = $db->prepare('INSERT INTO player (mac_address) VALUES (?)');
	$statement->bindValue(1, get_mac_address(), PDO::PARAM_STR);

	return $statement->execute();
}