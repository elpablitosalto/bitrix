<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
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

// JS -->
{
    $script_url = $_SERVER["DOCUMENT_ROOT"] . "/" . $templateFolder . "/script_custom.js";
    $script_url = str_replace("//", "/", $script_url);
    if (is_file($script_url)) {
        $script_content = file_get_contents($script_url);
        ?>
        <script type="text/javascript">
            <? echo $script_content; ?>
        </script>
    <?
    }
}
// <-- JS

// Hiddens -->
{
    ?>
    <input id="MODAL_CONTEST_WORKS_SLIDES_AJAX_PATH" type="hidden" value="<? echo $componentPath . "/ajax.php"; ?>" />
    <?
}
// <-- Hiddens



//echo "arContestWorks:";echo "<pre>";print_r($arResult["arContestWorks"]);echo "</pre>";
?>
<div class="ml-modal ml-modal-work" id="<?= $arResult["slideshowBlockId"]; ?>">
    <div class="ml-modal__overlay"></div>
    <div class="ml-modal__dialog">
        <div class="ml-modal__header">
            <button class="ml-modal__close" type="button">
                <svg class="icon icon-close ">
                    <use xlink:href="#close"></use>
                </svg>
            </button>
        </div>
        <div class="ml-modal__body">
            <div class="ml-works <? /*?>ml-works-slider<?*/?> js-ml-works-slider-winners-custom">
                <div class="ml-works-slider__container">
                    <div class="ml-works-slider__list">
                        <?
                        $i = 0;
                        foreach ($arResult["arContestWorks"] as $key => $ar_work) {
                            $i++;
                            ?>
                            <div class="ml-works-slider__item"
                                <?/*?>id="works_slider_item_<?= $ar_work["ELEMENT_ID"]; ?>"<?*/?>
                                data-elid="<?= $ar_work["ELEMENT_ID"]; ?>" data-slideind="<?= $i; ?>">
                                <div class="ml-work">
                                    <div class="ml-work__img"><img src="<?= $ar_work["PREVIEW_PICTURE_PATH"]; ?>" alt="">
                                    </div>
                                    <div class="ml-work__caption">
                                        <div class="ml-work__meta">
                                            <h3 class="ml-work__title">
                                                <?= $ar_work["CONTEST_NAME"]; ?>
                                            </h3>
                                            <h4 class="ml-work__participant">
                                                <?= $ar_work["PARTICIPANT_FULL_NAME"]; ?>
                                            </h4>
                                            <p class="ml-work__voting">Голосов:
                                                <?= $ar_work["COUNT_VOTES"]; ?>
                                            </p>
                                            <?
                                            if ($ar_work["SHOW_B_UPLOAD_WITH_PRIZE"] == "Y") {
                                                ?>
                                                <button class="ml-btn ml-btn_round ml-work__upload-btn" type="button"
                                                    data-modal="#modal-upload-photo">Загрузить фото с призом</button>
                                            <?
                                            }
                                            ?>
                                        </div>
                                        <div class="ml-work__desc">
                                            <p>
                                                <?= $ar_work["DESCRIPTION"]; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="ml-modal ml-modal-upload-photo" id="<?= $arResult["uploadPhotoBlockId"]; ?>">
    <div class="ml-modal__overlay"></div>
    <div class="ml-modal__dialog">
        <div class="ml-modal__header">
            <h3 class="ml-modal__title">Загрузить фото с призом</h3>
            <button class="ml-modal__close" type="button">
                <svg class="icon icon-close ">
                    <use xlink:href="#close"></use>
                </svg>
            </button>
        </div>
        <div class="ml-modal__body">
            <form class="ml-form ml-form-upload-photo" id="form-upload-photo" method="post" action="#">
                <?
                // Form Hiddens -->
                ?>
                <input name="IBLOCK_CODE" type="hidden" value="<? echo $arResult["CONTEST_WORKS_IBLOCK_CODE"]; ?>" />
                <input name="SEND_FORM" type="hidden" value="Y" />
                <input name="USER_ID" type="hidden" value="<? echo $arResult["USER_ID"]; ?>" />
                <input name="PHOTO_PRIZE_UPLOAD_FILE_NAME" id="PHOTO_PRIZE_UPLOAD_FILE_NAME" type="hidden" value="" />
                <input name="CONTEST_ELEMENT_ID" type="hidden"
                    value="<? echo $arResult["arContest"]["ELEMENT_ID"]; ?>" />
                <input name="CUR_WORK_ELEMENT_ID" id="CUR_WORK_ELEMENT_ID" type="hidden" value="" />
                <?
                // <-- Form Hiddens
                ?>
                <div class="ml-form__body">
                    <div class="ml-form-field">
                        <div class="ml-dropzone ml-dropzone_required js-ml-dropzone-photo-prize"
                            id="photo-prize-upload-photo-dropzone" data-error="Необходимо загрузить фото работы">
                            <div class="ml-dropzone-desc"><span class="color_dark-blue">Перетащите файл сюда или <span
                                        class="color_orange">выберите файл</span></span><span
                                    class="color_grey">Допустимый формат JPEG, JPG, PNG, вес до 10 мб</span></div>
                            <div class="fallback">
                                <input type="file" name="file">
                            </div>
                        </div>
                    </div>
                    <div id="<?= $arResult["uploadPhotoErrorBlockId"]; ?>" style="display: none; color: red;">
                    </div>
                    <div><br /></div>
                </div>
                <div class="ml-form__footer">
                    <button
                        class="ml-btn ml-btn_round ml-btn_anim-submit js-ml-btn_submit js_ml_btn_submit_photo_with_prize"
                        type="submit" data-start-text="Отправить" data-proccessing-text="Отправяется"
                        data-complete-text="Отправлено"><span>Отправить</span></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="ml-modal ml-modal-success modal-upload-photo-success" id="<?= $arResult["uploadPhotoSuccessBlockId"]; ?>">
    <div class="ml-modal__overlay"></div>
    <div class="ml-modal__dialog">
        <div class="ml-modal__header">
            <h3 class="ml-modal__title">Фото успешно отправлено</h3>
            <button class="ml-modal__close" type="button">
                <svg class="icon icon-close ">
                    <use xlink:href="#close"></use>
                </svg>
            </button>
        </div>
    </div>
</div>