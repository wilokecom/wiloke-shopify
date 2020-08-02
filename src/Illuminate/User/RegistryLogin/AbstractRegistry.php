<?php

namespace WilokeShopify\Illuminate\User\RegistryLogin;

class AbstractRegistry
{
    protected $aInfo;
    protected $password;
    protected $email;
    protected $username;
    protected $userId;
    
    protected function setupRequiredInformation()
    {
        if (!isset($this->aInfo['username'])) {
            wp_die('username is required');
        }
        
        $this->username = trim($this->aInfo['username']);
        
        if (isset($this->aInfo['password']) && !empty($this->aInfo['password'])) {
            $this->password = $this->aInfo['password'];
        } else {
            $this->password = wp_generate_password(10);
        }
        
        if (isset($this->aInfo['email']) && !empty($this->aInfo['email'])) {
            $this->email = $this->aInfo['email'];
        }
        
        return $this;
    }
    
    public function createAccount()
    {
        $userId = wp_create_user($this->username, $this->password, $this->email);
        
        if (empty($userId) || is_wp_error($userId)) {
            wp_die('We could not create username: ' . $userId->get_error_message());
        }
        
        $this->userId = $userId;
        
        return $this;
    }
    
    public function getUserId()
    {
        return $this->userId;
    }
}
