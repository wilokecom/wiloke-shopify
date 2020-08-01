---
description: Hướng dẫn đăng nhập đăng kí
---

# Login and Registration

Github [https://github.com/wilokecom/wiloke-shopify](https://github.com/wilokecom/wiloke-shopify) 

### Registration

Mọi phương thức đăng kí \(Shopfiy Registry, Facebook Registry, WordPress Registry\) đều phải kế thừa AbstractRegistry.

Các phương thức được gọi qua RegistryFactory 

```text
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

Class ShopifyRegistry extends AbstractRegistry implements InterfaceRegistry {
    
    private static $self;
    
    public static function start()
    {
        if (empty(self::$self)) {
            self::$self = new static();
        }
        
        return self::$self;
    }
    
    
    public function setupUserInfo($aInfo) {
        $this->aInfo = $aInfo;
        if (!isset($this->aInfo['username'])) {
            $this->aInfo['username'] = $this->aInfo['shop_name'];
        }
        
        $this->setupRequiredInformation();
        
        // Some other code there
        
        return $this;
    }
    
    
    public function updateUserMeta() {
    
    }
}

$userId = RegistryFactory::register('shopify', [
    'shop_name'    => $shopName,
    'access_token' => Shopify::retrieve()
]);
```

* Property $aInfo: Là một mảng, bắt buộc phải có username  và email \['username' =&gt; 'wiloke', 'email' =&gt; 'x@gmail.com'\] 

###  Shopify

Mỗi user được add 1 shopify duy nhất. 

Shopify được lưu vào user meta

```php
class UserMeta
{
    public static function updateShopName($userId, $shopName)
    {
        update_user_meta($userId, Name::autoAddPrefix('shop_name'), $shopName);
    }
}
```

 

