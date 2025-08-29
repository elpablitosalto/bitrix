<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Hair\Geo;
use Hair\HL;
use Hair\General;

$geo = new Geo();
?>
<footer class="<?php if ($APPLICATION->GetCurPage() == '/press-center/events/' || $APPLICATION->GetCurPage() == '/press-center/') {
                    echo 'mt-30';
                } ?>">
    <div class="top-footer">
        <div class="container">
            <div class="col-lg-4 _mobile-centered">
                <div class="top-footer__location"><?= $geo->getCity() ?></div>
                <a href="tel:<?= General::formatPhone(General::GetStaticInfo('main_phone')) ?>" class="top-footer__phone"><?= General::GetStaticInfo('main_phone') ?></a>
            </div>
            <div class="col-lg-5 top-footer__menu">
                <p class="top-footer__menu-mobile-title">Меню</p>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "bottom.menu",
                    array(
                        "ROOT_MENU_TYPE" => "bottom",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => array(),
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "left",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                    ),
                    false
                ); ?>
            </div>
            <div class="col-lg-3 top-footer__contacts">
                <p>Связаться с нами:</p>
                <a href="mailto:concept@bigcom.ru" class="top-footer__contacts-mail">
                    <!--                        --><? //=COption::GetOptionString('main','email_from');
                                                    ?>
                    concept@bigcom.ru
                </a>
                <div class="top-footer__contacts-socials">
                    <?
                    $hl = new HL();
                    $items = $hl->getList(SOCIALS, ['*'], [], ['UF_SORT_VALUE' => 'asc']);
                    foreach ($items as $item) :
                        $icon = CFile::GetPath($item['UF_WHITE_ICON']);
                    ?>
                        <a href="<?= $item['UF_LINK'] ?>" class="top-footer__contacts-socials--item <?= $item['UF_CODE'] ?>"><?= file_get_contents($_SERVER["DOCUMENT_ROOT"] . $icon); ?></a>
                    <?
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-footer">
        <a class="desktop-hidden" href="/"><img src="<?= MOCKUP ?>/images/logo_white-main-mobile.svg" width="140" height="36" /></a>
        <div class="container">
            <a href="https://web-aim.ru/" target="_blank"><img class="js_lazy" data-src="<?= MOCKUP ?>/images/logo-web-aim.svg" width="101" height="26" /></a>
            <a class="mobile-hidden" href="/"><img src="<?= MOCKUP ?>/images/logo_white-main.svg" /></a>
            <p class="bottom-footer__copyright">© 2001 - <?= date('Y') ?> ООО "БИГ"</p>
        </div>
    </div>
</footer>

<?
// Скрипты и стили для Recaptcha -->
if (true) {
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
}
// <-- Скрипты и стили для Recaptcha

// Скрипты -->
if (true) {
    $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => "/local/include/js_scripts.php",
            "AREA_FILE_RECURSIVE" => "N",
            "EDIT_MODE" => "html",
        ),
        false,
        array('HIDE_ICONS' => 'Y')
    );
}
// <-- Скрипты
?>

</body>

<div id="askQuestion" class="popup mfp-hide">
    <div class="popup_header">
        <h3>Задать вопрос</h3>
        <p>Заполните форму, и наши специалисты ответят вам в течение 24 часов</p>
    </div>
    <div class="popup_content">
        <form action="/local/ajax/forms/askQuestion.php" data-form-ajax>
            <input type="hidden" name="PAGE_URL" value="<?= $_SERVER['REQUEST_URI'] ?>">
            <div class="step">
                <div class="form-wrapper__item">
                    <label>Ваше имя*</label>
                    <input type="text" name="NAME" required>
                    <span class="error"></span>
                </div>
                <div class="form-wrapper__item">
                    <label>E-mail*</label>
                    <input type="email" name="EMAIL" required placeholder="pochta@mail.ru">
                    <span class="error">E-mail введен не корректно</span>
                </div>
                <div class="form-wrapper__item">
                    <label>Вопрос*</label>
                    <textarea name="MESSAGE"></textarea>
                </div>
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => "/local/include/capcha.php",
                        "AREA_FILE_RECURSIVE" => "N",
                        "EDIT_MODE" => "html",
                    ),
                    false,
                    array('HIDE_ICONS' => 'Y')
                );
                ?>
                <div class="form-wrapper__item form-wrapper__item-checkbox">
                    <input id="suggestion" type="checkbox" name="suggestion">
                    <label for="suggestion">Нажимая на кнопку, вы соглашаетесь с условиями
                        обработки персональных данных.</label>
                    <span class="error">Вы не согласились с условиями обработки персональных данных</span>
                </div>
            </div>
            <div class="step">
                <div class="form-wrapper__item _flex-column-center">
                    <button class="button _small" onclick="ym(26710119,'reachGoal','question'); return true;">Отправить</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="learning" class="popup mfp-hide">
    <div class="popup_header">
        <h3 id="seminar-name">Записаться на </h3>
        <p>Заполните форму, и наши специалисты ответят вам в течение 24 часов</p>
    </div>
    <div class="popup_content">
        <form action="/local/ajax/forms/learning.php" data-form-ajax>
            <input type="hidden" name="PAGE_URL" value="<?= $_SERVER['REQUEST_URI'] ?>">
            <div class="step">
                <div class="form-wrapper__item">
                    <label>ФИО*</label>
                    <input type="text" name="NAME" required>
                </div>
                <div class="form-wrapper__item">
                    <label>Телефон*</label>
                    <input type="PHONE" name="PHONE" required placeholder="+7 (_ _ _) _ _ _-_ _-_ _">
                </div>
                <div class="form-wrapper__item">
                    <label>E-mail*</label>
                    <input type="email" name="EMAIL" required placeholder="pochta@mail.ru">
                    <span class="error">E-mail введен не корректно</span>
                </div>
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => "/local/include/capcha.php",
                        "AREA_FILE_RECURSIVE" => "N",
                        "EDIT_MODE" => "html",
                    ),
                    false,
                    array('HIDE_ICONS' => 'Y')
                );
                ?>
                <div class="form-wrapper__item form-wrapper__item-checkbox">
                    <input id="suggestion" type="checkbox" name="suggestion">
                    <label for="suggestion">Нажимая на кнопку, вы соглашаетесь с условиями <a href="/upload/oferta/hair.ru_Публичный_договор-оферта_на_участие_в_семинарах.pdf" target="_blank">договора-оферты на проведение
                            семинара</a> и даете согласие на обработку и хранение ваших персональных данных.</label>
                    <span class="error">Вы не согласились с условиями обработки персональных данных</span>
                </div>
            </div>
            <div class="step">
                <div class="form-wrapper__item _flex-column-center">
                    <button class="button _small">Отправить</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="cityChoose" class="popup mfp-hide">
    <div class="popup_header">
        <h3>Выбрать город</h3>
        <p>Если вы хотите изменить ваше местоположение, заполните поле ниже или выберите город из списка</p>
    </div>
    <div class="popup_content">
        <form action="/local/ajax/personal/cityChoose.php" data-form-ajax>
            <div class="form-wrapper__item">
                <input type="text" data-city-init placeholder="Начните вводить название города..." name="CITY" required />
                <span class="error">Не указан город</span>
            </div>
            <div class="form-wrapper__item">
                <?
                $cities = General::getCities();
                foreach ($cities as $city) :
                    echo '<p class="cityChoose">' . $city . '</p>';
                endforeach;
                ?>
            </div>
        </form>
    </div>
</div>
<div class="modal" id="modalFormStatus">
    <div class="modal__content">
        <div class="modal__illustration">
            <svg class="modal__icon modal__icon_role_success" width="66" height="66" viewBox="0 0 66 66" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="33" cy="33" r="32" stroke="#13B70F" stroke-width="2" />
                <g clip-path="url(#clip0_1_6351)">
                    <path d="M27.5001 40.7L19.8001 33L17.2334 35.5667L27.5001 45.8333L49.5001 23.8333L46.9334 21.2667L27.5001 40.7Z" fill="#13B70F" />
                </g>
                <defs>
                    <clipPath id="clip0_1_6351">
                        <rect width="44" height="44" fill="white" transform="translate(11 11)" />
                    </clipPath>
                </defs>
            </svg>
            <svg class="modal__icon modal__icon_role_error" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 66 66" style="enable-background:new 0 0 66 66;">
                <circle fill="none" stroke="#E30613" stroke-width="2" cx="33" cy="33" r="32" />
                <g>
                    <defs>
                        <rect id="SVGID_1_" x="11" y="11" width="44" height="44" />
                    </defs>
                    <clipPath id="SVGID_2_">
                        <use xlink:href="#SVGID_1_" style="overflow:visible;" />
                    </clipPath>
                    <g clip-path="url(#SVGID_2_)">
                        <path fill="#E30613" d="M23.3,45.3l22-22l-2.6-2.6l-22,22" />
                        <path fill="#E30613" d="M20.7,23.3l22,22l2.6-2.6l-22-22" />
                    </g>
                </g>
            </svg>
        </div>
        <div class="modal__text" id="modalFormStatusContent">
        </div>
        <div class="modal__controls">
            <div class="modal__control">
                <button class="button js-fancybox-close" type="button">Хорошо</button>
            </div>
        </div>
    </div>
</div>

</html>