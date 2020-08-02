<?php

namespace WilokeShopify\Illuminate\Retrieve;

class RestRetrieve extends AbstractRetrieve implements InterfaceRetrieve
{
    private $statusCode = 200;
    private static $self;
    
    public static function start()
    {
        if (empty(self::$self)) {
            self::$self = new self();
        }
        
        return self::$self;
    }
    
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        
        return $this;
    }
    
    /**
     * @param $msg
     *
     * @return \WP_REST_Response
     */
    public function error($msg)
    {
        return new \WP_REST_Response($this->buildResponse([
            'msg'    => $msg,
            'status' => 'error'
        ]), $this->statusCode);
    }
    
    /**
     * @param $msg
     *
     * @return \WP_REST_Response
     */
    public function success($msg)
    {
        return new \WP_REST_Response($this->buildResponse([
            'msg'    => $msg,
            'status' => 'success'
        ]), $this->statusCode);
    }
}
