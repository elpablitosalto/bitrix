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
$this->setFrameMode(true);
?>
<?
$siteName = SITE_SERVER_NAME;
$pictureSrc = !empty($arResult['DETAIL_PICTURE']['SRC']) ? $arResult['DETAIL_PICTURE']['SRC'] : '';
$detailUrl = !empty($arResult['DETAIL_PAGE_URL']) ? $arResult['DETAIL_PAGE_URL'] : '';
$pathToImage = "https://{$siteName}{$pictureSrc}";
$pathToDetail = "https://{$siteName}{$detailUrl}";
?>
<script type="application/ld+json">
  <?
  $arr = array(
    "@context" => "https://schema.org",
    "@type" => "Person",
    "image" => "https://{$siteName}{$pathToImage}",
    "jobTitle" => !empty($arResult['FIELDS']['PREVIEW_TEXT']) ? $arResult['FIELDS']['PREVIEW_TEXT'] : null,
    "name" => !empty($arResult['FIELDS']['NAME']) ? $arResult['FIELDS']['NAME'] : null,
    "image" => $pathToImage,
    "url" => $pathToDetail
  );

echo json_encode($arr, JSON_UNESCAPED_UNICODE);
?>
  </script>
<div class="page__section">

		<div class="page__entity-panel">
			<!-- begin .entity-panel-->
			<div class="entity-panel">
				<div class="entity-panel__main">
					<div class="entity-panel__illustration entity-panel__illustration_state_placeholder">
						<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
							<?
								$renderImage = CFile::ResizeImageGet(
									$arResult["DETAIL_PICTURE"],
									Array("width" => 198, "height" => 198),
									BX_RESIZE_IMAGE_PROPORTIONAL_ALT , true
								);
							?>
							<img
								class="entity-panel__image"
								src="<?=$renderImage["src"]?>"
								width="<?=$renderImage["width"]?>"
								height="<?=$renderImage["height"]?>"
								alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
								title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
							/>
						<?endif;?>
					</div>
					<h1 class="entity-panel__title"><?=$arResult["NAME"]?></h1>
					<div class="entity-panel__list">
						<?if(!empty($arResult["PROPERTIES"]["SHORT_PARAMETERS"]["VALUE"])):?>
							<!-- begin .list-->
							<ul class="list list_columns_2">
								<?foreach($arResult["PROPERTIES"]["SHORT_PARAMETERS"]["VALUE"] as $arProp):?>
									<li class="list__item" data-char-limit="62"><?=$arProp?></li>
								<?endforeach;?>
							</ul>
							<!-- end .list-->
						<?endif;?>
					</div>
					<div class="entity-panel__controls">
						<div class="entity-panel__control">
							<!-- begin .button-->
							<a href="#expertContent_<?=$arResult["ID"]?>" class="button button_width_full js-go-to" type="button" data-address="expertContent"><span class="button__holder"><span class="button__text">Читать автора</span></span>
							</a>
							<!-- end .button-->
						</div>
					</div>
				</div>
				<?if(!empty($arResult["PROPERTIES"]["PARAMETERS"]["VALUE"])):?>
					<div class="entity-panel__content">
						<!-- begin .entry-grid-->
						<div class="entry-grid entity-panel__entry-grid">
							<ul class="entry-grid__list">
								<?foreach($arResult["PROPERTIES"]["PARAMETERS"]["DESCRIPTION"] as $key => $arProp):?>
									<li class="entry-grid__item">
										<!-- begin .entry-->
										<div class="entry entry-grid__snippet">
											<div class="entry__labels">
												<div class="entry__label">
													<!-- begin .label-->
													<div class="label label_size_s label_style_light"><?=$arResult["PROPERTIES"]["PARAMETERS"]["VALUE"][$key] ?></div>
													<!-- end .label-->
												</div>
											</div>
											<div class="entry__text"><?=$arProp?></div>
										</div>
										<!-- end .entry-->
									</li>
								<?endforeach;?>
						</div>
						<!-- end .entry-grid-->
					</div>
				<?endif;?>
			</div>
			<!-- end .entity-panel-->
		</div>

</div>