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
	<div class="dp-kkm-reviews-list">
		<?
		foreach ($arResult["ITEMS"] as $arItem) { ?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="dp-kkm-reviews-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
				<div class="dp-kkm-review">
					<div class="dp-kkm-review__header">
						<div class="dp-kkm-review__title">
							<?= html_entity_decode($arItem['NAME']); ?>
						</div>
						<div class="dp-kkm-review__image">
							<img src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
						</div>
					</div>
					<div class="dp-kkm-review__subtitle">
						<?= $arItem['DISPLAY_PROPERTIES']['ABOUT']['VALUE']; ?>
					</div>
					<div class="dp-kkm-review__text">
						<?= $arItem['REVIEW_PREVIEW_TEXT']; ?>
					</div>
					<? if ($arItem['SHOW_MORE'] == 'Y') { ?>
						<a class="dp-btn dp-btn_outlined dp-btn_m dp-kkm-review__btn js_review_show_more" data-id="<?= $arItem['ID'] ?>" href="#" data-modal="#review-detail">
							Читать весь отзыв
						</a>
					<? } ?>
				</div>
				<div style="display: none;">
					<div id="js_review_full_name_<?= $arItem['ID'] ?>">
						<?
						//echo strip_tags(html_entity_decode(str_replace(array('<br />', '<br>'), array(' ', ' '), $arItem['NAME']))); 
						echo str_replace(array('<br />', '<br>'), array(' ', ' '), html_entity_decode($arItem['NAME']));
						?>
					</div>
					<div id="js_review_full_about_<?= $arItem['ID'] ?>">
						<?= $arItem['DISPLAY_PROPERTIES']['ABOUT']['VALUE']; ?>
					</div>
					<div id="js_review_full_text_<?= $arItem['ID'] ?>">
						<?= $arItem['REVIEW_DETAIL_TEXT']; ?>
					</div>
				</div>
			</div>
		<?
		}
		?>
	</div>
<? } ?>