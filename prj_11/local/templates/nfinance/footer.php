<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
</div>
<div class="page__scroll-top page__scroll-top_state_hidden js-scroller-container">
    <!-- begin .scroller-->
    <a class="scroller js-go-to" href="#body">
        <svg class="scroller__icon" width="14" height="10" viewBox="0 0 14 10" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M13 9L7 1L1 9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </a>
    <!-- end .scroller-->
</div>
<div class="page__footer">
    <!-- begin .footer-->
    <div class="footer">
        <div class="footer__holder page__holder">
            <div class="footer__top">
                <div class="footer__logo">
                    <!-- begin .logo--><a class="logo" href="/"><img class="logo__image" src="<?=SITE_TEMPLATE_PATH?>/assets/blocks/logo/images/light.svg" alt="SITE NAME" title=""/></a>
                    <!-- end .logo-->
                </div>
                <!-- begin .button-->
                <button class="button js-modal" href="#modalCounseling"><span class="button__holder"><span class="button__text">Записаться на консультацию</span></span>
                </button>
                <!-- end .button-->
            </div>
            <div class="footer__main">
                <div class="footer__col">
                    <div class="footer__title">
                        <!-- begin .title-->
                        <div class="title title_size_h5">Навигация
                        </div>
                        <!-- end .title-->
                    </div>
                    <div class="footer__info-col">
                        <div class="footer__sub-col">
                            <div class="footer__sub-group">
                                <div class="footer__nav">
                                    <!-- begin .nav-->
                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:menu",
                                        "footer",
                                        array(
                                            "ROOT_MENU_TYPE" => "footer_first",
                                            "MENU_CACHE_TYPE" => "Y",
                                            "MENU_CACHE_TIME" => "3600",
                                            "MENU_CACHE_USE_GROUPS" => "Y",
                                            "MENU_CACHE_GET_VARS" => array(
                                            ),
                                            "MAX_LEVEL" => "1",
                                            "USE_EXT" => "N",
                                            "ALLOW_MULTI_SELECT" => "N",
                                            "COMPOSITE_FRAME_MODE" => "A",
                                            "COMPOSITE_FRAME_TYPE" => "AUTO"
                                        ),
                                        false
                                    );?>
                                    <!-- end .nav-->
                                </div>
                            </div>
                            <div class="footer__sub-group">
                                <div class="footer__nav">
                                    <!-- begin .nav-->
                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:menu",
                                        "footer",
                                        array(
                                            "ROOT_MENU_TYPE" => "footer_third",
                                            "MENU_CACHE_TYPE" => "Y",
                                            "MENU_CACHE_TIME" => "3600",
                                            "MENU_CACHE_USE_GROUPS" => "Y",
                                            "MENU_CACHE_GET_VARS" => array(
                                            ),
                                            "MAX_LEVEL" => "1",
                                            "USE_EXT" => "N",
                                            "ALLOW_MULTI_SELECT" => "N",
                                            "COMPOSITE_FRAME_MODE" => "A",
                                            "COMPOSITE_FRAME_TYPE" => "AUTO"
                                        ),
                                        false
                                    );?>
                                    <!-- end .nav-->
                                </div>
                            </div>
                        </div>
                        <div class="footer__sub-col">
                            <div class="footer__sub-group">
                                <div class="footer__nav">
                                    <!-- begin .nav-->
                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:menu",
                                        "footer",
                                        array(
                                            "ROOT_MENU_TYPE" => "footer_second",
                                            "MENU_CACHE_TYPE" => "Y",
                                            "MENU_CACHE_TIME" => "3600",
                                            "MENU_CACHE_USE_GROUPS" => "Y",
                                            "MENU_CACHE_GET_VARS" => array(
                                            ),
                                            "MAX_LEVEL" => "1",
                                            "USE_EXT" => "N",
                                            "ALLOW_MULTI_SELECT" => "N",
                                            "COMPOSITE_FRAME_MODE" => "A",
                                            "COMPOSITE_FRAME_TYPE" => "AUTO"
                                        ),
                                        false
                                    );?>
                                    <!-- end .nav-->
                                </div>
                            </div>
                            <div class="footer__sub-group">
                                <div class="footer__nav">
                                    <!-- begin .nav-->
                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:menu",
                                        "footer",
                                        array(
                                            "ROOT_MENU_TYPE" => "footer_fourth",
                                            "MENU_CACHE_TYPE" => "Y",
                                            "MENU_CACHE_TIME" => "3600",
                                            "MENU_CACHE_USE_GROUPS" => "Y",
                                            "MENU_CACHE_GET_VARS" => array(
                                            ),
                                            "MAX_LEVEL" => "1",
                                            "USE_EXT" => "N",
                                            "ALLOW_MULTI_SELECT" => "N",
                                            "COMPOSITE_FRAME_MODE" => "A",
                                            "COMPOSITE_FRAME_TYPE" => "AUTO"
                                        ),
                                        false
                                    );?>
                                    <!-- end .nav-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer__col footer__col_width_auto">
                    <div class="footer__title">
                        <!-- begin .title-->
                        <div class="title title_size_h5">Контакты
                        </div>
                        <!-- end .title-->
                    </div>
                    <div class="footer__contacts">
                        <div class="footer__sub-col">
                            <!-- begin .link-group-->
                            <div class="link-group">
                                <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/footer/contacts.php",
                                    Array(),
                                    Array("MODE" => "html", "NAME" => "FOOTER_CONTACTS")
                                );?>
                            </div>
                            <!-- end .link-group-->
                        </div>
                        <div class="footer__sub-col">
                            <!-- begin .link-group-->
                            <div class="link-group">
                                <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/footer/channels.php",
                                    Array(),
                                    Array("MODE" => "html", "NAME" => "FOOTER_CHANNELS")
                                );?>
                            </div>
                            <!-- end .link-group-->
                        </div>
                        <div class="footer__sub-col">
                            <div class="footer__social-nav">
                                <!-- begin .social-nav-->
                                <div class="social-nav social-nav_size_m">
                                    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/footer/social.php",
                                        Array(),
                                        Array("MODE" => "html", "NAME" => "FOOTER_SOCIAL")
                                    );?>
                                </div>
                                <!-- end .social-nav-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__extra">
                <div class="footer__copyright">© <?=date("Y")?> ООО «Нескучные финансы»  Все права защищены
                </div>
                <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/footer/links.php",
                    Array(),
                    Array("MODE" => "html", "NAME" => "FOOTER_LINKS")
                );?>
            </div>
        </div>
    </div>
    <!-- end .footer-->
    <div class="page__slide-nav">
        <!-- begin .menu-->
        <div class="menu">
            <button class="menu__close js-toggle" type="button" data-toggle-scope=".page__body" data-toggle-class="page__body_nav_open">
                | Закрыть меню
            </button>
            <div class="menu__logo">
                <!-- begin .logo--><a class="logo logo_size_s" href="/"><img class="logo__image" src="<?=SITE_TEMPLATE_PATH?>/assets/blocks/logo/images/main.svg" alt="SITE NAME" title=""/></a>
                <!-- end .logo-->
            </div>
            <div class="menu__nav">
                <!-- begin .menu-list-->
                <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "slide",
                    array(
                        "ROOT_MENU_TYPE" => "slide",
                        "MENU_CACHE_TYPE" => "Y",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => array(
                        ),
                        "MAX_LEVEL" => "1",
                        "USE_EXT" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                        "COMPOSITE_FRAME_MODE" => "A",
                        "COMPOSITE_FRAME_TYPE" => "AUTO"
                    ),
                    false
                );?>
                <!-- end .menu-list-->
            </div>
            <div class="menu__counseling">
                <div class="menu__text">Оставьте заявку, чтобы получить <br> консультацию по нашим услугам
                </div>
                <div class="menu__controls">
                    <div class="menu__controls">
                        <!-- begin .button-->
                        <button class="button button_width_full button_size_xs js-modal" href="#modalCounseling">
                            <span class="button__holder">
                                <span class="button__text">
                                    Консультация
                                </span>
                            </span>
                        </button>
                        <!-- end .button-->
                    </div>
                </div>
            </div>
            <div class="menu__social-nav">
                <!-- begin .social-nav-->
                <div class="social-nav social-nav_style_secondary">
                    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/footer/social.php",
                        Array(),
                        Array("MODE" => "html", "NAME" => "FOOTER_SOCIAL")
                    );?>
                </div>
                <!-- end .social-nav-->
            </div>
            <div class="menu__contact-group">
                <!-- begin .link-group-->
                <div class="link-group link-group_position_menu">
                    <ul class="link-group__list">
                        <li class="link-group__item">
                            <div class="link-group__wrapper">
                                <div class="link-group__sub">
                                    <!-- begin .link-item-->
                                    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/footer/phone.php",
                                        Array(),
                                        Array("MODE" => "html", "NAME" => "FOOTER_PHONE")
                                    );?>
                                    <!-- end .link-item-->
                                </div>
                            </div>
                        </li>
                        <li class="link-group__item">
                            <div class="link-group__wrapper">
                                <!-- begin .link-item-->
                                <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/footer/email.php",
                                    Array(),
                                    Array("MODE" => "html", "NAME" => "FOOTER_EMAIL")
                                );?>
                                <!-- end .link-item-->
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- end .link-group-->
            </div>
            <div class="menu__extra">
                <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/footer/legal_links.php",
                    Array(),
                    Array("MODE" => "html", "NAME" => "FOOTER_LEGAL_LINKS")
                );?>
                <div class="menu__copyright">© 2024 ООО «Нескучные финансы» <br>  Все права защищены
                </div>
            </div>
        </div>
        <!-- end .menu-->
    </div>
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/form/modals.php",
        Array(),
        Array("MODE" => "html", "NAME" => "MODAL_FORMS")
    );?>
</div>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-N5ZBJRD9');</script>
    <!-- End Google Tag Manager -->

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N5ZBJRD9"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->



</body>
</html>
<!-- end .page-->