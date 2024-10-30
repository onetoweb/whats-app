<?php

namespace Onetoweb\WhatsApp\Type;

/**
 * Message Types.
 */
final class Message
{
    /**
     * Types.
     */
    public const AUDIO = 'audio';
    public const CONTACTS = 'contacts';
    public const DOCUMENT = 'document';
    public const IMAGE = 'image';
    public const INTERACTIVE = 'interactive';
    public const LINK_PREVIEW = 'link_preview';
    public const LOCATION = 'location';
    public const REACTION = 'reaction';
    public const STICKER = 'sticker';
    public const TEMPLATE = 'template';
    public const TEXT = 'text';
    public const THREAD_CONTROL_NOTIFICATION = 'thread_control_notification';
    public const VIDEO = 'video';
    
    /**
     * @return array[]
     */
    public static function getTypes(): array
    {
        return [
            self::AUDIO,
            self::CONTACTS,
            self::DOCUMENT,
            self::IMAGE,
            self::INTERACTIVE,
            self::LINK_PREVIEW,
            self::LOCATION,
            self::REACTION,
            self::STICKER,
            self::TEMPLATE,
            self::TEXT,
            self::THREAD_CONTROL_NOTIFICATION,
            self::VIDEO,
        ];
    }
}
