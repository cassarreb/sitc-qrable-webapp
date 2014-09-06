<?php

require_once 'includes/mac_address.php';
require_once 'includes/progress.php';

$db = new PDO('mysql:host=localhost;dbname=sitc', 'root', '');

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="static/base.css">

		<title>QRable</title>
	</head>
	<body>
		<div class="container theme-showcase">
			<nav role="navigation" class="navbar navbar-default">
				<div class="navbar-header">
					<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" type="button">
						<span class="sr-only">Toggle</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="navbar-collapse collapse in">
					<ul class="menu nav navbar-nav navbar-right">
						<li>
							<a target="_blank" href="http://dand.netne.net/?page_id=6">
								<span>Daniel Desira - lead developer</span>
							</a>
						</li>
						<li>
							<a target="_blank" href="https://github.com/dannydes/sitc-qrable-webapp">
								<div class="fa fa-github-alt"></div>
								<span>Fork us on Github</span>
							</a>
						</li>
						<li>
							<a target="_blank" href="http://www.scienceinthecity.org.mt/">
								<img alt="Science in the City" src="https://fbcdn-sphotos-g-a.akamaihd.net/hphotos-ak-xaf1/v/t1.0-9/602585_137686633039158_2131553306_n.jpg?oh=4e980c965d069dbccfe69091ade3396e&oe=548ADA17&__gda__=1418644934_6be06968e3929bf52afb340bfb6303a6" height="70" width="70">
							</a>
						</li>
						<li>
							<a target="_blank" href="http://www.ictsamalta.org">
								<img alt="ICTSA" src="static/ICTSALogo.png">
							</a>
						</li>
					</ul>
				</div>
			</nav>
			<div id="start_modal" class="modal">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header"></div>
						<div class="modal-body">
							Click the button to start!
						</div>
						<div class="modal-footer">
							<button id="start" class="btn btn-primary" type="button">Start!</button>
						</div>
					</div>
				</div>
			</div>
			<p class="waiting">
				waiting 
				<strong class="waiting_dots">
					<span class="first_waiting_dot">.</span>
					<span class="second_waiting_dot">.</span>
					<span class="third_waiting_dot">.</span>
				</strong>
			</p>
			<p>
				<strong id="qr_remaining"><?php echo 10 - count(load_qr_codes($db)); ?></strong> stands remaining!
			</p>
			<p>
				<strong id="funfact"></strong>
			</p>
			<div id="non_occuring_qr" class="modal">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Close</span>
							</button>
						</div>
						<div class="modal-body">
							This QR code does not exist!
						</div>
					</div>
				</div>
			</div>
			<div id="token_code_modal" class="modal">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Close</span>
							</button>
						</div>
						<div class="modal-body">
							Congratulations! You may now redeem your prize. Token code: <strong id="token_code"></strong>
						</div>
					</div>
				</div>
			</div>
			<div id="duplicate_qr" class="modal">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Close</span>
							</button>
						</div>
						<div class="modal-body">
							This QR code has already been scanned!
						</div>
					</div>
				</div>
			</div>
			<div id="already_won" class="modal">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Close</span>
							</button>
						</div>
						<div class="modal-body">
							You already won! It's someone else's turn.
						</div>
					</div>
				</div>
			</div>
			<div id="file_reader_ns" class="modal">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Close</span>
							</button>
						</div>
						<div class="modal-body">
							We're sorry, but file reader is not supported by your browser!
						</div>
					</div>
				</div>
			</div>
			<div id="object_url_ns" class="modal">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Close</span>
							</button>
						</div>
						<div class="modal-body">
							We're sorry, but Object URL is not supported by your browser!
						</div>
					</div>
				</div>
			</div>
			<div id="xhr_error" class="modal">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Close</span>
							</button>
						</div>
						<div class="modal-body">
							Oh noes! Something went wrong on our side. Please, contact our team.
						</div>
					</div>
				</div>
			</div>
			<form id="qr_form" method="post" action="#">
				<label for="qr">QR code:</label>
				<input id="qr" class="form-control" type="text" name="qr">
				<input id="load_qr" class="load_qr" type="file" name="load_qr" accept="image/*">
				<button id="get_qr" class="btn btn-default" type="button" name="get_qr">Get QR</button>
				<button class="btn btn-primary" type="submit" name="submit">Go</button>
			</form>
			<noscript class="alert alert-warning noscript">
				Please <a href="//enable-javascript.com" target="_blank">enable JavaScript.</a>
			</noscript>
		</div>
		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script src="//dannydes.github.io/jsqrcode-production/jsqrcode.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
		<script src="static/base.js"></script>
	</body>
</html>
