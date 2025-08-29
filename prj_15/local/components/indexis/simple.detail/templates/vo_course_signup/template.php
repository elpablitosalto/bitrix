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
?>
<?
$this->AddEditAction($arResult['ID'], $arResult['EDIT_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arResult['ID'], $arResult['DELETE_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>

<a id="<?= $this->GetEditAreaId($arResult['ID']); ?>" href="<?=$arResult["PROPERTIES"]["LINK"]["VALUE"]?>" class="<?=$arResult["PROPERTIES"]["CLASS"]["VALUE"]?>" style="<?=$arResult["PROPERTIES"]["STYLE"]["VALUE"]?>">
	<?=$arResult["NAME"]?>
</a>

<?$this->SetViewTarget('link_'.$arParams["CODE"]);?><?=$arResult["PROPERTIES"]["LINK"]["VALUE"]?><?$this->EndViewTarget();?>