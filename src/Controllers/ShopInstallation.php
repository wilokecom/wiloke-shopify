<?php

namespace WilokeShopify\Controllers;

use WilokeShopify\ShopifyConnection\Shopify;

class ShopInstallation
{
    public function __construct($shopName)
    {
        $this->installShop($shopName);
    }
    
    public function installShop($shopName)
    {
        $status = Shopify::makeConnect($shopName)->createAuthRequest();
        if (!$status) {
            echo Shopify::retrieve();
            die;
        }
    }
}
