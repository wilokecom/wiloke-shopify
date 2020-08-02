<?php

namespace WilokeShopify\Models;

use WilokeShopify\Helpers\Name;

class UserMeta
{
    public static function updateShopName($userId, $shopName)
    {
        update_user_meta($userId, Name::autoAddPrefix('shop_name'), Name::removeShopifySubDomain($shopName));
    }
    
    public static function updateShopAccessToken($userId, $accessToken)
    {
        update_user_meta($userId, Name::autoAddPrefix('access_token'), $accessToken);
    }
    
    public static function getShopName($userId)
    {
        return get_user_meta($userId, Name::autoAddPrefix('shop_name'), true);
    }
    
    public static function getShopAccessToken($userId)
    {
        return get_user_meta($userId, Name::autoAddPrefix('access_token'), true);
    }
    
    public static function getUserIdByShopName($shopName)
    {
        global $wpdb;
        
        return $wpdb->get_var(
            sprintf(
                "SELECT user_id FROM $wpdb->usermeta WHERE meta_key='%s' AND meta_value='%s'",
                Name::autoAddPrefix('shop_name'),
                $wpdb->_real_escape(Name::removeShopifySubDomain($shopName))
            )
        );
    }
}
