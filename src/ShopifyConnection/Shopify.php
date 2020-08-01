<?php

namespace WilokeShopify\ShopifyConnection;

use PHPShopify\ShopifySDK;
use WilokeShopify\Helpers\App;

class Shopify
{
    private static $self;
    public $error;
    public $retrieve;
    private $shopName;
    public $shopSubfix = '.myshopify.com';
    
    public static function getError()
    {
        return self::$self->error;
    }
    
    public static function retrieve()
    {
        return self::$self->retrieve;
    }
    
    protected function generateShopName($shopName)
    {
        $this->shopName = trim($shopName);
        
        if (strpos($shopName, $this->shopSubfix) === false) {
            $this->shopName = $this->shopName.$this->shopSubfix;
        }
        
        return $this;
    }
    
    private function makeConfiguration()
    {
        $aConfiguration            = App::get('configs/app')['shopify']['myapp'];
        $aConfiguration['ShopUrl'] = $this->shopName;
        
        ShopifySDK::config($aConfiguration);
        
        return $this;
    }
    
    /**
     * @param $shopName
     *
     * @return Shopify
     */
    public static function makeConnect($shopName)
    {
        if (self::$self) {
            return self::$self;
        }
        
        self::$self = new self();
        
        self::$self->generateShopName($shopName)->makeConfiguration();
        
        return self::$self;
    }
    
    /**
     * @return bool
     */
    public function createAuthRequest()
    {
        try {
            \PHPShopify\AuthHelper::createAuthRequest(App::get('configs/app')['shopify']['scopes'],
                App::get('configs/app')['shopify']['redirectTo']);
            
            return true;
        } catch (\PHPShopify\Exception\SdkException $e) {
            $this->retrieve = $e->getMessage();
            
            return false;
        }
    }
    
    public function getAccessToken()
    {
        try {
            $this->retrieve = \PHPShopify\AuthHelper::getAccessToken();
            
            return !empty($this->retrieve);
        } catch (\PHPShopify\Exception\SdkException $e) {
            $this->retrieve = $e->getMessage();
            
            return false;
        }
    }
}
