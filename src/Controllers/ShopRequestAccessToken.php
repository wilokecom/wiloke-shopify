<?php

namespace WilokeShopify\Controllers;

use WilokeShopify\Controllers\RegistryLogin\RegistryFactory;
use WilokeShopify\Models\UserMeta;
use WilokeShopify\ShopifyConnection\Shopify;

class ShopRequestAccessToken
{
    public function __construct($shopName)
    {
        $this->getAccessToken($shopName);
    }
    
    public function getAccessToken($shopName)
    {
        $status = Shopify::makeConnect($shopName)->getAccessToken();
        
        if (!$status) {
            echo Shopify::retrieve();
            die;
        }
    
        $userId = UserMeta::getUserIdByShopName(Shopify::retrieve());
        if (!$userId) {
            $userId = RegistryFactory::register('shopify', [
                'shop_name'    => $shopName,
                'access_token' => Shopify::retrieve()
            ]);
            
            if ($userId) {
                wp_set_auth_cookie($userId, true);
            }
        }
    }
}
