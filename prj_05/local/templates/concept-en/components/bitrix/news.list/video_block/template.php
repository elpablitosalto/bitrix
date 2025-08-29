<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<? if (!empty($arResult['ITEMS'])) { ?>
	<div class="page__section">
		<!-- begin .section-->
		<div class="section">
			<div class="section__main">
				<div class="section__header">
					<div class="section__header-container page__container">
						<div class="section__title">
							<!-- begin .title-->
							<h2 class="title title_size_h2 title_font_secondary title_align_center title_weight_bold">
								<?= GetMessage('VIDEO_BLOCK_MATERIALS') ?>
							</h2>
							<!-- end .title-->
						</div>
					</div>
				</div>
				<div class="section__content">
					<div class="page__container">
						<div class="section__video-group">
							<!-- begin .video-group-->
							<div class="video-group">
								<div class="video-group__main">
									<ul class="video-group__list">
										<? foreach ($arResult['ITEMS'] as $k => $arItem) { ?>
											<?
											$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
											$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
											?>
											<li class="video-group__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
												<!-- begin .video-snippet-->
												<div class="video-snippet">													
													<a class="video-snippet__preview js-modal" data-type="iframe" href="<?= $arItem['VIDEO_LINK'];?>">
														<picture class="video-snippet__picture">
															<img src="<?= $arItem['VIDEO_PREVIEW_SLIDER']['SRC']; ?>" alt="<?= $arItem['VIDEO_PREVIEW_SLIDER']["ALT"] ?>" title="<?= $arItem['VIDEO_PREVIEW_SLIDER']["TITLE"] ?>" class="video-snippet__image" />
														</picture>
														<span class="video-snippet__play-icon"><svg class="video-snippet__icon" width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
																<path d="M60.646 38.8987L31.4643 18.8987C31.057 18.6213 30.5318 18.5907 30.0967 18.8213C29.6629 19.052 29.391 19.5053 29.391 20V60C29.391 60.4947 29.6629 60.948 30.098 61.1787C30.2917 61.2827 30.5052 61.3333 30.7175 61.3333C30.9788 61.3333 31.2401 61.2547 31.4643 61.1013L60.646 41.1013C61.0081 40.8533 61.2256 40.4413 61.2256 40C61.2256 39.5587 61.0081 39.1467 60.646 38.8987ZM32.0439 57.476V22.524L57.5448 40L32.0439 57.476Z" />
															</svg>
														</span>
													</a>
													<div class="video-snippet__info">
														<div class="video-snippet__section">
															<div class="video-snippet__text">
																<?= $arItem['NAME']; ?>
															</div>
														</div>
													</div>
												</div>
												<!-- end .video-snippet-->
											</li>
										<? } ?>
									</ul>
								</div>
							</div>
							<!-- end .video-group-->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end .section-->
	</div>
<? } ?>