<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<? foreach ($arResult["ITEMS"] as $arItem): ?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="dp-slider__item dp-item-col" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
		<div class="dp-event">
			<a class="dp-event__link" target="_blank" href="<?= $arItem['DISPLAY_PROPERTIES']['URL']['VALUE'] ?>">
				<div class="dp-event__caption">
					<div class="dp-event__tags">
						<? if (is_array($arItem["DISPLAY_PROPERTIES"]["THEME"]["DISPLAY_VALUE"])) { ?>
							<? foreach ($arItem["DISPLAY_PROPERTIES"]["THEME"]["DISPLAY_VALUE"] as $key => $val) { ?>
								<span class="dp-event__tag dp-event__category"><?=$val;?></span>
							<? } ?>
						<? } else if (mb_strlen($arItem["DISPLAY_PROPERTIES"]["THEME"]["DISPLAY_VALUE"]) > 0) { ?>
							<span class="dp-event__tag dp-event__category"><?=$arItem["DISPLAY_PROPERTIES"]["THEME"]["DISPLAY_VALUE"];?></span>
						<? } ?>
					</div>
					<h3 class="dp-event__title"><?= $arItem["NAME"] ?></h3>
					<?if(isset($arItem["DISPLAY_PROPERTIES"]["DATE_TIME_START"]["VALUE"]) && !empty($arItem["DISPLAY_PROPERTIES"]["DATE_TIME_START"]["VALUE"])){?>
						<div class="dp-event__meta"><span
								class="dp-event__live">Прямой эфир</span>
							<?
							$DATE_TIME_START = $arItem['DISPLAY_PROPERTIES']['DATE_TIME_START']['VALUE'];
							?>
							<time class="dp-event__date" datetime="<? echo FormatDate("c", MakeTimeStamp($DATE_TIME_START)); ?>">
								<? echo FormatDate("j F G:i", MakeTimeStamp($DATE_TIME_START)); ?> по МСК
							</time>
						</div>
					<?}?>
				</div>
				<div class="dp-event__speaker">
					<? if (!empty($arItem['PICTURE'])) { ?>
						<div class="dp-event__speaker-photo">
							<img src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
						</div>
					<? } ?>
					<div class="dp-event__speaker-caption">
						<p class="dp-event__speaker-title">Лектор:</p>
						<p class="dp-event__speaker-name"><?=$arItem['DISPLAY_PROPERTIES']['FIO']['DISPLAY_VALUE']?></p>
						<p class="dp-event__speaker-desc"><?= $arItem['PREVIEW_TEXT']; ?></p>
					</div>
				</div>
			</a>
		</div>
	</div>

<? endforeach; ?>

