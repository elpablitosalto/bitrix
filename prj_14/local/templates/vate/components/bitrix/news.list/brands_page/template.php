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
	<div class="page__section page__section_top_gradient">
		<div class="page__container">
			<!-- begin .section-->
			<div class="section section_spacing_top-none">
				<div class="section__main">
					<div class="section__header">
						<div class="section__header-container">
							<div class="section__title">
								<!-- begin .title-->
								<h1 class="title title_size_h1 title_case_upper title_style_gradient">
									Бренды производителей
								</h1>
								<!-- end .title-->
							</div>
						</div>
					</div>
					<!-- begin .brands-grid-->
					<div class="brands-grid">
						<div class="brands-grid__grid js_nav_result_<?= $arResult['NAV_RESULT']->NavNum ?>"">
							<? foreach ($arResult["ITEMS"] as $arItem) { ?>
								<?
								$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
								$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
								?>
								<a class="brands-grid__item" href="<?= $arItem['DETAIL_PAGE_URL']; ?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
									<!-- begin .brand-->
									<span class="brand">
										<span class="brand__wrapper">
											<span class="brand__illustration">
												<picture class="brand__picture">
													<img src="<?= $arItem['DETAIL_PICTURE_SLIDER']['SRC']; ?>" alt="<?= $arItem['DETAIL_PICTURE_SLIDER']["ALT"] ?>" title="<?= $arItem['DETAIL_PICTURE_SLIDER']["TITLE"] ?>" class="brand__image" />
												</picture>
											</span>
											<span class="brand__title"><?= $arItem['NAME']; ?></span>
										</span>
									</span>
									<!-- end .brand-->
								</a>
							<? } ?>
						</div>
						<?
						$navNum = $arResult['NAV_RESULT']->NavNum;
						?>
						<div class="brands-grid__controls js_nav_string <?= "js_nav_string_" . $navNum; ?>">
							<?
							echo $arResult["NAV_STRING"];
							?>
						</div>
					</div>
					<!-- end .brands-grid-->
				</div>
			</div>
			<!-- end .section-->
		</div>
	</div>
<? } ?>