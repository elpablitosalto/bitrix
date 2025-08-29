<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;
use Bitrix\Main\Application,
	Bitrix\Main\Context;

$context = Context::getCurrent();
$request = $context->getRequest();

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 *
 *  _________________________________________________________________________
 * |	Attention!
 * |	The following comments are for system use
 * |	and are required for the component to work correctly in ajax mode:
 * |	<!-- items-container -->
 * |	<!-- pagination-container -->
 * |	<!-- component-end -->
 */

$this->setFrameMode(true);

if (!empty($arResult['NAV_RESULT'])) {
	$navParams =  array(
		'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
		'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
		'NavNum' => $arResult['NAV_RESULT']->NavNum
	);
} else {
	$navParams = array(
		'NavPageCount' => 1,
		'NavPageNomer' => 1,
		'NavNum' => $this->randString()
	);
}

$showTopPager = false;
$showBottomPager = false;
$showLazyLoad = false;

if ($arParams['PAGE_ELEMENT_COUNT'] > 0 && $navParams['NavPageCount'] > 1) {
	$showTopPager = $arParams['DISPLAY_TOP_PAGER'];
	$showBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
	$showLazyLoad = $arParams['LAZY_LOAD'] === 'Y' && $navParams['NavPageNomer'] != $navParams['NavPageCount'];
}

$templateLibrary = array('popup', 'ajax', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES'])) {
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList,
	'USE_PAGINATION_CONTAINER' => $showTopPager || $showBottomPager,
);
unset($currencyList, $templateLibrary);

$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

$positionClassMap = array(
	'left' => 'product-item-label-left',
	'center' => 'product-item-label-center',
	'right' => 'product-item-label-right',
	'bottom' => 'product-item-label-bottom',
	'middle' => 'product-item-label-middle',
	'top' => 'product-item-label-top'
);

$discountPositionClass = '';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION'])) {
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos) {
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
	}
}

$labelPositionClass = '';
if (!empty($arParams['LABEL_PROP_POSITION'])) {
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos) {
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
	}
}

$arParams['~MESS_BTN_BUY'] = ($arParams['~MESS_BTN_BUY'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_BUY');
$arParams['~MESS_BTN_DETAIL'] = ($arParams['~MESS_BTN_DETAIL'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_DETAIL');
$arParams['~MESS_BTN_COMPARE'] = ($arParams['~MESS_BTN_COMPARE'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_COMPARE');
$arParams['~MESS_BTN_SUBSCRIBE'] = ($arParams['~MESS_BTN_SUBSCRIBE'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_SUBSCRIBE');
$arParams['~MESS_BTN_ADD_TO_BASKET'] = ($arParams['~MESS_BTN_ADD_TO_BASKET'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_ADD_TO_BASKET');
$arParams['~MESS_NOT_AVAILABLE'] = ($arParams['~MESS_NOT_AVAILABLE'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE');
$arParams['~MESS_NOT_AVAILABLE_SERVICE'] = ($arParams['~MESS_NOT_AVAILABLE_SERVICE'] ?? '')
	?: Loc::getMessage('CP_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE_SERVICE');
$arParams['~MESS_SHOW_MAX_QUANTITY'] = ($arParams['~MESS_SHOW_MAX_QUANTITY'] ?? '') ?: Loc::getMessage('CT_BCS_CATALOG_SHOW_MAX_QUANTITY');
$arParams['~MESS_RELATIVE_QUANTITY_MANY'] = ($arParams['~MESS_RELATIVE_QUANTITY_MANY'] ?? '') ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = ($arParams['MESS_RELATIVE_QUANTITY_MANY'] ?? '') ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['~MESS_RELATIVE_QUANTITY_FEW'] = ($arParams['~MESS_RELATIVE_QUANTITY_FEW'] ?? '') ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_FEW');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = ($arParams['MESS_RELATIVE_QUANTITY_FEW'] ?? '') ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_FEW');

$arParams['MESS_BTN_LAZY_LOAD'] = $arParams['MESS_BTN_LAZY_LOAD'] ?: Loc::getMessage('CT_BCS_CATALOG_MESS_BTN_LAZY_LOAD');

$obName = 'ob' . preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($navParams['NavNum']));
$containerName = 'container-' . $navParams['NavNum'];

if ($showTopPager) {
?>
	<div data-pagination-num="<?= $navParams['NavNum'] ?>">
		<!-- pagination-container -->
		<?= $arResult['NAV_STRING'] ?>
		<!-- pagination-container -->
	</div>
<?
}
?>
<div class="nb-reviews">
	<?
	if (!empty($arResult['ITEMS']) && !empty($arResult['ITEM_ROWS'])) {
		$areaIds = [];
		$itemParameters = [];

		foreach ($arResult['ITEMS'] as $item) {
			$uniqueId = $item['ID'] . '_' . md5($this->randString() . $component->getAction());
			$areaIds[$item['ID']] = $this->GetEditAreaId($uniqueId);
			$this->AddEditAction($uniqueId, $item['EDIT_LINK'], $elementEdit);
			$this->AddDeleteAction($uniqueId, $item['DELETE_LINK'], $elementDelete, $elementDeleteParams);

			$itemParameters[$item['ID']] = [
				'SKU_PROPS' => $arResult['SKU_PROPS'][$item['IBLOCK_ID']],
				'MESS_NOT_AVAILABLE' => ($arResult['MODULES']['catalog'] && $item['PRODUCT']['TYPE'] === ProductTable::TYPE_SERVICE
					? $arParams['~MESS_NOT_AVAILABLE_SERVICE']
					: $arParams['~MESS_NOT_AVAILABLE']
				),
			];
		}
	?>
		<!-- items-container -->
		<div class="nb-reviews-main">
			<div class="nb-reviews-main__container">
				<div class="nb-reviews-main__list">
					<?
					foreach ($arResult['ITEMS'] as $item) {
					?>
						<div class="nb-reviews-main__col" id="<?= $areaIds[$item['ID']] ?>">
							<div class="nb-review-main">
								<div class="nb-review-main__inner">
									<div class="nb-review-main__header">
										<div class="nb-review-main__img">
											<img src="<?= $item['PICTURE']['SRC'] ?>" loading="lazy" alt="<?= $item['PREVIEW_PICTURE']['ALT'] ?>">
											<div class="swiper-lazy-preloader"></div>
										</div>
										<div class="nb-review-main__caption">
											<div class="nb-review-main__title"><?= $item['NAME']; ?></div>
											<p class="nb-review-main__name"><?= $item['PROPERTIES']['PATIENT_NAME']['VALUE'] ?><? if (!empty($item['PROPERTIES']['PATIENT_AGE']['VALUE'])) : ?>, <?= Indexis::num2word($item['PROPERTIES']['PATIENT_AGE']['VALUE'], ['#NUM# год', '#NUM# года', '#NUM# лет']) ?><? endif; ?></p>
										</div>
									</div>
									<div class="nb-review-main-slider">
										<div class="nb-review-main-slider__img">
											<img class="active" src="<?= $item['PICTURE']['SRC'] ?>" loading="lazy" alt="<?= $item['PREVIEW_PICTURE']['ALT'] ?>">
											<? if (!empty($item['PROPERTIES']['PICTURE_BEFORE']['VALUE'])) : ?>
												<img src="<?= $item['PICTURE_BEFORE']['SRC'] ?>" loading="lazy" alt="">
											<? endif; ?>
											<? if (!empty($item['PROPERTIES']['PICTURE_AFTER']['VALUE'])) : ?>
												<img src="<?= $item['PICTURE_AFTER']['SRC'] ?>" loading="lazy" alt="">
											<? endif; ?>
										</div>
										<div class="nb-review-main-slider__thumbs">
											<div class="nb-review-main-slider__thumbs-list <? if (empty($item['PROPERTIES']['PICTURE_BEFORE']['VALUE']) && empty($item['PROPERTIES']['PICTURE_AFTER']['VALUE'])) echo ' nb-review-main-slider__thumbs-list-center' ?>">
												<? if (!empty($item['PROPERTIES']['PICTURE_BEFORE']['VALUE']) || !empty($item['PROPERTIES']['PICTURE_AFTER']['VALUE'])) : ?>
													<div class="nb-review-main-slider__thumb nb-review-main-slider__thumb-patient nb-review-main-slider__thumb_active">
														<div class="nb-review-main-slider__thumb-img"><img src="<?= $item['PICTURE']['SRC'] ?>" loading="lazy" alt="<?= $item['PREVIEW_PICTURE']['ALT'] ?>"></div>
														<p class="nb-review-main-slider__thumb-desc">Пациент</p>
													</div>
												<? endif; ?>
												<? if (!empty($item['PROPERTIES']['PICTURE_BEFORE']['VALUE'])) : ?>
													<div class="nb-review-main-slider__thumb nb-review-main-slider__thumb-before">
														<div class="nb-review-main-slider__thumb-img">
															<img src="<?= $item['PICTURE_BEFORE']['SRC'] ?>" loading="lazy" alt="">
														</div>
														<p class="nb-review-main-slider__thumb-desc">Было</p>
													</div>
												<? endif; ?>
												<? if (!empty($item['PROPERTIES']['PICTURE_AFTER']['VALUE'])) : ?>
													<div class="nb-review-main-slider__thumb nb-review-main-slider__thumb-after">
														<div class="nb-review-main-slider__thumb-img">
															<img src="<?= $item['PICTURE_AFTER']['SRC'] ?>" loading="lazy" alt="">
														</div>
														<p class="nb-review-main-slider__thumb-desc">Стало</p>
													</div>
												<? endif; ?>
												<?
												$notBeforeAfter = false;
												if (empty($item['PROPERTIES']['PICTURE_BEFORE']['VALUE']) && empty($item['PROPERTIES']['PICTURE_AFTER']['VALUE'])) {
													$notBeforeAfter = true;
												}
												?>
												<div class="nb-review-main-slider__thumb nb-review-main-slider__thumb-text<?if($notBeforeAfter){echo ' nb-review-main-slider__thumb_disabled';}?>">
													<div class="nb-review-main-slider__thumb-img"><img src="<?= SITE_TEMPLATE_PATH ?>/img/design/review-desc-thumb.svg" loading="lazy" alt=""></div>
													<p class="nb-review-main-slider__thumb-desc">Отзыв</p>
												</div>
											</div>
											<?
											if (
												!empty($item['PROPERTIES']['PICTURE_BEFORE']['VALUE'])
												||
												!empty($item['PROPERTIES']['PICTURE_AFTER']['VALUE'])
											) {
											?>
												<p class="nb-review-main-slider__thumbs-notice">(наведите курсор, чтоб посмотреть)</p>
											<? } ?>
										</div>
									</div>
									<div class="nb-review-main__desc">
										<p class="nb-review-main__desc-title">Отзыв:</p>
										<div class="nb-review-main__desc-text">
											<?/*?><div><?=$item['PREVIEW_TEXT']?></div><?*/ ?>
											<?= $item['PREVIEW_TEXT'] ?>
										</div>
									</div>
									<?
									$reviewDate = FormatDate('d.m.Y', strtotime($item['DATE_ACTIVE_FROM']));
									?>
									<time class="nb-review-main__date" datetime="<?= $reviewDate ?>"><?= $reviewDate ?></time>
									<? if (is_array($item['DISPLAY_PROPERTIES']['DOCTORS']['LINK_ELEMENT_VALUE']) && count($item['DISPLAY_PROPERTIES']['DOCTORS']['LINK_ELEMENT_VALUE']) > 0) : ?>
										<div class="nb-review-main__doctors">
											<p class="nb-review-main__doctors-title">ВРАЧ(И):</p>
											<ul class="nb-review-main__doctors-list">
												<? foreach (array_slice($item['DISPLAY_PROPERTIES']['DOCTORS']['LINK_ELEMENT_VALUE'], 0, 3) as $arDoctor) : ?>
													<li class="nb-review-main__doctor">
														<a class="nb-review-main__doctor-link" href="<?= $arDoctor['DETAIL_PAGE_URL'] ?>">
															<span class="nb-review-main__doctor-name"><?= $arDoctor['NAME'] ?></span>
															<? if (isset($arResult['DOCTOR_SPECIALIZATIONS'][$arDoctor['ID']])) : ?>:
															<span class="nb-review-main__doctor-prof">
																<?= implode(', ', $arResult['DOCTOR_SPECIALIZATIONS'][$arDoctor['ID']]) ?>
															</span>
														<? endif; ?>
														</a>
													</li>
												<? endforeach; ?>
											</ul>
										</div>
									<? endif; ?>
								</div>
							</div>
						</div>
					<?
					}
					?>
				</div>
			</div>
		</div>
		<div class="nb-reviews-thumbs">
			<div class="nb-reviews-thumbs__container">
				<div class="nb-reviews-thumbs__list">
					<?
					foreach ($arResult['ITEMS'] as $item) {
					?>
						<div class="nb-reviews-thumbs__col">
							<div class="nb-review-thumb">
								<div class="nb-review-thumb__top">
									<div class="nb-review-thumb__img">
										<img src="<?= $item['PICTURE']['SRC'] ?>" loading="lazy" alt="<?= $item['PREVIEW_PICTURE']['ALT'] ?>">
									</div>
									<div class="nb-review-thumb__caption">
										<div class="nb-review-thumb__title"><?= $item['NAME'] ?></div>
										<p class="nb-review-thumb__name">
											<?= $item['PROPERTIES']['PATIENT_NAME']['VALUE'] ?><? if (!empty($item['PROPERTIES']['PATIENT_AGE']['VALUE'])) : ?>, <?= Indexis::num2word($item['PROPERTIES']['PATIENT_AGE']['VALUE'], ['#NUM# год', '#NUM# года', '#NUM# лет']) ?><? endif; ?>
										</p>
									</div>
								</div>
								<div class="nb-review-thumb__desc">
									<?
									$text = $item['PREVIEW_TEXT'];
									/*
									$maxLen = 250;
									if (mb_strlen($text) > $maxLen) {
										$text = TruncateText($text, $maxLen);
									}
									*/
									?>
									<p><?= $text ?></p>
								</div>
								<span class="nb-review-thumb__link">Весь отзыв с фото</span>
							</div>
						</div>
					<?
					}
					?>
					<?
					if (count($arResult['ITEMS']) == 1) {
					?>
						<div class="nb-reviews-thumbs__col">
							<div class="nb-thumb nb-thumb_person">
								<div class="nb-thumb__top">
									<div class="nb-thumb__img"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/reviews/review-2-1.jpg" loading="lazy" alt=""></div>
									<div class="nb-thumb__caption">
										<p class="nb-thumb__name">Ольга</p>
										<div class="nb-thumb__title">Отдел контроля качества</div>
									</div>
								</div>
								<div class="nb-thumb__desc">
									<p>Нам очень важно знать ваше мнение о нашей работе. <br>По любым вопросам, связанным с&nbsp;качеством сервиса и лечения в нашей клинике, вы всегда можете можете обратится по&nbsp;телефону: <span style="white-space:nowrap;font-weight:700;">+7 (495) 783-66-06</span></p>
								</div>
							</div>
						</div>
						<div class="nb-reviews-thumbs__col">
							<div class="nb-thumb nb-thumb_person">
								<div class="nb-thumb__top">
									<div class="nb-thumb__img"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/reviews/review-2-1.jpg" loading="lazy" alt=""></div>
									<div class="nb-thumb__caption">
										<p class="nb-thumb__name">Ольга</p>
										<div class="nb-thumb__title">Отдел контроля качества</div>
									</div>
								</div>
								<div class="nb-thumb__desc">
									<p>Нам очень важно знать ваше мнение о нашей работе. <br>По любым вопросам, связанным с&nbsp;качеством сервиса и лечения в нашей клинике, вы всегда можете можете обратится по&nbsp;телефону: <span style="white-space:nowrap;font-weight:700;">+7 (495) 783-66-06</span></p>
								</div>
							</div>
						</div>
					<?
					}
					?>
					<?
					if (count($arResult['ITEMS']) == 2) {
						?>
						<div class="nb-reviews-thumbs__col">
							<div class="nb-thumb nb-thumb_person">
								<div class="nb-thumb__top">
									<div class="nb-thumb__img"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/reviews/review-2-1.jpg" loading="lazy" alt=""></div>
									<div class="nb-thumb__caption">
										<p class="nb-thumb__name">Ольга</p>
										<div class="nb-thumb__title">Отдел контроля качества</div>
									</div>
								</div>
								<div class="nb-thumb__desc">
									<p>Нам очень важно знать ваше мнение о нашей работе. <br>По любым вопросам, связанным с&nbsp;качеством сервиса и лечения в нашей клинике, вы всегда можете можете обратится по&nbsp;телефону: <span style="white-space:nowrap;font-weight:700;">+7 (495) 783-66-06</span></p>
								</div>
							</div>
						</div>
						<?
					}
					?>
				</div>
			</div>
		</div>
		<!-- items-container -->
	<?
	}
	?>
	<? if (count($arResult['ITEMS']) > 3) : ?>
		<div class="nb-pagination">
			<div class="nb-pagination__inner">
				<div class="nb-pagination__counter"><span class="font-weight_bold">3</span> из <?= $arResult['NAV_RESULT']->NavRecordCount ?></div>
				<button class="nb-btn nb-btn_light nb-btn_shadow nb-pagination__btn" type="button">Показать еще</button>
			</div>
		</div>
	<? endif; ?>
</div>
<?
if ($showLazyLoad) {
?>
	<div class="nb-pagination" data-entity="wrap-show-more-<?= $navParams['NavNum'] ?>">
		<div class="nb-pagination__inner" data-entity="inner-show-more-<?= $navParams['NavNum'] ?>">
			<?
			if ($showBottomPager) {
			?>
				<div data-pagination-num="<?= $navParams['NavNum'] ?>">
					<!-- pagination-container -->
					<?= $arResult['NAV_STRING'] ?>
					<!-- pagination-container -->
				</div>
			<?
			}
			?>
			<button class="nb-btn nb-btn_light nb-btn_shadow nb-pagination__btn" type="button" data-use="show-more-<?= $navParams['NavNum'] ?>"><?= $arParams['MESS_BTN_LAZY_LOAD'] ?></button>
		</div>
	</div>
<?
}

$signer = new \Bitrix\Main\Security\Sign\Signer;
$signedTemplate = $signer->sign($templateName, 'catalog.section');
$signedParams = $signer->sign(base64_encode(serialize($arResult['ORIGINAL_PARAMETERS'])), 'catalog.section');
?>
<? if (!empty($request->getQuery("bxajaxid"))) : ?>
	<script>
		if (typeof reviews == 'function')
			reviews(document.querySelector('#comp_<?= $request->getQuery("bxajaxid") ?> .nb-reviews'));
	</script>
<? endif; ?>
<script>
	BX.message({
		BTN_MESSAGE_BASKET_REDIRECT: '<?= GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT') ?>',
		BASKET_URL: '<?= $arParams['BASKET_URL'] ?>',
		ADD_TO_BASKET_OK: '<?= GetMessageJS('ADD_TO_BASKET_OK') ?>',
		TITLE_ERROR: '<?= GetMessageJS('CT_BCS_CATALOG_TITLE_ERROR') ?>',
		TITLE_BASKET_PROPS: '<?= GetMessageJS('CT_BCS_CATALOG_TITLE_BASKET_PROPS') ?>',
		TITLE_SUCCESSFUL: '<?= GetMessageJS('ADD_TO_BASKET_OK') ?>',
		BASKET_UNKNOWN_ERROR: '<?= GetMessageJS('CT_BCS_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
		BTN_MESSAGE_SEND_PROPS: '<?= GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_SEND_PROPS') ?>',
		BTN_MESSAGE_CLOSE: '<?= GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE') ?>',
		BTN_MESSAGE_CLOSE_POPUP: '<?= GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE_POPUP') ?>',
		COMPARE_MESSAGE_OK: '<?= GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_OK') ?>',
		COMPARE_UNKNOWN_ERROR: '<?= GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
		COMPARE_TITLE: '<?= GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_TITLE') ?>',
		PRICE_TOTAL_PREFIX: '<?= GetMessageJS('CT_BCS_CATALOG_PRICE_TOTAL_PREFIX') ?>',
		RELATIVE_QUANTITY_MANY: '<?= CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY']) ?>',
		RELATIVE_QUANTITY_FEW: '<?= CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW']) ?>',
		BTN_MESSAGE_COMPARE_REDIRECT: '<?= GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
		BTN_MESSAGE_LAZY_LOAD: '<?= CUtil::JSEscape($arParams['MESS_BTN_LAZY_LOAD']) ?>',
		BTN_MESSAGE_LAZY_LOAD_WAITER: '<?= GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_LAZY_LOAD_WAITER') ?>',
		SITE_ID: '<?= CUtil::JSEscape($component->getSiteId()) ?>'
	});
	var <?= $obName ?> = new JCCatalogSectionComponent({
		siteId: '<?= CUtil::JSEscape($component->getSiteId()) ?>',
		componentPath: '<?= CUtil::JSEscape($componentPath) ?>',
		navParams: <?= CUtil::PhpToJSObject($navParams) ?>,
		deferredLoad: false, // enable it for deferred load
		initiallyShowHeader: '<?= !empty($arResult['ITEM_ROWS']) ?>',
		bigData: <?= CUtil::PhpToJSObject($arResult['BIG_DATA']) ?>,
		lazyLoad: !!'<?= $showLazyLoad ?>',
		loadOnScroll: !!'<?= ($arParams['LOAD_ON_SCROLL'] === 'Y') ?>',
		template: '<?= CUtil::JSEscape($signedTemplate) ?>',
		ajaxId: '<?= CUtil::JSEscape($arParams['AJAX_ID'] ?? '') ?>',
		parameters: '<?= CUtil::JSEscape($signedParams) ?>',
		container: '<?= $containerName ?>'
	});
</script>
<!-- component-end -->