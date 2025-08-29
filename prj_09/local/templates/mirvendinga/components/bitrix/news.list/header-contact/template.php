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

<? if(!empty($arResult['GROUPS'])): ?>
			<?foreach($arResult['GROUPS'] as $type => $arGroup):?>
						<?foreach($arGroup as $key => $arItem):?>
							<div class="header__contact">
								<?
									if(!empty($arItem['PROPERTIES']['LINK_TEXT']['VALUE'])) {
										$link_text = $arItem['PROPERTIES']['LINK_TEXT']['VALUE'];
									}

									if(!empty($arItem['PROPERTIES']['LINK']['VALUE'])) {
										$link = $arItem['PROPERTIES']['LINK']['VALUE'];
									}

									if(!empty($arItem['PROPERTIES']['ICON_HTML']['~VALUE']['TEXT'])) {
										$icon = $arItem['PROPERTIES']['ICON_HTML']['~VALUE']['TEXT'];
									}
								?>
								<? if(!empty($link) && !empty($link_text)): ?>
									<a class="header__link" href="<?=$link?>" title="<?=$link_text?>" target="_blank">
										<?=$link_text?>
									</a>
								<? endif; ?>
							</div>
						<? unset($link_text, $link, $icon) ?>
						<?endforeach;?>
			<?endforeach;?>

<? endif; ?>
