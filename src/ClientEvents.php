<?php
/**
 * Yasmin
 * Copyright 2017-2019 Charlotte Dunois, All Rights Reserved
 *
 * Website: https://charuru.moe
 * License: https://github.com/CharlotteDunois/Yasmin/blob/master/LICENSE
*/

namespace CharlotteDunois\Yasmin;

use CharlotteDunois\Collect\Collection;
use CharlotteDunois\Yasmin\Interfaces\ChannelInterface;
use CharlotteDunois\Yasmin\Interfaces\TextChannelInterface;
use CharlotteDunois\Yasmin\Models\Guild;
use CharlotteDunois\Yasmin\Models\GuildMember;
use CharlotteDunois\Yasmin\Models\Message;
use CharlotteDunois\Yasmin\Models\MessageReaction;
use CharlotteDunois\Yasmin\Models\Presence;
use CharlotteDunois\Yasmin\Models\Role;
use CharlotteDunois\Yasmin\Models\Shard;
use CharlotteDunois\Yasmin\Models\User;
use DateTime;
use Throwable;

/**
 * Documents all Client events. ($client->on('name here', callable))
 *
 * The second parameter of *Update events is null, if cloning for that event is disabled.
 */
interface ClientEvents {
    /**
     * Emitted each time the client turns ready.
     * @return void
     */
    function ready();

	/**
	 * Emitted when the shard gets disconnected from the gateway.
	 * @param Shard $shard
	 * @param int $code
	 * @param string $reason
	 * @return void
	 */
    function disconnect(Shard $shard, int $code, string $reason);

	/**
	 * Emitted when the shard tries to reconnect.
	 * @param Shard $shard
	 * @return void
	 */
    function reconnect(Shard $shard);
    
    /**
     * Emitted when we receive a message from the gateway.
     * @param mixed  $message
     * @return void
     */
    function raw($message);

	/**
	 * Emitted when an uncached message gets deleted.
	 * @param TextChannelInterface $channel
	 * @param string $messageID
	 * @return void
	 */
    function messageDeleteRaw(TextChannelInterface $channel, string $messageID);

	/**
	 * Emitted when multple uncached messages gets deleted.
	 * @param TextChannelInterface $channel
	 * @param array $messageIDs
	 * @return void
	 */
    function messageDeleteBulkRaw(TextChannelInterface $channel, array $messageIDs);

	/**
	 * Emitted when an uncached message gets updated (does not mean the message got edited, check the edited timestamp for that).
	 * @param TextChannelInterface $channel
	 * @param array $data
	 * @return void
	 * @see https://discordapp.com/developers/docs/topics/gateway#message-update
	 * @see https://discordapp.com/developers/docs/resources/channel#message-object
	 */
    function messageUpdateRaw(TextChannelInterface $channel, array $data);

	/**
	 * Emitted when an error happens (inside the library or any listeners). You should always listen on this event.
	 * Failing to listen on this event will result in an exception when an error event gets emitted.
	 * @param Throwable $error
	 * @return void
	 */
    function error(Throwable $error);
    
    /**
     * Debug messages.
     * @param string|mixed  $message
     * @return void
     */
    function debug($message);

	/**
	 * Ratelimit information.
	 *
	 * The array has the following format:
	 * ```
	 * array(
	 *     'endpoint' => string,
	 *     'global' => bool,
	 *     'limit' => int|float, (float = \INF)
	 *     'remaining => int,
	 *     'resetTime' => float|null
	 * )
	 * ```
	 *
	 * @param array $data
	 * @return void
	 */
    function ratelimit(array $data);

	/**
	 * Emitted when a channel gets created.
	 * @param ChannelInterface $channel
	 * @return void
	 */
    function channelCreate(ChannelInterface $channel);

	/**
	 * Emitted when a channel gets updated.
	 * @param ChannelInterface $new
	 * @param ChannelInterface|null $old
	 * @return void
	 */
    function channelUpdate(ChannelInterface $new, ?ChannelInterface $old);

	/**
	 * Emitted when a channel gets deleted.
	 * @param ChannelInterface $channel
	 * @return void
	 */
    function channelDelete(ChannelInterface $channel);

	/**
	 * Emitted when a channel's pins gets updated. Due to the nature of the event, it's not possible to do much.
	 * @param ChannelInterface $channel
	 * @param DateTime|null $time
	 * @return void
	 */
    function channelPinsUpdate(ChannelInterface $channel, ?DateTime $time);

	/**
	 * Emitted when a guild gets joined.
	 * @param Guild $guild
	 * @return void
	 */
    function guildCreate(Guild $guild);

	/**
	 * Emitted when a guild gets updated.
	 * @param Guild $new
	 * @param Guild|null $old
	 * @return void
	 */
    function guildUpdate(Guild $new, ?Guild $old);

	/**
	 * Emitted when a guild gets left.
	 * @param Guild $guild
	 * @return void
	 */
    function guildDelete(Guild $guild);

	/**
	 * Emitted when a guild becomes (un)available.
	 * @param Guild $guild
	 * @return void
	 */
    function guildUnavailable(Guild $guild);

	/**
	 * Emitted when someone gets banned.
	 * @param Guild $guild
	 * @param User $user
	 * @return void
	 */
    function guildBanAdd(Guild $guild, User $user);

	/**
	 * Emitted when someone gets unbanned.
	 * @param Guild $guild
	 * @param User $user
	 * @return void
	 */
    function guildBanRemove(Guild $guild, User $user);

	/**
	 * Emitted when an user joins a guild.
	 * @param GuildMember $member
	 * @return void
	 */
    function guildMemberAdd(GuildMember $member);

	/**
	 * Emitted when a member gets updated.
	 * @param GuildMember $new
	 * @param GuildMember|null $old
	 * @return void
	 */
    function guildMemberUpdate(GuildMember $new, ?GuildMember $old);

	/**
	 * Emitted when an user leaves a guild.
	 * @param GuildMember $member
	 * @return void
	 */
    function guildMemberRemove(GuildMember $member);

	/**
	 * Emitted when the gateway sends requested members. The collection consists of GuildMember instances, mapped by their user ID.
	 * @param Guild $guild
	 * @param Collection $members
	 * @return void
	 * @see \CharlotteDunois\Yasmin\Models\GuildMember
	 */
    function guildMembersChunk(Guild $guild, Collection $members);

	/**
	 * Emitted when a role gets created.
	 * @param Role $role
	 * @return void
	 */
    function roleCreate(Role $role);

	/**
	 * Emitted when a role gets updated.
	 * @param Role $new
	 * @param Role|null $old
	 * @return void
	 */
    function roleUpdate(Role $new, ?Role $old);

	/**
	 * Emitted when a role gets deleted.
	 * @param Role $role
	 * @return void
	 */
    function roleDelete(Role $role);

	/**
	 * Emitted when a message gets received.
	 * @param Message $message
	 * @return void
	 */
    function message(Message $message);

	/**
	 * Emitted when a (cached) message gets updated (does not mean the message got edited, check the edited timestamp for that).
	 * @param Message $new
	 * @param Message|null $old
	 * @return void
	 */
    function messageUpdate(Message $new, ?Message $old);

	/**
	 * Emitted when a (cached) message gets deleted.
	 * @param Message $message
	 * @return void
	 */
    function messageDelete(Message $message);

	/**
	 * Emitted when multiple (cached) message gets deleted. The collection consists of Message instances, mapped by their ID.
	 * @param Collection $messages
	 * @return void
	 * @see \CharlotteDunois\Yasmin\Models\Message
	 */
    function messageDeleteBulk(Collection $messages);

	/**
	 * Emitted when someone reacts to a (cached) message.
	 * @param MessageReaction $reaction
	 * @param User $user
	 * @return void
	 */
    function messageReactionAdd(MessageReaction $reaction, User $user);

	/**
	 * Emitted when a reaction from a (cached) message gets removed.
	 * @param MessageReaction $reaction
	 * @param User $user
	 * @return void
	 */
    function messageReactionRemove(MessageReaction $reaction, User $user);

	/**
	 * Emitted when all reactions from a (cached) message gets removed.
	 * @param Message $message
	 * @return void
	 */
    function messageReactionRemoveAll(Message $message);

	/**
	 * Emitted when a presence updates.
	 * @param Presence $new
	 * @param Presence|null $old
	 * @return void
	 */
    function presenceUpdate(Presence $new, ?Presence $old);

	/**
	 * Emitted when someone starts typing in the channel.
	 * @param TextChannelInterface $channel
	 * @param User $user
	 * @return void
	 */
    function typingStart(TextChannelInterface $channel, User $user);

	/**
	 * Emitted when someone stops typing in the channel.
	 * @param TextChannelInterface $channel
	 * @param User $user
	 * @return void
	 */
    function typingStop(TextChannelInterface $channel, User $user);

	/**
	 * Emitted when someone updates their user account (username/avatar/etc.).
	 * @param User $new
	 * @param User|null $old
	 * @return void
	 */
    function userUpdate(User $new, ?User $old);

	/**
	 * Emitted when Discord responds to the user's Voice State Update event.
	 * If you get `null` for `$data`, then this means that there's no endpoint yet and need to await it = Awaiting Endpoint.
	 * @param array|null $data
	 * @return void
	 * @see https://discordapp.com/developers/docs/topics/gateway#voice-server-update
	 */
    function voiceServerUpdate(?array $data);

	/**
	 * Emitted when a member's voice state changes (leaves/joins/etc.).
	 * @param GuildMember $new
	 * @param GuildMember|null $old
	 * @return void
	 */
    function voiceStateUpdate(GuildMember $new, ?GuildMember $old);
}
