<?php

$router = new AltoRouter();
$router->map( 'GET', '/', 'ok', 'main_page' );

$router->map( 'GET', '/promotors/[i:id]?', 'PromotorsController#show', 'show_promotors' );
#$router->map( 'GET', '/promotors/new/', 'PromotorsController#new', 'new_promotors' );

$router->map( 'GET', '/promotors/[i:promotors_id]/promotion-actions/new', 'PromotionActionsController#new', 'create_promotion_actions' );

// match current request url
$match = $router->match();
