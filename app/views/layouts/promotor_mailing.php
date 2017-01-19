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
					<h1 style="color: black; margin: 0px 0px 4px 20px;"><?= $promotor->name ?></h1>
				</td>
				<td width="50%" style="text-align: right; color: #87889B;">
						
				</td>
			</tr>
		</table>
		<div style="display: block; width: 500px; height: 5px; background-color: #007EEB;"></div>
		<div class="preview-content" style="display: block;
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
			<?=	$content ?>
		</div>
		<div style="display: block; width: 500px; color: #B8C1CB; font-size: 12px; text-align: center;">
			Wiadomość wysłana za pośrednictwem serwisu Punktacja.pl
		</div>
	</div>
</body>
</html>
