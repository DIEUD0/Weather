<?php

require_once('models/CityManager.php');
require_once('models/SearchManager.php');

/**
 * showCity Function,
 * check if the user already searched for a city or changed units
 * else we load the weather of Paris, °C and km/h
 *
 * @param  int $day
 *
 * @return void
 */
function showCity($day = null)
{
	$cityManager = new \OpenClassrooms\Projet5\Weather\CityManager();

	if (isset($_COOKIE['mycity']) && isset($_COOKIE['mytimezone'])) {
		$setCity = $cityManager->setCityId($_COOKIE['mycity']);
		$setTimezone = $cityManager->setTimezone($_COOKIE['mytimezone']);
	}
	if (isset($_COOKIE['units'])) {
		$unit = $cityManager->setUnit();
	}
	$currentWeather = $cityManager->getCurrentWeather();
	$setForecastData = $cityManager->setForecastWeather();
	$setDay = $cityManager->setDay($day);
	$setPerHour = $cityManager->setPerHourForecast();
	$setPerDay = $cityManager->setPerDayForecast();
	$forecastWeather = $cityManager->getForecastWeather();
	$getDay = $cityManager->getDay();

	require('views/frontend/cityView.php');
}

/**
 * findCity Function,
 * check if there's a weather station in user city
 * and if there's one we create 2 cookies and redirect him to the weather page
 *
 * @param  string $station
 * @param  string $country
 * @param  float $lati
 * @param  float $longi
 *
 * @return void
 */
function findCity($station, $country, $lati, $longi)
{
	$searchManager = new \OpenClassrooms\Projet5\Weather\SearchManager();

	$cityId = $searchManager->getCityId($station, $country);
	$timezoneName = $searchManager->getTimezoneName($lati, $longi);

	if ($cityId == false) {
		throw new Exception('Aucune station disponible dans cette ville');
	} else {
		setcookie('mycity', $cityId, time() + 365*24*3600, null, null, false, true);
		setcookie('mytimezone', $timezoneName, time() + 365*24*3600, null, null, false, true);
		header('Location: ./');
	}
}

/**
 * changeUnits Function,
 * create or delete the 'units' cookie, handle °C to °F and km/h to mp/h
 *
 * @return void
 */
function changeUnits()
{
	if (isset($_COOKIE['units'])) {
		setcookie('units', '', time() - 3600, null, null, false, true);
	} else {
		setcookie('units', ' ', time() + 365*24*3600, null, null, false, true);
	}
	header('Location: ./');
}
