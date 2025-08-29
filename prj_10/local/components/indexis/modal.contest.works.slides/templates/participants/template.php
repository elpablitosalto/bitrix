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
global $USER;

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
    /*
    ?>
    <input id="MODAL_CONTEST_WORKS_SLIDES_AJAX_PATH" type="hidden" value="<? echo $componentPath . "/ajax.php"; ?>" />
    <?
    */
}
// <-- Hiddens

//echo "arContestWorks:";echo "<pre>";print_r($arResult["arContestWorks"]);echo "</pre>";
?>
<div class="ml-modal ml-modal-work modal-work-simple" id="<?= $arResult["slideshowBlockId"]; ?>">
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
            <div class="ml-works <?/*?>ml-works-slider<?*/?> js-ml-works-slider-custom">
                <div class="ml-works-slider__container">
                    <div class="ml-works-slider__list">
                        <?
                        $i = 0;
                        foreach ($arResult["arContestWorks"] as $key => $ar_work) {
                            $i++;
                            ?>
                            <div class="ml-works-slider__item" data-elid="<?= $ar_work["ELEMENT_ID"]; ?>"
                                data-slideind="<?= $i; ?>">
                                <div class="ml-work">
                                    <div class="ml-work__img"><img src="<?= $ar_work["PREVIEW_PICTURE_PATH"]; ?>" alt=""></div>
                                    <div class="ml-work__caption">
                                        <div class="ml-work__meta">
                                            <?/*<h3 class="ml-work__title"><?= $ar_work["CONTEST_NAME"]; ?></h3>*/?>
                                            <?if($ar_work["DESCRIPTION"]):?><p><?=$ar_work["DESCRIPTION"];?></p><?endif;?>
                                            <h4 class="ml-work__participant"><?= $ar_work["PARTICIPANT_FULL_NAME"]; ?></h4>
                                            <p class="ml-work__voting">Голосов: <?= $ar_work["COUNT_VOTES"]; ?></p>
                                            <?if ($USER->IsAdmin()):?>
                                            <p>ID: <?=$ar_work["ELEMENT_ID"];?></p>
                                            <?endif;?>
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