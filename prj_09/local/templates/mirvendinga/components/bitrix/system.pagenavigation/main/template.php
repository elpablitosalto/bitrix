<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$this->setFrameMode(true);

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>
<div class="pagination">
    <ul class="pagination__list">
        <?if ($arResult["NavPageNomer"] > 1):?>

            <?if($arResult["bSavePage"]):?>
                <li class="pagination__item pagination__item_type_prev">
                    <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" class="pagination__link">Предыдущая страница</a>
                </li>
            <?else:?>
                <?if ($arResult["NavPageNomer"] > 2):?>
                    <li class="pagination__item pagination__item_type_prev">
                        <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" class="pagination__link">Предыдущая страница</a>
                    </li>
                <?else:?>
                    <li class="pagination__item pagination__item_type_prev">
                        <a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="pagination__link">Предыдущая страница</a>
                    </li>
                <?endif?>
            <?endif?>

        <?else:?>
            <li class="pagination__item pagination__item_type_prev">
                <div class="pagination__link pagination__link_state_inactive">
                    Предыдущая страница
                </div>
            </li>
        <?endif?>

        <?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
            <li class="pagination__item pagination__item_type_next">
                <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" class="pagination__link">Следующая страница</a>
            </li>
        <?else:?>
            <li class="pagination__item pagination__item_type_next">
                <div class="pagination__link pagination__link_state_inactive">
                    Следующая страница
                </div>
            </li>
        <?endif?>

        <?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>

            <?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
                <li class="pagination__item">
                    <div class="pagination__label pagination__label_state_active">
                        <?=$arResult["nStartPage"]?>
                    </div>
                </li>
            <?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
                <li class="pagination__item">
                    <a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="pagination__link">
                        <span class="pagination__label"><?=$arResult["nStartPage"]?></span>
                    </a>
                </li>
            <?else:?>
                <li class="pagination__item">
                    <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>" class="pagination__link">
                        <span class="pagination__label"><?=$arResult["nStartPage"]?></span>
                    </a>
                </li>
            <?endif?>
            <?$arResult["nStartPage"]++?>
        <?endwhile?>
    </ul>
</div>