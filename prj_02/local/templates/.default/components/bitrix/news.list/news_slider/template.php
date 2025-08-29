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
if (!empty($arResult["ITEMS"])) {
?>
	<section class="news-detail-other">
		<div class="container">
			<div class="news-slider">
				<div class="section__head">
					<h3 class="section__title"><?= $arParams["HEADER"]; ?></h3>
					<div class="section__nav">
						<div class="swiper-nav lg">
							<button type="button" class="swiper-button prev">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop-light">
									<use xlink:href="#drop-light"></use>
								</svg>
							</button>
							<button type="button" class="swiper-button next">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop-light">
									<use xlink:href="#drop-light"></use>
								</svg>
							</button>
						</div>
					</div>
				</div>
				<div class="items-list swiper-container">
					<div class="swiper-wrapper">
						<? foreach ($arResult["ITEMS"] as $arItem) {
						?>
							<?
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
							?>
							<div class="swiper-slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
								<? if ($arItem["SHOW_TYPE"] == 1) { ?>
									<div class="list-item news-item">
										<a href="<?= $arItem["DETAIL_PAGE_URL"]; ?>" class="news-item__image">
											<picture>
												<img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" loading="lazy" alt="<?= $arItem["NAME"]; ?>" title="<?= $arItem["NAME"]; ?>" />
											</picture>
										</a>
										<div class="h5 news-item__title">
											<a href="<?= $arItem["DETAIL_PAGE_URL"]; ?>"><?= $arItem["NAME"]; ?></a>
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
								<? if ($arItem["SHOW_TYPE"] == 2) { ?>
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
								<? if ($arItem["SHOW_TYPE"] == 3) { ?>
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
								<? if ($arItem["SHOW_TYPE"] == 4) { ?>
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
								<? if ($arItem["SHOW_TYPE"] == 5) { ?>
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
							</div>
						<? } ?>
					</div>
				</div>
			</div>

			<div class="section__nav">
				<a href="<?= $arResult["MORE_URL"]; ?>">
					<u><?= $arParams["MORE_LINK_TITLE"]; ?></u>
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow">
						<use xlink:href="#arrow"></use>
					</svg>
				</a>
			</div>
		</div>
	</section>
<?
}
//vardump($arResult);
?>