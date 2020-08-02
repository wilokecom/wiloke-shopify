<?php

namespace WilokeShopify\Controllers;

use WilokeShopify\Helpers\Name;
use WilokeShopify\Illuminate\Request\Request;
use WilokeShopify\Illuminate\Routing\Redirector;
use WilokeShopify\Illuminate\User\RegistryLogin\RegistryFactory;
use WilokeShopify\Models\UserMeta;
use WilokeShopify\ShopifyConnection\Shopify;

class ShopRequestAccessToken
{
    public function getAccessToken(Request $oRequest)
    {
        $shopName    = $oRequest->getParam('shop');
        $accessToken = Shopify::makeConnect($shopName)->getAccessToken();
        if (!$accessToken) {
            echo Shopify::retrieve();
            die;
        }
        
        $userId = UserMeta::getUserIdByShopName($shopName);
        
        if (!$userId) {
            $userId = RegistryFactory::register('shopify', [
                'shop_name'    => Name::removeShopifySubDomain($oRequest->getParam('shop')),
                'access_token' => Shopify::retrieve()
            ]);
            
            if (!$userId) {
                echo 'Something went error! We could not create an account with your shopify information';
                die;
            }
        } else {
            UserMeta::updateShopAccessToken($userId, $accessToken);
            UserMeta::updateShopName($userId, $shopName);
        }
        
        wp_clear_auth_cookie();
        wp_set_auth_cookie($userId, true, is_ssl());
        Redirector::to();
    }
}
