<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?= '<title>' . TITLE . '</title>' . "\n" ?>
	<meta name="description" content="<?= DESCRIPTION ?>">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="./public/css/style.css" />
	<link rel="apple-touch-icon" sizes="180x180" href="./public/images/icons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="./public/images/icons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="./public/images/icons/favicon-16x16.png">
	<link rel="manifest" href="./public/images/icons/site.webmanifest">
	<link rel="mask-icon" href="./public/images/icons/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="shortcut icon" href="./public/images/icons/favicon.ico">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-config" content="./public/images/icons/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<![endif]-->
</head>

<!--<?= 'Date et heure actuelle de cette ville : ' . date('j/n H:i') ?>-->

<body>
	<div class="container">
		<nav class="navbar navbar-expand-sm navbar-light mt-3 mb-2">
			<form action="index.php?action=find" class="form-inline mx-auto mb-2" method="post">
				<div class="input-group">
					<input id="autocomplete" class="form-control" placeholder="Votre ville" type="text">
					<div class="input-group-append">
						<button class="btn btn-outline-success" type="submit"><i class="fa fa-paper-plane"></i></button>
					</div>
				</div>
				<input id="locality" type="hidden" name="station">
				<input id="country" type="hidden" name="country">
				<input id="utc_offset" type="hidden" name="utc_offset">
			</form>
			<button class="navbar-toggler mb-2" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<ul class="navbar-nav text-center ml-auto">
					<li class="nav-item active">
						<a class="nav-link" href="index.php"><i class="fas fa-sun fa-2x"></i><br />Météo<span class="sr-only"> (current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="index.php?action=change"><i class="fas fa-thermometer-three-quarters fa-2x"></i><br />Unité</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="toggle" href="#"><i class="fas fa-lightbulb fa-2x"></i><br />Thème</a>
					</li>
				</ul>
			</div>
		</nav>
		<?= $content ?>
		<footer>
			<p class="text-center">&copy; Site créer pour un projet OpenClassrooms</p>
		</footer>
		<a href="#" id="go-top">
			<i class="fas fa-chevron-up fa-lg"></i>
		</a>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" integrity="sha384-kW+oWsYx3YpxvjtZjFXqazFpA7UP/MbiY4jvs+RWZo2+N94PFZ36T6TFkc9O3qoB" crossorigin="anonymous"></script>
	<script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgj8WgLORXSYX0O5qmjniez9j8XsqCBtM&libraries=places&callback=citySearch"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.2/dist/Chart.min.js" integrity="sha256-CfcERD4Ov4+lKbWbYqXD6aFM9M51gN4GUEtDhkWABMo=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.4.0/dist/chartjs-plugin-datalabels.min.js" integrity="sha256-SuPHzbJ4RjnP4lvabrH9n9nPJrUZlG4SbCvTGMtpEaU=" crossorigin="anonymous"></script>
	<script src="./public/js/autocomplete.js"></script>
	<script src="./public/js/chart.js"></script>
	<script src="./public/js/theme.js"></script>
	<script src="./public/js/gotop.js"></script>
	<script src="./public/js/init.js"></script>
</body>

</html>