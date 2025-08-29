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
//vardump($arResult["ITEMS"]);

?>
<? if ($arParams["AJAX_LOAD"] != "Y" || TRUE) { ?>
	<div class="items-list news-list">
		<div class="row align-items-height <?= "nav_result_" . $arResult['NAV_RESULT']->NavNum; ?>">
		<? } ?>
		<?
		foreach ($arResult["ITEMS"] as $arItem) {
			$show_type = 1;
			if (strlen($arItem["SHOW_TYPE"]) > 0) {
				$show_type = $arItem["SHOW_TYPE"];
			}
			/*
			$show_type = 1;			
			$show_type_item = $arItem["DISPLAY_PROPERTIES"]["SHOW_TYPE"]["VALUE_ENUM"];
			if (strlen($show_type_item) > 0) {
				$show_type = $show_type_item;
			}
			*/
			//vardump($arItem["DISPLAY_PROPERTIES"]["SHOW_TYPE"]);
			//echo "show_type = ".$show_type."<br />";
		?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="col-sm-6 col-lg-4" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
				<? if ($show_type == 1) { ?>
					<div class="list-item news-item"><a href="<?= $arItem["DETAIL_PAGE_URL"]; ?>" class="news-item__image">
							<picture>
								<img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" loading="lazy" alt="<?= $arItem["NAME"]; ?>" title="<?= $arItem["NAME"]; ?>" />
							</picture>
						</a>
						<div class="h5 news-item__title"><a href="<?= $arItem["DETAIL_PAGE_URL"]; ?>"><?= $arItem["NAME"]; ?></a></div>
						<div class="news-item__info">
							<span class="text-size-sm news-item__date">
								<?
								echo FormatDate("j F Y", MakeTimeStamp($arItem["DISPLAY_PROPERTIES"]["PUBLIC_DATE"]["VALUE"]));
								?>
							</span>
							<span class="text-size-sm news-item__category">
								<?= $arItem["DISPLAY_PROPERTIES"]["PUBLICATION_TYPE"]["VALUE"]; ?>
							</span>
						</div>
					</div>
				<? } ?>
				<? if ($show_type == 2) { ?>
					<a href="<?= $arItem["DETAIL_PAGE_URL"]; ?>" class="list-item news-item news-item-2">
						<div class="news-item__info">
							<span class="text-size-sm news-item__date">
								<? echo FormatDate("j F Y", MakeTimeStamp($arItem["DISPLAY_PROPERTIES"]["PUBLIC_DATE"]["VALUE"])); ?>
							</span>
							<span class="text-size-sm news-item__category">
								<?= $arItem["DISPLAY_PROPERTIES"]["PUBLICATION_TYPE"]["VALUE"]; ?>
							</span>
						</div>
						<div class="h5 news-item__title"><?= $arItem["NAME"]; ?></div>
						<picture class="news-item-2__pattern">
							<img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/pdmi-orange-thin.png" loading="lazy" alt="<?= $arItem["NAME"]; ?>" title="<?= $arItem["NAME"]; ?>" />
						</picture>
					</a>
				<? } ?>
				<? if ($show_type == 3) { ?>
					<a href="<?= $arItem["DETAIL_PAGE_URL"]; ?>" class="list-item news-item news-item-2 bg-orange">
						<div class="news-item__info">
							<span class="text-size-sm news-item__date">
								<? echo FormatDate("j F Y", MakeTimeStamp($arItem["DISPLAY_PROPERTIES"]["PUBLIC_DATE"]["VALUE"])); ?>
							</span>
							<span class="text-size-sm news-item__category">
								<?= $arItem["DISPLAY_PROPERTIES"]["PUBLICATION_TYPE"]["VALUE"]; ?>
							</span>
						</div>
						<div class="h5 news-item__title"><?= $arItem["NAME"]; ?></div>
						<picture class="news-item-2__pattern">
							<img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/pdmi.png" loading="lazy" alt="<?= $arItem["NAME"]; ?>" title="<?= $arItem["NAME"]; ?>" />
						</picture>
					</a>
				<? } ?>
				<? if ($show_type == 4) { ?>
					<div class="list-item news-item news-item-media">
						<a href="<?= $arItem["DETAIL_PAGE_URL"]; ?>" class="news-item__image">
							<picture>
								<img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" loading="lazy" alt="<?= $arItem["NAME"]; ?>" title="<?= $arItem["NAME"]; ?>" />
							</picture>
						</a>
						<div class="h5 news-item__title"><a href="<?= $arItem["DETAIL_PAGE_URL"]; ?>"><?= $arItem["NAME"]; ?></a>
						</div>
						<div class="news-item__info">
							<span class="text-size-sm news-item__date">
								<? echo FormatDate("j F Y", MakeTimeStamp($arItem["DISPLAY_PROPERTIES"]["PUBLIC_DATE"]["VALUE"])); ?>
							</span>
							<span class="text-size-sm news-item__category">
								<?= $arItem["DISPLAY_PROPERTIES"]["PUBLICATION_TYPE"]["VALUE"]; ?>
							</span>
						</div>
					</div>
				<? } ?>
				<? if ($show_type == 5) { ?>
					<div class="list-item news-item news-item-media bg-orange">
						<a href="<?= $arItem["DETAIL_PAGE_URL"]; ?>" class="news-item__image">
							<picture>
								<img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" loading="lazy" alt="<?= $arItem["NAME"]; ?>" title="<?= $arItem["NAME"]; ?>" />
							</picture>
						</a>
						<div class="h5 news-item__title"><a href="<?= $arItem["DETAIL_PAGE_URL"]; ?>"><?= $arItem["NAME"]; ?></a></div>
						<div class="news-item__info">
							<span class="text-size-sm news-item__date">
								<? echo FormatDate("j F Y", MakeTimeStamp($arItem["DISPLAY_PROPERTIES"]["PUBLIC_DATE"]["VALUE"])); ?>
							</span>
							<span class="text-size-sm news-item__category">
								<?= $arItem["DISPLAY_PROPERTIES"]["PUBLICATION_TYPE"]["VALUE"]; ?>
							</span>
						</div>
					</div>
				<? } ?>
				<?/*if ($show_type == 4) {?>
					<div class="list-item news-item">
						<a href="<?= $arItem["DETAIL_PAGE_URL"]; ?>" class="news-item__image">
							<picture>
								<img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" loading="lazy" alt="<?= $arItem["NAME"]; ?>" title="<?= $arItem["NAME"]; ?>" />
							</picture>
						</a>
						<div class="h5 news-item__title"><a href="<?= $arItem["DETAIL_PAGE_URL"]; ?>"><?= $arItem["NAME"]; ?></a></div>
						<div class="news-item__info">
							<span class="text-size-sm news-item__date">
								<? echo FormatDate("j F Y", MakeTimeStamp($arItem["DISPLAY_PROPERTIES"]["PUBLIC_DATE"]["VALUE"])); ?>
							</span>
							<span class="text-size-sm news-item__category">
								<?= $arItem["DISPLAY_PROPERTIES"]["PUBLICATION_TYPE"]["VALUE"]; ?>
							</span>
						</div>
					</div>
				<? }*/ ?>
			</div>
		<? } ?>
		<? if ($arParams["AJAX_LOAD"] != "Y" || TRUE) { ?>
		</div>
	</div>
<? } ?>

<? if ($arParams["DISPLAY_BOTTOM_PAGER"] || TRUE) : ?>
	<div class="<?= "nav_string_" . $arResult['NAV_RESULT']->NavNum; ?>">
		<br /><?= $arResult["NAV_STRING"] ?>
	</div>
<? endif; ?>