<?php

/**
 * currentWeatherBg Function,
 * check the weather condition ID and return the right CSS class
 * https://openweathermap.org/weather-conditions
 *
 * @param  int $id
 * @param  int $atm
 * @param  int $sunrise
 * @param  int $sunset
 *
 * @return string
 */
function currentWeatherBg($id, $atm, $sunrise, $sunset)
{
	$thunderstorm = [200, 201, 202, 210, 211, 212, 221, 230, 231, 232];
	$snow = [600, 601, 602, 611, 612, 615, 616, 620, 621, 622];
	$cloud = [801, 802, 803, 804];
	$rain = [300, 301, 302, 310, 311, 312, 313, 314, 321, 500, 501, 502, 503, 504, 511, 520, 521, 522, 531, 701, 711, 721, 731, 741, 751, 761, 762, 771, 781];

	if (in_array($id, $thunderstorm)) {
		return 'thunder-storm';
	} elseif (in_array($id, $snow)) {
		return 'snow';
	} else {
		if ($atm >= $sunrise && $atm <= $sunset) {
			if (in_array($id, $cloud)) {
				return 'clouds';
			} elseif (in_array($id, $rain)) {
				return 'day-rain';
			} else {
				return 'day';
			}
		} else {
			if (in_array($id, $rain)) {
				return 'night-rain';
			} else {
				return 'night';
			}
		}
	}
}

/**
 * fixImgSunriseSunset Function,
 * check if $hour is between the sunrise/sunset hour
 * and adjust the 3rd letter of the icon name to fix API day/night icon
 *
 * @param  string $imgId
 * @param  string $hour
 * @param  string $sunrise
 * @param  string $sunset
 *
 * @return string
 */
function fixImgSunriseSunset($img, $hour, $sunrise, $sunset)
{
	if ($hour >= $sunrise && $hour <= $sunset) {
		return substr_replace($img, 'd', 2, 1);
	} else {
		return substr_replace($img, 'n', 2, 1);
	}
}

/**
 * tempTxt Function,
 * check if 'units' cookie exist, then return the correct unit name
 *
 * @return string
 */
function tempTxt()
{
	if (isset($_COOKIE['units'])) {
		return ' °F';
	} else {
		return ' °C';
	}
}

/**
 * windConversion Function,
 * check if 'units' cookie exist, then return the correct value
 *
 * @param  int $wind
 *
 * @return string
 */
function windConversion($wind)
{
	if (isset($_COOKIE['units'])) {
		return round($wind * 2.236936).' mp/h';
	} else {
		return round($wind * 3.6).' km/h';
	}
}

/**
 * days Function,
 * return the day abbreviation from date('w') function
 *
 * @param  int $day
 *
 * @return string
 */
function days($day)
{
	$days = ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'];
	return $days[$day];
}
