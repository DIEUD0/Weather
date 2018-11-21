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
	 * @param  int $utcOffset
	 *
	 * @return string
	 */
	public function getTimezoneName($utcOffset)
	{
		$utcOffset = $utcOffset * 60;
		$tz = timezone_name_from_abbr('', $utcOffset, 1);
		if ($tz === false) {
			$tz = timezone_name_from_abbr('', $utcOffset, 0);
		}
		
		return $tz;
	}
}
