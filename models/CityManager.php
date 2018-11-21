<?php

namespace OpenClassrooms\Projet5\Weather;

class CityManager
{
	private $_cityId = 6455259; // Paris ID by default
	private $_timezone = 'Europe/Paris';
	private $_unit = 'metric';
	private $_array;
	private $_day;

	public function setCityId($cityId)
	{
		$this->_cityId = (int) $cityId;
	}

	public function setTimezone($tz)
	{
		$this->_timezone = $tz;
	}

	public function setUnit()
	{
		$this->_unit = 'imperial';
	}

	public function getCurrentWeather()
	{
		$url = 'https://api.openweathermap.org/data/2.5/weather?lang=fr&id='.$this->_cityId.'&units='.$this->_unit.'&APPID='.APIKEY;
		$result = file_get_contents($url);

		return json_decode($result);
	}

	public function setForecastWeather()
	{
		$url = 'https://api.openweathermap.org/data/2.5/forecast?lang=fr&id='.$this->_cityId.'&units='.$this->_unit.'&APPID='.APIKEY;
		$result = file_get_contents($url);

		$this->_array = json_decode($result, true);
	}

	/**
	 * setDay Method,
	 * fixing summer hour problem and set the forecast day to show
	 *
	 * @param  int $day
	 *
	 * @return void
	 */
	public function setDay($day)
	{
		date_default_timezone_set($this->_timezone);
		if (isset($day)) {
			$this->_day = (int) $day;
		} else {
			$this->_day = date("j", $this->_array['list'][0]['dt']);
		}
	}

	/**
	 * setPerHourForecast Method,
	 * create a new array of values [perhour] to gather the infos for 1 specific day
	 *
	 * @return void
	 */
	public function setPerHourForecast()
	{
		foreach ($this->_array['list'] as $key => $value) {
			$this->_array['perhour'][$key]['date'] = explode('/', date("j/n", $value['dt']));
			$this->_array['perhour'][$key]['hour'] = date("H:i", $value['dt']);
			$this->_array['perhour'][$key]['icon'] = $value['weather'][0]['icon'];
			$this->_array['perhour'][$key]['description'] = ucfirst($value['weather'][0]['description']);
			$this->_array['perhour'][$key]['temp'] = round($value['main']['temp'], 0);

			// We delete every elements of [perhour] array that do not match with $this->_day
			if ($this->_array['perhour'][$key]['date'][0] != $this->_day) {
				unset($this->_array['perhour'][$key]);
			}
		}
	}

	/**
	 * setPerDayForecast Method,
	 * create 2 new array of values [conditon] and [perday] for the chart
	 *
	 * @return void
	 */
	public function setPerDayForecast()
	{
		$lastDay = '';
		$x = 0;
		foreach ($this->_array['list'] as $key => $value) {
			$this->_array['condition'][$key]['date'] = date("j", $value['dt']);

			if ($this->_array['condition'][$key]['date'] != $lastDay) {
				$thisDay = $this->_array['condition'][$key]['date'];
				$lastDay = $this->_array['condition'][$key]['date'];

				$this->_array['perday'][$thisDay]['day'] = date('w', $value['dt']);
				$this->_array['perday'][$thisDay]['date'] = explode('/', date("j/n", $value['dt']));
				$this->_array['perday'][$thisDay]['icon'] = $value['weather'][0]['icon'];
				$this->_array['perday'][$thisDay]['description'] = ucfirst($value['weather'][0]['description']);
				$this->_array['perday'][$thisDay]['maxtemp'] = round($value['main']['temp_max']);
				$this->_array['perday'][$thisDay]['mintemp'] = round($value['main']['temp_min']);
				$x++;
			} else {
				// Gather available infos between 1pm-3pm
				$this->_array['perday'][$lastDay]['hour'] = date("H", $value['dt']);
				if ($this->_array['perday'][$lastDay]['hour'] >= 13 && $this->_array['perday'][$lastDay]['hour'] <= 15) {
					$this->_array['perday'][$lastDay]['icon'] = $value['weather'][0]['icon'];
					$this->_array['perday'][$lastDay]['description'] = ucfirst($value['weather'][0]['description']);
				}

				// Condition with ternary operator, update max/min temp value if needed
				$this->_array['perday'][$lastDay]['mintemp'] = round($value['main']['temp_min']) < $this->_array['perday'][$lastDay]['mintemp'] ? round($value['main']['temp_min']) : $this->_array['perday'][$lastDay]['mintemp'];
				$this->_array['perday'][$lastDay]['maxtemp'] = round($value['main']['temp_max']) > $this->_array['perday'][$lastDay]['maxtemp'] ? round($value['main']['temp_max']) : $this->_array['perday'][$lastDay]['maxtemp'];
			}

			// To not continue after the 5th day, because the 6th day is never complete
			if ($x > 5) {
				unset($this->_array['perday'][$lastDay]);
				break;
			}
		}
	}

	public function getForecastWeather()
	{
		return $this->_array;
	}

	public function getDay()
	{
		return $this->_day;
	}
}
