<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="section__grid sections _active" data-mobile-tab="1">
	<?foreach($arResult['SECTIONS'] as $arSection):?>
				<?$pic = CFile::ResizeImageGet($arSection['PICTURE'], array('width'=>708, 'height'=>422), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
				<div class="section__row-item" >
					<img src="<?=$arSection['PICTURE']['SRC']?>" class="section__row-item-image" alt="">
					<div class="section__row-item_content">
						<a href="<?=$arSection['SECTION_PAGE_URL']?>" class="section__row-item--title-line"><?=$arSection['NAME']?></a>
						<?if(isset($arSection['ITEMS'])):?>
								<div class="section__row-item__subsections-list">
										<?$halfSeparator = (int)(count($arSection['ITEMS']) / 2)?>
										<div class="section__row-item__subsections-list--wrapper">
												<?foreach($arSection['ITEMS'] as $j => $arItem):?>
														<a href="<?=$arItem['SECTION_PAGE_URL']?>" class="section__row-item__subsections-link"><?=$arItem['NAME']?></a>
														<?if($j+1 == $halfSeparator):?>
																</div>
																<div class="section__row-item__subsections-list--wrapper">
														<?endif;?>
												<?endforeach;?>
										</div>
								</div>
						<?endif;?>
					</div>
				</div>
		<?endforeach;?>
</div>