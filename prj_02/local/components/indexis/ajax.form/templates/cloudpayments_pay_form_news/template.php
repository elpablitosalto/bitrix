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

<section id="news-help" class="news-help">
    <div class="container">
        <form action="/index.php" method="" action="" autocomplete="off" class="site-form main-help-item bg-orange ajax-form-pay">
            <input type="hidden" name="form_id" value="<?= $arParams["FORM_ID"] ?>">
            <?= bitrix_sessid_post() ?>
            <div class="main-help-item__content">
                <div class="h4 main-help-item__title">Даже небольшое <span class="text-color-yellow">пожертвование может
                        изменить жизнь</span> одной семьи <span class="text-color-yellow">к лучшему</span> уже сегодня</div>
                <div class="form-group">
                    <div class="buttons-line sum-line">
                        <input id="mhi-2-1" type="radio" name="mhi-2" value="300" checked class="custom-radio">
                        <label for="mhi-2-1" class="btn btn-orange-light label-like-btn sum-button">300 ₽</label>
                        <input id="mhi-2-2" type="radio" name="mhi-2" value="500" class="custom-radio">
                        <label for="mhi-2-2" class="btn btn-orange-light label-like-btn sum-button">500 ₽</label>
                        <input id="mhi-2-3" type="radio" name="mhi-2" value="1000" class="custom-radio">
                        <label for="mhi-2-3" class="btn btn-orange-light label-like-btn sum-button">1 000 ₽</label>
                        <input type="text" id="amount-num" name="mhi-3" value="" placeholder="Другая сумма" data-mask="number" class="form-control form-control-sum">
                        <input type="hidden" name="PROPERTY_SUM" value="300">
                    </div>
                </div>
                <div class="form-group">
                    <div class="buttons-line submit-line">
                        <div class="form-personal-agreement">
                            <input id="mhi-5" type="checkbox" value="y" name="AGREEMENT" class="custom-checkbox">
                            <label for="mhi-5" class="custom-checkbox-label">
                                Соглашаюсь с <a href="/docs/oferta.pdf" class="text-color-yellow" target="_blank"><u>офертой</u></a> и на обработку моих <a href="/docs/politika_v_otnoshenii_obrabotki_pd.pdf" class="text-color-yellow" target="_blank"><u>персональных данных</u></a>
                            </label>
                        </div>
                        <button type="button" class="btn btn-white sumbit-btn sumbit-pay-form">Я хочу помочь
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow">
                                <use xlink:href="#arrow"></use>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="captcha-container-hidden" id="captcha-container-hidden">
                    </div>
                </div>
            </div>
            <div class="main-help-item__decor-bottom animate-svg-image">
                <?/*?><?xml version="1.0" encoding="utf-8"?><?*/ ?>
                <!-- Generator: Adobe Illustrator 24.1.2, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                <svg version="1.1" id="news-help-pattern" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 952 331.8" style="enable-background:new 0 0 952 331.8;" xml:space="preserve" width="952" height="331.8">
                    <style type="text/css">
                        .news-help-pattern__heart {
                            fill: none;
                            stroke: #FFE271;
                            stroke-width: 15;
                        }
                    </style>
                    <path class="news-help-pattern__heart" d="M2.4,299.8c0,0,265.8,89.8,508.2-74.3c76.7-52,113.9-112.8,108.2-167.9c-3.9-37.2-34.7-60.2-68.6-45.5
    c-26.5,11.5-36,56.4-36,56.4s-34.7-13.2-54.4,8.3c-11.1,12.2-20.9,34.3-2,62.1c48.1,71,272.2,47.1,363.4,17.8
	c91.2-29.3,124.4-85.4,124.4-85.4" />
                </svg>

            </div>
            <div class="main_error"></div>
            <div class="msg"></div>
        </form>
    </div>
</section>