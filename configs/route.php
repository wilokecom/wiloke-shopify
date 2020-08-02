<?php
$oRoute->post('shop-installation', '\WilokeShopify\Controllers\ShopInstallation@installShop');
$oRoute->get('request-access-token', '\WilokeShopify\Controllers\ShopRequestAccessToken@getAccessToken');
