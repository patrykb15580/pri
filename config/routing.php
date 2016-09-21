<?php
if (isset($_POST['method'])) {
	$_SERVER['REQUEST_METHOD'] = $_POST['method'];
}

#die(print_r($_POST));

$router = new AltoRouter();
#$router->map( 'GET', '/', 'ok', 'main_page' );


$router->map( 'GET', '/promotors/[i:promotors_id]', 'PromotorsController#show', 'show_promotors' );
#$router->map( 'GET', '/promotors/new/', 'PromotorsController#new', 'new_promotors' );


$router->map( 'GET', '/promotors/[i:promotors_id]/promotion-actions/[i:id]', 'PromotionActionsController#show', 'show_promotion_actions' );
$router->map( 'GET', '/promotors/[i:promotors_id]/promotion-actions/new', 'PromotionActionsController#new', 'new_promotion_actions' );
$router->map( 'POST', '/promotors/[i:promotors_id]/promotion-actions', 'PromotionActionsController#create', 'create_promotion_actions' );
$router->map( 'GET', '/promotors/[i:promotors_id]/promotion-actions/[i:id]/edit', 'PromotionActionsController#edit', 'edit_promotion_actions' );
$router->map( 'POST', '/promotors/[i:promotors_id]/promotion-actions/[i:id]/update', 'PromotionActionsController#update', 'update_promotion_actions' );


$router->map( 'GET', '/promotors/[i:promotors_id]/rewards', 'RewardsController#index', 'index_rewards' );
$router->map( 'GET', '/promotors/[i:promotors_id]/rewards/[i:id]', 'RewardsController#show', 'show_rewards' );
$router->map( 'GET', '/promotors/[i:promotors_id]/rewards/new', 'RewardsController#new', 'new_rewards' );
$router->map( 'POST', '/promotors/[i:promotors_id]/rewards/create', 'RewardsController#create', 'create_rewards' );
$router->map( 'GET', '/promotors/[i:promotors_id]/rewards/[i:id]/edit', 'RewardsController#edit', 'edit_rewards' );
$router->map( 'POST', '/promotors/[i:promotors_id]/rewards/[i:id]/update', 'RewardsController#update', 'update_rewards' );
$router->map( 'GET', '/promotors/[i:promotors_id]/rewards/[i:id]/delete', 'RewardsController#delete', 'delete_rewards' );


$router->map( 'GET', '/promotors/[i:promotors_id]/promotion-actions/[i:action_id]/package/[i:id]', 'PromotionCodesPackagesController#show', 'show_promotion_codes_packages' );
$router->map( 'GET', '/promotors/[i:promotors_id]/promotion-actions/[i:action_id]/package/new', 'PromotionCodesPackagesController#new', 'new_promotion_codes_packages' );
$router->map( 'POST', '/promotors/[i:promotors_id]/promotion-actions/[i:action_id]/package/create', 'PromotionCodesPackagesController#create', 'create_promotion_codes_packages' );
$router->map( 'GET', '/promotors/[i:promotors_id]/promotion-actions/[i:action_id]/package/[i:id]/edit', 'PromotionCodesPackagesController#edit', 'edit_promotion_codes_packages' );
$router->map( 'POST', '/promotors/[i:promotors_id]/promotion-actions/[i:action_id]/package/[i:id]/update', 'PromotionCodesPackagesController#update', 'update_promotion_codes_packages' );

$router->map( 'GET', '/package/generate', 'PromotionCodesPackagesController#generate', 'generate_promotion_codes_packages' );

$router->map( 'DELETE', '/promotors/[i:promotors_id]/rewards/[i:reward_id]/image/[i:id]', 'RewardImagesController#delete', 'delete_reward_images' );

$router->map( 'GET', '/', 'StaticPagesController#start_page', 'start_page' );
$router->map( 'POST', '/insert_code', 'StaticPagesController#insert_code', 'insert_code' );
$router->map( 'GET', '/[a:code]', 'StaticPagesController#use_code', 'use_code' );


// match current request url
$match = $router->match();
Config::set('router', $router);