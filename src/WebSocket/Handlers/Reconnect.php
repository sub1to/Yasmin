<?php
/**
 * Yasmin
 * Copyright 2017-2019 Charlotte Dunois, All Rights Reserved
 *
 * Website: https://charuru.moe
 * License: https://github.com/CharlotteDunois/Yasmin/blob/master/LICENSE
*/

namespace CharlotteDunois\Yasmin\WebSocket\Handlers;

use CharlotteDunois\Yasmin\Interfaces\WSHandlerInterface;
use CharlotteDunois\Yasmin\WebSocket\WSConnection;
use CharlotteDunois\Yasmin\WebSocket\WSHandler;

/**
 * WS Event handler
 * @internal
 */
class Reconnect implements WSHandlerInterface {
    protected $wshandler;
    
    function __construct(WSHandler $wshandler) {
        $this->wshandler = $wshandler;
    }
    
    function handle(WSConnection $ws, $packet): void {
        $ws->reconnect($packet['d'] ?? false);
    }
}
