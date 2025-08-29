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

if (!$arResult["NavShowAlways"]) {
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");
?>

<?
$arDevicesClasses = array(
	'desktop' => 'dp-pagenav-list_desktop',
	'tablet' => 'dp-pagenav-list_tablet',
	'mobile' => 'dp-pagenav-list_mobile'
);
$arResult["nStartPageSource"] = $arResult["nStartPage"];
?>

<div class="dp-pagenav">
	<div class="container">
		<? foreach ($arDevicesClasses as $device => $deviceClass) { ?>
			<?
			$arResult["nStartPage"] = $arResult["nStartPageSource"];	
			?>
			<ul class="dp-pagenav-list <?= $deviceClass; ?>">
				<? if ($arResult["NavPageNomer"] == 1) { ?>
					<li class="dp-pagenav-list__item dp-pagenav-list__item_prev">
						<a class="dp-pagenav-list__link dp-pagenav-list__link_disabled" href="#">
							<svg class="icon icon-slider-arrow-left dp-pagenav-list__icon">
								<use xlink:href="#slider-arrow-left"></use>
							</svg>
						</a>
					</li>
				<? } else { ?>
					<li class="dp-pagenav-list__item dp-pagenav-list__item_prev">
						<a class="dp-pagenav-list__link" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>">
							<svg class="icon icon-slider-arrow-left dp-pagenav-list__icon">
								<use xlink:href="#slider-arrow-left"></use>
							</svg>
						</a>
					</li>

				<? } ?>

				<? if ($device == 'desktop') { ?>
					<? if ($arResult["nStartPage"] != 1) { ?>
						<li class="dp-pagenav-list__item dp-pagenav-list__item_prev">
							<a class="dp-pagenav-list__link" href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>">
								1
							</a>
						</li>
						<? if ($arResult["nStartPage"] > 2) { ?>
							<li class="dp-pagenav-list__item dp-pagenav-list__item_sep"><span>...</span></li>
						<? } ?>
					<? } ?>
				<? } ?>

				<? while ($arResult["nStartPage"] <= $arResult["nEndPage"]) : ?>
					<? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]) : ?>
						<li class="dp-pagenav-list__item">
							<a class="dp-pagenav-list__link dp-pagenav-list__link_active" href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>">
								<?= $arResult["nStartPage"] ?>
							</a>
						</li>
					<? elseif ($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false) : ?>
						<li class="dp-pagenav-list__item">
							<a class="dp-pagenav-list__link <?/*?>dp-pagenav-list__link_active<?*/ ?>" href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>">
								<?= $arResult["nStartPage"] ?>
							</a>
						</li>
					<? else : ?>
						<li class="dp-pagenav-list__item">
							<a class="dp-pagenav-list__link" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>">
								<?= $arResult["nStartPage"] ?>
							</a>
						</li>
					<? endif ?>
					<? $arResult["nStartPage"]++ ?>
				<? endwhile ?>

				<? if ($device == 'desktop') { ?>
					<? if ($arResult["nEndPage"] != $arResult["NavPageCount"]) { ?>
						<? if (($arResult["nEndPage"] + 1) != $arResult["NavPageCount"]) { ?>
							<li class="dp-pagenav-list__item dp-pagenav-list__item_sep"><span>...</span></li>
						<? } ?>
						<li class="dp-pagenav-list__item">
							<a class="dp-pagenav-list__link" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageCount"] ?>">
								<?= $arResult["NavPageCount"]; ?>
							</a>
						</li>
					<? } ?>
				<? } ?>

				<? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) { ?>
					<li class="dp-pagenav-list__item dp-pagenav-list__item_next">
						<a class="dp-pagenav-list__link" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>">
							<svg class="icon icon-slider-arrow-right dp-pagenav-list__icon">
								<use xlink:href="#slider-arrow-right"></use>
							</svg>
						</a>
					</li>
				<? } else { ?>
					<li class="dp-pagenav-list__item dp-pagenav-list__item_next">
						<a class="dp-pagenav-list__link dp-pagenav-list__link_disabled" href="#">
							<svg class="icon icon-slider-arrow-right dp-pagenav-list__icon">
								<use xlink:href="#slider-arrow-right"></use>
							</svg>
						</a>
					</li>
				<? } ?>
			</ul>
		<? } ?>
		<?/*?>
		<ul class="dp-pagenav-list dp-pagenav-list_tablet">
			<li class="dp-pagenav-list__item dp-pagenav-list__item_prev"><a class="dp-pagenav-list__link dp-pagenav-list__link_disabled" href="#">
					<svg class="icon icon-slider-arrow-left dp-pagenav-list__icon">
						<use xlink:href="#slider-arrow-left"></use>
					</svg></a></li>
			<li class="dp-pagenav-list__item"><a class="dp-pagenav-list__link dp-pagenav-list__link_active" href="#">1</a></li>
			<li class="dp-pagenav-list__item"><a class="dp-pagenav-list__link" href="#">2</a></li>
			<li class="dp-pagenav-list__item"><a class="dp-pagenav-list__link" href="#">3</a></li>
			<li class="dp-pagenav-list__item"><a class="dp-pagenav-list__link" href="#">4</a></li>
			<li class="dp-pagenav-list__item"><a class="dp-pagenav-list__link" href="#">5</a></li>
			<li class="dp-pagenav-list__item dp-pagenav-list__item_sep"><span>...</span></li>
			<li class="dp-pagenav-list__item"><a class="dp-pagenav-list__link" href="#">28</a></li>
			<li class="dp-pagenav-list__item dp-pagenav-list__item_next"><a class="dp-pagenav-list__link" href="#">
					<svg class="icon icon-slider-arrow-right dp-pagenav-list__icon">
						<use xlink:href="#slider-arrow-right"></use>
					</svg></a></li>
		</ul>
		<ul class="dp-pagenav-list dp-pagenav-list_mobile">
			<li class="dp-pagenav-list__item dp-pagenav-list__item_prev"><a class="dp-pagenav-list__link dp-pagenav-list__link_disabled" href="#">
					<svg class="icon icon-slider-arrow-left dp-pagenav-list__icon">
						<use xlink:href="#slider-arrow-left"></use>
					</svg></a></li>
			<li class="dp-pagenav-list__item"><a class="dp-pagenav-list__link dp-pagenav-list__link_active" href="#">1</a></li>
			<li class="dp-pagenav-list__item"><a class="dp-pagenav-list__link" href="#">2</a></li>
			<li class="dp-pagenav-list__item"><a class="dp-pagenav-list__link" href="#">3</a></li>
			<li class="dp-pagenav-list__item dp-pagenav-list__item_next"><a class="dp-pagenav-list__link" href="#">
					<svg class="icon icon-slider-arrow-right dp-pagenav-list__icon">
						<use xlink:href="#slider-arrow-right"></use>
					</svg></a></li>
		</ul>
		<?*/ ?>
	</div>
</div>