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

<? foreach ($arResult["ITEMS"] as $arItem) { ?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<?
	$button_play_class = '';
	if (mb_strlen($arItem['PROPERTIES']['VIDEO_LINK']['VALUE']) > 0) {
		$button_play_class = 'bigBlock_video';
	}
	?>
	<a class="bigBlock bigBlock<?= $arItem['PICTURE']['SIZE']; ?> <?= $button_play_class; ?>" <? if (mb_strlen($arItem['PROPERTIES']['VIDEO_LINK']['VALUE']) > 0) : ?> data-fancybox<? endif; ?> href="<? if (mb_strlen($arItem['PROPERTIES']['VIDEO_LINK']['VALUE']) > 0) : ?><?= $arItem['PROPERTIES']['VIDEO_LINK']['VALUE'] ?><? else : ?><?= $arItem['DETAIL_PAGE_URL']; ?><? endif; ?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
		<img class="bbimg" loading="lazy" data-size="<?= $arItem['PICTURE']['SIZE']; ?>" src="<?= $arItem['PICTURE']['SRC']; ?>" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="<?= $arItem['PICTURE']['WIDTH']; ?>" height="<?= $arItem['PICTURE']['HEIGHT']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
		<div class="content">
			<div class="title "><?= $arItem['NAME']; ?></div>
			<? if (mb_strlen($arItem['PREVIEW_TEXT']) > 0) : ?>
				<div class="text d">
					<?= strip_tags($arItem['PREVIEW_TEXT'], ['b', 'strong', 'em', 'br']); ?>
				</div>
				<?/*?>
				<p class="text d">
					<?= strip_tags($arItem['PREVIEW_TEXT'], ['b', 'strong', 'em', 'br']); ?>
				</p>
				<?*/ ?>
			<? endif; ?>
		</div>
	</a>
<? } ?>