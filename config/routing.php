<?php
if (isset($_POST['method'])) {
	$_SERVER['REQUEST_METHOD'] = $_POST['method'];
}

#die(print_r($_POST));

$router = new AltoRouter();
#$router->map( 'GET', '/', 'ok', 'main_page' );


$router->map( 'GET', '/promotors/[i:promotors_id]', 'PromotorsController#show', 'show_promotors' );
$router->map( 'GET', '/promotors/[i:promotors_id]/account', 'PromotorsController#edit', 'edit_promotor' );
$router->map( 'POST', '/promotors/[i:promotors_id]/account/update', 'PromotorsController#update', 'update_promotor' );
$router->map( 'GET', '/promotors/[i:promotors_id]/clients', 'PromotorsController#index_clients', 'index_clients' );
$router->map( 'GET', '/promotors/[i:promotors_id]/orders', 'PromotorsController#index_orders', 'index_promotors_orders' );
$router->map( 'GET', '/promotors/[i:promotors_id]/orders/[i:order_id]', 'PromotorsController#show_orders', 'show_promotors_orders' );


$router->map( 'GET', '/promotors/[i:promotors_id]/promotion-actions/[i:id]', 'PromotionActionsController#show', 'show_promotion_actions' );
$router->map( 'GET', '/promotors/[i:promotors_id]/promotion-actions/new', 'PromotionActionsController#new', 'new_promotion_actions' );
$router->map( 'POST', '/promotors/[i:promotors_id]/promotion-actions', 'PromotionActionsController#create', 'create_promotion_actions' );
$router->map( 'GET', '/promotors/[i:promotors_id]/promotion-actions/[i:id]/edit', 'PromotionActionsController#edit', 'edit_promotion_actions' );
$router->map( 'POST', '/promotors/[i:promotors_id]/promotion-actions/[i:id]/update', 'PromotionActionsController#update', 'update_promotion_actions' );


$router->map( 'GET', '/promotors/new', 'PromotorsController#new', 'new_promotor' );
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
$router->map( 'POST', '/insert-code', 'StaticPagesController#insert_code', 'insert_code' );
$router->map( 'GET', '/[a:code]', 'StaticPagesController#use_code', 'use_code' );
$router->map( 'POST', '/[a:code]/add-points', 'StaticPagesController#add_points', 'add_points' );
$router->map( 'GET', '/[a:code]/confirm', 'StaticPagesController#confirmation', 'confirmation' );


$router->map( 'GET', '/clients/[i:client_id]', 'ClientsController#show', 'show_client' );
$router->map( 'GET', '/clients/[i:client_id]/promotor-rewards/[i:promotors_id]', 'ClientsController#index_rewards', 'client_index_rewards' );
$router->map( 'GET', '/clients/[i:client_id]/promotor-rewards/[i:promotors_id]/reward/[i:reward_id]', 'ClientsController#show_rewards', 'client_show_rewards' );
$router->map( 'GET', '/clients/[i:client_id]/history', 'ClientsController#index_history', 'index_history' );
$router->map( 'GET', '/clients/[i:client_id]/reward/[i:reward_id]', 'ClientsController#new_order', 'new_order' );
$router->map( 'POST', '/clients/[i:client_id]/reward/[i:reward_id]/get', 'ClientsController#get_reward', 'get_reward' );
$router->map( 'GET', '/clients/[i:client_id]/orders', 'ClientsController#index_orders', 'index_client_orders' );


$router->map( 'GET', '/admin', 'AdminController#show', 'show_admin' );


// match current request url
$match = $router->match();
Config::set('router', $router);