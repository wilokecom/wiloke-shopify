<?php

use WilokeShopify\Helpers\App;
use WilokeShopify\Illuminate\Request\Request;
use WilokeShopify\Illuminate\Routing\Route;

define('WILOKE_SHOPIFY_VIEW_PATH', get_template_directory().'/publish/');
define('WILOKE_SHOPIFY_APP_PATH', get_template_directory().'/configs/');
define('WILOKE_SHOPIFY_VERESION', '1.0');
define('WILOKE_SHOPIFY_SUBDOMAIN', '.myshopify.com');

require_once get_template_directory().'/vendor/autoload.php';

App::bind('configs/app', include WILOKE_SHOPIFY_APP_PATH.'app.php');
App::bind('configs/special-router', include WILOKE_SHOPIFY_APP_PATH.'special-router.php');

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('mainstyle', get_stylesheet_uri(), [], WILOKE_SHOPIFY_VERESION);
});

// Route
if ($route = Request::getRoute()) {
    Route::load(WILOKE_SHOPIFY_APP_PATH.'route.php')
         ->direct($route, new Request())
    ;
}
