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


$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
?>

<ul class="equipment__nav-list">
    <li class="equipment__nav-item">
        <a class="equipment__nav-link <? if (intval($arParams['CUR_SECTION_ID']) == 0) { ?>equipment__nav-link_active<? } ?>" href="<?= $arParams['FOLDER_PATH']; ?>">
            Вся продукция (<?= $arResult['ALL_ELEMENTS_COUNT']; ?>)
        </a>
    </li>
    <? foreach ($arResult["SECTIONS"] as $section) {
        $this->AddEditAction($section['ID'], $section['EDIT_LINK'], $strSectionEdit);
        $this->AddDeleteAction($section['ID'], $section['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
    ?>
        <li class="equipment__nav-item" id="<? echo $this->GetEditAreaId($section['ID']); ?>">
            <a class="equipment__nav-link <? if (intval($arParams['CUR_SECTION_ID']) == $section['ID']) { ?>equipment__nav-link_active<? } ?>" href="<?= $arParams['FOLDER_PATH']; ?>?s=<?= $section['ID']; ?>">
                <?= $section["NAME"] ?> <span>(<?= $section["ELEMENT_CNT"] ?>)</span>
            </a>
        </li>
    <? } ?>
</ul>