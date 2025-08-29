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

//$this->AddEditAction($arResult['ID'], $arResult['EDIT_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_EDIT"));
//$this->AddDeleteAction($arResult['ID'], $arResult['DELETE_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
<div id="<?= $this->GetEditAreaId($arResult['ID']); ?>">
	<? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])) : ?>
		<div class="article__main-image">
			<img src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>" title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>" />
		</div>
	<? endif ?>

	<div class="article__wrapper" itemprop="articleBody">
		<?if (is_array($arResult["DETAIL_TEXT_EXPLODED"]) && count($arResult["DETAIL_TEXT_EXPLODED"]) > 0):?>
			<?foreach($arResult["DETAIL_TEXT_EXPLODED"] as $index => $arTextPart):?>
				<?=$arTextPart?>
				<?if (
					isset($arResult["PRODUCT_SLIDER_IDS"][$index])
					&& is_array($arResult["PRODUCT_SLIDER_IDS"][$index])
					&& count($arResult["PRODUCT_SLIDER_IDS"][$index]) > 0
				):?>
					<?
					$APPLICATION->IncludeFile(
						SITE_DIR . 'include/catalog/article_products.php',
						array(
							'FILTER_NAME' => 'arProductFilter' . $index,
							'PRODUCT_IDS' => $arResult["PRODUCT_SLIDER_IDS"][$index],
						),
						array('SHOW_BORDER' => false)
					);
					?>
				<?endif;?>
			<?endforeach;?>
		<?else:?>
			<?=$arResult["DETAIL_TEXT"]?>
		<?endif;?>

		<?
		$sharing_url = 'https://' . SITE_SERVER_NAME . $arResult["DETAIL_PAGE_URL"];
		?>
		<ul class="article__contact-list">
			<li class="article__contact-item">
				<a href="https://web.whatsapp.com/send?text=<?= $sharing_url ?>" data-action="share/whatsapp/share" target="_blank">
					<svg width="30" height="30">
						<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#whatsapp"></use>
					</svg>
				</a>
			</li>
			<li class="article__contact-item">
				<a href="https://telegram.me/share/url?url=<?= $sharing_url ?>" target="_blank">
					<svg width="30" height="30">
						<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#telegram"></use>
					</svg>
				</a>
			</li>

			<?/*?>
		<li class="article__contact-item">
			<a href="#">
				<svg width="30" height="30">
					<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons/sprite/svg-sprite.svg#telegram"></use>
				</svg>
			</a>
		</li>
		<li class="article__contact-item">
			<a href="#">
				<svg width="30" height="30">
					<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons/sprite/svg-sprite.svg#telegram"></use>
				</svg>
			</a>
		</li>
		<? */ ?>
		</ul>

		<? $APPLICATION->IncludeComponent(
			"bitrix:form.result.new",
			"question_to_technologist",
			array(
				"SEF_MODE" => "N",
				"WEB_FORM_ID" => $GLOBALS["arSiteConfig"]["WEB_FORM_ID_QUESTION_TO_TECHNOLOGIST"],
				"LIST_URL" => "",
				"EDIT_URL" => "",
				"SUCCESS_URL" => "",
				"CHAIN_ITEM_TEXT" => "",
				"CHAIN_ITEM_LINK" => "",
				"IGNORE_CUSTOM_TEMPLATE" => "Y",
				"USE_EXTENDED_ERRORS" => "Y",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "3600",
				"SEF_FOLDER" => "/",
				"VARIABLE_ALIASES" => array(),
			)
		); ?>
	</div>
</div>