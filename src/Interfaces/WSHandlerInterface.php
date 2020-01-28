<?php
/**
 * Yasmin
 * Copyright 2017-2019 Charlotte Dunois, All Rights Reserved
 *
 * Website: https://charuru.moe
 * License: https://github.com/CharlotteDunois/Yasmin/blob/master/LICENSE
*/

namespace CharlotteDunois\Yasmin\Interfaces;

use CharlotteDunois\Yasmin\WebSocket\WSConnection;
use CharlotteDunois\Yasmin\WebSocket\WSHandler;

/**
 * WS Handler interface.
 * @internal
 */
interface WSHandlerInterface {
	/**
	 * Constructor.
	 * @param WSHandler $wshandler
	 */
    function __construct(WSHandler $wshandler);

	/**
	 * Handles packets.
	 * @param WSConnection $ws
	 * @param $packet
	 * @return void
	 */
    function handle(WSConnection $ws, $packet): void;
}
