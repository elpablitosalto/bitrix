<?
/* IBLOCKS */
if(!defined('CATALOG_IB_ID')) {
    define('CATALOG_IB_ID', 36);
}

if(!defined('BANNERS_IB_ID')) {
    define('BANNERS_IB_ID', 4);
}

if(!defined('SOCIAL_NAV_IB_ID')) {
    define('SOCIAL_NAV_IB_ID', 38);
}

if(!defined('CONTACTS_IB_ID')) {
    define('CONTACTS_IB_ID', 39);
}

if(!defined('PROMO_IB_ID')) {
    define('PROMO_IB_ID', 41);
}

if(!defined('BRANDS_IB_ID')) {
    define('BRANDS_IB_ID', 3);
}

if(!defined('WAREHOUSES_IB_ID')) {
    define('WAREHOUSES_IB_ID', 42);
}

if(!defined('ADVANTAGES_IB_ID')) {
    define('ADVANTAGES_IB_ID', 43);
}

if(!defined('CLIENTS_PARTNERS_IB_ID')) {
    define('CLIENTS_PARTNERS_IB_ID', 47);
}

if(!defined('METRICS_IB_ID')) {
    define('METRICS_IB_ID', 46);
}

if(!defined('INFO_PANELS_IB_ID')) {
    define('INFO_PANELS_IB_ID', 44);
}

if(!defined('PVZ_IB_ID')) {
    define('PVZ_IB_ID', 45);
}

if(!defined('VIDEO_CAROUSEL_IB_ID')) {
    define('VIDEO_CAROUSEL_IB_ID', 52);
}

/* FORMS */
if(!defined('PERSONAL_DATA_LINK')) {
    define('PERSONAL_DATA_LINK', '/politika/');
}

/* AUTH */
if(!defined('AUTH_URL')) {
    define('AUTH_URL', '/auth/');
}

if(!defined('REGISTER_URL')) {
    define('REGISTER_URL', '/auth/register/');
}

if(!defined('PASSWORD_RECOVERY_URL')) {
    define('PASSWORD_RECOVERY_URL', '/auth/password-recovery/');
}

/* PERSONAL */
if(!defined('PERSONAL_URL')) {
    define('PERSONAL_URL', '/personal/');
}

if(!defined('CART_URL')) {
    define('CART_URL', PERSONAL_URL. 'cart/');
}

if(!defined('FAVORITES_URL')) {
    define('FAVORITES_URL', PERSONAL_URL. 'favorites/');
}

if(!defined('ORDER_URL')) {
    define('ORDER_URL',  PERSONAL_URL. 'make-order/');
}

if(!defined('ORDERS_URL')) {
    define('ORDERS_URL',  PERSONAL_URL. 'orders/');
}

if(!defined('PROFILE_URL')) {
    define('PROFILE_URL',  PERSONAL_URL. 'profile/');
}

if(!defined('PROFILES_URL')) {
    define('PROFILES_URL',  PERSONAL_URL. 'profiles/');
}

/* GLOBAL */
$catalogLayout = !empty($_COOKIE['CATALOG_LAYOUT']) ? $_COOKIE['CATALOG_LAYOUT'] : 'GRID';
define('CATALOG_LAYOUT', $catalogLayout);

$imageNotFound = '/mockup/dist/assets/images/image-not-found.png';
if(!defined('IMAGE_NOT_FOUND')) {
    define('IMAGE_NOT_FOUND', $imageNotFound);
}
if(!defined('LOGO_URL')) {
    define('LOGO_URL', '/local/templates/mirvendinga'.$imageNotFound);
}

/* reCAPTCHA */
if(!defined('CAPTCHA_SITE_KEY')) {
    define('CAPTCHA_SITE_KEY', '6LdhHQ4mAAAAACyY1zPBIXrWAcu2VxGTTiLeg6a-');
    // define('CAPTCHA_SITE_KEY', '6Lfq3RslAAAAAOvTrA1LtD2rDYiJ1iCckwtcid8T');
}

if(!defined('CAPTCHA_SECRET_KEY')) {
    define('CAPTCHA_SECRET_KEY', '6LdhHQ4mAAAAACds_Dxf8yzIHpPBcwi4ENJVqc3D');
    // define('CAPTCHA_SECRET_KEY', '6Lfq3RslAAAAAMmciWKvQ2P0OBu0o9a5c8q4e4Y6');
}

/*Услуги в каталоге*/
if(!defined('SERVICES_SECTION_ID')) {
    define('SERVICES_SECTION_ID', 544);
}
if(!defined('REPAIR_SERVICES_SECTION_ID')) {
    define('REPAIR_SERVICES_SECTION_ID', 546);
}
if(!defined('TRANSPORT_SERVICES_SECTION_ID')) {
    define('TRANSPORT_SERVICES_SECTION_ID', 545);
}

// Яндекс.Карты
define('YA_MAPS_LINK', 'https://api-maps.yandex.ru/2.1/?apikey=e0711a3e-e4c8-4a95-9aea-f3ced170b65d&lang=ru_RU');


// Свойство Привязка к разделам в каталоге
if(!defined('SECTIONS_LINK_PROP_ID')) {
    define('SECTIONS_LINK_PROP_ID', 349);
}
