<?php

namespace WilokeShopify\Helpers;

class View
{
    public static function load($file)
    {
        if (!file_exists(WILOKE_SHOPIFY_VIEW_PATH.$file)) {
            if (WP_DEBUG) {
                die(sprintf('%s does not exists', $file));
            }
            
            return false;
        }
        
        include WILOKE_SHOPIFY_VIEW_PATH.$file;
    }
}
