<?php

namespace WilokeShopify\Controllers;

use WilokeShopify\Illuminate\Request\Request;
use WilokeShopify\ShopifyConnection\Shopify;

class ShopInstallation
{
    public function installShop(Request $oRequest)
    {
        $status = Shopify::makeConnect($oRequest->getParam('shopname'))->createAuthRequest();
        if (!$status) {
            echo Shopify::retrieve();
            die;
        }
    }
}
