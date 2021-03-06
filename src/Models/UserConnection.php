<?php
/**
 * Yasmin
 * Copyright 2017-2019 Charlotte Dunois, All Rights Reserved
 *
 * Website: https://charuru.moe
 * License: https://github.com/CharlotteDunois/Yasmin/blob/master/LICENSE
*/

namespace CharlotteDunois\Yasmin\Models;

use CharlotteDunois\Yasmin\Client;

/**
 * Represents an user connection.
 *
 * @property string                               $id                 The ID of the connection account.
 * @property string                               $name               The username of the connection account.
 * @property string                               $type               The type of the user connection (e.g. twitch, youtube).
 * @property bool                                 $revoked            Whether the connection is revoked.
 * @property User $user               The user which this user connection belongs to.
 */
class UserConnection extends ClientBase {
    /**
     * The user which this user connection belongs to.
     * @var User
     */
    protected $user;
    
    /**
     * The ID of the connection account.
     * @var string
     */
    protected $id;
    
    /**
     * The username of the connection account.
     * @var string
     */
    protected $name;
    
    /**
     * The type of the user connection (e.g. twitch, youtube).
     * @var string
     */
    protected $type;
    
    /**
     *  Whether the connection is revoked.
     * @var bool
     */
    protected $revoked;

	/**
	 * @param Client $client
	 * @param User $user
	 * @param array $connection
	 * @internal
	 */
    function __construct(Client $client, User $user, array $connection) {
        parent::__construct($client);
        $this->user = $user;
        
        $this->id = (string) $connection['id'];
        $this->name = (string) $connection['name'];
        $this->type = (string) $connection['type'];
        $this->revoked = (bool) $connection['revoked'];
    }
}
