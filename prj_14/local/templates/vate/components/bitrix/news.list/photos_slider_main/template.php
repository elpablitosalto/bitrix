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
<? if (!empty($arResult["ITEMS"])) { ?>
	<div class="page__section">
		<!-- begin .section-->
		<div class="section section_spacing_top-none">
			<div class="section__main">
				<div class="section__header section__header_align_center page__container">
					<div class="section__header-container">
						<div class="section__title">
							<!-- begin .title-->
							<h2 class="title title_size_h1 title_align_center title_case_upper title_style_gradient">Фото
							</h2>
							<!-- end .title-->
						</div>
					</div>
				</div>
				<div class="section__content">
					<!-- begin .photo-carousel-->
					<div class="photo-carousel">
						<div class="photo-carousel__container swiper js-photo-carousel">
							<div class="photo-carousel__wrapper swiper-wrapper">
								<? foreach ($arResult["ITEMS"] as $arItem) { ?>
									<?
									$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
									$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
									?>
									<div class="photo-carousel__slide swiper-slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
										<a class="photo-carousel__illustration" href="<?= $arItem['DETAIL_PICTURE_SLIDER']['SRC']; ?>" data-fancybox="gallery">
											<picture class="photo-carousel__picture">
												<img src="<?= $arItem['PREVIEW_PICTURE_SLIDER']['SRC']; ?>" alt="<?= $arItem['PREVIEW_PICTURE_SLIDER']["ALT"] ?>" title="<?= $arItem['PREVIEW_PICTURE_SLIDER']["TITLE"] ?>" class="photo-carousel__image" />
											</picture>
										</a>
									</div>
								<? } ?>
							</div>
						</div>
						<div class="photo-carousel__navigation">
							<div class="photo-carousel__pagination">
								<!-- begin .bullet-pagination-->
								<div class="bullet-pagination bullet-pagination_role_photo">
								</div>
								<!-- end .bullet-pagination-->
							</div>
						</div>
					</div>
					<!-- end .photo-carousel-->
				</div>
			</div>
		</div>
		<!-- end .section-->
	</div>
<? } ?>