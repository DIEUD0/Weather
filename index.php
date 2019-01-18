<?php

require('settings/config.php');
require('settings/utils.php');
require('controllers/frontend.php');

try {
	if (isset($_GET['day'])) {
		if (isset($_GET['day']) && $_GET['day'] > 0) {
			showCity($_GET['day']);
		}
	} elseif (isset($_GET['action'])) {
		if ($_GET['action'] == 'find') {
			if (!empty($_POST['station']) && !empty($_POST['country']) && !empty($_POST['latitude']) && !empty($_POST['longitude'])) {
				findCity($_POST['station'], $_POST['country'], $_POST['latitude'], $_POST['longitude']);
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
