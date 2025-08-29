<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<? $this->setFrameMode( true ); ?>
<?
$sliderID  = "specials_slider_wrapp_".$this->randString();
$notifyOption = COption::GetOptionString("sale", "subscribe_prod", "");
$arNotify = unserialize($notifyOption);
?>
<?if($arResult["ITEMS"]):?>
	<?if($arParams["TITLE_BLOCK"]){?>
		<div class="top_block">
			<div class="title_block"><?=$arParams["TITLE_BLOCK"];?></div>
		</div>
	<?}?>
	<div class="common_product wrapper_block top_border1" id="<?=$sliderID?>">
		<?if($fast_view_text_tmp = \Bitrix\Main\Config\Option::get('aspro.mshop', 'EXPRESSION_FOR_FAST_VIEW', GetMessage('FAST_VIEW')))
			$fast_view_text = $fast_view_text_tmp;
		else
			$fast_view_text = GetMessage('FAST_VIEW');?>
		<ul class="slider_navigation top_big"></ul>
		<div class="all_wrapp">
			<div class="content_inner tab">
				<ul class="specials_slider slides wr block-rd">
					<?foreach($arResult["ITEMS"] as $key => $arItem):?>
                                    <?
            $arFilter = Array(
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "ID" => $arItem["ID"]
            );
            $res = CIBlockElement::GetList(Array(), $arFilter);
            if ($ob = $res->GetNextElement()) {
                $arProps = $ob->GetProperties();
            }
            ?>

            <? if ($arProps['RASPRODAT']['VALUE'] !== 'Да'): ?>
						<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
						$totalCount = CMShop::GetTotalCount($arItem);
						$arQuantityData = CMShop::GetQuantityArray($totalCount);
						$arItem["FRONT_CATALOG"]="Y";

						$strMeasure='';
						if($arItem["OFFERS"]){
							$strMeasure=$arItem["MIN_PRICE"]["CATALOG_MEASURE_NAME"];
						}else{
							if (($arParams["SHOW_MEASURE"]=="Y")&&($arItem["CATALOG_MEASURE"])){
								$arMeasure = CCatalogMeasure::getList(array(), array("ID"=>$arItem["CATALOG_MEASURE"]), false, false, array())->GetNext();
								$strMeasure=$arMeasure["SYMBOL_RUS"];
							}
						}
						?>
						<li id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="catalog_item">
							<div class="catalog-item__table-control">
								<div class="table-control">
									<?if ($arItem["PROPERTIES"]["RASSHIRENNAYA_RAZMERNAYA_SETKA"]["VALUE_XML_ID"] == "true"):?>
										<a href="#" class="table-control__icon-link" data-target="modal">
											<svg class="table-control__icon" width="41" height="30" viewBox="0 0 41 30" fill="none" xmlns="http://www.w3.org/2000/svg">
												<rect class="table-control__icon_stroke" x="9.0484" y="10.5645" width="22.9032" height="7.80645"/>
												<path class="table-control__icon_stroke" d="M12.3226 13.8386V18.8709"/>
												<path class="table-control__icon_stroke" d="M19.871 13.8386V18.8709"/>
												<path class="table-control__icon_stroke" d="M27.4193 13.8386V18.8709"/>
												<path class="table-control__icon_stroke" d="M23.6452 15.0967L23.6452 18.8709"/>
												<path class="table-control__icon_stroke" d="M16.0968 15.0967L16.0968 18.8709"/>
												<path class="table-control__icon_fill" d="M40.3536 15.3535C40.5488 15.1583 40.5488 14.8417 40.3536 14.6464L37.1716 11.4644C36.9763 11.2692 36.6597 11.2692 36.4645 11.4644C36.2692 11.6597 36.2692 11.9763 36.4645 12.1715L39.2929 15L36.4645 17.8284C36.2692 18.0237 36.2692 18.3402 36.4645 18.5355C36.6597 18.7308 36.9763 18.7308 37.1716 18.5355L40.3536 15.3535ZM34 15.5H40V14.5H34V15.5Z"/>
												<path class="table-control__icon_fill" d="M0.646447 15.3535C0.451184 15.1583 0.451184 14.8417 0.646447 14.6464L3.82843 11.4644C4.02369 11.2692 4.34027 11.2692 4.53553 11.4644C4.7308 11.6597 4.7308 11.9763 4.53553 12.1715L1.70711 15L4.53553 17.8284C4.7308 18.0237 4.7308 18.3402 4.53553 18.5355C4.34027 18.7308 4.02369 18.7308 3.82843 18.5355L0.646447 15.3535ZM7 15.5H1V14.5H7V15.5Z"/>
											</svg>
										</a>
									<?endif;?>
									<?if ($arItem["PROPERTIES"]["ZAKLYUCHENIE_MINPROMTORG"]["VALUE"] == "Да"):?>
                                        <?//$fccFile = CMShop::GetFileInfo($arItem["PROPERTIES"]["FCC"]["VALUE"]);?>
                                        <span class="table-control__label">ФСС</span>
                                    <?endif;?>
								</div>
							</div>
							<div class="image_wrapper_block">
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="thumb">
									<?if($arItem["PROPERTIES"]["HIT"]){?>
										<div class="stickers">
											<?foreach($arItem["PROPERTIES"]["HIT"]["VALUE_XML_ID"] as $key=>$class){?>
												<div class="sticker_<?=strtolower($class);?>" title="<?=$arItem["PROPERTIES"]["HIT"]["VALUE"][$key]?>"></div>
											<?}?>
										</div>
									<?}?>
									<?
									/*$frame = $this->createFrame()->begin('');
									$frame->setBrowserStorage(true);*/
									?>
										<?if( ($arParams["DISPLAY_WISH_BUTTONS"] != "N" || $arParams["DISPLAY_COMPARE"] == "Y")):?>
											<div class="like_icons">
												<?if($arItem["CAN_BUY"] && empty($arItem["OFFERS"]) && $arParams["DISPLAY_WISH_BUTTONS"] != "N"):?>
													<div class="wish_item_button">
														<span title="<?=GetMessage('CATALOG_WISH')?>" class="wish_item to" data-item="<?=$arItem["ID"]?>"><i></i></span>
														<span title="<?=GetMessage('CATALOG_WISH_OUT')?>" class="wish_item in added" style="display: none;" data-item="<?=$arItem["ID"]?>"><i></i></span>
													</div>
												<?endif;?>
												<?if($arParams["DISPLAY_COMPARE"] == "Y"):?>
													<div class="compare_item_button">
														<span title="<?=GetMessage('CATALOG_COMPARE')?>" class="compare_item to" data-iblock="<?=$arParams["IBLOCK_ID"]?>" data-item="<?=$arItem["ID"]?>" ><i></i></span>
														<span title="<?=GetMessage('CATALOG_COMPARE_OUT')?>" class="compare_item in added" style="display: none;" data-iblock="<?=$arParams["IBLOCK_ID"]?>" data-item="<?=$arItem["ID"]?>"><i></i></span>
													</div>
												<?endif;?>
											</div>
										<?endif;?>
									<?//$frame->end();?>
									<?if(!empty($arItem["PREVIEW_PICTURE"])):?>
										<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=($arItem["PREVIEW_PICTURE"]["ALT"]?$arItem["PREVIEW_PICTURE"]["ALT"]:$arItem["NAME"]);?>" title="<?=($arItem["PREVIEW_PICTURE"]["TITLE"]?$arItem["PREVIEW_PICTURE"]["TITLE"]:$arItem["NAME"]);?>" />
									<?elseif(!empty($arItem["DETAIL_PICTURE"])):?>
										<?$img = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array("width" => 170, "height" => 170), BX_RESIZE_IMAGE_PROPORTIONAL, true );?>
										<img src="<?=$img["src"]?>" alt="<?=($arItem["PREVIEW_PICTURE"]["ALT"]?$arItem["PREVIEW_PICTURE"]["ALT"]:$arItem["NAME"]);?>" title="<?=($arItem["PREVIEW_PICTURE"]["TITLE"]?$arItem["PREVIEW_PICTURE"]["TITLE"]:$arItem["NAME"]);?>" />
									<?else:?>
										<img src="<?=SITE_TEMPLATE_PATH?>/images/no_photo_medium.png" alt="<?=($arItem["PREVIEW_PICTURE"]["ALT"]?$arItem["PREVIEW_PICTURE"]["ALT"]:$arItem["NAME"]);?>" title="<?=($arItem["PREVIEW_PICTURE"]["TITLE"]?$arItem["PREVIEW_PICTURE"]["TITLE"]:$arItem["NAME"]);?>" />
									<?endif;?>
									<?if($arParams["SALE_STIKER"] && $arItem["PROPERTIES"][$arParams["SALE_STIKER"]]["VALUE"]){?>
										<div class="sticker_sale_text"><?=$arItem["PROPERTIES"][$arParams["SALE_STIKER"]]["VALUE"];?></div>
									<?}?>
								</a>
								<div class="fast_view_block" data-event="jqm" data-param-form_id="fast_view" data-param-iblock_id="<?=$arParams["IBLOCK_ID"];?>" data-param-id="<?=$arItem["ID"];?>" data-param-item_href="<?=urlencode($arItem["DETAIL_PAGE_URL"]);?>" data-name="fast_view"><?=$fast_view_text;?></div>
							</div>
							<?$arAddToBasketData = CMShop::GetAddToBasketArray($arItem, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], true);?>
							<div class="item_info">
								<div class="item-title">
									<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><span><?=$arItem["NAME"]?></span></a>
								</div>
								<?=$arQuantityData["HTML"];?>
								<div class="cost prices clearfix">
									<?if($arItem["OFFERS"]):?>
										<?\Aspro\Functions\CAsproMShopSku::showItemPrices($arParams, $arItem, $item_id, $min_price_id);?>
									<?else:?>
										<?
										if(isset($arItem['PRICE_MATRIX']) && $arItem['PRICE_MATRIX']) // USE_PRICE_COUNT
										{?>
											<?if($arItem['ITEM_PRICE_MODE'] == 'Q' && count($arItem['PRICE_MATRIX']['ROWS']) > 1):?>
												<?=CMShop::showPriceRangeTop($arItem, $arParams, GetMessage("CATALOG_ECONOMY"));?>
											<?endif;?>
											<?=CMShop::showPriceMatrix($arItem, $arParams, $strMeasure, $arAddToBasketData);?>
										<?
										}
										elseif($arItem["PRICES"])
										{?>
											<?=\Aspro\Functions\CAsproMShopItem::getItemPrices($arParams, $arItem["PRICES"], $strMeasure, $min_price_id);?>
										<?}?>
									<?endif;?>
								</div>
								<div class="basket_props_block" id="bx_basket_div_<?=$arItem["ID"];?>_<?=$sliderID;?>" style="display: none;">
									<?
											if (!empty($arItem['PRODUCT_PROPERTIES_FILL']))
											{
												foreach ($arItem['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo)
												{
									?>
										<input type="hidden" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>">
									<?
													if (isset($arItem['PRODUCT_PROPERTIES'][$propID]))
														unset($arItem['PRODUCT_PROPERTIES'][$propID]);
												}
											}
											$arItem["EMPTY_PROPS_JS"]="Y";
											$emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);
											if (!$emptyProductProperties)
											{
												$arItem["EMPTY_PROPS_JS"]="N";
									?>
									<div class="wrapper">
										<table>
									<?
												foreach ($arItem['PRODUCT_PROPERTIES'] as $propID => $propInfo)
												{
									?>
										<tr><td><? echo $arItem['PROPERTIES'][$propID]['NAME']; ?></td>
										<td>
									<?
													if(
														'L' == $arItem['PROPERTIES'][$propID]['PROPERTY_TYPE']
														&& 'C' == $arItem['PROPERTIES'][$propID]['LIST_TYPE']
													)
													{
														foreach($propInfo['VALUES'] as $valueID => $value)
														{
															?><label><input type="radio" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>><? echo $value; ?></label><?
														}
													}
													else
													{
														?><select name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"><?
														foreach($propInfo['VALUES'] as $valueID => $value)
														{
															?><option value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"selected"' : ''); ?>><? echo $value; ?></option><?
														}
														?></select><?
													}
									?>
										</td></tr>
									<?
												}
									?>
										</table>
									</div>
									<?
											}
									?>
								</div>

                                <div class="catalog-item__props">
                                    <div class="catalog-item__prop-list">
                                        <!--<table class="props_list props_list_flex">
                                            <?/*
                                                $propArray = ['MATERIAL', 'SEZON', 'PLOTNOST_MATERIALA', 'RAZMER'];
                                            */?>
                                            <tbody>
                                                <?/*foreach($propArray as $propName):*/?>
                                                    <?/*if($arItem['PROPERTIES'][$propName]['VALUE']):*/?>
                                                        <tr itemprop="additionalProperty" itemscope="" itemtype="http://schema.org/PropertyValue">
                                                            <td class="char_name">
                                                                <span><span itemprop="name">
                                                                    <?/*=$arItem['PROPERTIES'][$propName]['NAME'];*/?>
                                                                </span></span>
                                                            </td>
                                                            <td class="char_value">
                                                                <span itemprop="value">
                                                                    <?/*=$arItem['PROPERTIES'][$propName]['VALUE'];*/?>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    <?/*endif;*/?>
                                                <?/*endforeach;*/?>
                                            </tbody>
                                        </table>-->
                                        <?
                                            $arQuantity = getProductQty($arItem);
                                        ?>
                                        <div class="catalog-qty-desc-wrapper">
                                            <?=$arQuantity["HTML"]?>
                                        </div>
                                    </div>
                                    <?
                                    $arColors = productColors::getProductColorsFromHL($arItem);
                                    if(!empty($arColors)):
                                        ?>
                                        <div class="catalog-item__color-group">
                                            <div class="color-group">
                                                <div class="color-group__label">
                                                    Цвет:
                                                </div>
                                                <div class="color-group__list">
                                                    <?
                                                    foreach ($arColors as $color) {
                                                        ?>
                                                        <div class="color-group__item">
                                                            <?if(!empty($color["URL"])):?>
                                                                <a class="color-option" href="<?=$color["URL"]?>">
                                                                    <span class="color-option__illustration" style="background: url('<?=$color["UF_FILE"]["src"]?>') no-repeat;">
                                                                        <span><?=$color["UF_NAME"]?></span>
                                                                    </span>
                                                                </a>
                                                            <?else:?>
                                                                <div class="color-option color-option_state_active">
                                                                    <span class="color-option__illustration" style="background: url('<?=$color["UF_FILE"]["src"]?>') no-repeat;">
                                                                        <?=$color['UF_NAME']?>
                                                                    </span>
                                                                </div>
                                                            <?endif;?>
                                                        </div>
                                                        <?
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?endif;?>
                                </div>
								<div class="buttons_block clearfix">
									<?
									/*$frame = $this->createFrame()->begin('');
									$frame->setBrowserStorage(true);*/
									?>
										<?=$arAddToBasketData["HTML"]?>
									<?//$frame->end();?>
								</div>
							</div>
						</li>
                                                <? endif ?>
					<?endforeach;?>
				</ul>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				var flexsliderItemWidth = 210;
				var flexsliderItemMargin = 20;
				var sliderWidth = $('#<?=$sliderID?>').outerWidth();
				var flexsliderMinItems = Math.floor(sliderWidth / (flexsliderItemWidth + flexsliderItemMargin));


				$('#<?=$sliderID?> .content_inner').flexslider({
					animation: 'slide',
					selector: '.slides > li',
					slideshow: false,
					animationSpeed: 600,
					directionNav: true,
					controlNav: false,
					pauseOnHover: true,
					animationLoop: true,
					itemWidth: flexsliderItemWidth,
					itemMargin: flexsliderItemMargin,
					minItems: flexsliderMinItems,
					controlsContainer: '#<?=$sliderID?> .slider_navigation',
					start: function(slider){
						slider.find('li').css('opacity', 1);
					}
				});

				$(window).resize(function(){
					var itemsButtonsHeight = $('.wrapper_block#<?=$sliderID;?> .wr > li .buttons_block').height();
					$('.wrapper_block#<?=$sliderID;?> .wr .buttons_block').hide();
					if($('.wrapper_block#<?=$sliderID;?> .all_wrapp .content_inner').attr('data-hover') ==undefined){
						var tabsContentUnhover = ($('.wrapper_block#<?=$sliderID;?> .all_wrapp').height() * 1)+20;
						var tabsContentHover = tabsContentUnhover + itemsButtonsHeight+50;
						$('.wrapper_block#<?=$sliderID;?> .all_wrapp .content_inner').attr('data-unhover', tabsContentUnhover);
						$('.wrapper_block#<?=$sliderID;?> .all_wrapp .content_inner').attr('data-hover', tabsContentHover);
						$('.wrapper_block#<?=$sliderID;?> .all_wrapp').height(tabsContentUnhover);
						$('.wrapper_block#<?=$sliderID;?> .all_wrapp .content_inner').addClass('absolute');
					}
				});
				if($('#<?=$sliderID?> .slider_navigation .flex-disabled').length > 1){
				$('#<?=$sliderID?> .slider_navigation').hide();
			}
			$('.wrapper_block#<?=$sliderID;?> .wr > li').hover(
				function(){
					var tabsContentHover = $(this).closest('.content_inner').attr('data-hover') * 1;
					$(this).closest('.content_inner').fadeTo(100, 1);
					$(this).closest('.content_inner').stop().css({'height': tabsContentHover});
					$(this).find('.buttons_block').fadeIn(750, 'easeOutCirc');
				},
				function(){
					var tabsContentUnhoverHover = $(this).closest('.content_inner').attr('data-unhover') * 1;
					$(this).closest('.content_inner').stop().animate({'height': tabsContentUnhoverHover}, 100);
					$(this).find('.buttons_block').stop().fadeOut(203);
				}
			);
			});
		</script>
		<?$frame = $this->createFrame()->begin('');?>
		<script type="text/javascript">
		$("#<?=$sliderID?>").ready(function(){
			$(window).resize();
		});
		</script>
		<?$frame->end();?>
	</div>
<?endif;?>