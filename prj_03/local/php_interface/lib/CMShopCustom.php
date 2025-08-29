<?

use \Bitrix\Main\Page\Asset;

class CMShopCustom extends CMShop
{
    public static function Start($siteID)
    {
        // Кастомизация -->
        global $arDelayedLoading;
        // <-- Кастомизация

        global  $APPLICATION, $SITE_THEME, $TEMPLATE_OPTIONS, $THEME_SWITCHER, $STARTTIME, $HIDE_CATALOG_MULTILEVEL;
        $STARTTIME = time() * 1000;
        $SITE_THEME = COption::GetOptionString(self::moduleID, "COLOR_THEME", 'BLUE', $siteID);
        $TEMPLATE_OPTIONS = self::GetTemplateOptions($siteID);
        $THEME_SWITCHER = COption::GetOptionString(self::moduleID, 'THEME_SWITCHER', 'N', $siteID);


        define("ASPRO_TEMPLATE_LOADED", true);

        if ($TEMPLATE_OPTIONS && is_array($TEMPLATE_OPTIONS)) {
            // reset theme
            if ($_REQUEST["theme"] == "default") {
                foreach ($TEMPLATE_OPTIONS as $templateOptionKey => $templateOptionValue) {
                    if (isset($templateOptionValue["DEFAULT"])) {
                        $default = $templateOptionValue["DEFAULT"];
                        $TEMPLATE_OPTIONS[$templateOptionKey]["CURRENT_VALUE"] = strToUpper($default);
                        $_SESSION[SITE_ID][strToUpper($templateOptionKey)] = strToUpper($default);
                    }
                }
                COption::SetOptionString(self::moduleID, "NeedGenerateCustomTheme", 'Y', '', $siteID);
            } else {
                foreach ($TEMPLATE_OPTIONS as $templateOptionKey => $templateOptionValue) {
                    // read theme from $_SESSION if $THEME_SWITCHER == Y
                    $arOptionValues = array();
                    if ($templateOptionValue["VALUES"] && is_array($templateOptionValue["VALUES"])) {
                        foreach ($templateOptionValue["VALUES"] as  $i => $j) {
                            $arOptionValues[] = $j["VALUE"];
                        }
                    }
                    if (($THEME_SWITCHER == "Y") && $_SESSION[$siteID] && is_array($_SESSION[$siteID])) {
                        foreach ($_SESSION[SITE_ID] as $sessionKey => $sessionValue) {
                            if ($sessionKey == $templateOptionValue["ID"] && ($templateOptionValue["ID"] == "CUSTOM_COLOR_THEME" || in_array($sessionValue, $arOptionValues))) {
                                $TEMPLATE_OPTIONS[$templateOptionKey]["CURRENT_VALUE"] = $sessionValue;
                            }
                        }
                    }

                    // save theme changes in $_SESSION if $THEME_SWITCHER == Y
                    if ($_REQUEST && is_array($_REQUEST)) {
                        foreach ($_REQUEST as $requestKey => $requestValue) {
                            if (strToUpper($requestKey) == $templateOptionValue["ID"] && ($templateOptionValue["ID"] == "CUSTOM_COLOR_THEME" || in_array(strToUpper($requestValue), $arOptionValues))) {
                                if ($templateOptionValue["ID"] == "CUSTOM_COLOR_THEME") {
                                    $requestValue = str_replace('#', '', $requestValue);
                                    $requestValue = (strlen($requestValue) ? $requestValue : $templateOptionValue['DEFAULT']);
                                }

                                if ($templateOptionValue["ID"] == "COLOR_THEME" && $requestValue == 'CUSTOM') {
                                    COption::SetOptionString(self::moduleID, "NeedGenerateCustomTheme", 'Y', '', $siteID);
                                }

                                if ($THEME_SWITCHER == "Y") {
                                    $_SESSION[$siteID][strToUpper($requestKey)] = strToUpper($requestValue);
                                    $TEMPLATE_OPTIONS[$templateOptionKey]["CURRENT_VALUE"] = strToUpper($requestValue);
                                }
                            }
                        }
                    }
                }
            }

            if ($THEME_SWITCHER == "Y" && $TEMPLATE_OPTIONS["HEAD"]["VALUES"] && is_array($TEMPLATE_OPTIONS["HEAD"]["VALUES"])) {
                foreach ($TEMPLATE_OPTIONS["HEAD"]["VALUES"] as $arValue) {
                    if ($arValue["VALUE"] === $TEMPLATE_OPTIONS["HEAD"]["CURRENT_VALUE"]) {
                        $TEMPLATE_OPTIONS["LOGO_IMAGE"]["CURRENT_IMG"] = ($TEMPLATE_OPTIONS["LOGO_IMAGE"]["CURRENT_VALUE"] !== serialize(array())) ? $TEMPLATE_OPTIONS["LOGO_IMAGE"]["CURRENT_IMG"] : str_replace('//', '/', SITE_DIR . $arValue["IMG"]);
                        $TEMPLATE_OPTIONS["LOGO_IMAGE"]["IMG_PRINT"] = ($TEMPLATE_OPTIONS["LOGO_IMAGE"]["CURRENT_VALUE"] !== serialize(array())) ? $TEMPLATE_OPTIONS["LOGO_IMAGE"]["CURRENT_IMG"] : SITE_DIR . "include/logo_color.png";
                        $TEMPLATE_OPTIONS["HEAD"]["CURRENT_MENU"] = $arValue["MENU_TYPE"];
                        $TEMPLATE_OPTIONS["HEAD"]["CURRENT_HEAD_COLOR"] = $arValue["HEAD_COLOR"];
                        $TEMPLATE_OPTIONS["HEAD"]["CURRENT_MENU_COLOR"] = ($arValue["MENU_COLOR"] ? $arValue["MENU_COLOR"] : "none");
                        break;
                    }
                }
            }

            $HIDE_CATALOG_MULTILEVEL = ($TEMPLATE_OPTIONS["HEAD"]["CURRENT_VALUE"] == 'TYPE_1' || $TEMPLATE_OPTIONS["HEAD"]["CURRENT_VALUE"] == 'TYPE_2');
        }

        if (isset($_REQUEST["color_theme"]) && $_REQUEST["color_theme"]) {
            LocalRedirect($_SERVER["HTTP_REFERER"]);
        }

        $SITE_THEME = $TEMPLATE_OPTIONS["COLOR_THEME"]["CURRENT_VALUE"];
        $SITE_THEME_PATH = SITE_TEMPLATE_PATH . '/themes/' . strToLower($SITE_THEME . ($SITE_THEME !== 'CUSTOM' ? '' : '_' . $siteID));
        $APPLICATION->SetAdditionalCSS($SITE_THEME_PATH . '/theme.css', true);
        CMShop::GenerateThemes($siteID);

        $GLOBALS['arFrontLink'] = ['PROPERTY_SHOW_ON_INDEX_PAGE_VALUE' => 'Y'];

        if (CModule::IncludeModuleEx(self::moduleID) == 1) {
            $bIndexBot = false;
            //$bIndexBot = (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) && strpos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') !== false); // is indexed yandex/google bot

            $APPLICATION->SetPageProperty("viewport", "user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width");
            $APPLICATION->SetPageProperty("HandheldFriendly", "true");
            $APPLICATION->SetPageProperty("apple-mobile-web-app-capable", "yes");
            $APPLICATION->SetPageProperty("apple-mobile-web-app-status-bar-style", "black");
            $APPLICATION->SetPageProperty("SKYPE_TOOLBAR", "SKYPE_TOOLBAR_PARSER_COMPATIBLE");

            // Отложенная загрузка CSS -->
            if ($arDelayedLoading['flags']['delayLoad'] == 'Y') {
                $arDelayedLoading['css'][] = SITE_TEMPLATE_PATH . '/css/jquery.fancybox.css';
                //$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/jquery.fancybox.css');

                $arDelayedLoading['css'][] = SITE_TEMPLATE_PATH . '/css/styles.css';
                //$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/styles.css');

                $arDelayedLoading['css'][] = SITE_TEMPLATE_PATH . '/css/colors.css';
                //$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/colors.css');
            } else {
                $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/jquery.fancybox.css');
                $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/styles.css');
                $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/colors.css');
            }

            $bNAjaxMode = ((!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest')) && (strtolower($_REQUEST['ajax']) != 'y'));

            if ($_REQUEST && isset($_REQUEST['print'])) {
                $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/print.css', true);
            } else {
                $linkCss = SITE_TEMPLATE_PATH . '/css/media.css';
                if (((COption::GetOptionString('main', 'use_minified_assets', 'N', $siteID) === 'Y') && file_exists($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/css/media.min.css'))) {
                    $linkCss = SITE_TEMPLATE_PATH . '/css/media.min.css';
                }

                // Отложенная загрузка CSS -->
                if ($arDelayedLoading['flags']['delayLoad'] == 'Y') {
                    $arDelayedLoading['css'][] = $linkCss;
                    //$APPLICATION->SetAdditionalCSS($linkCss);
                } else {
                    $APPLICATION->SetAdditionalCSS($linkCss);
                }
                //$APPLICATION->SetAdditionalCSS(((COption::GetOptionString('main', 'use_minified_assets', 'N', $siteID) === 'Y') && file_exists($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/css/media.min.css')) ? SITE_TEMPLATE_PATH . '/css/media.min.css' : SITE_TEMPLATE_PATH . '/css/media.css', true);
            }
            $sCustomFont = \Bitrix\Main\Config\Option::get('aspro.mshop', 'CUSTOM_FONT', '');
            if ($bNAjaxMode) {
                if ($sCustomFont)
                    $APPLICATION->AddHeadString('<' . $sCustomFont . '>');

                if ($arDelayedLoading['flags']['delayLoad'] == 'Y') {
                    // Кастомизация -->

                    // Отложенная загрузка CSS -->
                    $arDelayedLoading['css'][] = SITE_TEMPLATE_PATH . '/css/xzoom.min.css';
                    //$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/xzoom.min.css');

                    $arDelayedLoading['css'][] = SITE_TEMPLATE_PATH . '/css/xzoom.css';
                    //$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/xzoom.css');

                    $arDelayedLoading['css'][] = SITE_TEMPLATE_PATH . '/css/custom.css';
                    //$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/custom.css', true);

                    $arDelayedLoading['css'][] = SITE_TEMPLATE_PATH . '/css/animation/animation_ext.css';
                    //$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/animation/animation_ext.css');

                    $arDelayedLoading['css'][] = SITE_TEMPLATE_PATH . '/css/jquery.mCustomScrollbar.min.css';
                    //$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/jquery.mCustomScrollbar.min.css');

                    // Отложенная загрузка JS -->
                    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.actual.min.js');

                    $arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . '/js/jqModal.js';
                    //$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jqModal.js');

                    $arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . '/js/jquery.fancybox.js';
                    //$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.fancybox.js');

                    $arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . '/js/jquery.history.js';
                    //$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.history.js');

                    $arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . '/js/jquery.flexslider.js';
                    //$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.flexslider.js');

                    $arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . '/js/jquery.validate.min.js';
                    //$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.validate.min.js');

                    $arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . '/js/jquery.inputmask.bundle.min.js';
                    //$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.inputmask.bundle.min.js');

                    $arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . '/js/jquery.easing.1.3.js';
                    //$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.easing.1.3.js');

                    $arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . '/js/equalize.min.js';
                    //$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/equalize.min.js');

                    $arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . '/js/jquery.alphanumeric.js';
                    //$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.alphanumeric.js');

                    $arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . '/js/jquery.cookie.js';
                    //$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.cookie.js');

                    $arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . '/js/jquery.plugin.min.js';
                    //$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.plugin.min.js');

                    $arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . '/js/jquery.countdown.min.js';
                    //$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.countdown.min.js');

                    $arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . '/js/jquery.countdown-ru.js';
                    //$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.countdown-ru.js');

                    $arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . '/js/jquery.ikSelect.js';
                    //$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.ikSelect.js');

                    $arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . '/js/sly.js';
                    //$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/sly.js');

                    $arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . '/js/jquery.mousewheel-3.0.6.min.js';
                    //$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.mousewheel-3.0.6.min.js');

                    $arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . '/js/jquery.mCustomScrollbar.min.js';
                    //$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.mCustomScrollbar.min.js');

                    $arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . '/js/equalize_ext.js';
                    //$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/equalize_ext.js');

                    $arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . '/js/velocity.js';
                    //$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/velocity.js'); 

                    $arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . '/js/velocity.ui.js';
                    //$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/velocity.ui.js'); 

                    $arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . '/js/xzoom.js';
                    //$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/xzoom.js'); 

                    $arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . '/js/scrollTabs.js';
                    //$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/scrollTabs.js');

                    $arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . '/js/main.js';
                    //$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/main.js');

                    $arDelayedLoading['scripts'][] = SITE_TEMPLATE_PATH . '/js/custom.js';
                    //$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/custom.js', true);
                    // <-- Кастомизация
                } else {
                    // Стандартный код -->
                    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/xzoom.min.css');
                    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/xzoom.css');
                    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/custom.css', true);
                    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/animation/animation_ext.css');
                    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/jquery.mCustomScrollbar.min.css');

                    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.actual.min.js');
                    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jqModal.js');
                    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.fancybox.js');
                    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.history.js');
                    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.flexslider.js');
                    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.validate.min.js');
                    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.inputmask.bundle.min.js');
                    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.easing.1.3.js'); // home - not
                    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/equalize.min.js');
                    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.alphanumeric.js');
                    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.cookie.js');
                    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.plugin.min.js');
                    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.countdown.min.js'); // home - not
                    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.countdown-ru.js'); // home - not
                    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.ikSelect.js');
                    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/sly.js');
                    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.mousewheel-3.0.6.min.js'); // home - not
                    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.mCustomScrollbar.min.js'); // home - not
                    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/equalize_ext.js');
                    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/velocity.js'); // home - not
                    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/velocity.ui.js'); // home - not
                    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/xzoom.js'); // home - not
                    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/scrollTabs.js');
                    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/main.js');
                    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/custom.js', true);
                    // <-- Стандартный код
                }
            }

            if (strlen($TEMPLATE_OPTIONS['FAVICON_IMAGE']['CURRENT_IMG'])) {
                $APPLICATION->AddHeadString('<link rel="shortcut icon" href="' . $TEMPLATE_OPTIONS['FAVICON_IMAGE']['CURRENT_IMG'] . '" type="image/x-icon" />', true);
            }
            if (strlen($TEMPLATE_OPTIONS['APPLE_TOUCH_ICON_57_IMAGE']['CURRENT_IMG'])) {
                $APPLICATION->AddHeadString('<link rel="apple-touch-icon" sizes="57x57" href="' . $TEMPLATE_OPTIONS['APPLE_TOUCH_ICON_57_IMAGE']['CURRENT_IMG'] . '" />', true);
            }
            if (strlen($TEMPLATE_OPTIONS['APPLE_TOUCH_ICON_72_IMAGE']['CURRENT_IMG'])) {
                $APPLICATION->AddHeadString('<link rel="apple-touch-icon" sizes="72x72" href="' . $TEMPLATE_OPTIONS['APPLE_TOUCH_ICON_72_IMAGE']['CURRENT_IMG'] . '" />', true);
            }

            if (!$bIndexBot) {
                CJSCore::Init(array("jquery", "ls"));
                CAjax::Init();
            } else {
                CJSCore::Init(array("jquery"));
            }
            \Bitrix\Main\Loader::includeModule('sale');
            \Bitrix\Main\Loader::includeModule('catalog');
            return true;
        } else {
            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/styles.css');
            $APPLICATION->SetTitle(GetMessage("ERROR_INCLUDE_MODULE"));
            $APPLICATION->IncludeFile(SITE_DIR . "include/error_include_module.php", array(), array());
            die();
        }
    }

    public static function SetJSOptions()
    {
        global $APPLICATION, $TEMPLATE_OPTIONS, $THEME_SWITCHER, $STARTTIME;
        $MESS["MIN_ORDER_PRICE_TEXT"] = COption::GetOptionString(self::moduleID, "MIN_ORDER_PRICE_TEXT", GetMessage("MIN_ORDER_PRICE_TEXT_EXAMPLE"), SITE_ID);
        // get actual ready|delayed|subscribed|compared items
        $arBasketAspro = self::getBasketAspro();

        if (COption::GetOptionString(self::moduleID, "SHOW_LICENCE", 'N', SITE_ID) == "Y") {
            ob_start();
            //$APPLICATION->IncludeFile(SITE_DIR."include/licenses_text.php", Array(), Array("MODE" => "html", "NAME" => "LICENSES"));
            include_once($_SERVER["DOCUMENT_ROOT"] . SITE_DIR . "include/licenses_text.php");
            $license_text = ob_get_contents();
            ob_end_clean();
            $MESS["LICENSES_TEXT"] = $license_text;
        }
        $bIndexBot = (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) && strpos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') !== false); // is indexed yandex/google bot
?>
        <? if (!$bIndexBot): ?>
            <script type="text/javascript">
                var arMShopOptions = {};

                BX.message(<?= CUtil::PhpToJSObject($MESS, false) ?>);
            </script>
            <? Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("options-block"); ?>
            <script>
                var arBasketAspro = <?= CUtil::PhpToJSObject($arBasketAspro, false, true) ?>;
                $(document).ready(function() {
                    setBasketAspro();
                });
            </script>
            <? Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("options-block", ""); ?>

            <script type="text/javascript">
                var arMShopOptions = ({
                    "SITE_ID": "<?= SITE_ID ?>",
                    "SITE_DIR": "<?= SITE_DIR ?>",
                    "FORM": ({
                        "ASK_FORM_ID": "ASK",
                        "SERVICES_FORM_ID": "SERVICES",
                        "FEEDBACK_FORM_ID": "FEEDBACK",
                        "CALLBACK_FORM_ID": "CALLBACK",
                        "RESUME_FORM_ID": "RESUME",
                        "TOORDER_FORM_ID": "TOORDER",
                        "CHEAPER_FORM_ID": "CHEAPER",
                    }),
                    "PAGES": ({
                        "FRONT_PAGE": "<?= self::IsMainPage() ?>",
                        "BASKET_PAGE": "<?= self::IsBasketPage() ?>",
                        "ORDER_PAGE": "<?= self::IsOrderPage() ?>",
                        "PERSONAL_PAGE": "<?= self::IsPersonalPage() ?>",
                        "CATALOG_PAGE": "<?= self::IsCatalogPage() ?>"
                    }),
                    "PRICES": ({
                        "MIN_PRICE": "<?= trim(COption::GetOptionString(self::moduleID, "MIN_ORDER_PRICE", "1000", SITE_ID)); ?>",
                    }),
                    "THEME": ({
                        "THEME_SWITCHER": "<?= strToLower(trim($THEME_SWITCHER)) ?>",
                        "COLOR_THEME": "<?= strToLower(trim($TEMPLATE_OPTIONS["COLOR_THEME"]["CURRENT_VALUE"])) ?>",
                        "CUSTOM_COLOR_THEME": "<?= strToLower(trim($TEMPLATE_OPTIONS["CUSTOM_COLOR_THEME"]["CURRENT_VALUE"])) ?>",
                        "LOGO_IMAGE": "<?= trim($TEMPLATE_OPTIONS["LOGO_IMAGE"]["CURRENT_IMG"]) ?>",
                        "FAVICON_IMAGE": "<?= trim($TEMPLATE_OPTIONS["FAVICON_IMAGE"]["CURRENT_IMG"]) ?>",
                        "APPLE_TOUCH_ICON_57_IMAGE": "<?= trim($TEMPLATE_OPTIONS["APPLE_TOUCH_ICON_57_IMAGE"]["CURRENT_IMG"]) ?>",
                        "APPLE_TOUCH_ICON_72_IMAGE": "<?= trim($TEMPLATE_OPTIONS["APPLE_TOUCH_ICON_72_IMAGE"]["CURRENT_IMG"]) ?>",
                        "BANNER_WIDTH": "<?= strToLower(trim($TEMPLATE_OPTIONS["BANNER_WIDTH"]["CURRENT_VALUE"])) ?>",
                        "BANNER_ANIMATIONTYPE": "<?= trim(COption::GetOptionString(self::moduleID, "BANNER_ANIMATIONTYPE", "SLIDE_HORIZONTAL", SITE_ID)); ?>",
                        "BANNER_SLIDESSHOWSPEED": "<?= trim(COption::GetOptionString(self::moduleID, "BANNER_SLIDESSHOWSPEED", "5000", SITE_ID)); ?>",
                        "BANNER_ANIMATIONSPEED": "<?= trim(COption::GetOptionString(self::moduleID, "BANNER_ANIMATIONSPEED", "600", SITE_ID)); ?>",
                        "HEAD": ({
                            "VALUE": "<?= strToLower(trim($TEMPLATE_OPTIONS["HEAD"]["CURRENT_VALUE"])) ?>",
                            "MENU": "<?= strToLower(trim($TEMPLATE_OPTIONS["HEAD"]["CURRENT_MENU"])) ?>",
                            "MENU_COLOR": "<?= strToLower(trim($TEMPLATE_OPTIONS["HEAD"]["CURRENT_MENU_COLOR"])) ?>",
                            "HEAD_COLOR": "<?= strToLower(trim($TEMPLATE_OPTIONS["HEAD"]["CURRENT_HEAD_COLOR"])) ?>",
                        }),
                        "BASKET": "<?= strToLower(trim($TEMPLATE_OPTIONS["BASKET"]["CURRENT_VALUE"])) ?>",
                        "STORES": "<?= strToLower(trim($TEMPLATE_OPTIONS["STORES"]["CURRENT_VALUE"])) ?>",
                        "STORES_SOURCE": "<?= strToLower(trim($TEMPLATE_OPTIONS["STORES_SOURCE"]["CURRENT_VALUE"])) ?>",
                        "TYPE_SKU": "<?= strToLower(trim($TEMPLATE_OPTIONS["TYPE_SKU"]["CURRENT_VALUE"])) ?>",
                        "TYPE_VIEW_FILTER": "<?= strToLower(trim($TEMPLATE_OPTIONS["TYPE_VIEW_FILTER"]["CURRENT_VALUE"])) ?>",
                        "SHOW_BASKET_ONADDTOCART": "<?= trim(COption::GetOptionString(self::moduleID, "SHOW_BASKET_ONADDTOCART", "Y", SITE_ID)) ?>",
                        "SHOW_ONECLICKBUY_ON_BASKET_PAGE": "<?= trim(COption::GetOptionString(self::moduleID, "SHOW_ONECLICKBUY_ON_BASKET_PAGE", "Y", SITE_ID)) ?>",
                        "SHOW_BASKET_PRINT": "<?= trim(COption::GetOptionString(self::moduleID, "SHOW_BASKET_PRINT", "N", SITE_ID)) ?>",
                        "PHONE_MASK": "<?= trim(COption::GetOptionString(self::moduleID, "PHONE_MASK", "+9 (999) 999-99-99", SITE_ID)); ?>",
                        "VALIDATE_PHONE_MASK": "<?= trim(COption::GetOptionString(self::moduleID, "VALIDATE_PHONE_MASK", "^[+][0-9] [(][0-9]{3}[)] [0-9]{3}[-][0-9]{2}[-][0-9]{2}$", SITE_ID)); ?>",
                        "SCROLLTOTOP_TYPE": "<?= (trim($TEMPLATE_OPTIONS["SCROLLTOTOP_TYPE"]["CURRENT_VALUE"])) ?>",
                        "SCROLLTOTOP_POSITION": "<?= trim(COption::GetOptionString(self::moduleID, "SCROLLTOTOP_POSITION", "PADDING", SITE_ID)) ?>",
                        "SHOW_LICENCE": "<?= COption::GetOptionString(self::moduleID, "SHOW_LICENCE", "N", SITE_ID) ?>",
                        "LICENCE_CHECKED": "<?= COption::GetOptionString(self::moduleID, "LICENCE_CHECKED", "N", SITE_ID) ?>",
                        "SHOW_TOTAL_SUMM": "<?= trim($TEMPLATE_OPTIONS["SHOW_TOTAL_SUMM"]["CURRENT_VALUE"]) ?>",
                        "CHANGE_TITLE_ITEM": "<?= trim($TEMPLATE_OPTIONS["CHANGE_TITLE_ITEM"]["CURRENT_VALUE"]) ?>",
                        "DETAIL_PICTURE_MODE": "<?= trim($TEMPLATE_OPTIONS["DETAIL_PICTURE_MODE"]["CURRENT_VALUE"]) ?>",
                        "HIDE_SITE_NAME_IN_TITLE": "<?= trim($TEMPLATE_OPTIONS["HIDE_SITE_NAME_IN_TITLE"]["CURRENT_VALUE"]) ?>",
                        "NLO_MENU": "<?= trim($TEMPLATE_OPTIONS["NLO_MENU"]["CURRENT_VALUE"]) ?>",
                        "MOBILE_CATALOG_BLOCK_COMPACT": "<?= trim($TEMPLATE_OPTIONS["MOBILE_CATALOG_BLOCK_COMPACT"]["CURRENT_VALUE"]) ?>",
                    }),
                    "COUNTERS": ({
                        "USE_YA_COUNTER": "<?= trim(COption::GetOptionString(self::moduleID, "USE_YA_COUNTER", 'N', SITE_ID)) ?>",
                        "YANDEX_COUNTER": "<?= strlen(trim(COption::GetOptionString(self::moduleID, "YANDEX_COUNTER", false, SITE_ID))) ?>",
                        "YA_COUNTER_ID": "<?= trim(COption::GetOptionString(self::moduleID, "YA_COUNTER_ID", '', SITE_ID)) ?>",
                        "YANDEX_ECOMERCE": "<?= trim(COption::GetOptionString(self::moduleID, "YANDEX_ECOMERCE", false, SITE_ID)) ?>",
                        "USE_FORMS_GOALS": "<?= trim(COption::GetOptionString(self::moduleID, "USE_FORMS_GOALS", 'COMMON', SITE_ID)) ?>",
                        "USE_BASKET_GOALS": "<?= trim(COption::GetOptionString(self::moduleID, "USE_BASKET_GOALS", 'Y', SITE_ID)) ?>",
                        "USE_1CLICK_GOALS": "<?= trim(COption::GetOptionString(self::moduleID, "USE_1CLICK_GOALS", 'Y', SITE_ID)) ?>",
                        "USE_FASTORDER_GOALS": "<?= trim(COption::GetOptionString(self::moduleID, "USE_FASTORDER_GOALS", 'Y', SITE_ID)) ?>",
                        "USE_FULLORDER_GOALS": "<?= trim(COption::GetOptionString(self::moduleID, "USE_FULLORDER_GOALS", 'Y', SITE_ID)) ?>",
                        "USE_DEBUG_GOALS": "<?= trim(COption::GetOptionString(self::moduleID, "USE_DEBUG_GOALS", 'N', SITE_ID)) ?>",
                        "GOOGLE_COUNTER": "<?= strlen(trim(COption::GetOptionString(self::moduleID, "GOOGLE_COUNTER", false, SITE_ID))) ?>",
                        "GOOGLE_ECOMERCE": "<?= trim(COption::GetOptionString(self::moduleID, "GOOGLE_ECOMERCE", false, SITE_ID)) ?>",
                        "TYPE": {
                            "ONE_CLICK": "<?= GetMessage("ONE_CLICK_BUY"); ?>",
                            "QUICK_ORDER": "<?= GetMessage("QUICK_ORDER"); ?>",
                        },
                        "GOOGLE_EVENTS": {
                            "ADD2BASKET": "<?= trim(COption::GetOptionString(self::moduleID, "BASKET_ADD_EVENT", "addToCart", SITE_ID)) ?>",
                            "REMOVE_BASKET": "<?= trim(COption::GetOptionString(self::moduleID, "BASKET_REMOVE_EVENT", "removeFromCart", SITE_ID)) ?>",
                            "CHECKOUT_ORDER": "<?= trim(COption::GetOptionString(self::moduleID, "CHECKOUT_ORDER_EVENT", "checkout", SITE_ID)) ?>",
                            "PURCHASE": "<?= trim(COption::GetOptionString(self::moduleID, "PURCHASE_ORDER_EVENT", "gtm.dom", SITE_ID)) ?>",
                        }
                        /*
                        "GOALS" : {
                        	"TO_BASKET": "<?= trim(COption::GetOptionString(self::moduleID, "TO_BASKET", "TO_BASKET", SITE_ID)) ?>",
                        	"ORDER_START": "<?= trim(COption::GetOptionString(self::moduleID, "ORDER_START", "ORDER_START", SITE_ID)) ?>",
                        	"ORDER_SUCCESS": "<?= trim(COption::GetOptionString(self::moduleID, "ORDER_SUCCESS", "ORDER_SUCCESS", SITE_ID)) ?>",
                        	"QUICK_ORDER_SUCCESS": "<?= trim(COption::GetOptionString(self::moduleID, "QUICK_ORDER_SUCCESS", "QUICK_ORDER_SUCCESS", SITE_ID)) ?>",
                        	"ONE_CLICK_BUY_SUCCESS": "<?= trim(COption::GetOptionString(self::moduleID, "ONE_CLICK_BUY_SUCCESS", "ONE_CLICK_BUY_SUCCESS", SITE_ID)) ?>",
                        }
                        */
                    }),
                    "JS_ITEM_CLICK": ({
                        "precision": 6,
                        "precisionFactor": Math.pow(10, 6)
                    })
                });

                $(document).ready(function() {
                    $.extend($.validator.messages, {
                        required: BX.message('JS_REQUIRED'),
                        email: BX.message('JS_FORMAT'),
                        equalTo: BX.message('JS_PASSWORD_COPY'),
                        minlength: BX.message('JS_PASSWORD_LENGTH'),
                        remote: BX.message('JS_ERROR')
                    });

                    $.validator.addMethod(
                        'regexp',
                        function(value, element, regexp) {
                            var re = new RegExp(regexp);
                            return this.optional(element) || re.test(value);
                        },
                        BX.message('JS_FORMAT')
                    );

                    $.validator.addMethod(
                        'filesize',
                        function(value, element, param) {
                            return this.optional(element) || (element.files[0].size <= param)
                        },
                        BX.message('JS_FILE_SIZE')
                    );

                    $.validator.addMethod(
                        'date',
                        function(value, element, param) {
                            var status = false;
                            if (!value || value.length <= 0) {
                                status = false;
                            } else {
                                // html5 date allways yyyy-mm-dd
                                var re = new RegExp('^([0-9]{4})(.)([0-9]{2})(.)([0-9]{2})$');
                                var matches = re.exec(value);
                                if (matches) {
                                    var composedDate = new Date(matches[1], (matches[3] - 1), matches[5]);
                                    status = ((composedDate.getMonth() == (matches[3] - 1)) && (composedDate.getDate() == matches[5]) && (composedDate.getFullYear() == matches[1]));
                                } else {
                                    // firefox
                                    var re = new RegExp('^([0-9]{2})(.)([0-9]{2})(.)([0-9]{4})$');
                                    var matches = re.exec(value);
                                    if (matches) {
                                        var composedDate = new Date(matches[5], (matches[3] - 1), matches[1]);
                                        status = ((composedDate.getMonth() == (matches[3] - 1)) && (composedDate.getDate() == matches[1]) && (composedDate.getFullYear() == matches[5]));
                                    }
                                }
                            }
                            return status;
                        }, BX.message('JS_DATE')
                    );

                    $.validator.addMethod(
                        'extension',
                        function(value, element, param) {
                            param = typeof param === 'string' ? param.replace(/,/g, '|') : 'png|jpe?g|gif';
                            return this.optional(element) || value.match(new RegExp('.(' + param + ')$', 'i'));
                        }, BX.message('JS_FILE_EXT')
                    );

                    $.validator.addMethod(
                        'captcha',
                        function(value, element, params) {
                            return $.validator.methods.remote.call(this, value, element, {
                                url: arMShopOptions['SITE_DIR'] + 'ajax/check-captcha.php',
                                type: 'post',
                                data: {
                                    captcha_word: value,
                                    captcha_sid: function() {
                                        return $(element).closest('form').find('input[name="captcha_sid"]').val();
                                    }
                                }
                            });
                        },
                        BX.message('JS_ERROR')
                    );

                    $.validator.addMethod(
                        'recaptcha',
                        function(value, element, param) {
                            console.log(23222)
                            var id = $(element).closest('form').find('.g-recaptcha').attr('data-widgetid');
                            if (typeof id !== 'undefined') {
                                return grecaptcha.getResponse(id) != '';
                            } else {
                                return true;
                            }
                        }, BX.message('JS_RECAPTCHA_ERROR')
                    );

                    $.validator.addClassRules({
                        'phone': {
                            regexp: arMShopOptions['THEME']['VALIDATE_PHONE_MASK']
                        },
                        'confirm_password': {
                            equalTo: 'input[name="REGISTER\[PASSWORD\]"]',
                            minlength: 6
                        },
                        'password': {
                            minlength: 6
                        },
                        'inputfile': {
                            extension: arMShopOptions['THEME']['VALIDATE_FILE_EXT'],
                            filesize: 5000000
                        },
                        'captcha': {
                            captcha: ''
                        },
                        'recaptcha': {
                            recaptcha: ''
                        }
                    });



                    if (arMShopOptions['THEME']['PHONE_MASK']) {
                        $('input.phone').inputmask('mask', {
                            'mask': arMShopOptions['THEME']['PHONE_MASK']
                        });
                    }

                    jqmEd('feedback', arMShopOptions['FORM']['FEEDBACK_FORM_ID']);
                    jqmEd('ask', arMShopOptions['FORM']['ASK_FORM_ID'], '.ask_btn');
                    jqmEd('services', arMShopOptions['FORM']['SERVICES_FORM_ID'], '.services_btn', '', '.services_btn');
                    if ($('.resume_send').length) {
                        $('.resume_send').live('click', function(e) {
                            $("body").append("<span class='resume_send_wr' style='display:none;'></span>");
                            jqmEd('resume', arMShopOptions['FORM']['RESUME_FORM_ID'], '.resume_send_wr', '', this);
                            $("body .resume_send_wr").click();
                            $("body .resume_send_wr").remove();
                        })
                    }
                    jqmEd('callback', arMShopOptions['FORM']['CALLBACK_FORM_ID'], '.callback_btn');
                });
            </script>

            <? if (CModule::IncludeModule('currency')): ?>
                <? CJSCore::Init(array('currency')); ?>
                <? $currencyFormat = CCurrencyLang::GetFormatDescription(CSaleLang::GetLangCurrency(SITE_ID)); ?>
                <? if (is_array($currencyFormat)): ?>
                    <script type="text/javascript">
                        function jsPriceFormat(_number) {
                            BX.Currency.setCurrencyFormat('<?= CSaleLang::GetLangCurrency(SITE_ID); ?>', <?= CUtil::PhpToJSObject($currencyFormat, false, true) ?>);
                            return BX.Currency.currencyFormat(_number, '<?= CSaleLang::GetLangCurrency(SITE_ID); ?>', true);
                        }
                    </script>
                <? endif; ?>
            <? endif; ?>
        <? endif; ?>

        <?/*fix reset POST*/
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["color_theme"]) {
            LocalRedirect($_SERVER["HTTP_REFERER"]);
        } ?>
<?
    }

    public static function del_Start($siteID)
    {
        global  $APPLICATION, $SITE_THEME, $TEMPLATE_OPTIONS, $THEME_SWITCHER, $STARTTIME, $HIDE_CATALOG_MULTILEVEL;
        $STARTTIME = time() * 1000;
        $SITE_THEME = COption::GetOptionString(self::moduleID, "COLOR_THEME", 'BLUE', $siteID);
        $TEMPLATE_OPTIONS = self::GetTemplateOptions($siteID);
        $THEME_SWITCHER = COption::GetOptionString(self::moduleID, 'THEME_SWITCHER', 'N', $siteID);


        define("ASPRO_TEMPLATE_LOADED", true);

        if ($TEMPLATE_OPTIONS && is_array($TEMPLATE_OPTIONS)) {
            // reset theme
            if ($_REQUEST["theme"] == "default") {
                foreach ($TEMPLATE_OPTIONS as $templateOptionKey => $templateOptionValue) {
                    if (isset($templateOptionValue["DEFAULT"])) {
                        $default = $templateOptionValue["DEFAULT"];
                        $TEMPLATE_OPTIONS[$templateOptionKey]["CURRENT_VALUE"] = strToUpper($default);
                        $_SESSION[SITE_ID][strToUpper($templateOptionKey)] = strToUpper($default);
                    }
                }
                COption::SetOptionString(self::moduleID, "NeedGenerateCustomTheme", 'Y', '', $siteID);
            } else {
                foreach ($TEMPLATE_OPTIONS as $templateOptionKey => $templateOptionValue) {
                    // read theme from $_SESSION if $THEME_SWITCHER == Y
                    $arOptionValues = array();
                    if ($templateOptionValue["VALUES"] && is_array($templateOptionValue["VALUES"])) {
                        foreach ($templateOptionValue["VALUES"] as  $i => $j) {
                            $arOptionValues[] = $j["VALUE"];
                        }
                    }
                    if (($THEME_SWITCHER == "Y") && $_SESSION[$siteID] && is_array($_SESSION[$siteID])) {
                        foreach ($_SESSION[SITE_ID] as $sessionKey => $sessionValue) {
                            if ($sessionKey == $templateOptionValue["ID"] && ($templateOptionValue["ID"] == "CUSTOM_COLOR_THEME" || in_array($sessionValue, $arOptionValues))) {
                                $TEMPLATE_OPTIONS[$templateOptionKey]["CURRENT_VALUE"] = $sessionValue;
                            }
                        }
                    }

                    // save theme changes in $_SESSION if $THEME_SWITCHER == Y
                    if ($_REQUEST && is_array($_REQUEST)) {
                        foreach ($_REQUEST as $requestKey => $requestValue) {
                            if (strToUpper($requestKey) == $templateOptionValue["ID"] && ($templateOptionValue["ID"] == "CUSTOM_COLOR_THEME" || in_array(strToUpper($requestValue), $arOptionValues))) {
                                if ($templateOptionValue["ID"] == "CUSTOM_COLOR_THEME") {
                                    $requestValue = str_replace('#', '', $requestValue);
                                    $requestValue = (strlen($requestValue) ? $requestValue : $templateOptionValue['DEFAULT']);
                                }

                                if ($templateOptionValue["ID"] == "COLOR_THEME" && $requestValue == 'CUSTOM') {
                                    COption::SetOptionString(self::moduleID, "NeedGenerateCustomTheme", 'Y', '', $siteID);
                                }

                                if ($THEME_SWITCHER == "Y") {
                                    $_SESSION[$siteID][strToUpper($requestKey)] = strToUpper($requestValue);
                                    $TEMPLATE_OPTIONS[$templateOptionKey]["CURRENT_VALUE"] = strToUpper($requestValue);
                                }
                            }
                        }
                    }
                }
            }

            if ($THEME_SWITCHER == "Y" && $TEMPLATE_OPTIONS["HEAD"]["VALUES"] && is_array($TEMPLATE_OPTIONS["HEAD"]["VALUES"])) {
                foreach ($TEMPLATE_OPTIONS["HEAD"]["VALUES"] as $arValue) {
                    if ($arValue["VALUE"] === $TEMPLATE_OPTIONS["HEAD"]["CURRENT_VALUE"]) {
                        $TEMPLATE_OPTIONS["LOGO_IMAGE"]["CURRENT_IMG"] = ($TEMPLATE_OPTIONS["LOGO_IMAGE"]["CURRENT_VALUE"] !== serialize(array())) ? $TEMPLATE_OPTIONS["LOGO_IMAGE"]["CURRENT_IMG"] : str_replace('//', '/', SITE_DIR . $arValue["IMG"]);
                        $TEMPLATE_OPTIONS["LOGO_IMAGE"]["IMG_PRINT"] = ($TEMPLATE_OPTIONS["LOGO_IMAGE"]["CURRENT_VALUE"] !== serialize(array())) ? $TEMPLATE_OPTIONS["LOGO_IMAGE"]["CURRENT_IMG"] : SITE_DIR . "include/logo_color.png";
                        $TEMPLATE_OPTIONS["HEAD"]["CURRENT_MENU"] = $arValue["MENU_TYPE"];
                        $TEMPLATE_OPTIONS["HEAD"]["CURRENT_HEAD_COLOR"] = $arValue["HEAD_COLOR"];
                        $TEMPLATE_OPTIONS["HEAD"]["CURRENT_MENU_COLOR"] = ($arValue["MENU_COLOR"] ? $arValue["MENU_COLOR"] : "none");
                        break;
                    }
                }
            }

            $HIDE_CATALOG_MULTILEVEL = ($TEMPLATE_OPTIONS["HEAD"]["CURRENT_VALUE"] == 'TYPE_1' || $TEMPLATE_OPTIONS["HEAD"]["CURRENT_VALUE"] == 'TYPE_2');
        }

        if (isset($_REQUEST["color_theme"]) && $_REQUEST["color_theme"]) {
            LocalRedirect($_SERVER["HTTP_REFERER"]);
        }

        $SITE_THEME = $TEMPLATE_OPTIONS["COLOR_THEME"]["CURRENT_VALUE"];
        $SITE_THEME_PATH = SITE_TEMPLATE_PATH . '/themes/' . strToLower($SITE_THEME . ($SITE_THEME !== 'CUSTOM' ? '' : '_' . $siteID));
        $APPLICATION->SetAdditionalCSS($SITE_THEME_PATH . '/theme.css', true);
        CMShop::GenerateThemes($siteID);

        $GLOBALS['arFrontLink'] = ['PROPERTY_SHOW_ON_INDEX_PAGE_VALUE' => 'Y'];

        if (CModule::IncludeModuleEx(self::moduleID) == 1) {
            $bIndexBot = (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) && strpos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') !== false); // is indexed yandex/google bot

            $APPLICATION->SetPageProperty("viewport", "user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width");
            $APPLICATION->SetPageProperty("HandheldFriendly", "true");
            $APPLICATION->SetPageProperty("apple-mobile-web-app-capable", "yes");
            $APPLICATION->SetPageProperty("apple-mobile-web-app-status-bar-style", "black");
            $APPLICATION->SetPageProperty("SKYPE_TOOLBAR", "SKYPE_TOOLBAR_PARSER_COMPATIBLE");

            if (!$bIndexBot)
                $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/jquery.fancybox.css');

            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/styles.css');
            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/colors.css');

            $bNAjaxMode = ((!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest')) && (strtolower($_REQUEST['ajax']) != 'y'));

            if ($_REQUEST && isset($_REQUEST['print'])) {
                $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/print.css', true);
            } else {
                $APPLICATION->SetAdditionalCSS(((COption::GetOptionString('main', 'use_minified_assets', 'N', $siteID) === 'Y') && file_exists($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/css/media.min.css')) ? SITE_TEMPLATE_PATH . '/css/media.min.css' : SITE_TEMPLATE_PATH . '/css/media.css', true);
            }
            $sCustomFont = \Bitrix\Main\Config\Option::get('aspro.mshop', 'CUSTOM_FONT', '');
            if ($bNAjaxMode) {
                if (!$bIndexBot) {
                    if ($sCustomFont)
                        $APPLICATION->AddHeadString('<' . $sCustomFont . '>');

                    // Мой код -->
                    if (true) {
                        $pageCode = TemplateTools::getCurPageCode();
                        self::showCSS($pageCode);
                        self::showJS($pageCode);
                    }
                    // <-- Мой код
                    else {
                        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/xzoom.min.css');
                        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/xzoom.css');
                        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/custom.css', true);
                        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/animation/animation_ext.css');
                        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/jquery.mCustomScrollbar.min.css');

                        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.actual.min.js');
                        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jqModal.js');
                        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.fancybox.js');
                        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.history.js');
                        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.flexslider.js');
                        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.validate.min.js');
                        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.inputmask.bundle.min.js');
                        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.easing.1.3.js'); // home - not
                        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/equalize.min.js');
                        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.alphanumeric.js');
                        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.cookie.js');
                        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.plugin.min.js');
                        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.countdown.min.js'); // home - not
                        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.countdown-ru.js'); // home - not
                        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.ikSelect.js');
                        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/sly.js');
                        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.mousewheel-3.0.6.min.js'); // home - not
                        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.mCustomScrollbar.min.js'); // home - not
                        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/equalize_ext.js');
                        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/velocity.js'); // home - not
                        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/velocity.ui.js'); // home - not
                        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/xzoom.js'); // home - not
                        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/scrollTabs.js');
                        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/main.js');
                        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/custom.js', true);
                    }
                }
            }

            if (strlen($TEMPLATE_OPTIONS['FAVICON_IMAGE']['CURRENT_IMG'])) {
                $APPLICATION->AddHeadString('<link rel="shortcut icon" href="' . $TEMPLATE_OPTIONS['FAVICON_IMAGE']['CURRENT_IMG'] . '" type="image/x-icon" />', true);
            }
            if (strlen($TEMPLATE_OPTIONS['APPLE_TOUCH_ICON_57_IMAGE']['CURRENT_IMG'])) {
                $APPLICATION->AddHeadString('<link rel="apple-touch-icon" sizes="57x57" href="' . $TEMPLATE_OPTIONS['APPLE_TOUCH_ICON_57_IMAGE']['CURRENT_IMG'] . '" />', true);
            }
            if (strlen($TEMPLATE_OPTIONS['APPLE_TOUCH_ICON_72_IMAGE']['CURRENT_IMG'])) {
                $APPLICATION->AddHeadString('<link rel="apple-touch-icon" sizes="72x72" href="' . $TEMPLATE_OPTIONS['APPLE_TOUCH_ICON_72_IMAGE']['CURRENT_IMG'] . '" />', true);
            }

            if (!$bIndexBot) {
                CJSCore::Init(array("jquery", "ls"));
                CAjax::Init();
            } else {
                CJSCore::Init(array("jquery"));
            }
            \Bitrix\Main\Loader::includeModule('sale');
            \Bitrix\Main\Loader::includeModule('catalog');
            return true;
        } else {
            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/styles.css');
            $APPLICATION->SetTitle(GetMessage("ERROR_INCLUDE_MODULE"));
            $APPLICATION->IncludeFile(SITE_DIR . "include/error_include_module.php", array(), array());
            die();
        }
    }

    public static function showCSS($pageCode)
    {
        global $APPLICATION;

        if (TemplateTools::checkShowCSS($pageCode, 'xzoom.min')) {
            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/xzoom.min.css');
        }
        if (TemplateTools::checkShowCSS($pageCode, 'xzoom')) {
            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/xzoom.css');
        }
        if (TemplateTools::checkShowCSS($pageCode, 'custom')) {
            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/custom.css', true);
        }
        if (TemplateTools::checkShowCSS($pageCode, 'animation_ext')) {
            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/animation/animation_ext.css');
        }
        if (TemplateTools::checkShowCSS($pageCode, 'jquery.mCustomScrollbar.min')) {
            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/css/jquery.mCustomScrollbar.min.css');
        }
    }

    public static function showJS($pageCode)
    {
        global $APPLICATION;

        if (TemplateTools::checkShowJS($pageCode, 'jquery.actual')) {
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.actual.min.js');
            //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.actual.min.js");
        }
        if (TemplateTools::checkShowJS($pageCode, 'jqModal')) {
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jqModal.js');
            //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jqModal.js");
        }
        if (TemplateTools::checkShowJS($pageCode, 'jquery.fancybox')) {
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.fancybox.js');
            //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.fancybox.js");
        }
        if (TemplateTools::checkShowJS($pageCode, 'jquery.history')) {
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.history.js');
            //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.history.js");
        }
        if (TemplateTools::checkShowJS($pageCode, 'jquery.flexslider')) {
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.flexslider.js');
            //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.flexslider.js");
        }
        if (TemplateTools::checkShowJS($pageCode, 'jquery.validate.min')) {
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.validate.min.js');
            //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.validate.min.js");
        }
        if (TemplateTools::checkShowJS($pageCode, 'jquery.inputmask.bundle')) {
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.inputmask.bundle.min.js');
            //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.inputmask.bundle.min.js");
        }
        if (TemplateTools::checkShowJS($pageCode, 'jquery.easing.1.3')) {
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.easing.1.3.js'); // home - not
            //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.easing.1.3.js");
        }
        if (TemplateTools::checkShowJS($pageCode, 'equalize')) {
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/equalize.min.js');
            //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/equalize.min.js");
        }
        if (TemplateTools::checkShowJS($pageCode, 'jquery.alphanumeric')) {
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.alphanumeric.js');
            //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.alphanumeric.js");
        }
        if (TemplateTools::checkShowJS($pageCode, 'jquery.cookie')) {
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.cookie.js');
            //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.cookie.js");
        }
        if (TemplateTools::checkShowJS($pageCode, 'jquery.plugin')) {
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.plugin.min.js');
            //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.plugin.min.js");
        }
        if (TemplateTools::checkShowJS($pageCode, 'jquery.countdown')) {
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.countdown.min.js'); // home - not
            //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.countdown.min.js");
        }
        if (TemplateTools::checkShowJS($pageCode, 'jquery.countdown-ru')) {
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.countdown-ru.js'); // home - not
            //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.countdown-ru.min.js");
        }
        if (TemplateTools::checkShowJS($pageCode, 'jquery.ikSelect')) {
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.ikSelect.js');
            //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.ikSelect.js");
        }
        if (TemplateTools::checkShowJS($pageCode, 'sly')) {
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/sly.js');
            //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/sly.js");
        }
        if (TemplateTools::checkShowJS($pageCode, 'jquery.mousewheel-3.0.6')) {
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.mousewheel-3.0.6.min.js'); // home - not
            //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.mousewheel-3.0.6.min.js");
        }
        if (TemplateTools::checkShowJS($pageCode, 'jquery.mCustomScrollbar')) {
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/jquery.mCustomScrollbar.min.js'); // home - not
            //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.mCustomScrollbar.min.js");
        }
        if (TemplateTools::checkShowJS($pageCode, 'equalize_ext')) {
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/equalize_ext.js');
            //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/equalize_ext.js");
        }
        if (TemplateTools::checkShowJS($pageCode, 'velocity')) {
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/velocity.js'); // home - not
            //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/velocity.js");
        }
        if (TemplateTools::checkShowJS($pageCode, 'velocity.ui')) {
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/velocity.ui.js'); // home - not
            //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/velocity.ui.js");
        }
        if (TemplateTools::checkShowJS($pageCode, 'xzoom')) {
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/xzoom.js'); // home - not
            //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/xzoom.js");
        }
        if (TemplateTools::checkShowJS($pageCode, 'scrollTabs')) {
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/scrollTabs.js');
            //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/scrollTabs.js");
        }
        if (TemplateTools::checkShowJS($pageCode, 'main')) {
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/main.js');
            //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/main.js");
        }
        if (TemplateTools::checkShowJS($pageCode, 'custom')) {
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . '/js/custom.js', true);
            //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/custom.js", true);
        }
    }
}
