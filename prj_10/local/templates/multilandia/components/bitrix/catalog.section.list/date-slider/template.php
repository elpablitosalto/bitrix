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

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

if (0 < $arResult["SECTIONS_COUNT"])
{
?>
    <div class="date-slider">
        <div class="date-slider__container">
            <div class="date-slider__wrapper">
                <?
                foreach ($arResult['SECTIONS'] as &$arSection)
                {
                    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
                    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
                    $timestamp = strtotime($arSection['UF_DATE']);
                    $isToday = ($timestamp == $arParams['CURRENT_TIMESTAMP']);
                    $isTomorrow = ($timestamp == strtotime('tomorrow', $arParams['CURRENT_TIMESTAMP']));
                    $isAfterTomorrow = ($timestamp == strtotime('tomorrow + 1 day', $arParams['CURRENT_TIMESTAMP']));
                    $isWide = ($isToday || $isTomorrow || $isAfterTomorrow);
                    ?>
                    <div class="date-slider__item" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
                        <a class="date-item<?if ($isWide):?> date-item_wide<?endif;?>" href="<? echo $arSection['SECTION_PAGE_URL']; ?>">
                            <span class="date-item__title">
                                <?if ($isWide):?>
                                    <?if ($isToday):?>
                                        <?=GetMessage('DATE_SLIDER_TODAY');?>
                                    <?elseif ($isTomorrow):?>
                                        <?=GetMessage('DATE_SLIDER_TOMORROW');?>
                                    <?elseif ($isAfterTomorrow):?>
                                        <?=GetMessage('DATE_SLIDER_AFTER_TOMORROW');?>
                                    <?endif;?>
                                <?else:?>
                                    <?=toUpper(FormatDate('d.m', $timestamp))?>
                                <?endif;?>
                            </span>
                            <span class="date-item__subtitle"><?if ($isWide):?><?=toUpper(FormatDate('d.m', $timestamp))?> <?endif;?><?=toUpper(FormatDate('D', $timestamp))?></span>
                        </a>
                    </div>
                    <?
                }
                ?>
            </div>
        </div>
    </div>
<?
}
?>