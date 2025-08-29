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

//vardump($arResult);

if (!empty($arResult["ITEMS"])) {
?>
	<? if ($arParams['SHOW_HEADER'] != 'N') { ?>
		<p class="materials-item__title">Варианты порошковой окраски в цветах RAL</p>
	<? } ?>
	<div class="materials-item__colors js_nav_result_<?= $arResult['NAV_RESULT']->NavNum ?>">
		<?
		foreach ($arResult["ITEMS"] as $arItem) {
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
			<div class="materials-item__color" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
					<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#<?= $arItem['DISPLAY_PROPERTIES']['COLOR_CODE']['DISPLAY_VALUE']; ?>"></path>
				</svg>
				<p><?= $arItem['DISPLAY_PROPERTIES']['CODE']['DISPLAY_VALUE']; ?></p>
				<?/*?><p>Green beiege</p><?*/ ?>
			</div>
		<?
		}
		?>
	</div>
	<? if ($arParams['SHOW_PAGER'] != 'N') { ?>
		<div class="js_nav_string <?= "js_nav_string_" . $arResult['NAV_RESULT']->NavNum; ?>">
			<?
			echo $arResult["NAV_STRING"];
			?>
		</div>
	<? } ?>
<? } ?>