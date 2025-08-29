<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
if(!$GLOBALS["USER"]->IsAuthorized()){
    LocalRedirect(AUTH_URL);
}
?>

<div class="section__profile">
    <!-- begin .profile-->
    <div class="profile js-profile-scope">
        <div class="profile__wrapper">
            <div class="profile__main">
                <div class="profile__content">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:sale.personal.section",
                        "main",
                        array(
                            "ACCOUNT_PAYMENT_ELIMINATED_PAY_SYSTEMS" => array(
                                0 => "0",
                            ),
                            "ACCOUNT_PAYMENT_PERSON_TYPE" => "1",
                            "ACCOUNT_PAYMENT_SELL_SHOW_FIXED_VALUES" => "Y",
                            "ACCOUNT_PAYMENT_SELL_TOTAL" => array(
                                0 => "100",
                                1 => "200",
                                2 => "500",
                                3 => "1000",
                                4 => "5000",
                                5 => "",
                            ),
                            "ACCOUNT_PAYMENT_SELL_USER_INPUT" => "Y",
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "3600",
                            "CACHE_TYPE" => "A",
                            "CHECK_RIGHTS_PRIVATE" => "N",
                            "COMPATIBLE_LOCATION_MODE_PROFILE" => "N",
                            "CUSTOM_PAGES" => "",
                            "CUSTOM_SELECT_PROPS" => array(
                            ),
                            "NAV_TEMPLATE" => "",
                            "ORDER_HISTORIC_STATUSES" => array(
                                0 => "P",
                                1 => "F",
                            ),
                            "PATH_TO_BASKET" => "/personal/cart/",
                            "PATH_TO_CATALOG" => "/catalog/",
                            "PATH_TO_CONTACT" => "",
                            "PATH_TO_PAYMENT" => "",
                            "PER_PAGE" => "20",
                            "PROP_1" => array(
                            ),
                            "PROP_2" => "",
                            "SAVE_IN_SESSION" => "Y",
                            "SEF_FOLDER" => "/personal/",
                            "SEF_MODE" => "Y",
                            "SEND_INFO_PRIVATE" => "N",
                            "SET_TITLE" => "N",
                            "SHOW_ACCOUNT_COMPONENT" => "N",
                            "SHOW_ACCOUNT_PAGE" => "N",
                            "SHOW_ACCOUNT_PAY_COMPONENT" => "N",
                            "SHOW_BASKET_PAGE" => "N",
                            "SHOW_CONTACT_PAGE" => "N",
                            "SHOW_ORDER_PAGE" => "Y",
                            "SHOW_PRIVATE_PAGE" => "Y",
                            "SHOW_PROFILE_PAGE" => "Y",
                            "SHOW_SUBSCRIBE_PAGE" => "N",
                            "USER_PROPERTY_PRIVATE" => "",
                            "USE_AJAX_LOCATIONS_PROFILE" => "N",
                            "COMPONENT_TEMPLATE" => ".default",
                            "ACCOUNT_PAYMENT_SELL_CURRENCY" => "RUB",
                            "COMPOSITE_FRAME_MODE" => "A",
                            "COMPOSITE_FRAME_TYPE" => "AUTO",
                            "ORDER_HIDE_USER_INFO" => array(
                                0 => "0",
                            ),
                            "ORDER_RESTRICT_CHANGE_PAYSYSTEM" => array(
                                0 => "0",
                            ),
                            "ORDER_DEFAULT_SORT" => "STATUS",
                            "ALLOW_INNER" => "N",
                            "ONLY_INNER_FULL" => "N",
                            "ORDERS_PER_PAGE" => "10",
                            "PROFILES_PER_PAGE" => "100",
                            "MAIN_CHAIN_NAME" => "Личный кабинет",
                            "PROP_5" => array(
                            ),
                            "ORDER_REFRESH_PRICES" => "N",
                            "ORDER_DISALLOW_CANCEL" => "N",
                            "SEF_URL_TEMPLATES" => array(
                                "index" => "index.php",
                                "orders" => "orders/",
                                "account" => "account/",
                                "subscribe" => "subscribe/",
                                "profile" => "profiles/",
                                "profile_detail" => "profiles/#ID#",
                                "private" => "profile/",
                                "order_detail" => "orders/#ID#",
                                "order_cancel" => "cancel/#ID#",
                            ),
                            "AJAX_MODE_PRIVATE" => "N"
                        ),
                        false
                    );?>
                </div>
            </div>
            <div class="profile__aside">
                <!-- begin .sidebar-->
                <div class="sidebar profile__sidebar">
                    <div class="sidebar__nav">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "personal_menu",
                            array(
                                "ROOT_MENU_TYPE" => "personal",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "MAX_LEVEL" => "1",
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "N",
                            ),
                            false
                        );?>
                    </div>
                    <div class="sidebar__controls">
                        <div class="sidebar__control">
                            <!-- begin .button-->
                            <a
                                class="button button_width_full button_size_s button_style_outline js-modal"
                                href="#modalRequestAOR"
                            >
                                <span class="button__holder">Запросить акт сверки</span>
                            </a>
                            <!-- end .button-->
                        </div>
                    </div>
                </div>
                <!-- end .sidebar-->
            </div>
        </div>
    </div>
    <!-- end .profile-->
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>