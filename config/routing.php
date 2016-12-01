<?php
if (isset($_POST['method'])) {
	$_SERVER['REQUEST_METHOD'] = $_POST['method'];
}

$router = new AltoRouter();

/* Admin */
$router->map( 'GET', '/admin', 'AdminController#show', 'show_admin' );
$router->map( 'GET', '/admin/new-promotor', 'AdminController#newPromotor', 'new_promotors' );
$router->map( 'GET', '/admin/promotor/[i:promotor_id]', 'AdminController#showPromotor', 'show_promotor' );
$router->map( 'GET', '/admin/promotor/[i:promotor_id]/action/[i:action_id]', 'AdminController#showPromotorAction', 'show_promotor_action' );
$router->map( 'GET', '/admin/promotor/[i:promotor_id]/stats', 'AdminController#showPromotorStats', 'show_promotor_stats' );
$router->map( 'GET', '/admin/promotor/[i:promotor_id]/action/[i:action_id]/package/[i:package_id]', 'AdminController#showPromotorPackage', 'show_promotor_package' );
$router->map( 'GET', '/admin/promotor/[i:promotor_id]/reward/[i:reward_id]', 'AdminController#showPromotorReward', 'show_promotor_reward' );
$router->map( 'GET', '/admin/promotor/[i:promotor_id]/order/[i:order_id]', 'AdminController#showPromotorOrder', 'show_promotor_order' );
$router->map( 'POST', '/admin/create-promotor', 'AdminController#createPromotor', 'create_promotors' );
$router->map( 'GET', '/admin/edit-promotor/[i:promotors_id]', 'AdminController#editPromotor', 'edit_promotor_by_admin' );
$router->map( 'POST', '/admin/update-promotor/[i:promotors_id]', 'AdminController#updatePromotor', 'update_promotor_by_admin' );
$router->map( 'GET', '/admin/orders', 'AdminController#indexOrders', 'index_admin_orders' );
$router->map( 'GET', '/admin/orders/[i:order_id]', 'AdminController#showOrder', 'show_admin_order' );

/* Admin -> new promotor */
$router->map( 'GET', '/promotors/new', 'PromotorsController#new', 'new_promotor' );

/* Promotor */
$router->map( 'GET', '/promotors/[i:promotors_id]', 'PromotorsController#show', 'show_promotors' );
$router->map( 'GET', '/promotors/[i:promotors_id]/stats', 'PromotorsController#stats', 'stats_promotors' );
$router->map( 'GET', '/promotors/[i:promotors_id]/account', 'PromotorsController#edit', 'edit_promotor' );
$router->map( 'POST', '/promotors/[i:promotors_id]/account/update', 'PromotorsController#update', 'update_promotor' );
$router->map( 'GET', '/promotors/[i:promotors_id]/clients', 'PromotorsController#indexClients', 'index_clients' );
$router->map( 'GET', '/promotors/[i:promotors_id]/orders', 'PromotorsController#indexOrders', 'index_promotors_orders' );
$router->map( 'GET', '/promotors/[i:promotors_id]/orders/[i:order_id]', 'PromotorsController#showOrders', 'show_promotors_orders' );


/* Promotor clients charts */
$router->map( 'POST', '/promotor/new-clients-in-month', 'PromotorsController#newClientsInMonth', 'newClientsInMonth' );
$router->map( 'POST', '/promotor/new-clients-in-year', 'PromotorsController#newClientsInYear', 'newClientsInYear' );
$router->map( 'POST', '/promotor/new-clients-in-range', 'PromotorsController#newClientsInRange', 'newClientsInRange' );


/* Promotor codes charts */
$router->map( 'POST', '/promotor/codes-used-in-month', 'PromotorsController#codesUsedInMonth', 'codesUsedInMonth' );
$router->map( 'POST', '/promotor/codes-used-in-year', 'PromotorsController#codesUsedInYear', 'codesUsedInYear' );
$router->map( 'POST', '/promotor/codes-used-in-range', 'PromotorsController#codesUsedInRange', 'codesUsedInRange' );


/* Reward details */
$router->map( 'POST', '/reward-details', 'ClientsController#showRewards', 'rewardDetails' );


/* Promotor -> promotion actions */
$router->map( 'GET', '/promotors/[i:promotors_id]/promotion-actions/[i:id]', 'PromotionActionsController#show', 'show_promotion_actions' );
$router->map( 'GET', '/promotors/[i:promotors_id]/promotion-actions/new', 'PromotionActionsController#new', 'new_promotion_actions' );
$router->map( 'POST', '/promotors/[i:promotors_id]/promotion-actions', 'PromotionActionsController#create', 'create_promotion_actions' );
$router->map( 'GET', '/promotors/[i:promotors_id]/promotion-actions/[i:id]/edit', 'PromotionActionsController#edit', 'edit_promotion_actions' );
$router->map( 'POST', '/promotors/[i:promotors_id]/promotion-actions/[i:id]/update', 'PromotionActionsController#update', 'update_promotion_actions' );


/* Promotor -> contests */
$router->map( 'GET', '/promotors/[i:promotors_id]/contests', 'ContestsController#index', 'index_contests' );
$router->map( 'GET', '/promotors/[i:promotors_id]/contests/[i:contest_id]', 'ContestsController#show', 'show_contests' );
$router->map( 'GET', '/promotors/[i:promotors_id]/contest/new', 'ContestsController#new', 'new_contests' );
$router->map( 'POST', '/promotors/[i:promotors_id]/contests/create', 'ContestsController#create', 'create_contests' );
$router->map( 'GET', '/promotors/[i:promotors_id]/contests/[i:contest_id]/edit', 'ContestsController#edit', 'edit_contests' );
$router->map( 'POST', '/promotors/[i:promotors_id]/contests/[i:contest_id]/update', 'ContestsController#update', 'update_contests' );
$router->map( 'POST', '/get-random-answer', 'ContestsController#getRandomAnswer', 'get_random_answer' );
$router->map( 'GET', '/promotors/[i:promotors_id]/contest/[i:contest_id]/new-stickers-package', 'ContestsController#newContestStickersPackage', 'new_contest_stickers_package' );
$router->map( 'POST', '/promotors/[i:promotors_id]/contest/[i:contest_id]/create-stickers-package', 'ContestsController#createContestStickersPackage', 'create_contest_stickers_package' );


/* Promotor -> rewards */
$router->map( 'GET', '/promotors/[i:promotors_id]/rewards', 'RewardsController#index', 'index_rewards' );
$router->map( 'GET', '/promotors/[i:promotors_id]/rewards/[i:id]', 'RewardsController#show', 'show_rewards' );
$router->map( 'GET', '/promotors/[i:promotors_id]/rewards/new', 'RewardsController#new', 'new_rewards' );
$router->map( 'POST', '/promotors/[i:promotors_id]/rewards/create', 'RewardsController#create', 'create_rewards' );
$router->map( 'GET', '/promotors/[i:promotors_id]/rewards/[i:id]/edit', 'RewardsController#edit', 'edit_rewards' );
$router->map( 'POST', '/promotors/[i:promotors_id]/rewards/[i:id]/update', 'RewardsController#update', 'update_rewards' );
$router->map( 'GET', '/promotors/[i:promotors_id]/rewards/[i:id]/delete', 'RewardsController#delete', 'delete_rewards' );


/* Promotor -> packages */
$router->map( 'GET', '/promotors/[i:promotors_id]/promotion-actions/[i:action_id]/package/[i:id]', 'PromotionCodesPackagesController#show', 'show_promotion_codes_packages' );
$router->map( 'GET', '/promotors/[i:promotors_id]/promotion-actions/[i:action_id]/package/new', 'PromotionCodesPackagesController#new', 'new_promotion_codes_packages' );
$router->map( 'POST', '/promotors/[i:promotors_id]/promotion-actions/[i:action_id]/package/create', 'PromotionCodesPackagesController#create', 'create_promotion_codes_packages' );
$router->map( 'GET', '/promotors/[i:promotors_id]/promotion-actions/[i:action_id]/package/[i:id]/edit', 'PromotionCodesPackagesController#edit', 'edit_promotion_codes_packages' );
$router->map( 'POST', '/promotors/[i:promotors_id]/promotion-actions/[i:action_id]/package/[i:id]/update', 'PromotionCodesPackagesController#update', 'update_promotion_codes_packages' );


/* Server operations */
$router->map( 'GET', '/package/generate', 'PromotionCodesPackagesController#generate', 'generate_promotion_codes_packages' );
$router->map( 'GET', '/stickers-package/generate', 'ContestsController#generate', 'generate_stickers_packages_codes' );
$router->map( 'GET', '/promotion-actions-check', 'StaticPagesController#checkIfActionsActive', 'check_if_actions_active' );


/* Promotor -> reward -> delete image */
$router->map( 'DELETE', '/promotors/[i:promotors_id]/rewards/[i:reward_id]/image/[i:id]', 'RewardImagesController#delete', 'delete_reward_images' );


/* Login/Logout */
$router->map( 'POST', '/sign-in', 'SessionController#create', 'sign_in' );
$router->map( 'GET', '/sign-out', 'SessionController#delete', 'sign_out' );


/* Static pages */
$router->map( 'GET', '/', 'StaticPagesController#startPage', 'start_page' );
$router->map( 'GET', '/contest/[a:code]', 'StaticPagesController#contest', 'contest_answer' );
$router->map( 'POST', '/contest/[i:id]/[a:code]/answer', 'StaticPagesController#contestAnswer', 'give_answer' );
$router->map( 'GET', '/login', 'StaticPagesController#login', 'login' );
$router->map( 'GET', '/promotor-login', 'StaticPagesController#promotorLogin', 'promotor_login' );
$router->map( 'POST', '/insert-code', 'StaticPagesController#insertCode', 'enter_code' );
$router->map( 'GET', '/[a:code]', 'StaticPagesController#useCode', 'use_code' );
$router->map( 'GET', '/[a:code]/is-used', 'StaticPagesController#codeIsUsed', 'code_is_used' );
$router->map( 'POST', '/[a:code]/add-points', 'StaticPagesController#addPoints', 'add_points' );
$router->map( 'GET', '/[a:code]/confirm', 'StaticPagesController#confirmation', 'confirmation' );
$router->map( 'GET', '/[a:code]/contest-confirm', 'StaticPagesController#contestConfirmation', 'contest_confirm' );
$router->map( 'GET', '/access-denied', 'StaticPagesController#authorizeError', 'access_denied' );


/* Client */
$router->map( 'GET', '/clients/[i:client_id]', 'ClientsController#show', 'show_client' );
$router->map( 'GET', '/clients/[i:client_id]/contests', 'ClientsController#indexContests', 'client_index_contests' );
$router->map( 'GET', '/clients/[i:client_id]/promotor-rewards/[i:promotors_id]', 'ClientsController#indexRewards', 'client_index_rewards' );
#$router->map( 'GET', '/clients/[i:client_id]/promotor-rewards/[i:promotors_id]/reward/[i:reward_id]', 'ClientsController#showRewards', 'client_show_rewards' );
$router->map( 'GET', '/clients/[i:client_id]/history', 'ClientsController#indexHistory', 'index_history' );
$router->map( 'GET', '/clients/[i:client_id]/reward/[i:reward_id]', 'ClientsController#newOrder', 'new_order' );
$router->map( 'POST', '/clients/[i:client_id]/reward/[i:reward_id]/get', 'ClientsController#getReward', 'get_reward' );
$router->map( 'GET', '/clients/[i:client_id]/orders', 'ClientsController#indexOrders', 'index_client_orders' );
$router->map( 'GET', '/clients/[i:client_id]/code', 'ClientsController#code', 'client_code' );
$router->map( 'POST', '/clients/[i:client_id]/insert-code', 'ClientsController#insertCode', 'client_enter_code' );
$router->map( 'GET', '/clients/[i:client_id]/[a:code]', 'ClientsController#answer', 'client_answer' );
$router->map( 'POST', '/clients/[i:client_id]/[a:code]/answer', 'ClientsController#giveAnswer', 'client_give_answer' );


/* Mailing */
$router->map( 'POST', '/send-hash-email', 'StaticPagesController#loginHashSend', 'send_client_hash' );


// match current request url
$match = $router->match();
Config::set('router', $router);