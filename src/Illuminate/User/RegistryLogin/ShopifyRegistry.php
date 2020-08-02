<?php

namespace WilokeShopify\Illuminate\User\RegistryLogin;

use WilokeShopify\Models\UserMeta;

class ShopifyRegistry extends AbstractRegistry implements InterfaceRegistry
{
    private static $self;
    
    public static function start()
    {
        if (empty(self::$self)) {
            self::$self = new static();
        }
        
        return self::$self;
    }
    
    /**
     * @param $aInfo
     *
     * @return $this|mixed
     */
    public function setupUserInfo($aInfo)
    {
        $this->aInfo = $aInfo;
        if (!isset($this->aInfo['username'])) {
            $this->aInfo['username'] = $this->aInfo['shop_name'];
        }
        
        $this->setupRequiredInformation();
        
        return $this;
    }
    
    public function updateUserMeta()
    {
        UserMeta::updateShopName($this->userId, $this->aInfo['shop_name']);
        UserMeta::updateShopAccessToken($this->userId, $this->aInfo['access_token']);
    }
}
