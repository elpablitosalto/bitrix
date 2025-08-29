<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult['SECTIONS'])) { ?>
	<div class="section__content">
		<div class="page__container">
			<div class="section__info-group">
				<!-- begin .info-group-->
				<div class="info-group">
					<ul class="info-group__list">
						<?
						$i = 0;
						?>
						<? foreach ($arResult['SECTIONS'] as $arSection) { ?>
							<?
							$addClass = '';
							if ($i == 4) {
								$i = 0;
							}
							if ($i == 1) {
								$addClass = 'info-panel_layout_reversed info-panel_links_long';
							} else if ($i == 3) {
								$addClass = ' info-panel_layout_reversed';
							} 
							?>
							<?
							$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
							$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
							?>
							<li class="info-group__item" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
								<!-- begin .info-panel-->
								<div class="info-panel <?=$addClass;?>">
									<div class="info-panel__wrapper">
										<div class="info-panel__illustration">
											<img src="<?= $arSection['PICTURE_TILE']['SRC']; ?>" alt="<?= $arSection['PICTURE_TILE']["ALT"] ?>" title="<?= $arSection['PICTURE_TILE']["TITLE"] ?>" class="info-panel__image"" />
										</div>
										<div class=" info-panel__content">
											<div class="info-panel__title">
												<?= $arSection['NAME'] ?>
											</div>
											<div class="info-panel__text">
												<?= $arSection['DESCRIPTION'] ?>
											</div>
											<?/*?>
											<div class="info-panel__link-group">
												<ul class="info-panel__links">
													<? foreach ($arSection['ITEMS'] as $j => $arItem) { ?>
														<li class="info-panel__link-item">
															<!-- begin .link-->
															<a class="link" href="<?= $arItem['SECTION_PAGE_URL'] ?>">
																<?= $arItem['NAME'] ?>
															</a>
															<!-- end .link-->
														</li>
													<? } ?>													
												</ul>
											</div>
											<?*/?>
										</div>
									</div>
								</div>
								<!-- end .info-panel-->
							</li>
							<? $i++; ?>
						<? } ?>						
					</ul>
				</div>
				<!-- end .info-group-->
			</div>
		</div>
	</div>
<? } ?>