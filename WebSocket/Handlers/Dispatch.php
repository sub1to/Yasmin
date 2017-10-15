<?php
/**
 * Neko Cord
 * Copyright 2017 Charlotte Dunois, All Rights Reserved
 *
 * Website: https://charuru.moe
 * License: MIT
*/

namespace CharlotteDunois\NekoCord\WebSocket\Handlers;

class Dispatch {
    private $wsevents = array();
    protected $wshandler;
    
    function __construct($wshandler) {
        $this->wshandler = $wshandler;
        
        $this->register('READY', '\CharlotteDunois\NekoCord\WebSocket\Events\Ready');
        $this->register('RESUMED', '\CharlotteDunois\NekoCord\WebSocket\Events\Resumed');
    }
    
    function getEvent($name) {
        if(isset($this->wsevents[$name])) {
            return $this->wsevents[$name];
        }
        
        throw new \Exception('Can not find WS event');
    }
    
    function handle($packet) { //TODO
        if(isset($this->wsevents[$packet['t']])) {
            try {
                $this->wsevents[$packet['t']]->handle($packet['d']);
            } catch(\Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }
    
    private function register($name, $class) {
        $this->wsevents[$name] = new $class($this->wshandler->client());
    }
}