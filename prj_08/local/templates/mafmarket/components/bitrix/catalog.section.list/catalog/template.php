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
$this->setFrameMode(true);
//echo '!!';
$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
?>

<? if (!empty($arResult['SECTIONS'])) { ?>
    <div class="dp-aside-menu">
        <ul class="dp-aside-menu__list">


            <? foreach ($arResult['SECTIONS'] as $sectId => $arSection) { ?>
                <?
                $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
                $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
                ?>
                <li class="dp-aside-menu__item<?if($arSection["CODE"] == $arParams["CURRENT_ELEMENT"]) echo " selected";?>" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
                    <a class="dp-aside-menu__link" href="<?=$arSection["SECTION_PAGE_URL"]?>"><span
                                class="dp-aside-menu__text"><?=$arSection["NAME"]?></span><span class="dp-aside-menu__quantity"><?=$arSection["ELEMENT_CNT"]?></span>
                    </a>
                </li>
            <? } ?>

        </ul>
    </div>

<? } ?>