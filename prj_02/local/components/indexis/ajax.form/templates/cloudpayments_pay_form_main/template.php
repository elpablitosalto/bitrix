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

<form class="ajax-form-pay">
    <input type="hidden" name="form_id" value="<?= $arParams["FORM_ID"] ?>">
    <?= bitrix_sessid_post() ?>
    <div class="site-form list-item main-help-item bg-orange">
        <div class="main-help-item__content">
            <div class="h5 main-help-item__title">Даже небольшое <span class="text-color-yellow">пожертвование может изменить жизнь</span><br>одной
                семьи <span class="text-color-yellow">к лучшему</span> уже сегодня
            </div>
            <div class="form-group">
                <div class="buttons-line periodicity-line">
                    <? $selected = false; ?>
                    <? foreach ($arResult["ENUMS"]["TYPE"] as $arEnum) { ?>
                        <input id="ui-cr-<?= $arEnum["ID"] ?>" type="radio" class="custom-radio" name="PROPERTY_TYPE" value="<?= $arEnum["ID"] ?>" <? if (!$selected) {
                                                                                                                                                        echo " checked";
                                                                                                                                                        $selected = true;
                                                                                                                                                    } ?> class="custom-radio">
                        <label for="ui-cr-<?= $arEnum["ID"] ?>" class="btn btn-orange-light label-like-btn"><?= $arEnum["VALUE"] ?></label>
                    <? } ?>
                </div>
            </div>
            <div class="form-group">
                <div class="buttons-line sum-line">
                    <input id="mhi-2-1" type="radio" name="mhi-2" value="300" checked class="custom-radio">
                    <label for="mhi-2-1" class="btn btn-orange-light label-like-btn sum-button">300
                        ₽</label>
                    <input id="mhi-2-2" type="radio" name="mhi-2" value="500" class="custom-radio">
                    <label for="mhi-2-2" class="btn btn-orange-light label-like-btn sum-button">500
                        ₽</label>
                    <input id="mhi-2-3" type="radio" name="mhi-2" value="1000" class="custom-radio">
                    <label for="mhi-2-3" class="btn btn-orange-light label-like-btn sum-button">1
                        000 ₽</label>
                    <input type="text" id="amount-num" name="mhi-3" value="" placeholder="Другая сумма" data-mask="number" class="form-control form-control-sum">
                    <input type="hidden" name="PROPERTY_SUM" value="300">
                </div>
            </div>
            <div class="form-group">
                <div class="captcha-container-hidden" id="captcha-container-hidden">
                </div>
            </div>
            <div class="form-personal-agreement">
                <input id="mhi-5" type="checkbox" value="y" name="AGREEMENT" class="custom-checkbox">
                <label for="mhi-5" class="custom-checkbox-label">Соглашаюсь с <a href="/docs/oferta.pdf" class="text-color-yellow" target="_blank"><u>офертой</u></a> и на обработку моих <a href="/docs/politika_v_otnoshenii_obrabotki_pd.pdf" class="text-color-yellow" target="_blank"><u>персональных данных</u></a></label>
            </div>
        </div>
        <div class="main-help-item__nav">
            <div class="buttons-line">
                <button type="button" class="btn btn-white sumbit-pay-form">Я хочу помочь
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow">
                        <use xlink:href="#arrow"></use>
                    </svg>
                </button>
            </div>
        </div>
        <div class="main-help-item__decor-bottom">
            <svg version="1.1" id="main-help-decor-home" class="main-help-decor-bg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1118 263.6" style="enable-background:new 0 0 1118 263.6;" xml:space="preserve" width="1118" height="263.6">
                <style type="text/css">
                    .main-help-decor-home {
                        fill-rule: evenodd;
                        clip-rule: evenodd;
                        fill: #FFE271;
                    }
                </style>
                <path class="main-help-decor-home" d="M870.2,43.9L928,0l60.9,39.6l1.5,41.3c12.9,0.3,25.2,0.8,36.6,1.5c27.5,1.6,50.2,4.1,66.1,6.1
	c7.9,1,14.1,1.9,18.4,2.6c2.1,0.3,3.7,0.6,4.8,0.8c0.2,0,0.3,0.1,0.5,0.1c0.3,0.1,0.6,0.1,0.8,0.1c0.1,0,0.3,0,0.3,0.1l0.1,0l0,0
	l0,0c0,0,0,0-1.2,7.3c-1.3,7.3-1.3,7.3-1.3,7.3l0,0l-0.1,0c-0.1,0-0.2,0-0.3-0.1c-0.3,0-0.6-0.1-1.2-0.2c-1-0.2-2.6-0.4-4.7-0.8
	c-4.1-0.6-10.2-1.5-17.9-2.6c-15.5-2-37.9-4.4-65-6c-16.1-1-34-1.6-53.1-1.8l-83.9,3.1c-21.8,1.8-44.4,4.5-67.2,8.3
	c-100,16.8-191.2,44.9-280.6,72.5l-0.9,0.3l-1.4,0.4c-1.7,0.5-3.4,1.1-5.2,1.6c-91.6,28.3-181.5,55.6-276.2,68.4
	C178.4,261,114,263.6,69.5,263.6c-22.3,0-39.6-0.7-51.4-1.4c-5.9-0.3-10.4-0.7-13.4-1c-1.5-0.1-2.7-0.2-3.5-0.3
	c-0.4,0-0.7-0.1-0.9-0.1c-0.1,0-0.2,0-0.2,0l-0.1,0l0,0c0,0,0,0,0.7-7.4c0.7-7.4,0.7-7.4,0.7-7.4l0,0c0,0,0.1,0,0.2,0
	c0.2,0,0.4,0,0.8,0.1c0.7,0.1,1.8,0.2,3.3,0.3c2.9,0.3,7.3,0.6,13,0.9c11.5,0.7,28.5,1.4,50.5,1.4c43.9,0.1,107.6-2.6,186.3-13.2
	c93.3-12.6,182-39.6,273.8-67.9c2.6-0.8,5.2-1.6,7.8-2.4c89.1-27.5,181.2-55.9,282.2-72.9c17.7-3,35.2-5.3,52.3-7L870.2,43.9z
	 M885.9,50.1l42.8-32.5l45,29.3l1.2,33.7c-27.1-0.2-56.7,0.6-87.8,3.2L885.9,50.1z" />
            </svg>
            <svg version="1.1" id="main-help-decor-bird" class="main-help-decor-element" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 65 36.1" style="enable-background:new 0 0 65 36.1;" xml:space="preserve" width="65" height="36.1" data-sy="70%" data-sx="25%" data-ey="20%" data-ex="70%">
                <style type="text/css">
                    .main-help-decor-bird {
                        fill: #FFE271;
                    }
                </style>
                <path class="main-help-decor-bird" d="M61,12.2h0.1l0,0l0,0l3.9-0.9L61.9,0l-3.8,0.9C57.7,1,53,2.1,47,5.2c-4.2,2.2-9.6,6.2-14.5,11.5
	c-5-5.2-10.4-9.3-14.5-11.5C12,2.1,7.3,1,6.9,0.9L3.1,0L0,11.3l3.9,0.9c0.2,0,3.7,0.9,8.1,3.3c4.3,2.3,10.5,6.4,15.3,13.2l5.2,7.4
	l5.2-7.4c4.8-6.8,10.9-10.9,15.3-13.2c2.3-1.2,4.4-2,5.9-2.6c0.7-0.3,1.3-0.4,1.7-0.5C60.8,12.2,60.9,12.2,61,12.2z" />
            </svg>

        </div>
    </div>

    <div class="main_error"></div>
    <div class="msg"></div>

</form>