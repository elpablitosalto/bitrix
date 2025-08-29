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
?>
<input type="hidden" value="<?= $arResult["ID"] ?>" id="js_material_id" />
<input type="hidden" value="<?= $arResult["IBLOCK_ID"] ?>" id="js_material_iblock_id" />
<input type="hidden" value="600" id="js_learned_time" />
<div class="dp-article-detail">
	<? if (!empty($arResult["DISPLAY_PROPERTIES"]['THEME']['DISPLAY_VALUE'])) { ?>
		<div class="dp-article-detail__header">
			<ul class="dp-article-detail__tags">
				<? foreach ($arResult["DISPLAY_PROPERTIES"]['THEME']['DISPLAY_VALUE'] as $key => $val) { ?>
					<li class="dp-article-detail__tag"><?= $val; ?></li>
				<? } ?>
			</ul>
		</div>
	<? } ?>

	<div class="dp-article-detail__body">
		<? if (!empty($arResult["DISPLAY_PROPERTIES"]['FILE']['FILE_VALUE'])) { ?>
			<div class="dp-video">
				<video preload="none" controls src="<?=$arResult["DISPLAY_PROPERTIES"]['FILE']['FILE_VALUE']['SRC'];?>" poster="<?=$arResult["DISPLAY_PROPERTIES"]['VIDEO_PREVIEW']['FILE_VALUE']['SRC'];?>"></video>
				<? if (!empty($arResult["DISPLAY_PROPERTIES"]['VIDEO_PREVIEW']['FILE_VALUE'])) { ?>
					<div class="dp-video__poster" style="background-image: url(<?=$arResult["DISPLAY_PROPERTIES"]['VIDEO_PREVIEW']['FILE_VALUE']['SRC'];?>)"></div>
				<? } ?>
				<button class="dp-btn-video dp-video__play" type="button">
					<span class="dp-btn-video__icon">
						<svg class="icon icon-play ">
							<use xlink:href="#play"></use>
						</svg>
					</span>
				</button>
			</div>
		<? } ?>
		<?= $arResult['DETAIL_TEXT']; ?>
	</div>

	<? if ($arParams['USER_AUTHORIZED'] == 'Y') { ?>
		<div class="dp-article-detail__footer">
			<div class="dp-article-detail__meta">
				<? if (!empty($arResult["ACTIVE_FROM"])) { ?>
					<time class="dp-article-detail__date" datetime="<? echo FormatDate("Y-m-d", MakeTimeStamp($arResult["ACTIVE_FROM"])); ?>">
						<? echo FormatDate("j F Y", MakeTimeStamp($arResult["ACTIVE_FROM"])); ?>
					</time>
				<? } ?>
			</div>
		</div>
	<? } ?>
</div>