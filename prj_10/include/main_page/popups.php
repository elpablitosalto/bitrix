<?php
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>
<div class="ml-modals">

    <?
    // Регистрация на конкурс -->
    $APPLICATION->IncludeComponent(
        "indexis:modal.contest.reg",
        ".default",
        array(
            "CACHE_TIME" => 3600,
            "CACHE_TYPE" => "A",
            "CONTEST_REG_IBLOCK_CODE" => $GLOBALS["arSiteConfig"]["arIblockCodes"]["PARTICIPANTS_WORKS"],
            "MODAL_DIV_ID" => $GLOBALS["arSiteConfig"]["arModalsParams"]["modal_contest_registration_id"],
            "URL_PRIVACY_POLICY" => URL_PRIVACY_POLICY,
            "CONTEST_ELEMENT_ID" => $GLOBALS["CONTEST_ELEMENT_ID"],
            "ANCHOR_TO_CONTEST_RULES" => $GLOBALS["arSiteConfig"]["arContestParams"]["ANCHOR_TO_CONTEST_RULES"],
        )
    );
    // <-- Регистрация на конкурс
    ?>

    <?
    // Слайдшоу работ победителей конкурса -->
    $APPLICATION->IncludeComponent(
        "indexis:modal.contest.works.slides",
        "winners",
        array(
            "CACHE_TIME" => 3600,
            "CACHE_TYPE" => "A",
            "CONTEST_WORKS_IBLOCK_CODE" => $GLOBALS["arSiteConfig"]["arIblockCodes"]["PARTICIPANTS_WORKS"],
            "CONTESTS_IBLOCK_CODE" => $GLOBALS["arSiteConfig"]["arIblockCodes"]["CONTESTS"],
            "CONTEST_ELEMENT_ID" => $GLOBALS["CONTEST_ELEMENT_ID"],
            "WINNERS" => "Y",
            "MODE" => "WINNERS",
        )
    );
    // <-- Слайдшоу работ победителей конкурса
    

    // Слайдшоу работ участников конкурса -->
    $APPLICATION->IncludeComponent(
        "indexis:modal.contest.works.slides",
        "participants",
        array(
            "CACHE_TIME" => 3600,
            "CACHE_TYPE" => "A",
            "CONTEST_WORKS_IBLOCK_CODE" => $GLOBALS["arSiteConfig"]["arIblockCodes"]["PARTICIPANTS_WORKS"],
            "CONTESTS_IBLOCK_CODE" => $GLOBALS["arSiteConfig"]["arIblockCodes"]["CONTESTS"],
            "CONTEST_ELEMENT_ID" => $GLOBALS["CONTEST_ELEMENT_ID"],
            "WINNERS" => "N",
            "MODE" => "PARTICIPANTS",
        )
    );
    // <-- Слайдшоу работ участников конкурса
    

    // Слайдшоу работ победителей всех конкурсов -->
    $APPLICATION->IncludeComponent(
        "indexis:modal.contest.works.slides",
        "winners",
        array(
            "CACHE_TIME" => 3600,
            "CACHE_TYPE" => "A",
            "CONTEST_WORKS_IBLOCK_CODE" => $GLOBALS["arSiteConfig"]["arIblockCodes"]["PARTICIPANTS_WORKS"],
            "CONTESTS_IBLOCK_CODE" => $GLOBALS["arSiteConfig"]["arIblockCodes"]["CONTESTS"],
            //"CONTEST_ELEMENT_ID" => $GLOBALS["CONTEST_ELEMENT_ID"],
            "WINNERS" => "Y",
            "MODE" => "ALL_WINNERS",
            "SHOW_ALL_WINNERS" => $GLOBALS["MODAL_ALL_WINNERS"],
        )
    );
    // <-- Слайдшоу работ победителей всех конкурсов
    

    // Слайдшоу работ текущего пользователя -->
    $APPLICATION->IncludeComponent(
        "indexis:modal.contest.works.slides",
        "participants",
        array(
            "CACHE_TIME" => 3600,
            "CACHE_TYPE" => "A",
            "CONTEST_WORKS_IBLOCK_CODE" => $GLOBALS["arSiteConfig"]["arIblockCodes"]["PARTICIPANTS_WORKS"],
            "CONTESTS_IBLOCK_CODE" => $GLOBALS["arSiteConfig"]["arIblockCodes"]["CONTESTS"],
            //"CONTEST_ELEMENT_ID" => $GLOBALS["CONTEST_ELEMENT_ID"],
            "WINNERS" => "N",
            "MODE" => "CURRENT_USER",
            "SHOW_WORKS_CURRENT_USER" => $GLOBALS["MODAL_SHOW_WORKS_CURRENT_USER"],
            "USER_ID" => $USER->GetID(),
        )
    );
    // <-- Слайдшоу работ текущего пользователя
    ?>

    <? /* Регистрация */?>
    <div class="ml-modal ml-modal-registration" id="modal-registration">
        <div class="ml-modal__overlay"></div>
        <div class="ml-modal__dialog">
            <div class="ml-modal__header">
                <h3 class="ml-modal__title">Регистрация</h3>
                <button class="ml-modal__close" type="button">
                    <svg class="icon icon-close ">
                        <use xlink:href="#close"></use>
                    </svg>
                </button>
            </div>
            <div class="ml-modal__body">
                <p>Для регистрации используйте социальные сети</p>
                <form class="ml-form ml-form-registration" id="form-registration" method="post" action="#">
                    <div class="ml-form__body">
                        <div class="ml-social-auth">
                            <ul class="ml-social-auth__list">
                                <li class="ml-social-auth__item"><a class="ml-social-auth__link" href="#">
                                        <svg class="icon icon-vk ">
                                            <use xlink:href="#vk"></use>
                                        </svg></a></li>
                                <li class="ml-social-auth__item"><a class="ml-social-auth__link" href="#">
                                        <svg class="icon icon-ok ">
                                            <use xlink:href="#ok"></use>
                                        </svg></a></li>
                                <li class="ml-social-auth__item"><a class="ml-social-auth__link" href="#">
                                        <svg class="icon icon-yandex ">
                                            <use xlink:href="#yandex"></use>
                                        </svg></a></li>
                                <li class="ml-social-auth__item"><a class="ml-social-auth__link" href="#">
                                        <svg class="icon icon-sber ">
                                            <use xlink:href="#sber"></use>
                                        </svg></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="ml-form__footer">
                        <div class="ml-form-field ml-agreement-checkbox">
                            <input id="registration-agreement" type="checkbox" checked>
                            <label for="registration-agreement"><span>Согласие с политикой
                                    конфиденциальности</span></label>
                            <p>При регистрации вы соглашаетесь с <a href="#" target="_blank">политикой
                                    конфиденциальности</a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <? /* End Регистрация */?>


    <? /* Вход в личный кабинет */?>
    <div class="ml-modal ml-modal-auth" id="modal-auth">
        <div class="ml-modal__overlay"></div>
        <div class="ml-modal__dialog">
            <div class="ml-modal__header">
                <h3 class="ml-modal__title">Вход в личный кабинет</h3>
                <button class="ml-modal__close" type="button">
                    <svg class="icon icon-close ">
                        <use xlink:href="#close"></use>
                    </svg>
                </button>
            </div>
            <div class="ml-modal__body">
                <p>Для входа используйте социальные сети</p>
                <form class="ml-form ml-form-auth" id="form-auth" method="post" action="#">
                    <div class="ml-form__body disable_href_click_form">
                        <? $APPLICATION->IncludeFile(
                            SITE_DIR . 'local/core/socialservices/auth.php',
                            [],
                            ['SHOW_BORDER' => false]
                        ); ?>

                        <div class="social_auth_error">
                            Необходимо принять соглашение о политике конфиденциальности.
                        </div>
                        <div class="ml-form__footer">
                            <div class="ml-form-field ml-agreement-checkbox js--auth_check_politic_agreement">
                                <input id="auth-agreement" name="privacyPolicy" type="checkbox">
                                <label for="auth-agreement">
                                    <span>Согласие с политикой конфиденциальности</span>
                                </label>
                                <p>При регистрации вы соглашаетесь с
                                    <a href="#" target="_blank">политикой конфиденциальности</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <? /* End Вход в личный кабинет */?>


    <? /* Изменить ник */?>
    <div class="ml-modal ml-modal-edit-nickname" id="modal-edit-nickname">
        <div class="ml-modal__overlay"></div>
        <div class="ml-modal__dialog">
            <div class="ml-modal__header">
                <h3 class="ml-modal__title">Изменить ник</h3>
                <button class="ml-modal__close" type="button">
                    <svg class="icon icon-close ">
                        <use xlink:href="#close"></use>
                    </svg>
                </button>
            </div>
            <div class="ml-modal__body">
                <form class="ml-form ml-form-edit-nickname" id="form-edit-nickname" method="post" action="#">
                    <div class="ml-form__body">
                        <div class="ml-form-field ml-form-field_text">
                            <input type="text" name="nickname" placeholder="Введите ник" required
                                <? if (intval(LOGIN_MAX_LENGTH) > 0) { ?> maxlength="<?= LOGIN_MAX_LENGTH; ?>" <? } ?>>
                        </div>
                        <div class="ml-form-step__error"></div>
                    </div>
                    <div class="ml-form__footer">
                        <button class="ml-btn ml-btn_round ml-form__submit" type="submit">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="ml-modal ml-modal-edit-nickname-success" id="modal-edit-nickname-success">
        <div class="ml-modal__overlay"></div>
        <div class="ml-modal__dialog">
            <div class="ml-modal__header">
                <h3 class="ml-modal__title">Ник успешно изменен</h3>
                <button class="ml-modal__close" type="button">
                    <svg class="icon icon-close ">
                        <use xlink:href="#close"></use>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <? /* End Изменить ник */?>


    <? /* Изменить аватар */?>
    <div class="ml-modal ml-modal-edit-avatar" id="modal-edit-avatar">
        <div class="ml-modal__overlay"></div>
        <div class="ml-modal__dialog">
            <div class="ml-modal__header">
                <h3 class="ml-modal__title">Изменить аватар</h3>
                <button class="ml-modal__close" type="button">
                    <svg class="icon icon-close ">
                        <use xlink:href="#close"></use>
                    </svg>
                </button>
            </div>
            <div class="ml-modal__body">
                <form class="ml-form ml-form-edit-avatar" id="form-edit-avatar" method="post" action="#">
                    <div class="ml-form__body">
                        <div class="ml-form-field ml-form-field_text">
                            <input type="file" name="avatar" placeholder="Загрузите файл аватара" required="">
                        </div>
                        <div class="ml-form-step__error"></div>
                    </div>
                    <div class="ml-form__footer">
                        <button class="ml-btn ml-btn_round ml-form__submit" type="submit">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <? /* End Изменить аватар */?>


    <? /* Аватар успешно изменен */?>
    <div class="ml-modal ml-modal-edit-avatar-success" id="modal-edit-avatar-success">
        <div class="ml-modal__overlay"></div>
        <div class="ml-modal__dialog">
            <div class="ml-modal__header">
                <h3 class="ml-modal__title">Аватар успешно изменен</h3>
                <button class="ml-modal__close" type="button">
                    <svg class="icon icon-close ">
                        <use xlink:href="#close"></use>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <? /* End Аватар успешно изменен */?>

</div>