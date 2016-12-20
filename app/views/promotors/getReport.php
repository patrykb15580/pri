<?php 
	$new_clients = count($promotor->newClientsInMonth(date('Y-m-d')));
	$clients_number = count($promotor->clients());

	$new_clients_ratio = 0;

	if (($clients_number - $new_clients) == 0 && $clients_number > 0) {
		$new_clients_ratio = '+ 100%';
	} else if (($clients_number - $new_clients) == $clients_number) {
		$new_clients_ratio = '+ 0%';
	} else {
		$new_clients_ratio = (($clients_number / ($clients_number - $new_clients)) * 100) - 100;
		$new_clients_ratio = '+ '.$new_clients_ratio.'%';
	}

	$used_codes_in_month = $promotor->codesUsedInMonth(date('Y-m-d'));

	$new_codes = count($used_codes_in_month);

	$codes_number = count($promotor->usedCodes());

	$new_codes_ratio = 0;

	if (($codes_number - $new_codes) == 0 && $codes_number > 0) {
		$new_codes_ratio = '+ 100%';
	} else if (($codes_number - $new_codes) == $codes_number) {
		$new_codes_ratio = '+ 0%';
	} else {
		$new_codes_ratio = (($codes_number / ($codes_number - $new_codes)) * 100) - 100;
		$new_codes_ratio = '+ '.$new_codes_ratio.'%';
	}

	$scored_points = 0;
	foreach ($used_codes_in_month as $code) {
		$value = $code->codeValue();
		$scored_points = $scored_points + $value;
	}
?>

<div style="display: block;
			width: 176mm; 
			height: 10mm; 
			background-color: #DCE6F0;
			margin: 0px auto 20mm auto;
			line-height: 8mm;
			padding: 5mm;
			font-size: 10mm;
			font-weight: bold;
">
	<?= $promotor->name ?>
</div>
<div style="display: block;
			width: 72%;
			margin: 0 auto;	
">
	<div style="position: relative;
				display: inline-block;
				width: 40mm; 
				height: 40mm; 
				background-color: white; 
				border: 1px solid; 
				border-radius: 20mm; 
				margin: 0px 2mm 0px 2mm;	
	">
		<p style="text-align: center; font-size: 10mm; font-weight: bold; margin: 12mm 0px 0px 0px; padding: 0px;">
			<?= $new_clients ?>
		</p>
		<p style="text-align: center; font-size: 3mm; margin: 0px 0px 0px 0px; padding: 0px;">
			Nowych klientów
		</p>
		<div style="position: absolute; 
					top: 0px; 
					left: 0px; 
					width: 12mm; 
					height: 12mm; 
					background-color: white; 
					border: 1px solid; 
					border-radius: 6mm; 
					font-size: 2.6mm; 
					font-weight: bold;
					text-align: center; 
					line-height: 7mm;
					padding: 0px;
		">
			<?= $new_clients_ratio ?>
		</div>
	</div>
	<div style="position: relative;
				display: inline-block;
				width: 40mm; 
				height: 40mm; 
				background-color: white; 
				border: 1px solid; 
				border-radius: 20mm; 
				margin: 0px 2mm 0px 2mm;	
	">
		<p style="text-align: center; font-size: 10mm; font-weight: bold; margin: 12mm 0px 0px 0px; padding: 0px;">
			<?= $new_codes ?>
		</p>
		<p style="text-align: center; font-size: 3mm; margin: 0px 0px 0px 0px; padding: 0px;">
			Użytych kodów
		</p>
		<div style="position: absolute; 
					top: 0px; 
					left: 0px; 
					width: 12mm; 
					height: 12mm; 
					background-color: white; 
					border: 1px solid; 
					border-radius: 6mm; 
					font-size: 2.6mm; 
					font-weight: bold;
					text-align: center; 
					line-height: 7mm;
					padding: 0px;
		">
			<?= $new_codes_ratio ?>
		</div>
	</div>
	<div style="position: relative;
				display: inline-block;
				width: 40mm; 
				height: 40mm; 
				background-color: white; 
				border: 1px solid; 
				border-radius: 20mm; 
				margin: 0px 2mm 0px 2mm;	
	">
		<p style="text-align: center; font-size: 10mm; font-weight: bold; margin: 12mm 0px 0px 0px; padding: 0px;;">
			<?= $scored_points ?>
		</p>
		<p style="text-align: center; font-size: 3mm; margin: 0px 0px 0px 0px; padding: 0px;">
			Zdobytych punktów
		</p>
	</div>
</div>
<br /><br />
<h3>Liczba użytych kodów w poszczególnych dniach miesiąca</h3>
<div style=" width: 176mm;" id="report-chart" data-promotorid="<?= $promotor->id ?>" data-month="<?= date('m') ?>"></div>

<script type="text/javascript" src="/assets/javascript/reportCharts.js"></script>