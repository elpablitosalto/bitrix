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

<ul class="page-menu__list">

    <? foreach ($arResult["SECTIONS"] as $section) {

        $this->AddEditAction($section['ID'], $section['EDIT_LINK'], $strSectionEdit);
        $this->AddDeleteAction($section['ID'], $section['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
    ?>
        <li class="page-menu__item" id="<? echo $this->GetEditAreaId($section['ID']); ?>">
            <a class="page-menu__link <?/*?>js--scroll-link<?*/?>" href="#reagents-<?= $section['ID'] ?>"><?= $section["NAME"] ?></a>
        </li>
    <? } ?>

</ul>