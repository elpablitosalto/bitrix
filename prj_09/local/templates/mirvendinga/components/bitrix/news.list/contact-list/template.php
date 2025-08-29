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
	<!-- begin .social-nav-->
	<div class="link-group link-group_content_centered link-group_content_m-uncentered">
		<ul class="link-group__list">
			<?foreach($arResult['GROUPS'] as $type => $arGroup):?>
				<li class="link-group__item">
					<div class="link-group__wrapper">
						<?foreach($arGroup as $key => $arItem):?>
							<div class="link-group__sub">
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
									<a class="link-item <?=($type === 'EMAIL' ? '' : 'link-item_text-size_l');?>" href="<?=$link?>" title="<?=$link_text?>" target="_blank">
										<? if(!empty($icon)): ?>
												<span class="link-item__icon-wrapper"><?=$icon?></span>
										<? else: ?>
											<? if($type === 'PHONE'): ?>
												<span class="link-item__icon-wrapper">
													<svg class="link-item__icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M4.41333 7.19333C5.37333 9.08 6.92 10.6267 8.80667 11.5867L10.2733 10.12C10.46 9.93333 10.72 9.88 10.9533 9.95333C11.7 10.2 12.5 10.3333 13.3333 10.3333C13.5101 10.3333 13.6797 10.4036 13.8047 10.5286C13.9298 10.6536 14 10.8232 14 11V13.3333C14 13.5101 13.9298 13.6797 13.8047 13.8047C13.6797 13.9298 13.5101 14 13.3333 14C10.3275 14 7.44487 12.806 5.31946 10.6805C3.19404 8.55513 2 5.67245 2 2.66667C2 2.48986 2.07024 2.32029 2.19526 2.19526C2.32029 2.07024 2.48986 2 2.66667 2H5C5.17681 2 5.34638 2.07024 5.4714 2.19526C5.59643 2.32029 5.66667 2.48986 5.66667 2.66667C5.66667 3.5 5.8 4.3 6.04667 5.04667C6.12 5.28 6.06667 5.54 5.88 5.72667L4.41333 7.19333Z"></path>
													</svg>
												</span>
											<? endif; ?>

											<? if($type === 'EMAIL'): ?>
												<span class="link-item__icon-wrapper">
													<svg class="link-item__icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M2.66659 13.3333C2.29992 13.3333 1.98614 13.2029 1.72525 12.942C1.46392 12.6807 1.33325 12.3667 1.33325 12V3.99999C1.33325 3.63332 1.46392 3.31955 1.72525 3.05866C1.98614 2.79732 2.29992 2.66666 2.66659 2.66666H13.3333C13.6999 2.66666 14.0139 2.79732 14.2753 3.05866C14.5361 3.31955 14.6666 3.63332 14.6666 3.99999V12C14.6666 12.3667 14.5361 12.6807 14.2753 12.942C14.0139 13.2029 13.6999 13.3333 13.3333 13.3333H2.66659ZM7.99992 8.54999C8.05547 8.54999 8.1137 8.54155 8.17458 8.52466C8.23592 8.50821 8.29436 8.48332 8.34992 8.44999L13.0666 5.49999C13.1555 5.44443 13.2221 5.3751 13.2666 5.29199C13.311 5.20843 13.3333 5.11666 13.3333 5.01666C13.3333 4.79443 13.2388 4.62777 13.0499 4.51666C12.861 4.40555 12.6666 4.4111 12.4666 4.53332L7.99992 7.33332L3.53325 4.53332C3.33325 4.4111 3.13881 4.40821 2.94992 4.52466C2.76103 4.64155 2.66659 4.80555 2.66659 5.01666C2.66659 5.12777 2.68881 5.22488 2.73325 5.30799C2.7777 5.39155 2.84436 5.45555 2.93325 5.49999L7.64992 8.44999C7.70547 8.48332 7.76392 8.50821 7.82525 8.52466C7.88614 8.54155 7.94436 8.54999 7.99992 8.54999Z"></path>
													</svg>
												</span>
											<? endif; ?>
										<? endif; ?>

										<span class="link-item__label"><?=$link_text?></span>
									</a>
								<? endif; ?>
							</div>
						<? unset($link_text, $link, $icon) ?>
						<?endforeach;?>
					</div>
				</li>
			<?endforeach;?>
		</ul>
	</div>
	<!-- end .social-nav-->
<? endif; ?>
