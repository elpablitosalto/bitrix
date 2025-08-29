<?

use Hair\Geo;
use Hair\HL;
use Hair\General;

$geo = new Geo();
$title = $APPLICATION->GetProperty('title');
$description = $APPLICATION->GetProperty('description');

$APPLICATION->SetPageProperty('title', $title);
$APPLICATION->SetPageProperty('description', $description);
?>
</div>
<div class="page__footer">
    <!-- begin .footer-->
    <div class="footer">
        <div class="footer__main">
            <div class="footer__wrapper page__container">
                <div class="footer__links">
                    <div class="footer__geo-select">
                        <!-- begin .icon-link-->
                        <a class="icon-link icon-link_icon-size_s icon-link_text-size_l icon-link_icon-spacing_l" data-popup class="location" href="#cityChoose">
                            <span class="icon-link__icon-wrapper">
                                <svg class="icon-link__icon" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.7643 0.0451624C11.6434 -0.0153796 11.5011 -0.0153796 11.3803 0.0451624L0.237825 5.61641C0.0261665 5.72235 -0.0595366 5.97979 0.0463807 6.19144C0.106672 6.31193 0.220122 6.39705 0.352657 6.42123L4.77494 7.22563L5.57934 11.6479C5.61226 11.8292 5.7574 11.9692 5.93976 11.9955C5.95992 11.9984 5.98026 11.9998 6.0006 11.9998C6.16304 11.9998 6.31155 11.9081 6.38417 11.7628L11.9554 0.620274C12.0615 0.408666 11.9759 0.15118 11.7643 0.0451624Z" />
                                </svg>
                            </span>
                            <span class="icon-link__text"><?= $geo->getCity() ?></span>
                        </a>
                        <!-- end .icon-link-->
                    </div>
                    <div class="footer__contact">
                        <!-- begin .icon-link-->
                        <a class="icon-link icon-link_text-size_xxl icon-link_icon-size_xxl icon-link_icon-spacing_l" href="tel:<?= General::formatPhone(General::GetStaticInfo('main_phone')) ?>">
                            <span class="icon-link__icon-wrapper">
                                <svg class="icon-link__icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.6582 11.4267L10.9482 8.96266C10.8201 8.84623 10.6518 8.78414 10.4787 8.78948C10.3057 8.79483 10.1415 8.86721 10.0209 8.99133L8.42552 10.632C8.04152 10.5587 7.26952 10.318 6.47485 9.52533C5.68019 8.73 5.43952 7.956 5.36819 7.57466L7.00752 5.97866C7.1318 5.85808 7.20428 5.69388 7.20963 5.5208C7.21498 5.34772 7.15278 5.17936 7.03619 5.05133L4.57285 2.342C4.45622 2.21357 4.29411 2.13567 4.12096 2.12484C3.94781 2.11401 3.77725 2.1711 3.64552 2.284L2.19885 3.52466C2.0836 3.64034 2.0148 3.7943 2.00552 3.95733C1.99552 4.124 1.80485 8.072 4.86619 11.1347C7.53685 13.8047 10.8822 14 11.8035 14C11.9382 14 12.0209 13.996 12.0429 13.9947C12.2059 13.9855 12.3597 13.9164 12.4749 13.8007L13.7149 12.3533C13.8282 12.222 13.8857 12.0516 13.8751 11.8785C13.8645 11.7053 13.7867 11.5432 13.6582 11.4267Z" />
                                </svg>
                            </span>
                            <span class="icon-link__text"><?= General::GetStaticInfo('main_phone') ?></span>
                        </a>
                        <!-- end .icon-link-->
                    </div>
                </div>
                <div class="footer__menu footer__menu_state_closed">
                    <button type="button" data-toggle-scope=".footer__menu" data-toggle-class="footer__menu_state_closed" class="footer__menu-trigger js-toggle">
                        Меню
                    </button>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "bottom.menu",
                        array(
                            "ROOT_MENU_TYPE" => "bottom_infinity",
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
                <div class="footer__contacts">
                    <div class="footer__text">Связаться с нами:</div>
                    <div class="footer__contact">
                        <!-- begin .icon-link-->
                        <a class="icon-link icon-link_text-size_xl icon-link_icon-size_xl icon-link_icon-spacing_l" href="tel:concept@bigcom.ru">
                            <span class="icon-link__icon-wrapper">
                                <svg class="icon-link__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22.7997 17.4V6.60005C22.7997 5.60405 21.9957 4.80005 20.9997 4.80005H4.1877C3.1917 4.80005 2.3877 5.60405 2.3877 6.60005V17.4C2.3877 18.396 3.1917 19.2 4.1877 19.2H20.9997C21.9957 19.2 22.7997 18.396 22.7997 17.4ZM21.2277 6.46805C21.6237 6.86405 21.4077 7.27205 21.1917 7.47605L16.3197 11.94L20.9997 16.812C21.1437 16.98 21.2397 17.2441 21.0717 17.4241C20.9157 17.616 20.5557 17.604 20.3997 17.484L15.1557 13.008L12.5877 15.348L10.0317 13.008L4.7877 17.484C4.6317 17.604 4.2717 17.616 4.1157 17.4241C3.9477 17.2441 4.0437 16.98 4.1877 16.812L8.8677 11.94L3.9957 7.47605C3.7797 7.27205 3.5637 6.86405 3.9597 6.46805C4.3557 6.07205 4.7637 6.26405 5.0997 6.55205L12.5877 12.6L20.0877 6.55205C20.4237 6.26405 20.8317 6.07205 21.2277 6.46805Z" />
                                </svg>
                            </span>
                            <span class="icon-link__text">concept@bigcom.ru</span>
                        </a>
                        <!-- end .icon-link-->
                    </div>
                    <div class="footer__social-nav">
                        <!-- begin .social-nav-->
                        <div class="social-nav social-nav_style_dependent">
                            <ul class="social-nav__list">
                                <?
                                $hl = new HL();
                                $items = $hl->getList(SOCIALS, ['*'], [], ['UF_SORT_VALUE' => 'asc']);
                                foreach ($items as $item) :
                                    $icon = CFile::GetPath($item['UF_WHITE_ICON']);
                                ?>
                                    <li class="social-nav__item">
                                        <a class="social-nav__link <?= $item['UF_CODE'] ?>" href="<?= $item['UF_LINK'] ?>">
                                            <?= file_get_contents($_SERVER["DOCUMENT_ROOT"] . $icon); ?>
                                        </a>
                                    </li>
                                <?
                                endforeach;
                                ?>
                            </ul>
                        </div>
                        <!-- end .social-nav-->
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="footer__bottom-wrapper page__container">
                <div class="footer__logo">
                    <!-- begin .logo-->
                    <a href="/" class="logo">
                        <picture class="logo__picture">
                            <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/mockup/dist/assets/blocks/logo/images/logo-full-light.svg", array(), array("MODE" => "html")); ?>
                            <? //$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/mockup/dist/assets/blocks/logo/images/logo-full-compact-light.svg", Array(),Array("MODE"=>"html"));
                            ?>
                        </picture>
                    </a>
                    <!-- end .logo-->
                </div>
                <!-- Needed to separate the logo to it's own line on mobile-->
                <div class="footer__mobile-separator">&nbsp;</div>
                <div class="footer__credit">
                    <!-- begin .dev-credit-->
                    <div class="dev-credit">
                        <a href="https://web-aim.ru/" target="_blank" class="dev-credit__link">
                            <span class="dev-credit__logo">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/mockup/dist/assets/blocks/dev-credit/images/logo.png" alt="WEB-AiM" class="dev-credit__image" title="" />
                            </span>
                        </a>
                    </div>
                    <!-- end .dev-credit-->
                </div>
                <div class="footer__copyright">© 2001 - <?= date('Y') ?> ООО "БИГ"</div>
            </div>
        </div>
    </div>
    <!-- end .footer-->
</div>
<div class="page__slide-nav">
    <!-- begin .mobile-menu-->
    <div class="mobile-menu">
        <div class="mobile-menu__controls">
            <div class="mobile-menu__control">
                <!-- begin .icon-link-->
                <? if ($USER->IsAuthorized()) : ?>
                    <? if (strpos($_SERVER['REQUEST_URI'], '/personal/') !== false) : ?>
                        <a class="icon-link" href="/?logout=yes&<?= bitrix_sessid_get() ?>">
                        <? else : ?>
                            <a class="icon-link" href="/personal/">
                            <? endif; ?>
                        <? else : ?>
                            <a class="icon-link" href="/personal/auth/">
                            <? endif; ?>
                            <span class="icon-link__icon-wrapper">
                                <svg class="icon-link__icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.1274 2.12769C9.01343 2.12769 7.92925 2.44115 6.99199 3.03417C6.08057 3.61085 5.34549 4.42542 4.86621 5.38978L5.78076 5.84431C6.60704 4.18174 8.2726 3.14896 10.1274 3.14896C12.8023 3.14896 14.9785 5.32513 14.9785 8.00003C14.9785 10.6749 12.8023 12.8511 10.1274 12.8511C8.2726 12.8511 6.60704 11.8183 5.78076 10.1557L4.86621 10.6103C5.34549 11.5747 6.08057 12.3892 6.99199 12.9659C7.92925 13.5589 9.01343 13.8724 10.1274 13.8724C13.3654 13.8724 15.9997 11.2381 15.9997 8.00003C15.9997 4.762 13.3654 2.12769 10.1274 2.12769Z" />
                                    <path d="M7.72403 9.68155L8.44614 10.4037L10.8498 8.00005L8.44614 5.59644L7.72403 6.31855L8.89485 7.48941H0V8.51069H8.89485L7.72403 9.68155Z" />
                                </svg>
                            </span>
                            <span class="icon-link__text">
                                <? if ($USER->IsAuthorized()) : ?>
                                    <? if (strpos($_SERVER['REQUEST_URI'], '/personal/') !== false) : ?>
                                        Выйти
                                    <? else : ?>
                                        Кабинет
                                    <? endif; ?>
                                <? else : ?>
                                    Войти
                                <? endif; ?>
                            </span>
                            </a>
                            <!-- end .icon-link-->
            </div>
        </div>
        <div class="mobile-menu__nav">
            <!-- begin .nav-->
            <!-- There is a data-text attribute on links, as well as a .nav__link-text element-->
            <!-- They are both necessary for the font-weight effect to not cause reflow-->
            <!-- They should either both be present, or both removed-->
            <!-- Otherwise the links will either have double text or no visible text at all-->
            <!-- data-text should have the same value as the text in side the link-->
            <nav class="nav nav_type_primary-mobile">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "main.menu",
                    array(
                        "ROOT_MENU_TYPE" => "main_infinity",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => array(),
                        "MAX_LEVEL" => "2",
                        "CHILD_MENU_TYPE" => "left",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                    ),
                    false
                ); ?>
            </nav>
            <!-- end .nav-->
        </div>
        <div class="mobile-nav__referrer">
            <div class="mobile-referrer">
                <a href="/" class="mobile-referrer__link">
                    Вернуться в CONCEPT
                </a>
            </div>
        </div>
        <div class="mobile-menu__nav">
            <!-- begin .nav-->
            <!-- There is a data-text attribute on links, as well as a .nav__link-text element-->
            <!-- They are both necessary for the font-weight effect to not cause reflow-->
            <!-- They should either both be present, or both removed-->
            <!-- Otherwise the links will either have double text or no visible text at all-->
            <!-- data-text should have the same value as the text in side the link-->
            <nav class="nav nav_type_simple">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "top.menu",
                    array(
                        "ROOT_MENU_TYPE" => "top_infinity",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => array(),
                        "MAX_LEVEL" => "2",
                        "CHILD_MENU_TYPE" => "left",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                        "COMPONENT_TEMPLATE" => "top.menu"
                    ),
                    false
                ); ?>
            </nav>
            <!-- end .nav-->
        </div>
        <div class="mobile-menu__contacts">
            <div class="mobile-menu__contact">
                <!-- begin .icon-link-->
                <a class="icon-link" data-popup class="location" href="#cityChoose">
                    <span class="icon-link__icon-wrapper">
                        <svg class="icon-link__icon" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.7643 0.0451624C11.6434 -0.0153796 11.5011 -0.0153796 11.3803 0.0451624L0.237825 5.61641C0.0261665 5.72235 -0.0595366 5.97979 0.0463807 6.19144C0.106672 6.31193 0.220122 6.39705 0.352657 6.42123L4.77494 7.22563L5.57934 11.6479C5.61226 11.8292 5.7574 11.9692 5.93976 11.9955C5.95992 11.9984 5.98026 11.9998 6.0006 11.9998C6.16304 11.9998 6.31155 11.9081 6.38417 11.7628L11.9554 0.620274C12.0615 0.408666 11.9759 0.15118 11.7643 0.0451624Z" />
                        </svg>
                    </span>
                    <span class="icon-link__text"><?= $geo->getCity() ?></span>
                </a>
                <!-- end .icon-link-->
            </div>
            <div class="mobile-menu__contact">
                <!-- begin .icon-link-->
                <a class="icon-link" href="tel:<?= General::formatPhone(General::getGeoPhone()) ?>">
                    <span class="icon-link__icon-wrapper">
                        <svg class="icon-link__icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.6582 11.4267L10.9482 8.96266C10.8201 8.84623 10.6518 8.78414 10.4787 8.78948C10.3057 8.79483 10.1415 8.86721 10.0209 8.99133L8.42552 10.632C8.04152 10.5587 7.26952 10.318 6.47485 9.52533C5.68019 8.73 5.43952 7.956 5.36819 7.57466L7.00752 5.97866C7.1318 5.85808 7.20428 5.69388 7.20963 5.5208C7.21498 5.34772 7.15278 5.17936 7.03619 5.05133L4.57285 2.342C4.45622 2.21357 4.29411 2.13567 4.12096 2.12484C3.94781 2.11401 3.77725 2.1711 3.64552 2.284L2.19885 3.52466C2.0836 3.64034 2.0148 3.7943 2.00552 3.95733C1.99552 4.124 1.80485 8.072 4.86619 11.1347C7.53685 13.8047 10.8822 14 11.8035 14C11.9382 14 12.0209 13.996 12.0429 13.9947C12.2059 13.9855 12.3597 13.9164 12.4749 13.8007L13.7149 12.3533C13.8282 12.222 13.8857 12.0516 13.8751 11.8785C13.8645 11.7053 13.7867 11.5432 13.6582 11.4267Z" />
                        </svg>
                    </span>
                    <span class="icon-link__text"><?= General::getGeoPhone() ?></span>
                </a>
                <!-- end .icon-link-->
            </div>
        </div>
        <div class="mobile-menu__social-nav">
            <!-- begin .social-nav-->
            <div class="social-nav">
                <ul class="social-nav__list">
                    <?
                    $hl = new HL();
                    $items = $hl->getList(SOCIALS, ['*'], [], ['UF_SORT_VALUE' => 'asc']);
                    foreach ($items as $item) :
                        $icon = CFile::GetPath($item['UF_ICON']);
                    ?>
                        <li class="social-nav__item">
                            <a class="social-nav__link <?= $item['UF_CODE'] ?>" href="<?= $item['UF_LINK'] ?>" target="_blank">
                                <?= file_get_contents($_SERVER["DOCUMENT_ROOT"] . $icon); ?>
                            </a>
                        </li>
                    <?
                    endforeach;
                    ?>
                </ul>
            </div>
            <!-- end .social-nav-->
        </div>
    </div>
    <!-- end .mobile-menu-->
</div>
<div class="page__modals">
    <!-- begin .modal-->
    <div class="modal" id="modalFormQuestion">
        <div class="modal__header">
            <div class="modal__title">
                <!-- begin .title-->
                <h2 class="title title_size_h3">Задать вопрос</h2>
                <!-- end .title-->
            </div>
            <div class="modal__text">Заполните форму, и наши специалисты ответят вам в течение 24 часов</div>
        </div>
        <div class="modal__content">
            <!-- begin .form-->
            <!-- Modifiers-->
            <!-- form_messages_shown - display the messages element. this will automatically display all the .form__message elements-->
            <form class="form form_spacing_s" action="/local/ajax/forms/askQuestion.php" data-form-ajax>
                <input type="hidden" name="PAGE_URL" value="<?= $_SERVER['REQUEST_URI'] ?>">
                <!-- messages can be placed before or after the form-->
                <div class="form__messages">
                    <!-- Modifiers-->
                    <!-- form__message_style_error - red color-->
                    <div class="form__message"></div>
                </div>
                <div class="form__main">
                    <div class="form__inputs">
                        <div class="form__line">
                            <!-- begin .form-control-->
                            <div class="form-control form-control_size_consistent">
                                <label class="form-control__holder">
                                    <span class="form-control__label">Ваше имя*</span>
                                    <span class="form-control__field">
                                        <!-- Modifiers-->
                                        <!-- form-control__input_state_invalid - red border, one of the two options to show invalid field-->
                                        <input type="text" name="NAME" class="form-control__input" required="required" />
                                    </span>
                                    <span class="form-control__messages">
                                        <span style="display: none" class="form-control__message form-control__message_style_error">
                                            Ошибка поля
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <!-- end .form-control-->
                        </div>
                        <div class="form__line">
                            <!-- begin .form-control-->
                            <div class="form-control form-control_size_consistent">
                                <label class="form-control__holder">
                                    <span class="form-control__label">E-mail*</span>
                                    <span class="form-control__field">
                                        <!-- Modifiers-->
                                        <!-- form-control__input_state_invalid - red border, one of the two options to show invalid field-->
                                        <input type="email" name="EMAIL" class="form-control__input" required="required" />
                                    </span>
                                    <span class="form-control__messages">
                                        <span style="display: none" class="form-control__message form-control__message_style_error">
                                            Ошибка поля
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <!-- end .form-control-->
                        </div>
                        <div class="form__line">
                            <!-- begin .form-control-->
                            <div class="form-control form-control_size_consistent">
                                <label class="form-control__holder">
                                    <span class="form-control__label">Вопрос*</span>
                                    <span class="form-control__field">
                                        <!-- Modifiers-->
                                        <!-- form-control__textarea_state_invalid - red border, one of the two options to show invalid field-->
                                        <textarea name="MESSAGE" class="form-control__textarea" required="required"></textarea>
                                    </span>
                                    <span class="form-control__messages">
                                        <span style="display: none" class="form-control__message form-control__message_style_error">
                                            Ошибка поля
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <!-- end .form-control-->
                        </div>
                    </div>
                    <div class="form__footer">
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
                        ); ?>
                        <div class="form__confirmation-check">
                            <!-- begin .check-elem-->
                            <div class="check-elem">
                                <input class="check-elem__input" id="suggestion" type="checkbox" name="suggestion" required />
                                <label for="suggestion" class="check-elem__label">
                                    Нажимая на кнопку, вы соглашаетесь с условиями обработки персональных
                                    данных.
                                </label>
                            </div>
                            <!-- end .ckeck-elem-->
                        </div>
                        <div class="form__controls">
                            <div class="form__control">
                                <!-- begin .button-->
                                <button class="button" type="submit">
                                    <span class="button__holder">Отправить</span>
                                </button>
                                <!-- end .button-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form__final">
                    <!-- begin .result-panel-->
                    <div class="result-panel"></div>
                    <!-- end .result-panel-->
                </div>
            </form>
            <!-- end .form-->
        </div>
    </div>
    <!-- end .modal-->
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
                <button class="button button_width_full js-fancybox-close" type="button">Хорошо</button>
            </div>
        </div>
    </div>
</div>
<? //Do not remove .page__sizer - used in extend() function in helpers.js, as well as lookbookSnippet() function in common.js
?>
<div class="page__container page__sizer"></div>

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

</html>