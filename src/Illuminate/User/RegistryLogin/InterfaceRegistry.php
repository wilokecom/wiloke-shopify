<?php

namespace WilokeShopify\Illuminate\User\RegistryLogin;

interface InterfaceRegistry
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
