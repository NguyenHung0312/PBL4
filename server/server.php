<?php
$logFile = "/var/log/apache2/site000/access/access-2022-11-05.log"; // local path to log file
// $logFile = "a"; // local path to log file
$interval = 1000; //how often it checks the log file for changes, min 100
$textColor = ""; //use CSS color
// Don't have to change anything bellow
if (!$textColor) $textColor = "white";
if ($interval < 100)  $interval = 100;
if (isset($_GET['getLog'])) {
	echo file_get_contents($logFile);
} else {
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Log</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
		<link rel="stylesheet" href="./assets/main.css">
		<style>
			@import url(http://fonts.googleapis.com/css?family=Ubuntu);

			* {
				margin: 0;
				padding: 0;
				border: 0;
				font-size: 100%;
			}

			.log_panel {
				background-color: black;
				color: <?php echo $textColor; ?>;
				font-family: 'Ubuntu', sans-serif;
				font-size: 16px;
				line-height: 20px;
			}

			h4 {
				font-size: 18px;
				line-height: 22px;
				color: #fff;
			}

			#log {
				position: relative;
				/* top: -34px; */
			}

			#scrollLock {
				width: 2px;
				height: 2px;
				display: block;
			}

			.log_panel {
				height: 500px;
				padding-top: 50px;
			}

			#box_check {
				display: block;
				height: 700px;
				background-color: #fff;
			}

			div.scroll {
				background-color: #ccc;
				height: 150px;
				overflow-x: hidden;
				overflow-y: auto;
				text-align: justify;
				padding: 20px;
			}
		</style>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
		<script>
			setInterval(readLogFile, <?php echo $interval; ?>);
			window.onload = readLogFile;
			var pathname = window.location.pathname;
			var scrollLock = false;

			function readLogFile() {
				$.get(pathname, {
					getLog: "true"
				}, function(data) {
					data = data.replace(new RegExp("\n", "g"), "<br />");
					$("#log").html(data);
					if (scrollLock == true) {
						$('html,body').animate({
							scrollTop: $("#scrollLock").offset().top
						}, <?php echo $interval; ?>)
					};
				});
			}
			//active button
			$(document).ready(function() {
				$('li').click(function() {
					$("li.active").removeClass("active");
					$(this).addClass('active');
				})
			});
		</script>
	</head>

	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="position: sticky; top:0; left: 0; z-index: 1;">
			<a class="navbar-brand" href="#">CheckLogs</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul id="btn-item" class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="#box_check">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Logs</a>
					</li>
				</ul>
				<form class="form-inline my-2 my-lg-0">
					<!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->
					<!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Secure</button> -->
					<label for="" class="lb" style="color:#ccc;" >Off</label>
					<label class="switch">
						<input type="checkbox" checked aria-label="Search" id="but">
						<span class="slider round"></span>
					</label>
					<label for="" class="lb" style="color: #28a745;">Secure</label>
				</form>
			</div>
		</nav>
		<div id="log" class="scroll" style="padding-top: 56px;">
		</div>
		<hr id="log2">
		<div id="box_check">

		</div>
	</body>

	</html>
<?php  } ?>