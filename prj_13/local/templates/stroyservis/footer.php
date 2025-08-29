<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?
global $isHomePage;
if ($isHomePage != true) {
    $PAGE_TYPE = 1;
    if (defined('PAGE_TYPE')) {
        $PAGE_TYPE = PAGE_TYPE;
    }
    if ($PAGE_TYPE == 2 || $PAGE_TYPE == 3 || $PAGE_TYPE == 6) { ?>
        </section><?
                } else if (PAGE_TYPE == 4) {
                    // Карточка товара
                }
            }
                    ?>
<div class="header-catalog__overlay"></div>
</main>
<footer class="footer">
    <div class="container">
        <div class="footer-top mb-20">
            <div class="footer-top__logo">
                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/img/design/logo.png" alt="Стройсервис">
            </div>
            <div class="footer-top__image">
                <img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/img/design/object-logo.svg" alt="">
            </div>
        </div>
    </div>
    <div class="footer-main">
        <div class="container">
            <div class="footer-main__wrapper">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "footer",
                    array(
                        "ROOT_MENU_TYPE" => "footer1",
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "left",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_TIME" => "86400",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => "",
                        "MENU_TITLE" => "О компании"
                    )
                );
                ?>
            </div>
            <?/* <div class="footer-main__wrapper footer-main__catalog">
               
                $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "footer",
                    array(
                        "ROOT_MENU_TYPE" => "footer2",
                        "MAX_LEVEL" => "2",
                        "CHILD_MENU_TYPE" => "left",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_TIME" => "86400",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => "",
                        "MENU_TITLE" => "Каталог"
                    )
                );
                
            </div> */?>
            <div class="footer-main__wrapper footer-main__content">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "footer",
                    array(
                        "ROOT_MENU_TYPE" => "footer3",
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "left",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_TIME" => "86400",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => "",
                        "MENU_CLASS" => "footer-main__content-list"
                    )
                );
                ?>
            </div>
            <div class="footer-main__wrapper d-none d-md-block"></div>
            <div class="footer-main__contacts">
                <div class="footer-main__phones">
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "bottom_phone",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/common/phone.php",
                        )
                    );
                    ?>
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "bottom_email",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/common/email.php",
                        )
                    );
                    ?>
                </div>
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "bottom_work_hours",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/common/work_hours.php",
                    )
                );
                ?>
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "bottom_address",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/common/address.php",
                    )
                );
                ?>
                <div class="footer-main__social">
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "bottom_social",
                        array(
                            "ROOT_MENU_TYPE" => "bottom_social",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "bottom_social",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_TIME" => "86400",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => ""
                        )
                    );
                    ?>
                </div>
            </div>
            <div class="footer-main__wrapper footer-seo-catalog-menu">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "footer",
                    array(
                        "ROOT_MENU_TYPE" => "footer_seo_catalog",
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "footer_seo_catalog",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_TIME" => "86400",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => "",
                        "MENU_TITLE" => "Популярные разделы"
                    )
                );
                ?>
            </div>
            <div class="footer-main__markets">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "marketplace_footer",
                    array(
                        "ROOT_MENU_TYPE" => "marketplace",
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "marketplace",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_TIME" => "86400",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => ""
                    )
                );
                ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="footer-bottom">
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR . "include/common/copyright.php",
                )
            );
            ?>
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR . "include/common/footer_links.php",
                )
            );
            ?>
            <a href="https://indexis.ru" target="_blank">Сделано в INDEXIS</a>
        </div>
    </div>
</footer>
<div class="overlay"></div>
</div>

<?
$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    array(
        "AREA_FILE_SHOW" => "file",
        "PATH" => "/include/static/bonus_popup.php"
    )
); ?>

<?
// Контейнеры для AJAX -->
?>
<div id="js_popup_order_basket"></div>
<div id="js_popup_quick_order"></div>
<?
// <-- Контейнеры для AJAX
?>
<?
// Hidden'ы -->
?>
<input type="hidden" value="Y" id="js_add2basket_double" />
<input type="hidden" value="<?= $GLOBALS['arSiteConfig']['AJAX']["BASKET_URL"]; ?>" id="jsBasketAjaxUrl" />
<input type="hidden" value="<?= $GLOBALS['arSiteConfig']['AJAX']["ORDER_URL"]; ?>" id="jsOrderAjaxUrl" />
<?
// <--
?>
<?
// Попап картинок -->
?>
<div class="popup popup-certificate">
    <div class="popup-certificate__image">
        <img loading="lazy" src="" alt="Изображение" title="Изображение" />
    </div>
    <button class="popup-form__popup_close"></button>
</div>
<?
// <-- Попап картинок
?>
<? if (!$USER->IsAuthorized()) : ?>
    <div class="popup popup-authorization">
        <div class="popup-authorization__wrapper">
            <div class="popup-authorization__logo"><img src="<?= SITE_TEMPLATE_PATH ?>/img/design/logo.png" alt="Стройсервис"></div>
            <div class="popup-authorization__login">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:system.auth.authorize",
                    "",
                    array(
                        "REGISTER_URL" => "",
                        "PROFILE_URL" => "",
                        "SHOW_ERRORS" => "Y",
                        "AUTH_RESULT" => $APPLICATION->arAuthResult
                    ),
                    false
                ); ?>
            </div>
        </div>
        <button class="popup-form__popup_close"></button>
    </div>
    <div class="popup popup-registration">
        <div class="popup-authorization__wrapper">
            <div class="popup-authorization__logo"><img loading="lazy" src="<?= SITE_TEMPLATE_PATH ?>/img/design/logo.png" alt="Стройсервис"></div>
            <div class="popup-authorization__login">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.register",
                    "",
                    array(
                        "USER_PROPERTY_NAME" => "",
                        "SEF_MODE" => "Y",
                        "SHOW_FIELDS" => array("NAME", "LAST_NAME"),
                        "REQUIRED_FIELDS" => array("NAME", "LAST_NAME"),
                        "AUTH" => "Y",
                        "USE_BACKURL" => "Y",
                        "SUCCESS_PAGE" => "",
                        "SET_TITLE" => "N",
                        "USER_PROPERTY" => array(),
                        "SEF_FOLDER" => SITE_DIR,
                        "VARIABLE_ALIASES" => array()
                    )
                );
                ?>
            </div>
        </div>
        <button class="popup-form__popup_close"></button>
    </div>
<? endif; ?>

<? if ($GLOBALS['SHOW_FORM_PRODUCT_ON_ORDER'] == 'Y' || 1) { ?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:form.result.new",
        "product_on_order",
        array(
            "SEF_MODE" => "N",
            "WEB_FORM_ID" => $GLOBALS["arSiteConfig"]["WEB_FORM_ID_PRODUCT_ON_ORDER"],
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
            'PRODUCT_NAME' => array(
                'VALUE' => 'NAME',
                'AUTOCOMPLETE' => 'Y'
            ),
            "AJAX_MODE" => "N",
        )
    ); ?>
<? } ?>

<? if ($GLOBALS['SHOW_FORM_REQUEST_WHOLESALE_PRICE'] == 'Y' || 1) { ?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:form.result.new",
        "request_wholesale_price",
        array(
            "SEF_MODE" => "N",
            "WEB_FORM_ID" => $GLOBALS["arSiteConfig"]["WEB_FORM_ID_REQUEST_WHOLESALE_PRICE"],
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
            'PRODUCT_NAME' => array(
                'VALUE' => 'NAME',
                'AUTOCOMPLETE' => 'Y'
            ),
            "AJAX_MODE" => "N",
        )
    ); ?>
<? } ?>

<? if ($GLOBALS['SHOW_FORM_CHOOSE_ANALOGUE'] == 'Y' || 1) { ?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:form.result.new",
        "choose_analogue",
        array(
            "SEF_MODE" => "N",
            "WEB_FORM_ID" => $GLOBALS["arSiteConfig"]["WEB_FORM_ID_CHOOSE_ANALOGUE"],
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
            'PRODUCT_NAME' => array(
                'VALUE' => 'NAME',
                'AUTOCOMPLETE' => 'Y'
            ),
            "AJAX_MODE" => "N",
        )
    ); ?>
<? } ?>

    <script>
        var event_status1 = false;
        $(window).on("load", function() {
            $(window).one("mouseover click scroll", function() {
                if(!event_status1) {
                    <!-- Roistat Counter Start -->
                    (function(w, d, s, h, id) {
                        w.roistatProjectId = id; w.roistatHost = h;
                        var p = d.location.protocol == "https:" ? "https://" : "http://";
                        var u = /^.*roistat_visit=[^;]+(.*)?$/.test(d.cookie) ? "/dist/module.js" : "/api/site/1.0/"+id+"/init?referrer="+encodeURIComponent(d.location.href);
                        var js = d.createElement(s); js.charset="UTF-8"; js.async = 1; js.src = p+h+u; var js2 = d.getElementsByTagName(s)[0]; js2.parentNode.insertBefore(js, js2);
                    })(window, document, 'script', 'cloud.roistat.com', 'ad2e0f387fe8f1ded1dad35e0479cc72');
                    <!-- Roistat Counter End -->
                    event_status1 = true;
                }
            });
        });
    </script>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(16721107, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true,
            trackHash:true
        });
    </script>
    <noscript><div><img loading="lazy" src="https://mc.yandex.ru/watch/16721107" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

    <link rel="stylesheet" href="<?=(SITE_TEMPLATE_PATH . "/libs/fancybox/fancybox.css")?>" media="none" onload="if(media!='all')media='all'">
    <link rel="stylesheet" href="<?=(SITE_TEMPLATE_PATH . "/libs/selectric/public/selectric_custom.css")?>" media="none" onload="if(media!='all')media='all'">

</body>

</html>
<?$APPLICATION->SetPageProperty('keywords','');?>