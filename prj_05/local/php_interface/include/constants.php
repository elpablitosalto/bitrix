<?
/* FILES STRUCTURE */
define('MOCKUP','/static/app');

/* IBLOCKS */
define('CATALOG',2);
define('CATALOG_SKU',3);
define('MATERIALS',4);
define('VIDEO',5);
define('EVENTS',6);
define('NEWS',8);
define('OUR_TEAM',9);
define('SALONS',11);
define('WRITE_US',12);
define('MARKETING_MATERIALS',14);
define('ORDERS',15);
define('ASK_QUESTION',16);
define('REZUME',19);
define('DISTRIBUTION_ASK',21);
define('LEARNING',22);
define('WRITE_TECH',23);
define('ORDER_REQUEST', 31);
define('PARTNERSHIP_REQUEST', 37);
define('MARKETPLACES', 43);
define('SEO_IB_ID', 52);
define('CONCEPT_CATALOG_EN_IB_ID', 61);
define('CONCEPT_CATALOG_EN_VARS_IB_ID', 62);
define('INFINITY_CATALOG_EN_IB_ID', 63);
define('INFINITY_CATALOG_EN_VARS_IB_ID', 64);
define('CONCEPT_BANNERS_MAIN_IB_ID', 1);
define('CONCEPT_BANNERS_ABOUT_IB_ID', 66);
define('CONCEPT_BANNERS_COOPERATION_IB_ID', 27);
define('INFINITY_BANNERS_COOPERATION_IB_ID', 65);
define('TRAINING_VIDEOS_IB_ID', 39);
define('BANNER_EDU_VIDEOS_IB_ID', 40);

/* HighLoad Blocks */
define('SOCIALS',10);
define('COLOR_HL_ID',6);

/* Sections */
define('OUR_TEAM_TECH',22);

/* Константы по-умолчанию */
define('DEFAULT_CITY',27); //Ростов-на-Дону, ID города по-умолчанию
define('DEFAULT_REGION',11); //Ростов-на-Дону, ID региона по-умолчанию
define('USER_GROUPS',[5,6,7]);
define('MASTER',5);
define('TECH',6);
define('DISTRIBUTOR',7);

/* Статическая информация */
define('STATIC_IBLOCK',20);
define('SERTIFICATES_ABOUT',277);
define('REWARDS_ABOUT',278);
define('TECHNOLOGIES_ABOUT',279);

/* Константы API */
define('YANDEX_MAP','66de7a90-b211-4120-8d6e-ffc800d8e8aa');
define('DADATA','35feed8928f54feb9655ce38286c870137aa1bce');

/* reCAPTCHA */
if(!defined('CAPTCHA_SITE_KEY')) {
    define('CAPTCHA_SITE_KEY', '6LeiX3cfAAAAAAHbgfoOoQrQNZSgOawPhjUT9b0K'); // hair.ru
    //define('CAPTCHA_SITE_KEY', '6LdfTZ8qAAAAAJyf_NZnGKbjtUIDKAdq0-UefK2j'); // hairen.wadev.ru
}

if(!defined('CAPTCHA_SECRET_KEY')) {
    define('CAPTCHA_SECRET_KEY', '6LdsmFkoAAAAADoB76YFK1XaTiwQNr6D_shbVdkQ'); // hair.ru
    //define('CAPTCHA_SECRET_KEY', '6LdfTZ8qAAAAAPNALKewaRyxNliFRv1_vHdI9MYD'); // hairen.wadev.ru
}

/*Infinity*/
define('INFINITY_ROOT','/infinity');

define('INFINITY_CATALOG_IB_ID', 45);
define('INFINITY_CATALOG_VARIANTS_IB_ID', 48);

define('INFINITY_MAIN_BANNERS_IB_ID', 44);
define('INFINITY_MAIN_FEATURES_IB_ID', 46);
define('INFINITY_CATALOG_BANNERS_IB_ID', 47);
define('INFINITY_PRODUCT_BANNERS_IB_ID', 49);
define('INFINITY_LOOKBOOK_IB_ID', 51);