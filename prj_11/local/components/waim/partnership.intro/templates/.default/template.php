<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @var CMain $APPLICATION */
/** @var CUser $USER */
/** @var CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>
<div class="page__section page__section_no_overflow">
	<div class="page__holder">
		<!-- begin .section-->
		<div class="section section_space_close">
			<div class="section__content">
				<div class="section__media-panel">
					<!-- begin .main-banner-->
					<div class="main-banner main-banner_layout-type_a">
						<div class="main-banner__container">
							<div class="main-banner__wrapper">
								<div class="main-banner__content">
									<div class="main-banner__title">
										<?if(!empty($arParams["TITLE"])):?><span class="highlight"><?=htmlspecialchars_decode($arParams["TITLE"])?></span><?endif;?>
										<?if(!empty($arParams["SUBTITLE"])):?><br><?=htmlspecialchars_decode($arParams["SUBTITLE"])?><?endif;?>
									</div>
									<div class="main-banner__controls">
										<div class="main-banner__control">
											<!-- begin .button-->
											 <a class="button button_type_wide js-go-to" href="#participationSection">
												<span class="button__holder">
													<span class="button__text">Подробнее</span>
												</span>
											</a>
											<!-- end .button-->
										</div>
									</div>
								</div>
								<div class="main-banner__illustration">
									<picture class="main-banner__picture">
										<?if(!empty($arParams["IMAGE_XS"])):?>
											<source srcset="<?=$arParams["IMAGE_XS"]?>" type="image/png" media="(max-width: 479px)" class="main-banner__source">
										<?endif;?>
										<?if(!empty($arParams["IMAGE_S"])):?>
											<source srcset="<?=$arParams["IMAGE_S"]?>" type="image/png" media="(max-width: 767px)" class="main-banner__source">
										<?endif;?>
										<?if(!empty($arParams["IMAGE_M"])):?>
											<source srcset="<?=$arParams["IMAGE_M"]?>" type="image/png" media="(max-width: 1024px)" class="main-banner__source">
										<?endif;?>
										<?if(!empty($arParams["IMAGE"])):?>
											<?
												$altText = htmlspecialchars_decode($arParams["TITLE"]) . ' ' .  htmlspecialchars_decode($arParams["SUBTITLE"]);
												$altText = strip_tags($altText);
											?>
											<img src="<?=$arParams["IMAGE"]?>" alt="<?=$altText?>" class="main-banner__image">
										<?endif;?>
									</picture>
								</div>
							</div>
						</div>
					</div>
					<!-- end .main-banner-->
				</div>
			</div>
		</div>
		<!-- end .section-->
	</div>
</div>