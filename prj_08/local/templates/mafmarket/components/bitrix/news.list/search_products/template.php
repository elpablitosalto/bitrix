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

//vardump($arResult);

if (!empty($arResult["ITEMS"])) {
?>

	<p class="search__result-main">Результаты поиска: <span><?= $arParams['QUERY']; ?></span>
	</p>
	<p class="search__result-quantity"><?= Indexis::num2word_2($arParams['RESULTS_COUNT'], ['Показан #NUM# результат', 'Показано #NUM# результата', 'Показано #NUM# результатов']) ?>:</p>
	<p class="search__result-title">Изделия</p>
	<ul class="search__result-list js_list_wrapper js_nav_result_<?= $arResult['NAV_RESULT']->NavNum ?>">
		<? foreach ($arResult['ITEMS'] as $key => $arItem) { ?>
			<li class="search__result-item">
				<a class="search__result-image" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
					<img src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
				</a>
				<div class="search__result-description">
					<a class="search__result-name" href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['NAME'] ?></a>
					<div class="search__result-breadcrumbs">
						<?
						//vardump($arResult['NAV_CHAINS'][$arItem['IBLOCK_SECTION_ID']]);
						?>
						<ul class="breadcrumbs__list">
							<li class="breadcrumbs__item">
								<a class="breadcrumbs__link" href="/"><span>Главная</span>
									<meta content="0">
								</a>
							</li>
							<li class="breadcrumbs__item">
								<a class="breadcrumbs__link" href="/catalog/"><span>Каталог</span>
									<meta content="1">
								</a>
							</li>
							<?
							if (!empty($arResult['NAV_CHAINS'][$arItem['IBLOCK_SECTION_ID']])) {
								$ar = $arResult['NAV_CHAINS'][$arItem['IBLOCK_SECTION_ID']];
								$i = 0;
							?>
								<? foreach ($ar as $sId => $arS) { ?>
									<?
									$i++;
									if ($i == count($ar)) {
									?>
										<li class="breadcrumbs__item">
											<?= $arS['NAME']; ?>
										</li>
									<?
									} else {
									?>
										<li class="breadcrumbs__item">
											<a class="breadcrumbs__link" href="<?= $arS['SECTION_PAGE_URL']; ?>"><span><?= $arS['NAME']; ?></span>
												<meta content="2">
											</a>
										</li>
									<?
									}
									?>
								<? } ?>
							<? } ?>
						</ul>
					</div>
					<p class="search__result-text">
						<?= $arItem['PREVIEW_TEXT'] ?>
					</p>
				</div>
			</li>
		<? } ?>
	</ul>

	<div class="js_more_items <?= "js_nav_string_" . $arResult['NAV_RESULT']->NavNum; ?>">
		<?
		echo $arResult["NAV_STRING"];
		?>
		<?/*?>
		<a class="dp-btn search__result-more" href="#">Показать еще</a>
		<?*/ ?>
	</div>

<? } ?>