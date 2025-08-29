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

<? if(!empty($arResult['ITEMS'])): ?>
		<!-- begin .social-nav-->
		<div class="social-nav social-nav_layout_inline-to-col">
		<ul class="social-nav__list">
			<?foreach($arResult['ITEMS'] as $key => $arItem):?>
				<?
					if(!empty($arItem['PROPERTIES']['LINK']['VALUE'])) {
						$link = $arItem['PROPERTIES']['LINK']['VALUE'];
					}

					if(!empty($arItem['PROPERTIES']['ICON_HTML']['~VALUE']['TEXT'])) {
						$icon = $arItem['PROPERTIES']['ICON_HTML']['~VALUE']['TEXT'];
					}
				?>

				<? if(!empty($link)): ?>
					<li class="social-nav__item">
						<a class="social-nav__link" href="<?=$link?>" title="<?=$arItem['NAME']?>" target="_blank">

							<? if(!empty($icon)): ?>
									<span class="social-nav__icon-wrapper"><?=$icon?></span>
							<? endif; ?>

							<span class="social-nav__text"><?=$arItem['NAME']?></span>
						</a>
					</li>
				<? endif; ?>
			<?endforeach;?>
		</ul>
	</div>
	<!-- end .social-nav-->
<? endif; ?>
