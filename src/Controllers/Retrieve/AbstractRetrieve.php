<?php

namespace WilokeShopify\Controllers\Response;

abstract class AbstractRetrieve
{
    public $aInfo = [];
    
    public function addAdditionalInfo($aInfo)
    {
        $this->aInfo = $aInfo;
        
        return $this;
    }
    
    public function buildResponse($aMsg)
    {
        return array_merge($aMsg, $this->aInfo);
    }
}
