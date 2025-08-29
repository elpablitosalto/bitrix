<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<?php if (0 < $arResult["SECTIONS_COUNT"]): ?>
	<!-- begin .link-filter-->
	<div class="link-filter undefined js-link-filter">
		<div class="link-filter__list">
			<ul class="link-filter__list">
				<?php foreach ($arResult['SECTIONS'] as &$arSection): ?>
					<?php if(!empty($arSection['ELEMENT_CNT'])): ?>
						<li class="link-filter__item">
							<a
								class="link-filter__link <?php if($arSection['ID'] === $arParams['CURRENT_SECTION_ID']): ?>link-filter__link_state_active<?php endif; ?>"
								href="<? echo $arSection['SECTION_PAGE_URL']; ?>"
							>
								<?=$arSection['NAME']?>
							</a>
						</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
	<!-- end .link-filter-->
<?php endif; ?>