<?php

require('config.php');
require('utils.php');
require('controllers/frontend.php');

try {
	if (isset($_GET['day'])) {
		if (isset($_GET['day']) && $_GET['day'] > 0) {
			showCity($_GET['day']);
		}
	} elseif (isset($_GET['action'])) {
		if ($_GET['action'] == 'find') {
			if (!empty($_POST['station']) && !empty($_POST['country']) && !empty($_POST['utc_offset'])) {
				findCity($_POST['station'], $_POST['country'], $_POST['utc_offset']);
			} else {
				throw new Exception('Veuillez choisir le nom d\'une ville valide');
			}
		} elseif ($_GET['action'] == 'change') {
			changeUnits();
		}
	} else {
		showCity();
	}
} catch (Exception $e) {
	echo 'Erreur : ' . $e->getMessage();
}
