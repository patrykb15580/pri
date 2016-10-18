<?php
	$router = Config::get('router');
?>	
<h2 id="show_top_title">
	<a href="<?= $router->generate('show_promotor', ['promotor_id' => $params['promotor_id']]) ?>" id="link_underline">
		<?= $reward->promotor()->name ?>
	</a> > 
	<a href="<?= $router->generate('show_promotor', ['promotor_id' => $params['promotor_id']]).'?show=rewards' ?>" id="link_underline">
		Katalog nagród
	</a> > <?= $reward->name ?>
</h2>
<hr>
Status: <?= PromotionAction::STATUSES[$reward->status] ?>
<br />Cena: <?= $reward->prize ?> pkt
<br /><br /><div id="reward_description"><?= nl2br($reward->description) ?></div>
<br />
<div id="reward_images_container">
<?php foreach ($reward->images() as $image) { 
	$img_path = "/system/".StringUntils::camelCaseToUnderscore(get_class($image))."s/".$image->id.'/small/'.$image->file_name; ?>
	<div id="reward_image_box">
		<img id="reward_image" src="<?= $img_path ?>">
	</div>
<?php } ?>
</div>
