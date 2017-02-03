<div id="title-box">
	<i class="fa fa-envelope-open-o title-box-icon dark-blue-icon" aria-hidden="true"></i><p class="title-box-text">Mailing</p>
</div>

<form id="mailing-tool" method="POST" action="<?= $router->generate('send_promotor_mailing', ['promotors_id'=>$promotor->id]) ?>">
	<div class="title">
		<span>Tytuł: </span><input type="text" name="title">
	</div>
	<div class="recipients">
		Wyślij do 
		<select class="select-group" name="group">
			<option value="0">Wszystkich klientów (<?= count($promotor->clients()) ?>)</option>
			<option value="1">Klientów akcji</option>
		</select>
		<select class="actions" name="action">
			<?php
				$actions = $promotor->actions();

				//usort($actions, function ($a, $b) {
				//    return $a->email <=> $b->email;
				//});

				foreach ($actions as $action) { ?>
					<option value="<?= $action->id ?>"><?= $action->name ?> (<?= count($action->clients()) ?>)</option><br />
				<?php }
			?>
		</select>
	</div>
	<input type="hidden" name="content" value="">
	<div class="editor"></div>	
	<div class="preview">
		<p class="preview-title">Podgląd wiadomości</p>
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

			</div>
			<div style="display: block; width: 500px; color: #B8C1CB; font-size: 12px; text-align: center;">
				Wiadomość wysłana za pośrednictwem serwisu Punktacja.pl
			</div>
		</div>
	</div>
	<input type="submit" value="Wyślij">
</form>

<script type="text/javascript" src="/assets/javascript/trumbowyg/dist/langs/pl.min.js"></script>

<script type="text/javascript" src="/assets/javascript/trumbowyg/dist/trumbowyg.min.js"></script>

<script type="text/javascript">
	$('#mailing-tool .editor').trumbowyg({
		lang: 'pl',
	    btns: [
	        ['formatting'],
	        'btnGrp-design',
	        ['superscript', 'subscript'],
	        ['link'],
	        'btnGrp-justify',
	        'btnGrp-lists',
	        ['horizontalRule'],
	        ['removeformat'],
        ]
	});

	$('.actions').hide();

	$('#mailing-tool .editor').on('blur keyup keydown paste mouseup', function(){
		var content = $('#mailing-tool .editor').trumbowyg('html');
		$('input[name=content]').val(content);
		$('.preview-content').html(content);
	});
	
	$('.select-group').change(function(){
		var val = $(this).val();
		if (val == 1) {
			$('.actions').fadeIn();
		} else if (val > 1 || val < 1) {
			$('.actions').fadeOut();
		}
	});


</script>
