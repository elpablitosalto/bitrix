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

use \Bitrix\Main\Localization\Loc;

if (count($arResult["ITEMS"]) == 0)
	return false;
?>
<div class="nb-affiliated--country-address--list">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="nb-affiliated--country-address--item"  id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<span class="nb-affiliated--country-address"><?=trim(str_replace('«Белый кролик»', '', $arItem['NAME']))?></span>
			<?if (is_array($arItem['PROPERTIES']['METRO']['VALUE_ENUM']) && count($arItem['PROPERTIES']['METRO']['VALUE_ENUM']) > 0):?>
				<span class="nb-affiliated--country-metro">
					<?
					$arMetro = array_map(function($metroName) {
						return 'М. ' . trim($metroName);
					}, $arItem['PROPERTIES']['METRO']['VALUE_ENUM']);
					echo implode(' / ', $arMetro);
					?>
				</span>
			<?endif;?>
		</div>
	<?endforeach;?>
</div>
