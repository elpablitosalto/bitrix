<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Grid\Declension;

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
?>
<? if (!empty($arResult["ITEMS"])) {
	$iCount = count($arResult["ITEMS"]);
	if ($iCount > 8) {
		$actionPos = 8;
		$copyElement = true;
	} else {
		$actionPos = $iCount - 1;
		$copyElement = false;
	}
	//echo "iCount = ".$iCount."<br />";
?>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="partners__list">

					<? 
					$i = 0;
					foreach ($arResult["ITEMS"] as $key => $item) {
						$i++;
						$this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
						<? if (($key == ($actionPos+1))) { ?>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-sm-12">

				<div class="banner-heart">
					<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_TEMPLATE_PATH . "/include/blocks/about/about_partners2.php"
								)
							); ?>
					<div class="banner-heart__decor">
						<picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/heart-decor.svg" loading="lazy" alt="Дорога к дому" title="Дорога к дому" />
						</picture>
					</div>
				</div>

			</div>
		</div>
	</div>

	<div class="container <?/* if ($iCount < 10) { echo 'partners-desk-hide'; } ?> <? if ($iCount < 9) { echo 'partners-mob-hide';} /**/ ?>">
		<div class="row">
			<div class="col-sm-12">
				<div class="partners__list">
				<? } ?>
				<a target="_blank" href="<?= $item["DISPLAY_PROPERTIES"]["LINK"]["VALUE"] ?>" class="partners__box <?/* if (($key == $actionPos) && $copyElement) {echo 'partners-mob-hide';} /**/ ?>" id="<?= $this->GetEditAreaId($item['ID']); ?>">
					<? if ($item["PREVIEW_PICTURE"]["ID"] > 0) { ?>
						<div class="partners__logo">

							<picture>
								<img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] ?>" loading="lazy" alt="<?= $item["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $item["PREVIEW_PICTURE"]["TITLE"] ?>" />
							</picture>
						</div>
					<? } ?>
					<div class="partners__title"><?= $item["NAME"] ?></div>
					<? if (!empty($item["DISPLAY_PROPERTIES"]["LINK"]["VALUE"])) { ?>
						<div class="partners__link">Перейти на сайт</div>
					<? } ?>
				</a>
			<? } ?>
				</div>
			</div>
		</div>
	</div>
<? } ?>