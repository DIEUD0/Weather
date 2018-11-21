<?php

ini_set('memory_limit', '-1');
ini_set('max_execution_time', '0');

try {
	$db = new PDO('mysql:host=localhost;dbname=projet5;charset=utf8', 'root', '');
} catch (Exception $e) {
	die('Erreur : '.$e->getMessage());
}

$url = file_get_contents('city.list.json'); // http://bulk.openweathermap.org/sample/
$array = json_decode($url, true);

foreach ($array as $row) {
	$id = $row['id'];
	$station =  $row['name'];
	$country = $row['country'];

	$sql = $db->prepare('INSERT INTO stations(id, station, country) VALUES(?, ?, ?)');
	$affectedLines = $sql->execute(array($id, $station, $country));
}
