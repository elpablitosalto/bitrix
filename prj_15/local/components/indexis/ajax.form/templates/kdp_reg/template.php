<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>


<div class="dp-top-3-check-list-section dp-top-3-check-list-section-1">
    <div class="dp-top-3-check-list">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="dp-top-3-check-list__wrapper">
                        <p class="dp-top-3-check-list__title">После регистрации<br>на&nbsp;мастер-класс<br>вы&nbsp;получите<br><span style="color:#d4b171;">чек-лист</span></p>
                        <p class="dp-top-3-check-list__desc">и сможете уже применять<br>советы по общению с трудным пациентом<br>на практике</p>
                    </div>
                </div>
                <div class="col-md-5">
                    <form class="dp-form dp-mc-reg-form ajax-form" action="">
                        <input type="hidden" name="form_id" value="<?= $arParams["FORM_ID"] ?>">
                        <?= bitrix_sessid_post() ?>
                        <div class="dp-form__header">
                            <p>Зарегистрируйтесь <br>на&nbsp;бесплатный мастер-класс <br>28.01.2024
                            </p>
                        </div>
                        <div class="dp-form__body">
                            <div class="row">
                                <div class="col-12 col-time">
                                    <p class="dp-field__title">Выберите удобное время просмотра</p>
                                    <?foreach($arResult["ENUMS"]["TIME"] as $arEnum){?>
                                        <div class="dp-field">
                                            <input id="mcrf-1-time-<?=$arEnum["ID"]?>" value="<?=$arEnum["ID"]?>" type="checkbox" name="PROPERTY_TIME[]" wfd-id="id<?=$arEnum["ID"]?>">
                                            <label for="mcrf-1-time-<?=$arEnum["ID"]?>"><?=$arEnum["VALUE"]?></label>
                                        </div>
                                    <?}?>
                                </div>
                                <div class="col-12">
                                    <div class="dp-field">
                                        <input type="email" name="PROPERTY_EMAIL" placeholder="E-mail" required="" wfd-id="id15">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="dp-field">
                                        <input type="text" name="PROPERTY_NAME" placeholder="Имя" required="" wfd-id="id16">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="dp-field">
                                        <p class="dp-field__title">Специальность</p>
                                        <div class="selectric-wrapper selectric-dp-form-select">
                                            <div class="selectric">
                                                <select class="dp-form-select" name="PROPERTY_SPECIALITY" required="" tabindex="-1">
                                                    <?foreach($arResult["ENUMS"]["SPECIALITY"] as $arEnum){?>
                                                        <option value="<?=$arEnum["UF_XML_ID"]?>"><?=$arEnum["UF_NAME"]?></option>
                                                    <?}?>
                                                </select>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="dp-field">
                                        <div class="iti iti--allow-dropdown iti--separate-dial-code"><div class="iti__flag-container"><div class="iti__selected-flag" role="combobox" aria-controls="iti-2__country-listbox" aria-owns="iti-2__country-listbox" aria-expanded="false" tabindex="0" title="Russia (Россия): +7" aria-activedescendant="iti-2__item-ru-preferred"><div class="iti__flag iti__ru"></div><div class="iti__selected-dial-code">+7</div><div class="iti__arrow"></div></div></div><input class="iti-input js-iti-input" type="tel" name="tel" autocomplete="off" data-intl-tel-input-id="2" placeholder="+7 (___) ___-__-__" wfd-id="id18" style="padding-left: 52px;"><input name="tel" type="hidden" wfd-id="id19"><input type="hidden" name="fullNumber" wfd-id="id20"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="dp-btn dp-form__submit" type="submit">Зарегистрироваться</button>
                                </div>
                                    <div class="main_error"></div>
                                    <div class="msg"></div>
                            </div>
                        </div>
                        <div class="dp-form__footer">
                            <div class="dp-field dp-field_agreement">
                                <input id="mcrf-1-agreement" type="checkbox" name="PROPERTY_SOGL" value="Y">
                                <label for="mcrf-1-agreement"></label><span>Я согласен на&nbsp;обработку моих персональных данных в&nbsp;соответствии с&nbsp;<a href="/privacy/" target="_blank">Договором оферты</a> и&nbsp;<a href="/privacy/" target="_blank">Политикой Конфиденциальности</a></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
