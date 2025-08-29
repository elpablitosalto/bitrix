<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>


<? foreach ($arResult["ITEMS"] as $arItem): ?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>

    <div class="dp-slider__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
        <div class="dp-blog-item">
            <a class="dp-blog-item__link" href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                <? if (isset($arItem["PREVIEW_PICTURE"]["SRC"])) { ?>
                    <div class="dp-blog-item__img">
                        <img
                                src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                        >
                    </div>
                <? } ?>

                <div class="dp-blog-item__caption">
                    <div class="dp-blog-item__tags">
                        <span class="dp-blog-item__tag dp-blog-item__category">Запись вебинара</span>
                    </div>
                    <h3 class="dp-blog-item__title"><?= $arItem["NAME"] ?></h3>
                    <time class="dp-blog-item__date" datetime="<?= $arItem["DATE_ACTIVE_FROM"] ?>"><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></time>
                </div>
            </a>
        </div>
    </div>

<? endforeach; ?>


