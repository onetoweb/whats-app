<?php

namespace Onetoweb\WhatsApp\Type;

/**
 * Interactive Types.
 */
final class Interactive
{
    /**
     * Types.
     */
    public const ADDRESS_MESSAGE = 'address_message';
    public const BUTTON = 'button';
    public const CALL_PERMISSION_REQUEST = 'call_permission_request';
    public const CATALOG_MESSAGE = 'catalog_message';
    public const CTA_URL = 'cta_url';
    public const FLOW = 'flow';
    public const FORM_MESSAGE = 'form_message';
    public const LIST = 'list';
    public const LOCATION_REQUEST_MESSAGE = 'location_request_message';
    public const MENU_OPTIONS = 'menu_options';
    public const MESSAGE_WITH_LINK = 'message_with_link';
    public const MESSAGE_WITH_LINK_STATUS = 'message_with_link_status';
    public const ORDER_DETAILS = 'order_details';
    public const ORDER_STATUS = 'order_status';
    public const PRODUCT = 'product';
    public const PRODUCT_LIST = 'product_list';
    public const VOICE_CALL = 'voice_call';
    
    /**
     * @return array[]
     */
    public static function getTypes(): array
    {
        return [
            self::ADDRESS_MESSAGE,
            self::BUTTON,
            self::CALL_PERMISSION_REQUEST,
            self::CATALOG_MESSAGE,
            self::CTA_URL,
            self::FLOW,
            self::FORM_MESSAGE,
            self::LIST,
            self::LOCATION_REQUEST_MESSAGE,
            self::MENU_OPTIONS,
            self::MESSAGE_WITH_LINK,
            self::MESSAGE_WITH_LINK_STATUS,
            self::ORDER_DETAILS,
            self::ORDER_STATUS,
            self::PRODUCT,
            self::PRODUCT_LIST,
            self::VOICE_CALL,
        ];
    }
}
