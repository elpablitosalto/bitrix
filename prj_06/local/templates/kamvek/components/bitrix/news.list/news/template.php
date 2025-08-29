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
<div id="ArtikelTeaserWrapper" class="respBlock">
	<div id="ArtikelTeaser">
		<? 
		$i = 0;
		foreach ($arResult["ITEMS"] as $arItem) {
			$i++;
			$ext_class = '';
			if ($i == 1 || $i == 2) {
				$ext_class = 'oben';
			}
		?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<a id="<?= $this->GetEditAreaId($arItem['ID']); ?>" class="newsTeaser <?= $ext_class ?>" href="<?= $arItem['DETAIL_PAGE_URL']; ?>" title="<?= $arItem['NAME']; ?>" itemscope itemtype="https://schema.org/NewsArticle">
				<div itemprop="image" itemscope itemtype="https://schema.org/ImageObject" class="img" style="background-image: url();">
					<img loading="lazy" src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" width="<?= $arItem['PICTURE']['WIDTH']; ?>" height="<?= $arItem['PICTURE']['HEIGHT']; ?>" />
					<meta itemprop="url" content="<?= $arItem['SOURCE_PICTURE']['SRC']; ?>">
					<meta itemprop="width" content="<?= $arItem['SOURCE_PICTURE']['WIDTH']; ?>">
					<meta itemprop="height" content="<?= $arItem['SOURCE_PICTURE']['HEIGHT']; ?>">
				</div>
				<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
					<div class="teaserExtras">
						<span class="datum"><?= $arItem['DISPLAY_ACTIVE_FROM']; ?></span>
					</div>
				<?endif?>
				<div class="teaserText">
					<h2 class="title" itemprop="name" style="min-height: 89px"><?= $arItem['NAME']; ?></h2>
					<meta itemprop="url" content="<?= $arItem['DETAIL_PAGE_URL']; ?>" />
					<meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="<?= $arItem['DETAIL_PAGE_URL']; ?>" />
					<meta itemprop="headline" content="<?= $arItem['NAME']; ?>" />
					<p class="summary" itemprop="description"><?= TruncateText($arItem['PREVIEW_TEXT'], $arParams['PREVIEW_TRUNCATE_LEN']); ?></p>
					<p class="teaserExtras">
						<meta itemprop="dateModified" content="<?= $arItem['DATE_UPDATE_FORMAT_M'] ?>" />
						<meta itemprop="datePublished" content="<?= $arItem['DATE_CREATE_FORMAT_M'] ?>" />
						<span itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
							<meta itemprop="name" content="Каменный век" />
						</span>
						<?/*?>
						<span class="kat icon-category">Unternehmen, Filme / Audio</span>
						<?*/ ?>
					</p>
				</div>
			</a>
		<? } ?>
	</div>
</div>
<?= $arResult['NAV_STRING'] ?>

<?/*?>
<aside class="nextprev">
	<div class="paginatedPages">

		1

		<a href="/news?start=15">2</a>

		<a href="/news?start=30">3</a>

		<a href="/news?start=45">4</a>

		<a href="/news?start=60">5</a>

		<a href="/news?start=75">6</a>

		<a href="/news?start=90">7</a>

		<a href="/news?start=105">8</a>

		<a href="/news?start=120">9</a>

		<a href="/news?start=135">10</a>

		<a href="/news?start=150">11</a>

		<a href="/news?start=165">12</a>

		<a href="/news?start=180">13</a>

		<a href="/news?start=195">14</a>

		<a href="/news?start=210">15</a>

		<a href="/news?start=225">16</a>
	</div>
</aside>
<?*/?>