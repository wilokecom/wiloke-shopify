<?php

namespace WilokeShopify\Illuminate\Routing;

class Redirector
{
    public static function to($to = null, $aQuery = [])
    {
        $to = empty($to) ? home_url('/') : $to;
        
        wp_redirect(add_query_arg($aQuery, $to));
        exit();
    }
}
