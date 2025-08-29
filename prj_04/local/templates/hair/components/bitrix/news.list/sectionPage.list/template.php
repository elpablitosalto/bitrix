<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Hair\General;
$obj = CIBlockSection::GetList(false,['IBLOCK_ID' => CATALOG, 'ACTIVE'=>'Y', 'ID' => $arResult['ITEMS'][0]['IBLOCK_SECTION_ID']],false,['UF_*']);
if($res = $obj->GetNext())
{
    $arSection = $res;
}

$detailedCollection = isset($arSection['UF_DETAILED_COLLECTION']) && $arSection['UF_DETAILED_COLLECTION'] == 1;
$showAllTabsControl = $detailedCollection;
?>
<section class="product-list">
    <div class="container">
		<?if($detailedCollection):?>
			<div class="product-list__inner">
            <h2 class="content-text-h2">Товары из коллекции</h2>
		<?endif;?>
        <div class="tabs">
            <div class="tabs-buttons-wrapper">
                <?$i=1;?>
				<?if($showAllTabsControl):?>
                    <button class="tabs-buttons-wrapper__button _active" data-tab="<?=$i?>">Все товары коллекции</button>
                	<?$i++;?>
				<?endif;?>
				<?foreach($arResult['TYPES'] as $k => $type):?>
                    <button class="tabs-buttons-wrapper__button" data-tab="<?=$i?>"><?=$type['NAME']?></button>
                    <?$i++;?>
                <?endforeach;?>
            </div>
			<!--            --><?//foreach($arResult['ITEMS'] as $curr):?>
			<!--            --><?// d($curr['NAME'])?>
			<!--            --><?//endforeach;?>
			<?if(!$showAllTabsControl): // Открываем контейнер сразу, если показывем кнопку Всё?>
				<div class="all-items">
					<div class="tabs-item_active">
			<?else:?>
				<div class="tabs-items">
					<div class="tabs-item _active">
			<?endif;?>
						<div class="product-list_wrapper">
							<?foreach($arResult['ITEMS'] as $k => $arItem):?>
								<?$pic = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>9999, 'height'=>550), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
								<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="product-list_item">
									<div class="product-list_item-image">
										<img class="js_lazy" data-src="<?=$pic['src']?>" loading="lazy" alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>" />
									</div>
									<p class="product-list_item-link"><?=$arItem['PREVIEW_TEXT']?></p>
									<span class="product-list_item-subtext"><?=$arItem['NAME']?></span>
									<div class="product-list_item-description">
										<?if(isset($arItem['DISPLAY_PROPERTIES']['PRODUCT_TYPE'])):?>
											<div class="product-list_item-description__item">
												<div class="product-list_item-description__item-icon">
													<?=file_get_contents($_SERVER["DOCUMENT_ROOT"].General::getProductPropertycon('PRODUCT_TYPE'));?>
												</div>
												<div class="product-list_item-description__item-text">
													<p>Тип</p>
													<?if(is_array($arItem['DISPLAY_PROPERTIES']['PRODUCT_TYPE']['DISPLAY_VALUE'])):?>
														<?foreach($arItem['DISPLAY_PROPERTIES']['PRODUCT_TYPE']['DISPLAY_VALUE'] as $val):?>
															<span><?=$val?></span>
														<?endforeach;?>
													<?else:?>
														<span><?=$arItem['DISPLAY_PROPERTIES']['PRODUCT_TYPE']['DISPLAY_VALUE']?></span>
													<?endif;?>
												</div>
											</div>
										<?endif;?>
										<?if(isset($arItem['DISPLAY_PROPERTIES']['PRODUCT_FEATURE'])):?>
											<div class="product-list_item-description__item">
												<div class="product-list_item-description__item-icon">
													<?=file_get_contents($_SERVER["DOCUMENT_ROOT"].General::getProductPropertycon('PRODUCT_FEATURE'));?>
												</div>
												<div class="product-list_item-description__item-text">
													<p>Особенность</p>
													<?if(is_array($arItem['DISPLAY_PROPERTIES']['PRODUCT_FEATURE']['DISPLAY_VALUE'])):?>
														<?foreach($arItem['DISPLAY_PROPERTIES']['PRODUCT_FEATURE']['DISPLAY_VALUE'] as $val):?>
															<span><?=$val?></span>
														<?endforeach;?>
													<?else:?>
														<span><?=$arItem['DISPLAY_PROPERTIES']['PRODUCT_FEATURE']['DISPLAY_VALUE']?></span>
													<?endif;?>
												</div>
											</div>
										<?endif;?>
										<?if(isset($arItem['DISPLAY_PROPERTIES']['PRODUCT_PROPS'])):?>
											<div class="product-list_item-description__item">
												<div class="product-list_item-description__item-icon">
													<?=file_get_contents($_SERVER["DOCUMENT_ROOT"].General::getProductPropertycon('PRODUCT_PROPS'));?>
												</div>
												<div class="product-list_item-description__item-text">
													<p>Свойства</p>
													<?if(is_array($arItem['DISPLAY_PROPERTIES']['PRODUCT_PROPS']['DISPLAY_VALUE'])):?>
														<?foreach($arItem['DISPLAY_PROPERTIES']['PRODUCT_PROPS']['DISPLAY_VALUE'] as $val):?>
															<span><?=$val?></span>
														<?endforeach;?>
													<?else:?>
														<span><?=$arItem['DISPLAY_PROPERTIES']['PRODUCT_PROPS']['DISPLAY_VALUE']?></span>
													<?endif;?>
												</div>
											</div>
										<?endif;?>
										<?if(isset($arItem['DISPLAY_PROPERTIES']['PRODUCT_COMPOSITION'])):?>
											<div class="product-list_item-description__item">
												<div class="product-list_item-description__item-icon">
													<?=file_get_contents($_SERVER["DOCUMENT_ROOT"].General::getProductPropertycon('PRODUCT_COMPOSITION'));?>
												</div>
												<div class="product-list_item-description__item-text">
													<p>Состав</p>
													<?if(is_array($arItem['DISPLAY_PROPERTIES']['PRODUCT_COMPOSITION']['DISPLAY_VALUE'])):?>
														<?foreach($arItem['DISPLAY_PROPERTIES']['PRODUCT_COMPOSITION']['DISPLAY_VALUE'] as $val):?>
															<span><?=$val?></span>
														<?endforeach;?>
													<?else:?>
														<span><?=$arItem['DISPLAY_PROPERTIES']['PRODUCT_COMPOSITION']['DISPLAY_VALUE']?></span>
													<?endif;?>
												</div>
											</div>
										<?endif;?>
									</div>
								</a>
							<?endforeach;?>
						</div>
			<?if(!$showAllTabsControl): // Открываем контейнер сразу, если показывем кнопку Всё?>
					</div><!-- /.tabs-item_active -->
				</div><!-- /.all-items -->
				<div class="current-select-item">
			<?else:?>
					</div><!-- /.tabs-item -->
			<?endif;?>
                <?$i=1;?>
                <?foreach($arResult['TYPES'] as $k => $type):?>
                    <div class="tabs-item<?//=($i == 1) ? ' _active' : ''?>">
                        <div class="product-list_wrapper">
                            <?foreach($type['ITEMS'] as $j => $arItem):?>
                                <?$pic = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>9999, 'height'=>550), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
                                <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="product-list_item">
                                    <div class="product-list_item-image">
                                        <img class="js_lazy" data-src="<?=$pic['src']?>" loading="lazy" alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>" />
                                    </div>
                                    <p class="product-list_item-link"><?=$arItem['PREVIEW_TEXT']?></p>
                                    <span class="product-list_item-subtext"><?=$arItem['NAME']?></span>
                                    <div class="product-list_item-description">
                                        <?if(isset($arItem['DISPLAY_PROPERTIES']['PRODUCT_TYPE'])):?>
                                            <div class="product-list_item-description__item">
                                                <div class="product-list_item-description__item-icon">
                                                    <?=file_get_contents($_SERVER["DOCUMENT_ROOT"].General::getProductPropertycon('PRODUCT_TYPE'));?>
                                                </div>
                                                <div class="product-list_item-description__item-text">
                                                    <p>Тип</p>
                                                    <?if(is_array($arItem['DISPLAY_PROPERTIES']['PRODUCT_TYPE']['DISPLAY_VALUE'])):?>
                                                        <?foreach($arItem['DISPLAY_PROPERTIES']['PRODUCT_TYPE']['DISPLAY_VALUE'] as $val):?>
                                                            <span><?=$val?></span>
                                                        <?endforeach;?>
                                                    <?else:?>
                                                        <span><?=$arItem['DISPLAY_PROPERTIES']['PRODUCT_TYPE']['DISPLAY_VALUE']?></span>
                                                    <?endif;?>
                                                </div>
                                            </div>
                                        <?endif;?>
                                        <?if(isset($arItem['DISPLAY_PROPERTIES']['PRODUCT_FEATURE'])):?>
                                            <div class="product-list_item-description__item">
                                                <div class="product-list_item-description__item-icon">
                                                    <?=file_get_contents($_SERVER["DOCUMENT_ROOT"].General::getProductPropertycon('PRODUCT_FEATURE'));?>
                                                </div>
                                                <div class="product-list_item-description__item-text">
                                                    <p>Особенность</p>
                                                    <?if(is_array($arItem['DISPLAY_PROPERTIES']['PRODUCT_FEATURE']['DISPLAY_VALUE'])):?>
                                                        <?foreach($arItem['DISPLAY_PROPERTIES']['PRODUCT_FEATURE']['DISPLAY_VALUE'] as $val):?>
                                                            <span><?=$val?></span>
                                                        <?endforeach;?>
                                                    <?else:?>
                                                        <span><?=$arItem['DISPLAY_PROPERTIES']['PRODUCT_FEATURE']['DISPLAY_VALUE']?></span>
                                                    <?endif;?>
                                                </div>
                                            </div>
                                        <?endif;?>
                                        <?if(isset($arItem['DISPLAY_PROPERTIES']['PRODUCT_PROPS'])):?>
                                            <div class="product-list_item-description__item">
                                                <div class="product-list_item-description__item-icon">
                                                    <?=file_get_contents($_SERVER["DOCUMENT_ROOT"].General::getProductPropertycon('PRODUCT_PROPS'));?>
                                                </div>
                                                <div class="product-list_item-description__item-text">
                                                    <p>Свойства</p>
                                                    <?if(is_array($arItem['DISPLAY_PROPERTIES']['PRODUCT_PROPS']['DISPLAY_VALUE'])):?>
                                                        <?foreach($arItem['DISPLAY_PROPERTIES']['PRODUCT_PROPS']['DISPLAY_VALUE'] as $val):?>
                                                            <span><?=$val?></span>
                                                        <?endforeach;?>
                                                    <?else:?>
                                                        <span><?=$arItem['DISPLAY_PROPERTIES']['PRODUCT_PROPS']['DISPLAY_VALUE']?></span>
                                                    <?endif;?>
                                                </div>
                                            </div>
                                        <?endif;?>
                                        <?if(isset($arItem['DISPLAY_PROPERTIES']['PRODUCT_COMPOSITION'])):?>
                                            <div class="product-list_item-description__item">
                                                <div class="product-list_item-description__item-icon">
                                                    <?=file_get_contents($_SERVER["DOCUMENT_ROOT"].General::getProductPropertycon('PRODUCT_COMPOSITION'));?>
                                                </div>
                                                <div class="product-list_item-description__item-text">
                                                    <p>Состав</p>
                                                    <?if(is_array($arItem['DISPLAY_PROPERTIES']['PRODUCT_COMPOSITION']['DISPLAY_VALUE'])):?>
                                                        <?foreach($arItem['DISPLAY_PROPERTIES']['PRODUCT_COMPOSITION']['DISPLAY_VALUE'] as $val):?>
                                                            <span><?=$val?></span>
                                                        <?endforeach;?>
                                                    <?else:?>
                                                        <span><?=$arItem['DISPLAY_PROPERTIES']['PRODUCT_COMPOSITION']['DISPLAY_VALUE']?></span>
                                                    <?endif;?>
                                                </div>
                                            </div>
                                        <?endif;?>
                                    </div>
                                </a>
                            <?endforeach;?>
                            <?$i++;?>
                        </div>
                    </div>
                <?endforeach;?>
			<?if($showAllTabsControl):?>
            	</div><!-- /.tabs-items -->
			<?endif;?>
        </div>
		<?if($detailedCollection):?>
			</div>
		<?endif;?>
    </div>
</section>