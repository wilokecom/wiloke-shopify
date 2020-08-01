<?php

namespace WilokeShopify\Controllers\Response;

class NormalRetrieve extends AbstractRetrieve implements InterfaceRetrieve
{
    private static $self;
    
    public static function start()
    {
        if (empty(self::$self)) {
            self::$self = new self();
        }
        
        return self::$self;
    }
    
    /**
     * @param $msg
     *
     * @return array
     */
    public function error($msg)
    {
        return $this->buildResponse([
            'status' => 'error',
            'msg'    => $msg
        ]);
    }
    
    /**
     * @param $msg
     *
     * @return array
     */
    public function success($msg)
    {
        return $this->buildResponse([
            'status' => 'success',
            'msg'    => $msg
        ]);
    }
}
