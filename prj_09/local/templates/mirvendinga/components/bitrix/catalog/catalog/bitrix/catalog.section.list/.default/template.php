<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<?php if (0 < $arResult["SECTIONS_COUNT"]): ?>
	<!-- begin .category-group-->
	<div class="category-group">
			<ul class="category-group__list">
				<?php foreach ($arResult['SECTIONS'] as &$arSection): ?>
					<li class="category-group__item">
							<!-- begin .category-panel-->
							<div class="category-panel category-group__panel">
									<?php if(!empty($arSection['PICTURE']['SRC'])): ?>
										<div class="category-panel__illustration">
												<picture class="category-panel__picture">
														<img data-src="<?=$arSection['PICTURE']['SRC']?>" alt="<?=$arSection['NAME']?>" class="category-panel__image lazyload">
												</picture>
										</div>
									<?php endif ?>
									<div class="category-panel__content">
											<div class="category-panel__title">
													<!-- begin .title-->
													<div class="title title_size_h4">
															<a href="<?=$arSection['SECTION_PAGE_URL']; ?>" class="category-panel__link"><?=$arSection['NAME']?></a>
													</div>
													<!-- end .title-->
											</div>
									</div>
							</div>
							<!-- end .category-panel-->
					</li>
				<?php endforeach; ?>
			</ul>
	</div>
	<!-- end .category-group-->
<?php else: ?>
	<p>Товаров еще нет :(</p>
<?php endif; ?>