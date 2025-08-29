<?
global $isHomePage;
?>

<?
$bShowBanner = true;
if (defined('SHOW_TEMPLATE_BOTTOM_BANNER') && SHOW_TEMPLATE_BOTTOM_BANNER == 'N') {
    $bShowBanner = false;
}
?>
<? if ($bShowBanner) { ?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "banner_cooperation_main_page",
        array(
            "IBLOCK_ID" => CONCEPT_BANNERS_COOPERATION_IB_ID,
            "IBLOCK_TYPE" => "banners_en",
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array(0 => "", 1 => "",),
            "FILTER_NAME" => "arrBannerCooperation",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "Y",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "1",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Новости",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array(0 => "LINK", 1 => "MOBILE_IMAGE", 2 => "TABLET_IMAGE", 3 => "DESKTOP_IMAGE", 4 => "",),
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "Y",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY2" => "ACTIVE_FROM",
            "SORT_BY1" => "SORT",
            "SORT_ORDER2" => "DESC",
            "SORT_ORDER1" => "ASC",
            "STRICT_SECTION_CHECK" => "N"
        )
    ); ?>
<? } ?>

<?
$bShowAsk = true;
if (defined('SHOW_TEMPLATE_BOTTOM_ASK') && SHOW_TEMPLATE_BOTTOM_ASK == 'N') {
    $bShowAsk = false;
}
?>
<? if ($bShowAsk) { ?>
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_DIR . "/include/main/ask_text_button.php",
            "AREA_FILE_RECURSIVE" => "N",
            "EDIT_MODE" => "html",
        ),
        false,
        array('HIDE_ICONS' => 'Y')
    );
    ?>
<? } ?>

</div>
<div class="page__footer">
    <!-- begin .footer-->
    <div class="footer">
        <div class="footer__main">
            <div class="footer__container page__container">
                <div class="footer__info">
                    <div class="footer__lang-link">
                        <!-- begin .icon-link-->
                        <a class="icon-link icon-link_icon-size_s icon-link_gap_l icon-link_weight_regular icon-link_style_light" href="https://hair.ru">
                            <span class="icon-link__icon-wrapper">
                                <svg class="icon-link__icon" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 6C0 2.68629 2.68629 0 6 0C9.31371 0 12 2.68629 12 6C12 9.31371 9.31371 12 6 12C2.68629 12 0 9.31371 0 6ZM5.625 0.807415C5.12293 0.960959 4.62347 1.42292 4.20956 2.19899C4.10222 2.40026 4.00301 2.61888 3.91328 2.85271C4.44216 2.97068 5.01787 3.04584 5.625 3.06791V0.807415ZM3.18639 2.65458C3.29357 2.36652 3.41451 2.09596 3.54779 1.84605C3.68183 1.59473 3.83147 1.35931 3.99545 1.14626C3.35215 1.41223 2.77324 1.80236 2.28859 2.28678C2.5597 2.42466 2.86057 2.54833 3.18639 2.65458ZM2.63134 5.625C2.65856 4.82249 2.77263 4.05947 2.95862 3.36922C2.53149 3.23026 2.13733 3.06226 1.78535 2.86908C1.2048 3.64929 0.835789 4.59623 0.763184 5.625H2.63134ZM3.68152 3.56913C3.51467 4.18983 3.40872 4.88474 3.38179 5.625H5.625V3.81836C4.94265 3.7952 4.28781 3.70918 3.68152 3.56913ZM6.375 3.81836V5.625H8.6182C8.59127 4.88474 8.48533 4.18983 8.31848 3.56913C7.71219 3.70918 7.05734 3.7952 6.375 3.81836ZM3.38179 6.375C3.40872 7.11525 3.51467 7.81016 3.68152 8.43086C4.28781 8.29081 4.94265 8.20479 5.625 8.18163V6.375H3.38179ZM6.375 6.375V8.18163C7.05734 8.20479 7.71219 8.29081 8.31848 8.43086C8.48533 7.81016 8.59127 7.11525 8.6182 6.375H6.375ZM3.91328 9.14728C4.00301 9.38111 4.10222 9.59973 4.20956 9.801C4.62347 10.5771 5.12293 11.039 5.625 11.1926V8.93208C5.01787 8.95415 4.44216 9.02931 3.91328 9.14728ZM3.99545 10.8537C3.83147 10.6407 3.68183 10.4053 3.54779 10.1539C3.41451 9.90403 3.29357 9.63347 3.18639 9.34541C2.86057 9.45166 2.5597 9.57533 2.28859 9.71321C2.77325 10.1976 3.35216 10.5878 3.99545 10.8537ZM2.95862 8.63078C2.77263 7.94052 2.65856 7.1775 2.63134 6.375H0.763184C0.835789 7.40377 1.2048 8.3507 1.78535 9.13091C2.13733 8.93773 2.53149 8.76973 2.95862 8.63078ZM8.00455 10.8537C8.64784 10.5878 9.22675 10.1976 9.71141 9.71321C9.44029 9.57533 9.13942 9.45166 8.81361 9.34541C8.70642 9.63347 8.58549 9.90403 8.4522 10.1539C8.31816 10.4053 8.16852 10.6407 8.00455 10.8537ZM6.375 8.93208V11.1926C6.87707 11.039 7.37653 10.5771 7.79044 9.801C7.89778 9.59973 7.99698 9.38111 8.08671 9.14728C7.55784 9.02931 6.98212 8.95415 6.375 8.93208ZM9.04137 8.63078C9.4685 8.76973 9.86266 8.93773 10.2146 9.13091C10.7952 8.3507 11.1642 7.40377 11.2368 6.375H9.36866C9.34144 7.1775 9.22736 7.94052 9.04137 8.63078ZM11.2368 5.625C11.1642 4.59623 10.7952 3.64929 10.2146 2.86908C9.86266 3.06226 9.4685 3.23026 9.04137 3.36922C9.22736 4.05947 9.34144 4.82249 9.36866 5.625H11.2368ZM8.4522 1.84605C8.58549 2.09596 8.70642 2.36652 8.81361 2.65458C9.13942 2.54833 9.44029 2.42466 9.71141 2.28678C9.22675 1.80236 8.64784 1.41223 8.00455 1.14626C8.16852 1.35931 8.31816 1.59473 8.4522 1.84605ZM8.08671 2.85271C7.99698 2.61888 7.89778 2.40026 7.79044 2.19899C7.37653 1.42292 6.87707 0.960959 6.375 0.807415V3.06791C6.98212 3.04584 7.55784 2.97068 8.08671 2.85271Z" />
                                </svg>
                            </span>
                            <span class="icon-link__text">Переключить на русский</span>
                        </a>
                        <!-- end .icon-link-->
                    </div>
                    <div class="footer__big-link">
                        <!-- begin .icon-link-->
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "/include/template/footer_email.php",
                                "AREA_FILE_RECURSIVE" => "N",
                                "EDIT_MODE" => "html",
                            ),
                            false,
                        ); ?>
                        <!-- end .icon-link-->
                    </div>
                </div>
                <div class="footer__nav">
                    <div class="footer__nav-trigger">
                        <!-- begin .link-->
                        <button class="link link_style_ninja js-toggle" type="button" data-toggle-scope=".footer" data-toggle-class="footer_nav_open">Menu
                        </button>
                        <!-- end .link-->
                    </div>
                    <div class="footer__nav-wrapper">
                        <!-- begin .nav-->
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "bottom",
                            array(
                                "ROOT_MENU_TYPE" => "bottom_sections",
                                "MAX_LEVEL" => "1",
                                "CHILD_MENU_TYPE" => "left",
                                "USE_EXT" => "N",
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "Y",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => ""
                            )
                        ); ?>
                        <!-- end .nav-->
                    </div>
                </div>
                <div class="footer__contacts">
                    <div class="footer__title">Contact us
                    </div>
                    <div class="footer__links">
                        <div class="footer__link">
                            <!-- begin .icon-link-->
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "/include/template/footer_email_small.php",
                                    "AREA_FILE_RECURSIVE" => "N",
                                    "EDIT_MODE" => "html",
                                ),
                                false,
                            ); ?>
                            <!-- end .icon-link-->
                        </div>
                    </div>
                    <div class="footer__social-nav">
                        <!-- begin .social-nav-->
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "/include/template/footer_social.php",
                                "AREA_FILE_RECURSIVE" => "N",
                                "EDIT_MODE" => "html",
                            ),
                            false,
                        ); ?>
                        <!-- end .social-nav-->
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="footer__container page__container">
                <div class="footer__credit">
                    <!-- begin .dev-credit-->
                    <a class="dev-credit footer__dev-credit" href="https://web-aim.ru" target="_blank"><span class="dev-credit__illustration">
                            <picture class="dev-credit__picture"><img src="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/blocks/dev-credit/images/web-aim.png" alt="image" class="dev-credit__image" title="" />
                            </picture>
                        </span>
                    </a>
                    <!-- end .dev-credit-->
                </div>
                <div class="footer__logo">
                    <!-- begin .logo-->
                    <? if (!$isHomePage) { ?>
                        <a class="logo footer__logo-wrapper" href="<?= SITE_DIR ?>">
                        <? } ?>
                        <svg class="logo__figure" width="256" height="74" viewBox="0 0 256 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M124.8 45.6C117.4 45.6 113.1 41.7 113.1 34.8C113.1 27.9 117.4 24 124.8 24C130.7 24 134.5 26.4 135.9 30.8L140.9 30.5C139.3 23.7 133.6 19.9 124.8 19.9C114.3 19.9 108.2 25.3 108.2 34.8C108.2 44.2 114.3 49.7 124.8 49.7C133.8 49.7 139.5 45.7 141 38.7L136.1 38.4C134.8 43 130.8 45.6 124.8 45.6Z" fill="white" />
                            <path d="M197.8 19.9C192.6 19.9 188.6 21.5 186 24.5V20.4H181.4V59.3H186V45.1C188.5 48 192.5 49.6 197.8 49.6C208.3 49.6 213.9 44.2 213.9 34.7C213.8 25.3 208.3 19.9 197.8 19.9ZM197.3 45.6C189.9 45.6 185.6 41.7 185.6 34.8C185.6 27.9 189.9 24 197.3 24C204.7 24 209 27.9 209 34.8C209 41.6 204.7 45.6 197.3 45.6Z" fill="white" />
                            <path d="M89.3 19.9C84.1 19.9 80 21.8 77.3 24.9V20.4H72.7V49.2H77.3V40V38.5C77.3 37.6 77.3 36.5 77.3 35.7C77.3 29.4 82.3 24.3 89.3 24.3C96.3 24.3 100.1 28.5 100.1 34.8C100.1 36.4 100.1 49.3 100.1 49.3H105C105 49.3 105 36.4 105 34.8C104.9 25.9 99.2 19.9 89.3 19.9Z" fill="white" />
                            <path d="M175.8 41.8L170.5 41.4C168.6 44.1 165.2 45.6 160.6 45.6C153.8 45.6 149.7 42.3 149 36.6H174.5H177.1C177.2 36 177.2 35.4 177.2 34.8C177.2 25.4 171.1 19.9 160.6 19.9C150.1 19.9 144 25.3 144 34.8C144 44.2 150.1 49.7 160.6 49.7C168.1 49.6 173.4 46.8 175.8 41.8ZM160.6 23.9C167.1 23.9 171.2 27 172.1 32.4H149C149.9 27 154 23.9 160.6 23.9Z" fill="white" />
                            <path d="M160.6 14.9C162.8 14.9 164.2 13.6 164.2 11.7C164.2 9.8 162.7 8.5 160.6 8.5C158.5 8.5 157 9.8 157 11.7C157 13.6 158.4 14.9 160.6 14.9Z" fill="white" />
                            <path d="M52.4 19.9C41.9 19.9 35.8 25.3 35.8 34.8C35.8 44.2 41.9 49.7 52.4 49.7C62.9 49.7 69 44.3 69 34.8C69 25.3 62.9 19.9 52.4 19.9ZM52.4 45.6C45 45.6 40.7 41.7 40.7 34.8C40.7 27.9 45 24 52.4 24C59.8 24 64.1 27.9 64.1 34.8C64.1 41.6 59.8 45.6 52.4 45.6Z" fill="white" />
                            <path d="M239.9 24.8V20.6H222.3C222.3 14.3 222.3 9.70001 222.3 9.70001H217.7C217.7 9.70001 217.7 31.7 217.7 34.7C217.7 44.1 223.8 49.6 234.3 49.6C236.3 49.6 238.2 49.4 239.9 49V44.6C238.3 45.2 236.4 45.6 234.3 45.6C226.9 45.6 222.3 41.7 222.3 34.8C222.3 33.7 222.3 29.5 222.3 24.8H239.9Z" fill="white" />
                            <path d="M32.8 38.6L27.9 38.3C26.6 42.9 22.7 45.5 16.6 45.5C9.2 45.5 4.9 41.6 4.9 34.7C4.9 27.8 9.2 23.9 16.6 23.9C22.5 23.9 26.3 26.3 27.7 30.7L32.7 30.4C31.1 23.6 25.4 19.8 16.6 19.8C6.1 19.9 0 25.3 0 34.8C0 44.2 6.1 49.7 16.6 49.7C25.6 49.6 31.3 45.7 32.8 38.6Z" fill="white" />
                            <path d="M64.2 65.5C61.1 65.5 59.4 67 59.4 69.6C59.4 72.2 61.2 73.7 64.2 73.7C67.3 73.7 69 72.2 69 69.6C69 67 67.2 65.5 64.2 65.5ZM64.2 71.8C62.6 71.8 61.7 71 61.7 69.6C61.7 68.2 62.6 67.4 64.2 67.4C65.8 67.4 66.7 68.2 66.7 69.6C66.7 71 65.8 71.8 64.2 71.8Z" fill="white" />
                            <path d="M159.2 65.5C156.1 65.5 154.4 67 154.4 69.6C154.4 72.2 156.2 73.7 159.2 73.7C162.3 73.7 164 72.2 164 69.6C164 67 162.2 65.5 159.2 65.5ZM159.2 71.8C157.6 71.8 156.7 71 156.7 69.6C156.7 68.2 157.6 67.4 159.2 67.4C160.8 67.4 161.7 68.2 161.7 69.6C161.7 71 160.8 71.8 159.2 71.8Z" fill="white" />
                            <path d="M178.4 71.3L174.2 65.7H173.1H171.5H170.9V73.5H173.1V67.8L177.3 73.5H178.4H180H180.6V65.7H178.4V71.3Z" fill="white" />
                            <path d="M146.4 65.7H144.2V73.5H146.4V65.7Z" fill="white" />
                            <path d="M78 65.7H77.1V73.5H79.3V71H83.9V69.3H79.3V67.5H84.7V65.7H79.3H78Z" fill="white" />
                            <path d="M96.5 70.4H101.8V68.7H96.5V67.5H102.4V65.7H96.5H95.2H94.3V73.5H95.2H96.5H102.6V71.6H96.5V70.4Z" fill="white" />
                            <path d="M206 65.7H203.8V71.6V73.5H206H211.2V71.6H206V65.7Z" fill="white" />
                            <path d="M34.3 65.7H29.6H28.7V73.5H30.9V71H34.3C36 71 37 70.1 37 68.3C37 66.6 36 65.7 34.3 65.7ZM33.8 69.3H30.9V67.6H33.8C34.3 67.6 34.7 68 34.7 68.5C34.7 68.9 34.3 69.3 33.8 69.3Z" fill="white" />
                            <path d="M52.4 68.3C52.4 66.6 51.5 65.6 49.7 65.6H45H44.1V73.4H46.3V71H47.7L49.7 73.5H52.5L50.2 71C51.6 70.8 52.4 69.9 52.4 68.3ZM46.3 67.5H49.2C49.7 67.5 50.1 67.9 50.1 68.4C50.1 68.9 49.7 69.3 49.2 69.3H46.3V67.5Z" fill="white" />
                            <path d="M192.7 65.7H191.4H190.5L186.9 73.5H189.1L189.8 71.9H194.2L194.9 73.5H197.1L193.6 65.7H192.7ZM190.7 70.1L192.1 67L193.5 70.1H190.7Z" fill="white" />
                            <path d="M117.1 68.7L114.2 68.5C113.7 68.5 113.5 68.3 113.5 68C113.5 67.5 114.6 67.3 115.5 67.3C116.5 67.3 117.3 67.5 117.4 67.8L119.6 67.7C119.5 66.6 118.6 65.4 115.5 65.4C113.4 65.4 111.2 66 111.2 68C111.2 69.3 112.3 70 113.9 70.2L116.8 70.4C117.4 70.5 117.7 70.6 117.7 71C117.7 71.5 116.9 71.7 115.7 71.7C114.5 71.7 113.6 71.4 113.5 70.8L111.1 70.9C111.3 72.3 112.3 73.5 115.7 73.5C118.3 73.5 120 72.7 120 70.9C119.9 69.6 118.9 68.9 117.1 68.7Z" fill="white" />
                            <path d="M133.5 68.7L130.6 68.5C130.1 68.5 129.9 68.3 129.9 68C129.9 67.5 131 67.3 131.9 67.3C132.9 67.3 133.7 67.5 133.8 67.8L136 67.7C135.9 66.6 135 65.4 131.9 65.4C129.8 65.4 127.6 66 127.6 68C127.6 69.3 128.7 70 130.3 70.2L133.2 70.4C133.8 70.5 134.1 70.6 134.1 71C134.1 71.5 133.3 71.7 132.1 71.7C130.9 71.7 130 71.4 129.9 70.8L127.5 70.9C127.7 72.3 128.7 73.5 132.1 73.5C134.7 73.5 136.4 72.7 136.4 70.9C136.4 69.6 135.3 68.9 133.5 68.7Z" fill="white" />
                            <path d="M246.8 2.5H249.7C250.4 2.5 250.9 2.7 251.3 3C251.7 3.3 251.9 3.8 251.9 4.4C251.9 5.2 251.6 5.8 250.9 6.1L251.9 9.1H251L250 6.3C249.8 6.3 249.7 6.3 249.5 6.3H247.6V9H246.8V2.5ZM247.7 5.6H249.6C250.6 5.6 251 5.2 251 4.4C251 4 250.9 3.7 250.7 3.5C250.5 3.3 250.1 3.2 249.6 3.2H247.7V5.6Z" fill="white" />
                            <path d="M249.4 11.5C246.2 11.5 243.7 8.89998 243.7 5.79998C243.7 2.69998 246.3 0.0999756 249.4 0.0999756C252.6 0.0999756 255.1 2.69998 255.1 5.79998C255.1 8.89998 252.5 11.5 249.4 11.5ZM249.4 0.799976C246.7 0.799976 244.4 2.99998 244.4 5.79998C244.4 8.59998 246.6 10.8 249.4 10.8C252.1 10.8 254.4 8.59998 254.4 5.79998C254.4 2.99998 252.1 0.799976 249.4 0.799976Z" fill="white" />
                        </svg>
                        <? if (!$isHomePage) { ?>
                        </a>
                    <? } ?>
                    <!-- end .logo-->
                </div>
                <div class="footer__copyright">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "/include/template/footer_copyright.php",
                            "AREA_FILE_RECURSIVE" => "N",
                            "EDIT_MODE" => "html",
                        ),
                        false,
                    ); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- end .footer-->
</div>
<div class="page__slide-menu js-header-offset" data-offset-property="top">
    <!-- begin .slide-menu-->
    <div class="slide-menu">
        <div class="slide-menu__lang-link">
            <!-- begin .icon-link-->
            <a class="icon-link icon-link_style_light" href="https://hair.ru"><span class="icon-link__icon-wrapper"><svg class="icon-link__icon" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 6C0 2.68629 2.68629 0 6 0C9.31371 0 12 2.68629 12 6C12 9.31371 9.31371 12 6 12C2.68629 12 0 9.31371 0 6ZM5.625 0.807415C5.12293 0.960959 4.62347 1.42292 4.20956 2.19899C4.10222 2.40026 4.00301 2.61888 3.91328 2.85271C4.44216 2.97068 5.01787 3.04584 5.625 3.06791V0.807415ZM3.18639 2.65458C3.29357 2.36652 3.41451 2.09596 3.54779 1.84605C3.68183 1.59473 3.83147 1.35931 3.99545 1.14626C3.35215 1.41223 2.77324 1.80236 2.28859 2.28678C2.5597 2.42466 2.86057 2.54833 3.18639 2.65458ZM2.63134 5.625C2.65856 4.82249 2.77263 4.05947 2.95862 3.36922C2.53149 3.23026 2.13733 3.06226 1.78535 2.86908C1.2048 3.64929 0.835789 4.59623 0.763184 5.625H2.63134ZM3.68152 3.56913C3.51467 4.18983 3.40872 4.88474 3.38179 5.625H5.625V3.81836C4.94265 3.7952 4.28781 3.70918 3.68152 3.56913ZM6.375 3.81836V5.625H8.6182C8.59127 4.88474 8.48533 4.18983 8.31848 3.56913C7.71219 3.70918 7.05734 3.7952 6.375 3.81836ZM3.38179 6.375C3.40872 7.11525 3.51467 7.81016 3.68152 8.43086C4.28781 8.29081 4.94265 8.20479 5.625 8.18163V6.375H3.38179ZM6.375 6.375V8.18163C7.05734 8.20479 7.71219 8.29081 8.31848 8.43086C8.48533 7.81016 8.59127 7.11525 8.6182 6.375H6.375ZM3.91328 9.14728C4.00301 9.38111 4.10222 9.59973 4.20956 9.801C4.62347 10.5771 5.12293 11.039 5.625 11.1926V8.93208C5.01787 8.95415 4.44216 9.02931 3.91328 9.14728ZM3.99545 10.8537C3.83147 10.6407 3.68183 10.4053 3.54779 10.1539C3.41451 9.90403 3.29357 9.63347 3.18639 9.34541C2.86057 9.45166 2.5597 9.57533 2.28859 9.71321C2.77325 10.1976 3.35216 10.5878 3.99545 10.8537ZM2.95862 8.63078C2.77263 7.94052 2.65856 7.1775 2.63134 6.375H0.763184C0.835789 7.40377 1.2048 8.3507 1.78535 9.13091C2.13733 8.93773 2.53149 8.76973 2.95862 8.63078ZM8.00455 10.8537C8.64784 10.5878 9.22675 10.1976 9.71141 9.71321C9.44029 9.57533 9.13942 9.45166 8.81361 9.34541C8.70642 9.63347 8.58549 9.90403 8.4522 10.1539C8.31816 10.4053 8.16852 10.6407 8.00455 10.8537ZM6.375 8.93208V11.1926C6.87707 11.039 7.37653 10.5771 7.79044 9.801C7.89778 9.59973 7.99698 9.38111 8.08671 9.14728C7.55784 9.02931 6.98212 8.95415 6.375 8.93208ZM9.04137 8.63078C9.4685 8.76973 9.86266 8.93773 10.2146 9.13091C10.7952 8.3507 11.1642 7.40377 11.2368 6.375H9.36866C9.34144 7.1775 9.22736 7.94052 9.04137 8.63078ZM11.2368 5.625C11.1642 4.59623 10.7952 3.64929 10.2146 2.86908C9.86266 3.06226 9.4685 3.23026 9.04137 3.36922C9.22736 4.05947 9.34144 4.82249 9.36866 5.625H11.2368ZM8.4522 1.84605C8.58549 2.09596 8.70642 2.36652 8.81361 2.65458C9.13942 2.54833 9.44029 2.42466 9.71141 2.28678C9.22675 1.80236 8.64784 1.41223 8.00455 1.14626C8.16852 1.35931 8.31816 1.59473 8.4522 1.84605ZM8.08671 2.85271C7.99698 2.61888 7.89778 2.40026 7.79044 2.19899C7.37653 1.42292 6.87707 0.960959 6.375 0.807415V3.06791C6.98212 3.04584 7.55784 2.97068 8.08671 2.85271Z" />
                    </svg></span><span class="icon-link__text">Переключить на русский</span>
            </a>
            <!-- end .icon-link-->
        </div>
        <div class="slide-menu__nav">
            <!-- begin .nav-->
            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "top_ib_mob",
                array(
                    "ROOT_MENU_TYPE" => "top_catalog_mob",
                    "MAX_LEVEL" => "1",
                    "CHILD_MENU_TYPE" => "left_catalog",
                    "USE_EXT" => "Y",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "Y",
                    "MENU_CACHE_TYPE" => "A",
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "MENU_CACHE_GET_VARS" => ""
                )
            ); ?>
            <!-- end .nav-->
        </div>
        <div class="slide-menu__referrer">
            <a class="slide-menu__referrer-link" href="/infinity/">Infinity</a>
        </div>
        <div class="slide-menu__nav">
            <!-- begin .nav-->
            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "top_mob",
                array(
                    "ROOT_MENU_TYPE" => "top_sections_mob",
                    "MAX_LEVEL" => "2",
                    "CHILD_MENU_TYPE" => "left",
                    "USE_EXT" => "Y",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "Y",
                    "MENU_CACHE_TYPE" => "A",
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "MENU_CACHE_GET_VARS" => ""
                )
            ); ?>
            <!-- end .nav-->
        </div>
        <div class="slide-menu__contacts">
            <div class="slide-menu__links">
                <div class="slide-menu__link">
                    <!-- begin .icon-link-->
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "/include/template/header_email_mob.php",
                            "AREA_FILE_RECURSIVE" => "N",
                            "EDIT_MODE" => "html",
                        ),
                        false,
                    ); ?>
                    <!-- end .icon-link-->
                </div>
            </div>
            <div class="slide-menu__social-nav">
                <!-- begin .social-nav-->
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "/include/template/header_social_mob.php",
                        "AREA_FILE_RECURSIVE" => "N",
                        "EDIT_MODE" => "html",
                    ),
                    false,
                ); ?>
                <!-- end .social-nav-->
            </div>
        </div>
    </div>
    <!-- end .slide-menu-->
</div>

<div class="page__modals">
    <!-- begin .modal-->
    <? $APPLICATION->IncludeComponent(
        "bitrix:form.result.new",
        "ask_modal",
        array(
            "SEF_MODE" => "N",
            "WEB_FORM_ID" => 1,
            "LIST_URL" => "",
            "EDIT_URL" => "",
            "SUCCESS_URL" => "",
            "CHAIN_ITEM_TEXT" => "",
            "CHAIN_ITEM_LINK" => "",
            "IGNORE_CUSTOM_TEMPLATE" => "Y",
            "USE_EXTENDED_ERRORS" => "Y",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "3600",
            "SEF_FOLDER" => "/",
            "VARIABLE_ALIASES" => array(),
        )
    ); ?>
    <!-- end .modal-->
</div>

<?
// Скрипты и стили для Recaptcha -->
$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    array(
        "AREA_FILE_SHOW" => "file",
        "PATH" => "/local/include/captcha_js_css.php",
        "AREA_FILE_RECURSIVE" => "N",
        "EDIT_MODE" => "html",
    ),
    false,
    array('HIDE_ICONS' => 'Y')
);
// <-- Скрипты и стили для Recaptcha
?>

</body>

</html>