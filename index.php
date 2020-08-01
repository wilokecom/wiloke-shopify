<?php

use WilokeShopify\Models\UserMeta;
use WilokeShopify\RegistryLogin\RegistryFactory;
use WilokeShopify\ShopifyConnection\Shopify;

get_header();

if (isset($_GET['shop'])) {
    $route = 'request-access-token';
} else {
    $route = isset($_REQUEST['route']) && !empty($_REQUEST['route']) ? trim($_REQUEST['route']) : '';
}

switch ($route) {
    case 'shop-installation':
        if (!isset($_REQUEST['shopname']) || empty($_REQUEST['shopname'])) {
            return false;
        }
        
        new \WilokeShopify\Controllers\ShopInstallation($_REQUEST['shopname']);
        break;
    case 'request-access-token':
        new \WilokeShopify\Controllers\ShopRequestAccessToken($_REQUEST['shop']);
        break;
    
    default:
        ?>
        <h1 class="center mt-20">Wiloke Shopify</h1>
        <form class="center" action="<?php echo home_url('/'); ?>" method="post">
            <p>
                <label for="shop-name">Your Shopify</label>
                <input type="text" name="shopname" id="shop-name"> .myshopify.com
            </p>

            <input type="hidden" name="route" value="shop-installation">
            <button type="submit">Register</button>
        </form>
        <?php
        break;
}
get_footer();
