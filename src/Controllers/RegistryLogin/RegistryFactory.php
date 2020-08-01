<?php

namespace WilokeShopify\Controllers\RegistryLogin;

class RegistryFactory
{
    public static function register($gateway, $aInfo) {
        $oRegistry = null;
        
        switch ($gateway) {
            case 'shopify':
                $oRegistry = ShopifyRegistry::start();
                break;
        }
        
        if (!empty($oRegistry)) {
            $oRegistry->setupUserInfo($aInfo)->createAccount()->updateUserMeta();
            return $oRegistry->getUserId();
        }
        
        return false;
    }
}
