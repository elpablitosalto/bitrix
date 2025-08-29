<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

if ($arResult['SECTIONS']) {
	$strSectionEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'SECTION_EDIT');
	$strSectionDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'SECTION_DELETE');
	$arSectionDeleteParams = ['CONFIRM' => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')];
	?>
	<div class="row anim-list">
		<?foreach ($arResult['SECTIONS'] as $arSection) {
			$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
			$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

			$img = [];
			$img = CFile::ResizeImageGet($arSection['~PICTURE'], ['width' => 360 * 2, 'height' => 240 * 2], BX_RESIZE_IMAGE_PROPORTIONAL, true, false, false, 100);
			$img = $img['src'] ? : SITE_TEMPLATE_PATH.'/img/no_photo.png';
			?>
			<div class="col-6 col-md-3" id="<?=$this->GetEditAreaId($arSection['ID'])?>">
				<div class="anim-item anim-item_article">
					<a class="anim-item__link" href="<?=$arSection['SECTION_PAGE_URL']?>">
						<div class="anim-item__img">
							<img class="lazyload" data-src="<?=$img?>" src="<?=$img?>" alt="<?=$arSection['NAME']?>">
						</div>
						<div class="anim-item__caption">
							<p class="anim-item__title"><?=$arSection['NAME']?></p>
							<time class="anim-item__date" datetime="<?=FormatDate('Y-m-d', MakeTimeStamp($arSection['DATE_CREATE']))?>">
								<?=FormatDate('j F Y', MakeTimeStamp($arSection['DATE_CREATE']))?>
							</time>
						</div>
					</a>
				</div>
			</div>
		<?}?>
	</div>
<?}?>