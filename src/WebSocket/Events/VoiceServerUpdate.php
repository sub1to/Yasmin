<?php
/**
 * Yasmin
 * Copyright 2017-2019 Charlotte Dunois, All Rights Reserved
 *
 * Website: https://charuru.moe
 * License: https://github.com/CharlotteDunois/Yasmin/blob/master/LICENSE
*/

namespace CharlotteDunois\Yasmin\WebSocket\Events;

use CharlotteDunois\Yasmin\Client;
use CharlotteDunois\Yasmin\Interfaces\WSEventInterface;
use CharlotteDunois\Yasmin\WebSocket\WSConnection;
use CharlotteDunois\Yasmin\WebSocket\WSManager;

/**
 * WS Event
 * @see https://discordapp.com/developers/docs/topics/gateway#voice-server-update
 * @internal
 */
class VoiceServerUpdate implements WSEventInterface {
    /**
     * The client.
     * @var Client
     */
    protected $client;
    
    function __construct(Client $client, WSManager $wsmanager) {
        $this->client = $client;
    }
    
    function handle(WSConnection $ws, $data): void {
        $this->client->queuedEmit('voiceServerUpdate', $data);
    }
}
