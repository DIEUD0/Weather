<?php

namespace OpenClassrooms\Projet5\Weather;

require_once("models/Manager.php");

class SearchManager extends Manager
{
	/**
	 * getCityId Method,
	 * return the city ID to use with OpenWeatherMap API
	 *
	 * @param  string $station
	 * @param  string $country
	 *
	 * @return int
	 */
	public function getCityId($station, $country)
	{
		$req = $this->dbConnect()->prepare('SELECT id FROM stations WHERE station = ? and country= ? LIMIT 1');
		$req->execute(array($station, $country));
		$cityId = $req->fetch();

		return $cityId[0];
	}

	/**
	 * getTimezoneName Method,
	 * return the current timezone from the utc offset coming from Google Autocomplete Places library
	 *
	 * @param  float $lati
	 * @param  float $longi
	 *
	 * @return string
	 */
	public function getTimezoneName($lati, $longi)
	{
		date_default_timezone_set("UTC");
		$url = 'https://maps.googleapis.com/maps/api/timezone/json?location='.$lati.','.$longi.'&timestamp='.time().'&key='.GOOGLE_APIKEY;
		$result = file_get_contents($url);
		$json_tz = json_decode($result);

		return $json_tz->timeZoneId;
	}
}
