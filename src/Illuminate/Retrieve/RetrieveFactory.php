<?php

namespace WilokeShopify\Illuminate\Retrieve;

class RetrieveFactory
{
    public function retrieve($type)
    {
        $oRetrieve = false;
        switch ($type) {
            case 'rest':
                $oRetrieve = RestRetrieve::start();
                break;
            case 'ajax':
                $oRetrieve = AjaxRetrieve::start();
                break;
            default:
                $oRetrieve = NormalRetrieve::start();
                break;
        }
        
        return $oRetrieve;
    }
}
