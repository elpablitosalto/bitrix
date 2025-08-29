<?
if (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest") die();

use \Bitrix\Main\Page\Asset;

global $APPLICATION, $TEMPLATE_OPTIONS, $arSite, $bIndexBot, $isHomePage, $arDelayedLoading;
IncludeTemplateLangFile(__FILE__);
?>

<? if (CSite::InDir(SITE_DIR . 'help/') || CSite::InDir(SITE_DIR . 'company/') || CSite::InDir(SITE_DIR . 'info/')) : ?>
    </div>
<? endif; ?>
<? if (!$isFrontPage && !$isContactsPage) : ?>
    </div>
    </div>
    </section>
    </div>
<? endif; ?>
</div><? // <div class="wrapper">
        ?>
<footer id="footer" <?= ($isFrontPage ? 'class="main"' : '') ?>>
    <div class="footer_inner">
        <div class="wrapper_inner">
            <div class="footer_top">
                <div class="wrap_md">
                    <div class="iblock sblock">
                        <? /* $APPLICATION->IncludeComponent("bitrix:subscribe.form", "mshop", array(
                          "AJAX_MODE" => "N",
                          "SHOW_HIDDEN" => "N",
                          "ALLOW_ANONYMOUS" => "Y",
                          "SHOW_AUTH_LINKS" => "N",
                          "CACHE_TYPE" => "A",
                          "CACHE_TIME" => "86400",
                          "CACHE_NOTES" => "",
                          "SET_TITLE" => "N",
                          "AJAX_OPTION_JUMP" => "N",
                          "AJAX_OPTION_STYLE" => "Y",
                          "AJAX_OPTION_HISTORY" => "N",
                          "AJAX_OPTION_ADDITIONAL" => "",
                          "LK" => "Y",
                          "COMPONENT_TEMPLATE" => "mshop",
                          "USE_PERSONALIZATION" => "Y",
                          "PAGE" => SITE_DIR."personal/subscribe/"
                          ),
                          false,
                          array(
                          "ACTIVE_COMPONENT" => "Y"
                          )
                          ); */ ?>
                        <? $APPLICATION->IncludeFile(SITE_DIR . "include/footer_logo.php", array(), array("MODE" => "html", "NAME" => GetMessage("LOGO"))); ?>
                    </div>
                    <div class="iblock phones">
                        <div class="wrap_md">
                            <div class="empty_block iblock"></div>
                            <div class="phone_block iblock">
                                <span class="phone_wrap">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.67962 3.32038L7.29289 2.70711C7.68342 2.31658 8.31658 2.31658 8.70711 2.70711L11.2929 5.29289C11.6834 5.68342 11.6834 6.31658 11.2929 6.70711L9.50048 8.49952C9.2016 8.7984 9.1275 9.255 9.31653 9.63307C10.4093 11.8186 12.1814 13.5907 14.3669 14.6835C14.745 14.8725 15.2016 14.7984 15.5005 14.4995L17.2929 12.7071C17.6834 12.3166 18.3166 12.3166 18.7071 12.7071L21.2929 15.2929C21.6834 15.6834 21.6834 16.3166 21.2929 16.7071L20.6796 17.3204C18.5683 19.4317 15.2257 19.6693 12.837 17.8777L11.6286 16.9714C9.88504 15.6638 8.33622 14.115 7.02857 12.3714L6.12226 11.163C4.33072 8.7743 4.56827 5.43173 6.67962 3.32038Z" fill="#222222" />
                                    </svg>

                                    <span><? $APPLICATION->IncludeFile(SITE_DIR . "include/phone.php", array(), array("MODE" => "html", "NAME" => GetMessage("PHONE"))); ?></span>
                                </span>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer_bottom">
                <div class="wrap_md">
                    <div class="iblock menu_block">
                        <div class="wrap_md">
                            <div class="iblock copy_block">
                                <? $APPLICATION->IncludeFile(SITE_DIR . "include/footer_address.php", array(), array("MODE" => "html", "NAME" => GetMessage("ADDRESS"))); ?>
                                <? /* <div class="copyright">
                                  <?$APPLICATION->IncludeFile(SITE_DIR."include/copyright.php", Array(), Array("MODE" => "html", "NAME"  => GetMessage("COPYRIGHT")));?>
                                  </div>
                                  <div class="pay_system_icons">
                                  <?$APPLICATION->IncludeFile(SITE_DIR."include/pay_system_icons.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("PAY_SYSTEM")));?>
                                  </div> */ ?>
                            </div>
                            <div class="iblock all_menu_block">
                                <? /* $APPLICATION->IncludeComponent("bitrix:menu", "bottom_submenu_top", array(
                                  "ROOT_MENU_TYPE" => "bottom",
                                  "MENU_CACHE_TYPE" => "Y",
                                  "MENU_CACHE_TIME" => "86400",
                                  "MENU_CACHE_USE_GROUPS" => "N",
                                  "MENU_CACHE_GET_VARS" => "",
                                  "MAX_LEVEL" => "1",
                                  "USE_EXT" => "N",
                                  "DELAY" => "N",
                                  "ALLOW_MULTI_SELECT" => "N"
                                  ),
                                  false,
                                  array(
                                  "ACTIVE_COMPONENT" => "Y"
                                  )
                                  ); */ ?>
                                <div class="wrap_md">
                                    <div class="iblock submenu_block">
                                        <span class="menu_item" style="padding: 0px 0px 10px 6px;"><a class="menu__item-link" href="/katalog/spetsodezhda"><b>Спецодежда</b></a></span>
                                        <?
                                        $APPLICATION->IncludeComponent(
                                            "bitrix:menu",
                                            "bottom_submenu",
                                            array(
                                                "ROOT_MENU_TYPE" => "bottom_company",
                                                "MENU_CACHE_TYPE" => "Y",
                                                "MENU_CACHE_TIME" => "86400",
                                                "MENU_CACHE_USE_GROUPS" => "N",
                                                "MENU_CACHE_GET_VARS" => array(),
                                                "MAX_LEVEL" => "1",
                                                "USE_EXT" => "N",
                                                "DELAY" => "N",
                                                "ALLOW_MULTI_SELECT" => "N",
                                                "CACHE_SELECTED_ITEMS" => "N"
                                            ),
                                            false
                                        );
                                        ?>
                                    </div>
                                    <div class="iblock submenu_block">
                                        <span class="menu_item" style="padding: 0px 0px 10px 6px;"><a class="menu__item-link" href="/katalog/obuv"><b>Спецобувь</b></a></span>
                                        <?
                                        $APPLICATION->IncludeComponent(
                                            "bitrix:menu",
                                            "bottom_submenu",
                                            array(
                                                "ROOT_MENU_TYPE" => "bottom_obuv",
                                                "MENU_CACHE_TYPE" => "Y",
                                                "MENU_CACHE_TIME" => "86400",
                                                "MENU_CACHE_USE_GROUPS" => "N",
                                                "MENU_CACHE_GET_VARS" => array(),
                                                "MAX_LEVEL" => "1",
                                                "USE_EXT" => "N",
                                                "DELAY" => "N",
                                                "ALLOW_MULTI_SELECT" => "N",
                                                "CACHE_SELECTED_ITEMS" => "N"
                                            ),
                                            false
                                        );
                                        ?>
                                    </div>
                                    <div class="iblock submenu_block">
                                        <span class="menu_item" style="padding: 0px 0px 10px 6px;"><a class="menu__item-link" href="/katalog/siz/"><b>Средства защиты рук</b></a></span>
                                        <?
                                        $APPLICATION->IncludeComponent(
                                            "bitrix:menu",
                                            "bottom_submenu",
                                            array(
                                                "ROOT_MENU_TYPE" => "bottom_ruki",
                                                "MENU_CACHE_TYPE" => "Y",
                                                "MENU_CACHE_TIME" => "86400",
                                                "MENU_CACHE_USE_GROUPS" => "N",
                                                "MENU_CACHE_GET_VARS" => array(),
                                                "MAX_LEVEL" => "1",
                                                "USE_EXT" => "N",
                                                "DELAY" => "N",
                                                "ALLOW_MULTI_SELECT" => "N",
                                                "CACHE_SELECTED_ITEMS" => "N"
                                            ),
                                            false
                                        );
                                        ?>
                                    </div>
                                    <div class="iblock submenu_block">
                                        <span class="menu_item" style="padding: 0px 0px 10px 6px;"><a class="menu__item-link" href="/katalog/bezopasnost_rabochego_mesta_1/"><b>Средства индивидуальной защиты</b></a></span>
                                        <?
                                        $APPLICATION->IncludeComponent(
                                            "bitrix:menu",
                                            "bottom_submenu",
                                            array(
                                                "ROOT_MENU_TYPE" => "bottom_siz",
                                                "MENU_CACHE_TYPE" => "Y",
                                                "MENU_CACHE_TIME" => "86400",
                                                "MENU_CACHE_USE_GROUPS" => "N",
                                                "MENU_CACHE_GET_VARS" => array(),
                                                "MAX_LEVEL" => "1",
                                                "USE_EXT" => "N",
                                                "DELAY" => "N",
                                                "ALLOW_MULTI_SELECT" => "N",
                                                "CACHE_SELECTED_ITEMS" => "N"
                                            ),
                                            false
                                        );
                                        ?>
                                    </div>
                                    <div class="iblock submenu_block">
                                        <span class="menu_item" style="padding: 0px 0px 10px 6px;"><a class="menu__item-link" href="/katalog/bezopasnost_rabochego_mesta_1/"><b>Безопасность рабочего места</b></a></span>
                                        <?
                                        $APPLICATION->IncludeComponent(
                                            "bitrix:menu",
                                            "bottom_submenu",
                                            array(
                                                "ROOT_MENU_TYPE" => "bottom_bezopastnost",
                                                "MENU_CACHE_TYPE" => "Y",
                                                "MENU_CACHE_TIME" => "86400",
                                                "MENU_CACHE_USE_GROUPS" => "N",
                                                "MENU_CACHE_GET_VARS" => array(),
                                                "MAX_LEVEL" => "1",
                                                "USE_EXT" => "N",
                                                "DELAY" => "N",
                                                "ALLOW_MULTI_SELECT" => "N",
                                                "CACHE_SELECTED_ITEMS" => "N"
                                            ),
                                            false
                                        );
                                        ?>
                                    </div>
                                </div>
                                <div class="footer__links">
                                    <?php
                                    $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        "",
                                        array(
                                            "AREA_FILE_SHOW" => "file",
                                            "AREA_FILE_SUFFIX" => "inc",
                                            "EDIT_TEMPLATE" => "",
                                            "PATH" => "/include/bottom_info.php"
                                        )
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="iblock social_block">
                        <div class="wrap_md">
                            <div class="empty_block iblock"></div>
                            <div class="social_wrapper iblock">
                                <div class="social">
                                    <? include($_SERVER['DOCUMENT_ROOT'] . SITE_DIR . 'include/social.info.mshop.default.php'); ?>
                                </div>
                            </div>
                        </div>
                        <div id="bx-composite-banner"></div>
                    </div>
                </div>
            </div>
            <? $APPLICATION->IncludeFile(SITE_DIR . "include/bottom_include1.php", array(), array("MODE" => "text", "NAME" => GetMessage("ARBITRARY_1"))); ?>
            <? $APPLICATION->IncludeFile(SITE_DIR . "include/bottom_include2.php", array(), array("MODE" => "text", "NAME" => GetMessage("ARBITRARY_2"))); ?>
        </div>
    </div>
</footer>
<?
if (!CSite::inDir(SITE_DIR . "index.php")) {
    if (strlen($APPLICATION->GetPageProperty('title')) > 1) {
        $title = $APPLICATION->GetPageProperty('title');
    } else {
        $title = $APPLICATION->GetTitle();
    }
    $APPLICATION->SetPageProperty("title", $title . (COption::GetOptionString('aspro.mshop', 'HIDE_SITE_NAME_IN_TITLE', '', SITE_ID) == 'Y' ? '' : ' - ' . $arSite['SITE_NAME']));
} else {
    if (strlen($APPLICATION->GetPageProperty('title')) > 1) {
        $title = $APPLICATION->GetPageProperty('title');
    } else {
        $title = $APPLICATION->GetTitle();
    }
    if (!empty($title)) {
        $APPLICATION->SetPageProperty("title", $title);
    } else {
        $APPLICATION->SetPageProperty("title", $arSite['SITE_NAME']);
    }
}
?>
<div id="content_new"></div>
<? CMShop::footerAction(); ?>

<? if ($GLOBALS['SHOW']['modal_size_grid'] != 'N') { ?>
    <div id="modal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Таблица размеров спецодежды:</h3>
                    <a href="#" title="Закрыть" class="close" data-close="modal">×</a>
                </div>
                <div class="modal-body">
                    <div class="size_table">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Размер:</td>
                                        <td>88/92</td>
                                        <td>96/100</td>
                                        <td>104/108</td>
                                        <td>112/116</td>
                                        <td>120/124</td>
                                    </tr>
                                    <tr>
                                        <td>Обхват груди, см.</td>
                                        <td>87-94</td>
                                        <td>95-102</td>
                                        <td>103-110</td>
                                        <td>111-118</td>
                                        <td>119-126</td>
                                    </tr>
                                    <tr>
                                        <td>Обхват талии, см.</td>
                                        <td>77-84</td>
                                        <td>85-92</td>
                                        <td>93-100</td>
                                        <td>101-108</td>
                                        <td>109-116</td>
                                    </tr>
                                    <tr>
                                        <td>Обхват бедер, см.</td>
                                        <td>89-96</td>
                                        <td>97-104</td>
                                        <td>105-112</td>
                                        <td>113-120</td>
                                        <td>121-128</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h6>Рост:</h6>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>
                                            <p>Рост:</p>
                                        </td>
                                        <td>
                                            <p>158-164</p>
                                        </td>
                                        <td>
                                            <p>170-176</p>
                                        </td>
                                        <td>
                                            <p>182-188</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Фактический рост, см:</p>
                                        </td>
                                        <td>
                                            <p>От 155 до 167 включ.</p>
                                        </td>
                                        <td>
                                            <p>От 167 до 179 включ.</p>
                                        </td>
                                        <td>
                                            <p>От 179 до 191 включ.</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h5>Соответствие размеров обуви:</h5>
                        <h6>Для женщин:</h6>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Метрическая система нумерации</td>
                                        <td>23,0</td>
                                        <td>23,5</td>
                                        <td>24,0</td>
                                        <td>24,5</td>
                                        <td>25,0</td>
                                        <td>25,5</td>
                                        <td>26,0</td>
                                        <td>26,5</td>
                                        <td>27,0</td>
                                        <td>27,5</td>
                                    </tr>
                                    <tr>
                                        <td>Штихмассовая система нумерации</td>
                                        <td>35,0</td>
                                        <td>36,0</td>
                                        <td>37,0</td>
                                        <td>38,0</td>
                                        <td>39,0</td>
                                        <td>40,0</td>
                                        <td>40,5</td>
                                        <td>41,0</td>
                                        <td>42,0</td>
                                        <td>43,0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h6>Для мужчин:</h6>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Метрическая система нумерации</td>
                                        <td>25,0</td>
                                        <td>25,5</td>
                                        <td>26,0</td>
                                        <td>26,5</td>
                                        <td>27,0</td>
                                        <td>27,5</td>
                                        <td>28,0</td>
                                        <td>28,5</td>
                                        <td>29,0</td>
                                        <td>30,0</td>
                                    </tr>
                                    <tr>
                                        <td>Штихмассовая система нумерации</td>
                                        <td>39,0</td>
                                        <td>40,0</td>
                                        <td>40,5</td>
                                        <td>41,0</td>
                                        <td>42,0</td>
                                        <td>43,0</td>
                                        <td>43,5</td>
                                        <td>44,0</td>
                                        <td>45,0</td>
                                        <td>46,0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<? } ?>

<?
// JS -->
?>
<?
// ShowHead -->
//$APPLICATION->ShowHeadScripts();      // Вывод скриптов
// <-- ShowHead
?>
<?
// Загружается через JS по событию скролла страницы
/*?>
<script async src="https://use.fontawesome.com/330b84a353.js"></script>
<?*/ ?>
<? if (!$bIndexBot) : ?>

    <? if ($GLOBALS['SHOW']['modal_size_grid'] != 'N') { ?>
        <script async>
            document.addEventListener('click', function(e) {
                if (e.target.dataset.target === 'modal') {
                    e.preventDefault();
                    document.querySelector('#modal').classList.add('open');
                } else if (e.target.dataset.close === 'modal') {
                    e.preventDefault();
                    document.querySelector('#modal').classList.remove('open');
                }
            });
        </script>
    <? } ?>

    <?/*?>
    <script async src="/local/templates/aspro_mshop/js/gonumbersMaskPhone.js"></script>
    <?/**/ ?>

    <?
    // -->
    ?>
    <?/*?>
    <!-- Mango chat -->
    <script async>
        (function(w, d, u, i, o, s, p) {
            if (d.getElementById(i)) {
                return;
            }
            w['MangoObject'] = o;
            w[o] = w[o] || function() {
                (w[o].q = w[o].q || []).push(arguments)
            };
            w[o].u = u;
            w[o].t = 1 * new Date();
            s = d.createElement('script');
            s.async = 1;
            s.id = i;
            s.src = u;
            s.charset = 'utf-8';
            p = d.getElementsByTagName('script')[0];
            p.parentNode.insertBefore(s, p);
        }(window, document, '//widgets.mango-office.ru/widgets/mango.js', 'mango-js', 'mgo'));
        mgo({
            multichannel: {
                id: 10825
            }
        });
    </script>
    <script async src="//cdn.callibri.ru/callibri.js" type="text/javascript" charset="utf-8"></script>
    <?*/ ?>
    <?
    // <--
    ?>
<? endif; ?>
<?
// Загрузка скриптов, стилей через JS по событию скролла страницы -->
?>
<script async>
    var loadScripts = true;
    var loadCss = true;
    $(document).ready(function() {
        $(document).one({
            'scroll touchstart mouseenter click': function() {
                loadJsOnScroll();
                loadCssOnScroll();
            }
        });
    });

    function loadJsOnScroll() {
        if (loadScripts == true) {

            <? // Подключены через Google TM --> 
            ?>
            <?/*?>
            $.getScript("https://use.fontawesome.com/330b84a353.js");
            $.getScript("https://cdn.callibri.ru/callibri.js");
            $.getScript("/local/templates/aspro_mshop/js/fancybox/5.0/dist/fancybox/fancybox.umd.js");
            $.getScript("<?= SITE_TEMPLATE_PATH ?>/js_custom/gonumbersMaskPhone.js");
            <?*/ ?>
            <? // <-- 
            ?>

            <? // Отключен, заменен на другой чат --> 
            ?>
            <?/*?>
            $.getScript("/local/templates/aspro_mshop/js_custom/mango_chat.js");
            <?*/ ?>
            <? // <-- 
            ?>

            <? // Старое --> 
            ?>
            <?/*?>
            $.getScript("https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js");
            <?*/ ?>
            <? // <-- 
            ?>

            <? // Список скриптов --> 
            ?>
            <? if (!empty($arDelayedLoading['scripts'])) { ?>
                <? foreach ($arDelayedLoading['scripts'] as $key => $path) { ?>
                    $.getScript("<?= $path; ?>");
                <? } ?>
            <? } ?>
            <? // <-- 
            ?>

            loadScripts = false;
        }
    }

    function loadCssOnScroll() {
        if (loadCss == true) {
            <? if (!empty($arDelayedLoading['css'])) { ?>
                <? foreach ($arDelayedLoading['css'] as $key => $path) { ?>
                    var stylesheet;
                    stylesheet = document.createElement('link');
                    stylesheet.href = '<?= $path ?>';
                    stylesheet.rel = 'stylesheet';
                    stylesheet.type = 'text/css';
                    document.getElementsByTagName('head')[0].appendChild(stylesheet);
                    <?/*?>
                    $("head").append('<link rel="stylesheet" href="<?= $path ?>">');
                    <?*/ ?>
                <? } ?>
            <? } ?>
            <?/*?>
            $("head").append($('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">'));
            <?*/ ?>
            loadCss = false;
        }
    }
</script>
<script src="/local/templates/aspro_mshop/js/lazysizes.min.js" async></script>
<?
// <-- Загрузка скриптов, стилей через JS по событию скролла страницы
?>
<?
// <-- JS
?>

</body>

</html>