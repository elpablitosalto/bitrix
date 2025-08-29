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
	<section class="dp-section">
		<div class="container">
			<div class="dp-section__body">
				<?
				foreach ($arResult["ITEMS"] as $arItem) {
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
					<?/*?><div id="<?= $this->GetEditAreaId($arItem['ID']); ?>"><?*/?>
						<div class="production__wrapper" id="<?= $arItem['CODE']; ?>">
							<?
							switch ($arItem['DISPLAY_PROPERTIES']['BLOCK_TYPE']['VALUE_XML_ID']) {
								case 'TYPE_1':
							?>

									<h3><?= $arItem['DISPLAY_PROPERTIES']['HEADER']['VALUE']; ?></h3>
									<div class="production__image-wrapper">
										<div class="production__image">
											<img src="<?= $arItem['PICTURE_1']['SRC']; ?>" alt="<?= $arItem['PICTURE_1']['ALT']; ?>" title="<?= $arItem['PICTURE_1']['TITLE']; ?>" />
										</div>
										<p class="production__text">
											<?= $arItem['PREVIEW_TEXT']; ?>
										</p>
									</div>
									<div class="production__image">
										<img src="<?= $arItem['PICTURE_2']['SRC']; ?>" alt="<?= $arItem['PICTURE_2']['ALT']; ?>" title="<?= $arItem['PICTURE_2']['TITLE']; ?>" />
									</div>

								<?
									break;
								case 'TYPE_2':
								?>
									<h3><?= $arItem['DISPLAY_PROPERTIES']['HEADER']['VALUE']; ?></h3>
									<div class="production__image">
										<img src="<?= $arItem['PICTURE_1']['SRC']; ?>" alt="<?= $arItem['PICTURE_1']['ALT']; ?>" title="<?= $arItem['PICTURE_1']['TITLE']; ?>" />
									</div>
									<p class="production__text production__mb">
										<?= $arItem['PREVIEW_TEXT']; ?>
									</p>
									<div class="production__image">
										<img src="<?= $arItem['PICTURE_2']['SRC']; ?>" alt="<?= $arItem['PICTURE_2']['ALT']; ?>" title="<?= $arItem['PICTURE_2']['TITLE']; ?>" />
									</div>
								<?
									break;
								case 'TYPE_3':
								?>
									<h3 class="production__short">
										<?= $arItem['DISPLAY_PROPERTIES']['HEADER']['VALUE']; ?>
									</h3>
									<p class="production__text production__mb production__short">
										<?= $arItem['PREVIEW_TEXT']; ?>
									</p>
									<div class="production__text-wrapper">
										<div class="production__image">
											<img src="<?= $arItem['PICTURE_1']['SRC']; ?>" alt="<?= $arItem['PICTURE_1']['ALT']; ?>" title="<?= $arItem['PICTURE_1']['TITLE']; ?>" />
										</div>
										<div class="production__image">
											<img src="<?= $arItem['PICTURE_2']['SRC']; ?>" alt="<?= $arItem['PICTURE_2']['ALT']; ?>" title="<?= $arItem['PICTURE_2']['TITLE']; ?>" />
										</div>
									</div>
								<?
									break;
								case 'TYPE_4':
								?>
									<h2><?= $arItem['DISPLAY_PROPERTIES']['HEADER']['VALUE']; ?></h2>
									<div class="production__text-wrapper">
										<?= $arItem['PREVIEW_TEXT']; ?>
									</div>
									<p class="production__text">
										<?= $arItem['DETAIL_TEXT']; ?>
									</p>
								<?
									break;
								case 'TYPE_5':
								?>
									<h2><?= $arItem['DISPLAY_PROPERTIES']['HEADER']['VALUE']; ?></h2>
									<div class="production__image">
										<img src="<?= $arItem['PICTURE_1']['SRC']; ?>" alt="<?= $arItem['PICTURE_1']['ALT']; ?>" title="<?= $arItem['PICTURE_1']['TITLE']; ?>" />
									</div>
							<?
									break;
							}
							?>
						</div>
					<?/*?></div><?*/?>
				<?
				}
				?>
			</div>
		</div>
	</section>
<? } ?>