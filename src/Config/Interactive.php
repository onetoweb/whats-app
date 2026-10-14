<?php

namespace Onetoweb\WhatsApp\Config;

enum Interactive: string
{
    case ADDRESS_MESSAGE = 'address_message';
    case BUTTON = 'button';
    case CALL_PERMISSION_REQUEST = 'call_permission_request';
    case CATALOG_MESSAGE = 'catalog_message';
    case CTA_URL = 'cta_url';
    case FLOW = 'flow';
    case FORM_MESSAGE = 'form_message';
    case LIST = 'list';
    case LOCATION_REQUEST_MESSAGE = 'location_request_message';
    case MENU_OPTIONS = 'menu_options';
    case MESSAGE_WITH_LINK = 'message_with_link';
    case MESSAGE_WITH_LINK_STATUS = 'message_with_link_status';
    case ORDER_DETAILS = 'order_details';
    case ORDER_STATUS = 'order_status';
    case PRODUCT = 'product';
    case PRODUCT_LIST = 'product_list';
    case VOICE_CALL = 'voice_call';
}
