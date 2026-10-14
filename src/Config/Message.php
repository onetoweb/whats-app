<?php

namespace Onetoweb\WhatsApp\Config;

enum Message: string
{
    case AUDIO = 'audio';
    case CONTACTS = 'contacts';
    case DOCUMENT = 'document';
    case IMAGE = 'image';
    case INTERACTIVE = 'interactive';
    case LINK_PREVIEW = 'link_preview';
    case LOCATION = 'location';
    case REACTION = 'reaction';
    case STICKER = 'sticker';
    case TEMPLATE = 'template';
    case TEXT = 'text';
    case THREAD_CONTROL_NOTIFICATION = 'thread_control_notification';
    case VIDEO = 'video';
}
