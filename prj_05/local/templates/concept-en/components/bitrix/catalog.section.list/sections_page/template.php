<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult['SECTIONS'])) { ?>
	<div class="catalog__categories">
		<div class="catalog__tiles">
			<!-- begin .tiles-->
			<div class="tiles">
				<ul class="tiles__list">
					<?
					$i = 0;
					?>
					<? foreach ($arResult['SECTIONS'] as $arSection) { ?>
						<?
						$addClass = '';
						if ($i == 2) {
							$addClass = 'tiles__item_size_tall';
						}
						?>
						<?
						$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
						$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
						?>
						<li class="tiles__item <?= $addClass; ?>" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
							<div class="tiles__panel">
								<div class="tiles__background">
									<picture class="tiles__picture">
										<img src="<?= $arSection['PICTURE_TILE']['SRC']; ?>" alt="<?= $arSection['PICTURE_TILE']["ALT"] ?>" title="<?= $arSection['PICTURE_TILE']["TITLE"] ?>" class="tiles__image" />
									</picture>
								</div>
								<div class="tiles__content">
									<div class="tiles__title">
										<a class="tiles__link" href="<?= $arSection['SECTION_PAGE_URL'] ?>">
											<?= $arSection['NAME'] ?>
										</a>
									</div>
									<? if (isset($arSection['ITEMS'])) { ?>
										<ul class="tiles__links">
											<? foreach ($arSection['ITEMS'] as $j => $arItem) { ?>
												<li class="tiles__link-item">
													<a class="tiles__link" href="<?= $arItem['SECTION_PAGE_URL'] ?>">
														<?= $arItem['NAME'] ?>
													</a>
												</li>
											<? } ?>
										</ul>
									<? } ?>
								</div>
							</div>
						</li>
						<?
						$i++;
						?>
					<? } ?>
				</ul>
			</div>
			<!-- end .tiles-->
		</div>
	</div>
<? } ?>