<?php
	$router = Config::get('router');
	$path_new = $router->generate('new_promotion_codes_packages', ['promotors_id' => $params['promotors_id'], 'action_id' => $params['id']]);
	$path_update = $router->generate('edit_promotion_actions', ['promotors_id' => $params['promotors_id'], 'id' => $params['id']]);
	#echo "<pre>";
	#die(print_r($promotion_action));
?>	
<h1 id="show_top_title">Akcje promocyjne > <?= $promotion_action->name ?></h1>
<div id="show_top_options">
	<a href="<?= $path_update ?>">Edytuj</a>
</div>
<br /><a href="<?= $path_new ?>"><button id="add_new">Nowy pakiet kodów</button></a>
<br /><br />
Status: <?= PromotionAction::STATUSES[$promotion_action->status] ?>
<br />Czas trwania: <?php if ($promotion_action->indefinitely == 0) {echo "od ".$promotion_action->from_at." do ".$promotion_action->to_at;}else echo "bezterminowo"; ?>
<h3>Aktywne</h3>
<?php
	$packages = $promotion_action->activePackages();
	include 'app/views/promotion_actions/_promotion_codes_packages.php';
?>

<h3>Nieaktywne</h3>
<?php
	$packages = $promotion_action->inactivePackages();
	include 'app/views/promotion_actions/_promotion_codes_packages.php';
?>