<?php

namespace WilokeShopify\Controllers\Response;

class AjaxRetrieve extends AbstractRetrieve implements InterfaceRetrieve
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
     */
    public function error($msg)
    {
        wp_send_json_error($this->buildResponse([
            'msg' => $msg
        ]));
    }
    
    /**
     * @param $msg
     */
    public function success($msg)
    {
        wp_send_json_success($this->buildResponse([
            'msg' => $msg
        ]));
    }
}
