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

<section id="projects-detail-help" class="projects-detail-help">
    <div class="container">
        <form method="" action="/index.php" autocomplete="off" class="site-form main-help-item bg-orange ajax-form-pay">
            <input type="hidden" name="form_id" value="<?= $arParams["FORM_ID"] ?>">
            <?= bitrix_sessid_post() ?>
            <div class="main-help-item__content">
                <div class="h3 main-help-item__title"><?= ($arParams["CUSTOM_NAME"]) ? $arParams["CUSTOM_NAME"] : "Поддержать проект"; ?></div>
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
                    <input type="text" name="PROPERTY_EMAIL" value="" placeholder="Ваш E-mail *" required class="form-control transparent">
                </div>
                <div class="form-personal-agreement">
                    <input id="mhi-5" type="checkbox" value="y" name="AGREEMENT" class="custom-checkbox">
                    <label for="mhi-5" class="custom-checkbox-label">
                        Соглашаюсь с <a href="/docs/oferta.pdf" class="text-color-yellow" target="_blank"><u>офертой</u></a> и на обработку моих <a href="/docs/politika_v_otnoshenii_obrabotki_pd.pdf" class="text-color-yellow" target="_blank"><u>персональных данных</u></a>
                    </label>
                    <br /><br />
                </div>
                <div class="form-group">
                    <div class="buttons-line">
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
                <svg width="866" id="projects-detail-help-decor" height="403" viewBox="0 0 866 403" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="projects-detail-help-decor__ground" d="M944.794 256.251C842.388 209.316 692.994 188.849 530.406 207.125C355.859 226.746 105.111 340.438 17.4428 416.289M885.021 233.518C668.942 165.975 356.141 363.002 268.473 438.854" stroke="#FFE271" stroke-width="15" />
                    <path class="projects-detail-help-decor__trees" d="M382.791 354.71L379.736 335.125M379.736 335.125C347.112 315.406 350.564 289.81 372.804 262.722C396.736 285.328 407.365 308.105 379.736 335.125Z" stroke="#FFE271" stroke-width="15" />
                    <path class="projects-detail-help-decor__home" d="M578.049 203.162L578.049 97.2741M745.459 201.468C745.459 167.275 745.459 97.2741 745.459 97.2741M633.852 199.783L633.852 118.428L689.656 118.428L689.656 199.783M445.572 219.358L443.877 199.773M443.877 199.773C411.253 180.054 414.705 154.458 436.945 127.37C461.337 145.637 471.506 172.753 443.877 199.773Z" stroke="#FFE271" stroke-width="15" />
                    <path class="projects-detail-help-decor__roof" d="M551.435 116.135L661.926 24.785L703.115 58.8384M772.417 116.135L737.01 86.8616M703.115 58.8384L703.115 24.785L737.01 24.785L737.01 86.8616M703.115 58.8384L737.01 86.8616" stroke="#FFE271" stroke-width="15" />
                    <path class="projects-detail-help-decor__bird" d="M48.625 144C59.6909 148.574 70.2537 157.213 77.2957 175C100.433 160.262 123.068 164.328 132.625 166.869" stroke="#FFE271" stroke-width="15" />
                </svg>

            </div>
            <div class="main_error"></div>
            <div class="msg"></div>
        </form>
    </div>
</section>