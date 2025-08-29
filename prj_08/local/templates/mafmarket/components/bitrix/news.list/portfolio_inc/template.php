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
	<section class="dp-section">
		<div class="container">
			<h2 class="dp-section__individual-title">
				<? $APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_TEMPLATE_PATH . "/include/blocks/common/individual_portfolio_block_header.php"
					)
				); ?>
			</h2>
		</div>
		<div class="container">
			<div class="dp-section__body">
				<div class="dp-individual__list js_list_wrapper js_nav_result_<?= $arResult['NAV_RESULT']->NavNum ?>">
					<?
					foreach ($arResult["ITEMS"] as $arItem) {
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
						<div class="dp-individual__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<div class="dp-individual__item-img">
								<img src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
							</div>
							<div class="dp-individual__item-description">
								<?= $arItem['PREVIEW_TEXT']; ?>
								<a class="dp-individual__text-link" href="<?= $arItem['DETAIL_PAGE_URL']; ?>">Смотреть весь проект</a>
							</div>
						</div>
					<?
					}
					?>
				</div>
				<div class="js_nav_string <?= "js_nav_string_" . $arResult['NAV_RESULT']->NavNum; ?>">
					<?
					echo $arResult["NAV_STRING"];
					?>
				</div>
			</div>
		</div>
	</section>

<? } ?>