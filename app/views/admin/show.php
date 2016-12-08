<?php
	$router = Config::get('router');
	$path_new = $router->generate('new_promotors', []);
?>	
<div id="title-box">
	<i class="fa fa-users title-box-icon light-purple-icon" aria-hidden="true"></i><p class="title-box-text">Promotorzy</p>
</div>
<div id="title-box-options-bar">
	<a href="<?= $path_new ?>"><button class="options-bar-button">Nowy promotor</button></a>
</div>
<?php 
	include 'app/views/admin/_promotors.php';
?>


<div class="left-label label" data-div="div-1">yuitdeunjtr</div><div class="right-label label" data-div="div-2">ewfwefewfe</div>
<br />


<div class="div div-1">
	edokwefewuqif
</div>

<div class="div div-2">
	ddjifheqi
</div>

<p class="js-data"></p>

<script type="text/javascript">
	$('.div-2').hide();

	$('.label').click(function(){
		var val = $(this).data('div');
		$.when($('.div').fadeOut()).then(function(){$('.' + val).fadeIn()});

		$('.js-data').html(val);
	});
</script>