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
<input type="hidden" value="180" id="js_learned_time" />
<input type="hidden" value="N" id="js_learned_start_countdown" />
<input type="hidden" id="js_buy_link" data-go-link="N" value="" />
<input type="hidden" id="js_material_detail_page_url" value="<?= $arResult['DETAIL_PAGE_URL']; ?>" />

<?
$addClass = '';
if ($arResult['HIDE_FOR_NO_AUTHORIZED'] == 'Y') {
	$addClass = 'dp-article-detail-public';
}
?>
<div class="dp-article-detail <?= $addClass; ?>">
	<? if (!empty($arResult["DISPLAY_PROPERTIES"]['THEME']['DISPLAY_VALUE'])) { ?>
		<div class="dp-article-detail__header">
			<ul class="dp-article-detail__tags">
				<? foreach ($arResult["DISPLAY_PROPERTIES"]['THEME']['DISPLAY_VALUE'] as $key => $val) { ?>
					<li class="dp-article-detail__tag"><?= $val; ?></li>
				<? } ?>
			</ul>
		</div>
	<? } ?>

	<? if ($arResult['SHOW_BODY'] != 'N') { ?>
		<div class="dp-article-detail__body <? if ($arParams['USER_AUTHORIZED'] != 'Y') { ?><? } ?>" <? if (empty($arResult["ACTIVE_FROM"])) { ?> style="padding-bottom: 0;" <? } ?>>
			<? if ($arResult['SHOW_WAIT_PAYMENT'] == 'Y') { ?>
				<div class="note-reg dp-note-reg-webinar">
					<p class="note-reg__title">Пожалуйста, подождите пока пройдёт оплата. Обычно это занимает несколько минут. После этого вебинар будет доступен для просмотра. </p>
				</div>
			<? } else if ($arParams['USER_AUTHORIZED'] != 'Y' || $arResult['SHOW_PAID'] == 'N') {
				$str = 'Смотрите полное видео вебинара бесплатно после регистрации личного кабинета';
				if ($arResult['SHOW_PAID'] == 'N') {
					$str = 'Смотрите полное видео вебинара после оплаты';
				}
			?>
				<div class="note-reg dp-note-reg-webinar">
					<p class="note-reg__title"><?= $str; ?></p>
					<? if ($arResult['SHOW_PAID'] == 'N') { ?>
						<button class="dp-btn dp-btn_orange note-reg__btn js_buy_check_auth" type="button" data-link="<?= $arResult['DISPLAY_PROPERTIES']['BUY_LINK']['VALUE'] ?>" data-mb-block="2">Купить</button>
					<? } else { ?>
						<button class="dp-btn dp-btn_orange note-reg__btn" type="button" data-modal="#modal-auth" data-mb-block="2">Зарегистрироваться</button>
					<? } ?>
				</div>
			<? } ?>
			<? if ($arResult['HIDE_FOR_NO_AUTHORIZED'] == 'Y') { ?>
				<? if (!empty($arResult['PICTURE'])) { ?>
					<figure>
						<picture class="dp-article-detail__img">
							<img src="<?= $arResult['PICTURE']['SRC']; ?>" alt="<?= $arResult['PICTURE']['ALT']; ?>" title="<?= $arResult['PICTURE']['TITLE']; ?>" />
						</picture>
						<?/*?>
						<figcaption>На вебинаре обсудили понятие биосимиляров, механизм создания и введения в практику, доказательства безопасности, практическую значимость и клинический пример их назначения</figcaption>
						<?*/ ?>
					</figure>
				<? } ?>
			<? } else { ?>
				<? if (!empty($arResult['FILE_VIDEO'])) { ?>
					<div class="dp-video">
						<video preload="none" controls src="<?= $arResult['FILE_VIDEO']['SRC']; ?>" poster="<?= $arResult["DISPLAY_PROPERTIES"]['VIDEO_PREVIEW']['FILE_VALUE']['SRC']; ?>"></video>
						<? if (!empty($arResult["DISPLAY_PROPERTIES"]['VIDEO_PREVIEW']['FILE_VALUE'])) { ?>
							<div class="dp-video__poster" style="background-image: url(<?= $arResult["DISPLAY_PROPERTIES"]['VIDEO_PREVIEW']['FILE_VALUE']['SRC']; ?>)"></div>
						<? } ?>

						<?
						$class = '';
						if ($arResult['SHOW_FULL_VIDEO'] == 'Y') {
							$class = 'js_play_webinar';
						}
						?>
						<button class="dp-btn-video dp-video__play test <?= $class; ?>" type="button">
							<span class="dp-btn-video__icon">
								<svg class="icon icon-play ">
									<use xlink:href="#play"></use>
								</svg>
							</span>
						</button>
					</div>
				<? } ?>
			<? } ?>
			<?= $arResult['DETAIL_TEXT']; ?>
		</div>
	<? } ?>

	<?
	//if ($arResult['HIDE_FOR_NO_AUTHORIZED'] != 'Y') { 
	if ($arParams['USER_AUTHORIZED'] != 'Y') {
	?>
		<? if (!empty($arResult["ACTIVE_FROM"])) { ?>
			<div class="dp-article-detail__footer">
				<div class="dp-article-detail__meta">
					<time class="dp-article-detail__date" datetime="<? echo FormatDate("Y-m-d", MakeTimeStamp($arResult["ACTIVE_FROM"])); ?>">
						<? echo FormatDate("j F Y", MakeTimeStamp($arResult["ACTIVE_FROM"])); ?>
					</time>
				</div>
			</div>
		<? } ?>
	<? } ?>
</div>