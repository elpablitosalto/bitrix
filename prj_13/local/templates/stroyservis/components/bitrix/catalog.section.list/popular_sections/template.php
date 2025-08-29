<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

use \Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

if (0 < $arResult["SECTIONS_COUNT"])
{
?>
	<section class="catalog">
		<?if ($arParams['HIDE_SECTION_NAME'] != 'Y'):?>
			<div class="title-section">
				<h2><?=Loc::getMessage('CATALOG_POPULAR_SECTIONS')?></h2>
				<a class="title-link" href="<?=SITE_DIR?>catalog/"><?=Loc::getMessage('TO_CATALOG')?></a>
			</div>
		<?endif;?>
		<ul class="catalog__list">
			<?
			foreach ($arResult['SECTIONS'] as &$arSection) {
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
				?>
				<li class="catalog__item" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
					<a href="<? echo $arSection['SECTION_PAGE_URL']; ?>">
						<div class="catalog__description">
							<p class="catalog__title"><? echo $arSection['NAME']; ?></p>
							<p class="catalog__notation"><? echo Indexis::num2word($arSection['ELEMENT_CNT'], ['#NUM# товар', '#NUM# товара', '#NUM# товаров']); ?></p>
						</div>
						<?if (!empty($arSection['UF_POPULAR_ICON'])):?>
							<div class="catalog__icon">
								<img loading="lazy" src="<?=CFile::GetPath($arSection['UF_POPULAR_ICON'])?>" alt="">
							</div>
						<?endif;?>
					</a>
				</li>
				<?
			}
			?>
		</ul>
	</section>
	<?
}
?>