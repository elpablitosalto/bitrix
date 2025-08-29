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
<input type="hidden" value="30" id="js_learned_time" />
<input type="hidden" value="Y" id="js_learned_start_countdown" />
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

	<div class="dp-article-detail__body">
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
		<?= $arResult['DETAIL_TEXT']; ?>
	</div>

	<? if ($arResult['HIDE_FOR_NO_AUTHORIZED'] == 'Y') { ?>
		<div class="note-reg">
			<p class="note-reg__title">Бесплатно после регистрации личного кабинета</p>
			<button class="dp-btn dp-btn_orange note-reg__btn" type="button" data-modal="#modal-auth" data-mb-block="2">Зарегистрироваться</button>
		</div>
	<? } ?>

	<? if ($arResult['HIDE_FOR_NO_AUTHORIZED'] != 'Y') { ?>
		<div class="dp-article-detail__footer">
			<div class="dp-article-detail__meta">
				<? if (!empty($arResult["DISPLAY_PROPERTIES"]['AUTHOR']['DISPLAY_VALUE'])) { ?>
					<p class="dp-article-detail__author">
						Автор статьи: <span class="medium"><?= $arResult["DISPLAY_PROPERTIES"]['AUTHOR']['DISPLAY_VALUE']; ?></span>
					</p>
				<? } ?>
				<? if (!empty($arResult["ACTIVE_FROM"])) { ?>
					<time class="dp-article-detail__date" datetime="<? echo FormatDate("Y-m-d", MakeTimeStamp($arResult["ACTIVE_FROM"])); ?>">
						<? echo FormatDate("j F Y", MakeTimeStamp($arResult["ACTIVE_FROM"])); ?>
					</time>
				<? } ?>
			</div>
			<div class="dp-article-detail__share">
				<div class="dp-share">
					<p class="dp-share__title">Поделиться статьей:</p>
					<script src="https://yastatic.net/share2/share.js"></script>
					<div class="ya-share2" data-curtain data-size="l" data-shape="round" data-limit="3" data-services="vkontakte,odnoklassniki,telegram"></div>
				</div>
			</div>
			<?/*?>
			<div class="dp-article-detail__share">
				<div class="dp-share">
					<p class="dp-share__title">Поделиться статьей:</p>
					<ul class="dp-share__list">
						<li class="dp-share__item"><a class="dp-share__link" href="#">
								<svg class="icon icon-vk ">
									<use xlink:href="#vk"></use>
								</svg></a></li>
						<li class="dp-share__item"><a class="dp-share__link" href="#">
								<svg class="icon icon-ok ">
									<use xlink:href="#ok"></use>
								</svg></a></li>
						<li class="dp-share__item"><a class="dp-share__link" href="#">
								<svg class="icon icon-tg ">
									<use xlink:href="#tg"></use>
								</svg></a></li>
					</ul>
				</div>
			</div>
			<?*/ ?>
		</div>
	<? } ?>
</div>