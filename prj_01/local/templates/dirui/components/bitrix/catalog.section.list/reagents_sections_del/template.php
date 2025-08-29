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
?>

<div class="bookmarks-table__marks">

<?foreach($arResult["SECTIONS"] as $section){

    $this->AddEditAction($section['ID'], $section['EDIT_LINK'], $strSectionEdit);
    $this->AddDeleteAction($section['ID'], $section['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
    ?>
    <a id="<? echo $this->GetEditAreaId($section['ID']); ?>" class="bookmarks-table__link js--scroll-link" href="#section-<?=$section['ID']?>">
        <?=$section["NAME"]?><span> <?=$section["ELEMENT_CNT"]?></span>
    </a>
<?}?>

    <a href="#callback" class="header-top-banner__btn btn btn--large btn--rose">Связаться с нами</a>
</div>