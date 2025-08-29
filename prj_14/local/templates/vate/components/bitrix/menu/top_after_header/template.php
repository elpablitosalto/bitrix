<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
	<?
	$this->SetViewTarget('TOP_BIG_IMG');
	?>
	<div class="page__nav-slider">
		<!-- begin .nav-carousel-->
		<div class="nav-carousel">
			<div class="nav-carousel__container swiper js-nav-carousel page__container">
				<div class="nav-carousel__wrapper swiper-wrapper">
					<?
					foreach ($arResult as $arItem) {
						if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
							continue;
					?>
						<? if ($arItem["SELECTED"]): ?>
						<? else: ?>
						<? endif ?>
						<div class="nav-carousel__slide swiper-slide">
							<!-- begin .button-->
							<a class="button button_style_outline button_width_full <?= $arItem["PARAMS"]["add_class"]; ?>" href="<?= $arItem["LINK"] ?>">
								<span class="button__holder"><?= $arItem["TEXT"] ?></span></a>
							<!-- end .button-->
						</div>
					<? } ?>					
				</div>
			</div>
			<div class="nav-carousel__navigation">
				<div class="nav-carousel__arrows">
					<!-- begin .carousel-nav-->
					<div class="carousel-nav carousel-nav_position_sides carousel-nav_disabled_hide js-carousel-nav" data-nav-scope=".nav-carousel" data-nav-target=".swiper">
						<div class="carousel-nav__control">
							<!-- begin .button-->
							<button class="button js-carousel-nav-prev button button_width_fit button button_style_transparent" type="button"><span class="button__holder"><svg class="button__icon" width="14" height="23" viewBox="0 0 14 23" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M13.45 0.622505C12.6892 -0.178307 11.4233 -0.210766 10.6225 0.550005L1.38565 9.32501C0.140652 10.5078 0.140654 12.4923 1.38565 13.675L10.6225 22.45C11.4233 23.2108 12.6892 23.1783 13.45 22.3775C14.2108 21.5767 14.1783 20.3108 13.3775 19.55L4.90381 11.5L13.3775 3.45C14.1783 2.68923 14.2108 1.42332 13.45 0.622505Z" fill="currentColor" />
									</svg></span>
							</button>
							<!-- end .button-->
						</div>
						<div class="carousel-nav__control">
							<!-- begin .button-->
							<button class="button js-carousel-nav-next button button_width_fit button button_style_transparent" type="button"><span class="button__holder"><svg class="button__icon" width="14" height="23" viewBox="0 0 14 23" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M0.550005 0.622505C1.31078 -0.178307 2.57669 -0.210766 3.3775 0.550005L12.6143 9.32501C13.8593 10.5078 13.8593 12.4923 12.6143 13.675L3.3775 22.45C2.57669 23.2108 1.31078 23.1783 0.550005 22.3775C-0.210766 21.5767 -0.178307 20.3108 0.622505 19.55L9.09619 11.5L0.622505 3.45C-0.178307 2.68923 -0.210766 1.42332 0.550005 0.622505Z" fill="currentColor" />
									</svg></span>
							</button>
							<!-- end .button-->
						</div>
					</div>
					<!-- end .carousel-nav-->
				</div>
			</div>
		</div>
		<!-- end .nav-carousel-->
	</div>
	<?
	$this->EndViewTarget();
	?>
<? endif ?>