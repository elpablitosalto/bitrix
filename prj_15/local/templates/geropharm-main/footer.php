<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Context;

?>
<?
if (!defined('PAGE_TYPE')) {
    define('PAGE_TYPE', 1);
}
?>
<? if (!$isHomePage && !defined("ERROR_404")) { ?>
    <? if (PAGE_TYPE == 1) { ?>
        </div>
    <? } else if (PAGE_TYPE == 2) { ?>

    <? } ?>
    </div>
<? } ?>
</div>
</div>
</main>
<footer class="dp-footer">
    <div class="container">
        <div class="row">
            <div class="col dp-footer-col-logo"><a class="dp-footer-logo" href="/"><img class="dp-footer-logo__img"
                                                                                        src="<?= SITE_TEMPLATE_PATH ?>/img/design/logo.svg"
                                                                                        alt="Герофарм" width="185"
                                                                                        height="80"></a></div>
            <div class="col dp-footer-col-menu">
                <div class="dp-footer-menu">
                    <ul class="dp-footer-menu__list">
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
                    </ul>
                </div>
            </div>
            <div class="col dp-footer-col-contacts">
                <div class="dp-footer-contacts">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/content/main/contacts.php",
                        )
                    ); ?>
                </div>
                <div class="dp-footer-menu dp-footer-menu-privacy">
                    <ul class="dp-footer-menu__list">
                        <li class="dp-footer-menu__item"><a class="dp-footer-menu__link" href="/privacy/">Политика
                                конфиденциальности</a></li>
                        <li class="dp-footer-menu__item"><a class="dp-footer-menu__link" href="/licence/">Лицензионное
                                соглашение</a></li>
                    </ul>
                </div>
            </div>
            <div class="col dp-footer-col-feedback">

                <? $APPLICATION->IncludeComponent(
                    "indexis:ajax.form",
                    "subscribe",
                    array(
                        "IBLOCK_ID" => Indexis::getIblockId("subscribe", "forms", "s1"),
                        "RETURN_FIELDS" => "Y",
                        "MINDBOX_TYPE" => "JS",
                        "MINDBOX" => "mindboxSubscriptionForm",
                        "IBLOCK_TYPE" => "forms",
                        "FIELDS" => [
                            "NAME" => ["CLEAR", "NOT_EMPTY", "EMAIL"],
                        ],
                    )
                ); ?>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/content/main/social.php",
                    )
                ); ?>
            </div>
        </div>
    </div>
</footer>
</div>

<?
if (!defined('SET_OG_MARKING')) {
    define('SET_OG_MARKING', 'N');
}
if (SET_OG_MARKING == 'Y') {
    // Разметка OG. https://ogp.me
    CMarkingOG::setPageProps();
}
?>

<? $APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    array(
        "AREA_FILE_SHOW" => "file",
        "PATH" => SITE_DIR . "include/service/counters.php",
    )
); ?>

<div class="dp-modals">

    <?
    global $USER;
    $quizComplete = $USER->GetParam("QUIZ");
    if ($quizComplete != "Y") {
        ?>
        <? $APPLICATION->IncludeComponent(
            "indexis:ajax.form",
            "quiz",
            array(
                "IBLOCK_ID" => Indexis::getIblockId("quiz", "content", "s1"),
                "IBLOCK_TYPE" => "content",
                "RETURN_FIELDS" => "Y",
                "MINDBOX_TYPE" => "JS",
                "MINDBOX" => "mindboxQuiz",
                "SET_QUIZ" => "Y",
                "FIELDS" => [
                    "PROPERTY_WORK" => ["NOT_EMPTY", "HL_MULTIPLE"],
                    "PROPERTY_STR1" => ["CLEAR", "NUMBER"],
                    "PROPERTY_STR2" => ["CLEAR", "NUMBER"],
                    "PROPERTY_REASON" => ["HL_MULTIPLE"],
                    "PROPERTY_REASON2" => ["NOT_EMPTY", "HL_MULTIPLE"],
                    "PROPERTY_REASON_RESULT" => ["NOT_EMPTY", "HL_MULTIPLE"],
                    "PROPERTY_PACIENT_TYPE" => ["HL_LIST"],
                    "PROPERTY_THEMES" => ["NOT_EMPTY", "HL_MULTIPLE"],
                    "PROPERTY_HOW_GET" => ["LIST_MULTIPLE"],
                    "PROPERTY_MATERISLAS_DATE" => ["LIST_MULTIPLE"],
                ],
                "HANDLERS" => [
                    "NAME" => "Квиз пользователя " . $USER->GetID(),
                ],
            )
        ); ?>
    <? } ?>

    <? if (!isset($_COOKIE["doctor_agree"])) { ?>
        <div class="dp-modal dp-modal-required dp-modal-practicing-doctor" id="modal-practicing-doctor"
             style="display: block;">
            <div class="dp-modal__overlay"></div>
            <div class="dp-modal__dialog">
                <div class="dp-modal__header">
                    <h3 class="dp-modal__title">Уважаемый посетитель сайта!</h3>
                </div>
                <div class="dp-modal__body">
                    <p>Информация на данном сайте предназначена только для врачей.</p>
                    <p>Подтвердите, что вы являетесь практикующим врачом.</p>
                </div>
                <div class="dp-modal__footer">
                    <button onclick="doctor_agree()" class="dp-btn dp-btn_orange dp-modal-required__confirm-btn"
                            type="button">Подтверждаю
                    </button>
                </div>
            </div>
        </div>
        <script>
            function doctor_agree() {
                var cookieDate = new Date(new Date().getTime() + 1000 * 3600 * 24 * 365 * 1000).toUTCString();
                document.cookie = "doctor_agree=y" + "; path=/; expires=" + cookieDate + ";";
            }
        </script>
    <? } elseif (!isset($_COOKIE["cookie_agree"])) { ?>
        <div class="dp-modal dp-modal-required dp-modal-cookies dp-modal_active" id="modal-cookies"
             style="display: block;">
            <div class="dp-modal__overlay"></div>
            <div class="dp-modal__dialog">
                <div class="dp-modal__body">
                    <p>Цифровая Академия работает с файлами cookie, чтобы совершенствовать сервис. Используя сайт, вы
                        соглашаетесь с&nbsp;<a href="#" target="_blank">этим</a>.</p>
                </div>
                <div class="dp-modal__footer">
                    <button onclick="cookie_agree()" class="dp-btn dp-btn_orange dp-modal-required__confirm-btn"
                            type="button">Принять
                    </button>
                </div>
            </div>
        </div>
        <script>
            function cookie_agree() {
                var cookieDate = new Date(new Date().getTime() + 1000 * 3600 * 24 * 365 * 1000).toUTCString();
                document.cookie = "cookie_agree=y" + "; path=/; expires=" + cookieDate + ";";
            }
        </script>
    <? } ?>

    <?
    if ($USER->IsAuthorized()) {
        $APPLICATION->IncludeComponent(
            "indexis:soc.after.reg",
            "",
        );
    }
    ?>

    <? if (!$USER->IsAuthorized() || Context::getCurrent()->getRequest()->get("AUTH_FORM") == "Y") { ?>
        <div class="dp-modal dp-modal-sign dp-modal-auth" id="modal-auth">
            <div class="dp-modal__overlay"></div>
            <div class="dp-modal__dialog">
                <button class="dp-modal__close" type="button">
                    <svg class="icon icon-cross ">
                        <use xlink:href="#cross"></use>
                    </svg>
                </button>
                <div class="dp-modal__header">
                    <h3 class="dp-modal__title">Вход или регистрация</h3>
                </div>
                <div class="dp-modal__body">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:system.auth.form",
                        "modal",
                        array(
                            "REGISTER_URL" => "",
                            "FORGOT_PASSWORD_URL" => "",
                            "PROFILE_URL" => "",
                            "SHOW_ERRORS" => "Y",
                            "AJAX_MODE" => "Y",
                            "AJAX_OPTION_SHADOW" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "AJAX_OPTION_HISTORY" => "N",
                        )
                    ); ?>
                </div>
            </div>
        </div>

        <div class="dp-modal dp-modal-sign dp-modal-registration" id="modal-registration">
            <div class="dp-modal__overlay"></div>
            <div class="dp-modal__dialog">
                <button class="dp-modal__close" type="button">
                    <svg class="icon icon-cross ">
                        <use xlink:href="#cross"></use>
                    </svg>
                </button>
                <div class="dp-modal__header">
                    <h3 class="dp-modal__title">Регистрация</h3>
                </div>
                <div class="dp-modal__body">
                    <div class="dp-modal__desc">
                        <p>Регистрация на сайте дает доступ ко всем бесплатным материалам нашего сообщества.</p>
                    </div>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.register",
                        "modal",
                        array(
                            "USER_PROPERTY_NAME" => "",
                            "SEF_MODE" => "N",
                            "SHOW_FIELDS" => array("NAME", "LAST_NAME", "PERSONAL_PHONE", "UF_SPECIALITY", "UF_AGREEMENT", "UF_REG_POINT"),
                            "REQUIRED_FIELDS" => array("NAME", "LAST_NAME", "UF_SPECIALITY", "UF_AGREEMENT", "UF_REG_POINT"),
                            "AUTH" => "Y",
                            "USE_BACKURL" => "Y",
                            "SUCCESS_PAGE" => "",
                            "SET_TITLE" => "N",
                            "USER_PROPERTY" => array(),
                            "SEF_FOLDER" => "/",
                            "VARIABLE_ALIASES" => array(),
                            "AJAX_MODE" => "Y",
                            "AJAX_OPTION_SHADOW" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "AJAX_OPTION_HISTORY" => "N",
                        )
                    ); ?>

                </div>
            </div>
        </div>
    <? } ?>
</div>

</body>

</html>