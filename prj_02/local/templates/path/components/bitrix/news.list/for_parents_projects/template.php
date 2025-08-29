<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Grid\Declension;

?>
<? if (!empty($arResult["ITEMS"])) { ?>


    <section class="wrapper rs__projects">
        <div class="container">
            <div class="rs__content">
                <div class="rs__content--top">
                    <h3 class="rs__section--title">Вас могут заинтересовать проекты</h3>
                </div>
                <div class="rs__projects--block">
                    <? foreach ($arResult["ITEMS"] as $num => $item) { ?>
                        <?
                        $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <div class="rs__projects--item" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                            <div class="rs__projects--box">
                                <div class="rs__projects--content">
                                    <? if ($num % 2 == 0) { ?>
                                        <? if ($item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"]) { ?>
                                            <picture class="rs__projects--pic">
                                                <img src="<?= $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] ?>"
                                                     alt="<?= $item["PREVIEW_PICTURE"]["ALT"] ?>"
                                                     title="<?= $item["PREVIEW_PICTURE"]["TITLE"] ?>"
                                                     class="rs__projects--img">
                                            </picture>
                                        <? } ?>
                                    <? } ?>
                                    <div class="rs__projects--info">
                                        <div class="rs__projects--title"><a href="<?=$item["DETAIL_PAGE_URL"]?>"><?= $item["NAME"] ?></a></div>
                                        <div class="rs__projects--text"><?= $item["PREVIEW_TEXT"] ?>
                                        </div>
                                        <? if (!empty($item["DISPLAY_PROPERTIES"]["BENEFICIARY_TYPE"]["DISPLAY_VALUE"])) { ?>
                                            <div class="rs__label">
                                                <div class="rs__label--box">
                                                    <? foreach ($item["DISPLAY_PROPERTIES"]["BENEFICIARY_TYPE"]["DISPLAY_VALUE"] as $dispVal) { ?>
                                                        <div class="rs__label--item"><?= $dispVal ?></div>
                                                    <? } ?>
                                                </div>
                                            </div>
                                        <? } ?>
                                    </div>
                                    <? if ($num % 2 != 0) { ?>
                                        <? if ($item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"]) { ?>
                                            <picture class="rs__projects--pic rs__projects--pic-bg">
                                                <img src="<?= $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] ?>"
                                                     alt="<?= $item["PREVIEW_PICTURE"]["ALT"] ?>"
                                                     title="<?= $item["PREVIEW_PICTURE"]["TITLE"] ?>"
                                                     class="rs__projects--img">
                                            </picture>
                                        <? } ?>
                                    <? } ?>
                                </div>
                            </div>
                        </div>
                    <? } ?>
                </div>
                <div class="rs__button__group rs__section--nav">
                    <a class="rs__button__default rs__button--icon ico-arrow-main rs__button--icon-right"
                       href="/projects/">Показать все проекты</a>
                </div>
            </div>
        </div>
    </section>

<? } ?>


