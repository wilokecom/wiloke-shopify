<?php

namespace WilokeShopify\Controllers\RegistryLogin;

interface InterfaceRegister
{
    /**
     * @param $aInfo ['username' => '', 'password' => '', 'email' => '']
     *
     * @return mixed
     */
    public function setupUserInfo($aInfo);
    
    public function createAccount();
    
    public function updateUserMeta();
}
