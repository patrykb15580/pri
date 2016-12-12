<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

	<style type="text/css">
		a {
			text-decoration: none;
		}
	</style>
</head>
<body style="background-color: #E3EBF3; margin: 0px; padding: 100px 0px;">
	<div style="width: 500px; margin: 0 auto;">
		<table width="100%">
			<tr>
				<td width="50%">
					<h1 style="color: black; margin: 0px 0px 4px 20px;">punktacja</h1>
				</td>
				<td width="50%" style="text-align: right; color: #87889B;">
					Znajdziesz nas na <img style="vertical-align: middle;" src="<?= Config::get('host') ?>/static/fb.png" alt="fb"> <img style="margin: 0px 20px 0px 0px; vertical-align: middle;" src="<?= Config::get('host') ?>/static/pinterest.png" alt="pinterest">
				</td>
			</tr>
		</table>
		<div style="display: block; width: 500px; height: 5px; background-color: #61C63F;"></div>
		<div style="display: block;
			background-color: white;
			margin: 0px 0px 20px 0px;
			padding: 15px 50px 30px 50px;
			width: 396px;
			border-top: 0px;
			border-right: 2px;
			border-bottom: 2px;
			border-left: 2px;
			border-color: #CED2D6;
			border-style: solid;
			font-size: 14px;
			color: #353535;
		">
			<?php
				include 'app/views/mailing/'.$method_name.'.php';
			?>
		</div>
		<div style="display: block; width: 500px; color: #B8C1CB; font-size: 12px; text-align: center;">
			<table width="100%">
				<tr>
					<td style="text-align: center;" width="50%">
						<img style="width: 16px; height: 16px; vertical-align: middle;" src="<?= Config::get('host') ?>/static/www.png" alt="www"> www.punktacja.pl	
					</td>
					<td style="text-align: center;" width="50%">
						<img style="width: 16px; height: 16px; vertical-align: middle;" src="<?= Config::get('host') ?>/static/email.png" alt="email"> info@punktacja.pl
					</td>
				</tr>
			</table>
			<br />
			Wiadomość wygenerowana automatycznie, prosimy na nią nie odpowiadać.
		</div>
	</div>
</body>
</html>
