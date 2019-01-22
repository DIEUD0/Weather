<?php
ob_start();

$currentSunrise = $currentWeather->sys->sunrise;
$currentSunset = $currentWeather->sys->sunset;
$hourSunrise = date('H:i', $currentSunrise);
$hourSunset = date('H:i', $currentSunset);
?>

<section class="row">
	<article class="col-12">
		<div class="textwbg <?= currentWeatherBg($currentWeather->weather[0]->id, time(), $currentSunrise, $currentSunset) ?>">
			<span class="float-right bigtxt">
				<?= roundZeroFix($currentWeather->main->temp).' '.tempTxt() ?>
				<img src="https://openweathermap.org/img/w/<?= fixImgSunriseSunset($currentWeather->weather[0]->icon, date('H:i'), $hourSunrise, $hourSunset) ?>.png" class="main" alt="Icone <?= $currentWeather->weather[0]->description ?>">
			</span>
			<h1>
				<i class="fas fa-city fa-sm shadow"></i>
				<?= $currentWeather->name ?>
			</h1>
			<span class="float-right mr-3">
				<?= ucfirst($currentWeather->weather[0]->description) ?>
			</span>
			<p>
				<i class="fas fa-sun shadow"></i>
				<?= $hourSunrise ?>
				<i class="ml-4 fas fa-moon shadow"></i>
				<?= $hourSunset ?>
			</p>
			<div class="row text-center">
				<div class="col-6">
					<p class="lgtxt">
						<i class="fas fa-tint fa-sm shadow"></i>&nbsp;
						Humidité:
						<?= $currentWeather->main->humidity ?>%
					</p>
				</div>
				<div class="col-6">
					<p class="lgtxt">
						Vent:
						<?= windConversion($currentWeather->wind->speed) ?>&nbsp;
						<?php if (isset($currentWeather->wind->deg)): ?>
						<i class="fas fa-arrow-up fa-sm shadow" data-fa-transform="rotate-<?= round($currentWeather->wind->deg) ?>"></i>
						<?php endif ?>
					</p>
				</div>
			</div>
		</div>
	</article>
</section>

<section class="row">
	<?php foreach ($forecastWeather['perhour'] as $forecastPerHour): ?>
	<article class="col-12 lessmargin">
		<div>
			<div class="row align-items-center">
				<div class="col-4">
					<p class="bold pt-1"><i class="far fa-clock fa-lg"></i>&nbsp;
						<?= $forecastPerHour['hour'] ?>
					</p>
				</div>
				<div class="col-4">
					<p class="text-center">
						<?= $forecastPerHour['description'] ?>
					</p>
				</div>
				<div class="bold col-4">
					<span class="float-right pb-2">
						<?= $forecastPerHour['temp'].' '.tempTxt() ?>
						<img src="https://openweathermap.org/img/w/<?= fixImgSunriseSunset($forecastPerHour['icon'], $forecastPerHour['hour'], $hourSunrise, $hourSunset) ?>.png" alt="Icone <?= $forecastPerHour['description'] ?>">
					</span>
				</div>
			</div>
		</div>
	</article>
	<?php endforeach ?>
</section>

<script>
	var maxTemp = [
		<?php foreach ($forecastWeather['perday'] as $chartMaxTemp): ?>
		<?= $chartMaxTemp['maxtemp'] ?>
		,
		<?php endforeach ?>
	];
	var minTemp = [
		<?php foreach ($forecastWeather['perday'] as $chartMaxTemp): ?>
		<?= $chartMaxTemp['mintemp'] ?>
		,
		<?php endforeach ?>
	];
</script>

<section class="row">
	<article class="col-12">
		<div class="chart">
			<div class="row text-center">
				<?php foreach ($forecastWeather['perday'] as $forecastPerDay): ?>
				<div class="col overflowhide  
					<?php if ($getDay == $forecastPerDay['date'][0]): ?>
						gradient
					<?php endif ?>">
					<a href="?day=<?= $forecastPerDay['date'][0] ?>" class="none" data-toggle="tooltip" data-placement="top" title="<?= $forecastPerDay['description'] ?>">
						<span class="
							<?php if ($getDay == $forecastPerDay['date'][0]): ?>
								bold
							<?php endif ?>">
							<?= days($forecastPerDay['day']) ?>
						</span>
						<p>
							<?= implode("/", $forecastPerDay['date']) ?>
						</p>
						<p>
							<img src="https://openweathermap.org/img/w/<?= $forecastPerDay['icon'] ?>.png" alt="Icone <?= $forecastPerDay['description'] ?>">
						</p>
					</a>
				</div>
				<?php endforeach ?>
			</div>
			<div class="none">
				<canvas id="lineChart"></canvas>
			</div>
		</div>
	</article>
</section>

<?php
//echo '<pre>'. print_r($forecastWeather['perday'], true). '</pre>';

$content = ob_get_clean();

require('template.php');
