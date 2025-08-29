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
if (!empty($arResult['SECTIONS'])) {
?>
	<section class="category-mapei">
		<h2 class="category-mapei__title">Товары <?= $arParams['BRAND_NAME']; ?> есть в категориях:</h2>
		<ul class="category__list">
			<?
			$i = 0;
			foreach ($arResult['SECTIONS'] as &$arSection) {
				$i++;
				$active = '';
				if ($i == 1) {
					$active = 'category-item_active';
				}
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
			?>

				<li class="category__item" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
					<a class="category__link" href="<?= $arSection["SECTION_PAGE_URL_FILTER"]; ?>">
						<p class="category__title">
							<?= $arSection["NAME"]; ?> <span>(<?= $arParams['AR_COUNT_ELEMENTS'][$arSection['ID']] ?>)</span>
						</p>
						<div class="category__image">
							<img src="<?= $arSection['PICTURE']['SRC'] ?>" alt="<?= $arSection['PICTURE']['ALT'] ?>" title="<?= $arSection['PICTURE']['TITLE'] ?>" />
						</div>
					</a>
				</li>
			<?
			}
			?>
		</ul>
		<button class="category__show-list category__show-list_hidden">Смотреть все категории</button>
	</section>

	<?
	//vardump($arParams['COUNT_ELEMENTS']);
	//vardump($arResult['arSectionsIds']);
	?>

	<?/*?>
	<ul class="category-list">
		<?
		$i = 0;
		foreach ($arResult['SECTIONS'] as &$arSection) {
			$i++;
			$active = '';
			if ($i == 1) {
				$active = 'category-item_active';
			}
			$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
			$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
		?>
			<li class="category-item <?= $active; ?>" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
				<div class="category-image">
					<img src="<?= $arSection['PICTURE']['SRC'] ?>" alt="<?= $arSection['PICTURE']['ALT'] ?>" title="<?= $arSection['PICTURE']['TITLE'] ?>" />
				</div><?= $arSection["NAME"]; ?>
			</li>
		<?
		}
		?>
		<li class="category-item">
			<div class="category-image"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/category/spectralock.png" alt=""></div>Акции
		</li>
	</ul>
	<?*/ ?>
<? } ?>