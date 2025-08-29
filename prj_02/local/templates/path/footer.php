<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
</main>
<footer class="wrapper rs__footer">
    <div class="rs__footer--top">
        <div class="container">
            <div class="rs__content">
                <div class="rs__footer--box">
                    <div class="rs__footer--left">
                        <div class="rs__footer--item rs__footer--info">
                            <div class="rs__footer--logo-box">
                                <div class="rs__footer--logo">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/logo.svg">
                                </div>
                                <div class="rs__footer--logo-parthner">
                                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/logo-main.svg">
                                </div>
                            </div>
                        </div>

                        <div class="rs__footer--item rs__footer--menu">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:menu",
                                "bottom",
                                array(
                                    "ROOT_MENU_TYPE" => "bottom",
                                    "MAX_LEVEL" => "1",
                                    "CHILD_MENU_TYPE" => "",
                                    "USE_EXT" => "Y",
                                    "DELAY" => "N",
                                    "ALLOW_MULTI_SELECT" => "N",
                                    "MENU_CACHE_TYPE" => "N",
                                    "MENU_CACHE_TIME" => "3600",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "MENU_CACHE_GET_VARS" => ""
                                )
                            ); ?>
                        </div>
                    </div>
                    <div class="rs__footer--right">
                        <div class="rs__footer--item rs__footer--address">
                            <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/footer/adress.php"
                                )
                            ); ?>
                        </div>
                        <div class="rs__footer--item rs__footer--social">
                            <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/footer/soc.php"
                                )
                            ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="rs__footer--bottom">
        <div class="container">
            <div class="rs__content">
                <div class="rs__footer--box">
                    <div class="rs__footer--left">
                        <div class="rs__footer--item rs__footer--item-coppyriter">
                            <div class="rs__footer--coppyriter">© Программа «Путь к успеху» реализуется <a class="rs__footer--coppyriter-link" href="https://dorogakdomu.ru/ " target="_self">фондом «Дорога к
                                    дому»</a>
                            </div>
                        </div>
                    </div>
                    <div class="rs__footer--right">
                        <div class="rs__footer--item rs__footer--item-data-policy">
                            <a class="rs__footer--data-policy" href="/docs/politika_v_otnoshenii_obrabotki_pd.pdf" target="_blank">Политика обработки персональных данных</a>
                        </div>
                        <div class="rs__footer--item rs__footer--item-developer">
                            <div class="rs__footer--developer">Разработано в <a class="rs__footer--developer-link" href="https://indexis.ru/" target="_blank">INDEXIS</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="rs__notic"></div>
<div class="is-hidden modal__hidden"></div>
</div>
</body>

</html>