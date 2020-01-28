<?php
/**
 * Yasmin
 * Copyright 2017-2019 Charlotte Dunois, All Rights Reserved
 *
 * Website: https://charuru.moe
 * License: https://github.com/CharlotteDunois/Yasmin/blob/master/LICENSE
*/

namespace CharlotteDunois\Yasmin\Interfaces;

use CharlotteDunois\Yasmin\Models\Emoji;
use CharlotteDunois\Yasmin\Models\MessageReaction;
use InvalidArgumentException;

/**
 * Something all emoji storages implement. The storage also is used as factory.
 */
interface EmojiStorageInterface extends StorageInterface {
    /**
     * Returns the current element. From Iterator interface.
     * @return Emoji
     */
    function current();
    
    /**
     * Fetch the key from the current element. From Iterator interface.
     * @return string
     */
    function key();
    
    /**
     * Advances the internal pointer. From Iterator interface.
     * @return Emoji|false
     */
    function next();
    
    /**
     * Resets the internal pointer. From Iterator interface.
     * @return Emoji|false
     */
    function rewind();
    
    /**
     * Checks if current position is valid. From Iterator interface.
     * @return bool
     */
    function valid();
    
    /**
     * Returns all items.
     * @return Emoji[]
     */
    function all();
    
    /**
     * Resolves given data to an emoji.
     * @param Emoji|MessageReaction|string|int  $emoji  string/int = emoji ID
     * @return Emoji
     * @throws InvalidArgumentException
     */
    function resolve($emoji);
    
    /**
     * Determines if a given key exists in the collection.
     * @param string  $key
     * @return bool
     * @throws InvalidArgumentException
    */
    function has($key);
    
    /**
     * Returns the item at a given key. If the key does not exist, null is returned.
     * @param string  $key
     * @return Emoji|null
     * @throws InvalidArgumentException
    */
    function get($key);
    
    /**
     * Sets a key-value pair.
     * @param string                                $key
     * @param Emoji  $value
     * @return $this
     * @throws InvalidArgumentException
     */
    function set($key, $value);
    
    /**
     * Factory to create (or retrieve existing) emojis.
     * @param array  $data
     * @return Emoji
     * @internal
     */
    function factory(array $data);
}
