<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?if($arResult["ITEMS"]):?>
	<div class="block_wr parrallax-shops" >
		<div class="js_lazy bg_map" data-src="<?=SITE_TEMPLATE_PATH?>/images/map_large.png"></div>
		<div class="wrapper_inner">
			<div class="stores news">
				<div class="top_block">
					<?
					$title_block=($arParams["TITLE_BLOCK"] ? $arParams["TITLE_BLOCK"] : GetMessage('STORES_TITLE'));
					$listurl = str_replace('//', '/', str_replace(array('#'.'SITE_DIR'.'#'), array(SITE_DIR), $arResult['LIST_PAGE_URL']));
					$count= ceil(count($arResult["ITEMS"]) / 3);
					?>
					<div class="title_block"><?=$title_block?></div>
					<a href="/contacts/"><?=GetMessage('ALL_STORES')?></a>
				</div>
				<div class="stores_list">
					<div class="stores_navigation slider_navigation"></div>
					<ul class="row list-unstyled">
						<?foreach($arResult["ITEMS"] as $arItem):?>
							<li class="col-12 col-md-3 mb-2">
								<div class="wrapp_block" itemscope="" itemtype="http://schema.org/Organization">
									<?if(in_array('NAME', $arParams['FIELD_CODE'])):?>
										<a href="/contacts/"><span class="icon"></span><span class="text" itemprop="name"><?=$arItem["NAME"]?></span></a>
									<?endif;?>
									<?if(!empty($arItem['PROPERTIES']["ADDRESS"]['VALUE']) && in_array('ADDRESS', $arParams["PROPERTY_CODE"])):?>
										<div class="store_text" itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
											<span class="title"><?=GetMessage('ADDRESS')?> </span>
                                            <?if(!empty($arItem['PROPERTIES']["REGION"]['VALUE']) && in_array('REGION', $arParams["PROPERTY_CODE"])):?>
                                                <span class="value" itemprop="addressRegion"><?=$arItem['PROPERTIES']["REGION"]['VALUE']?></span>
                                                <span class="font-size-12">, </span>
                                            <?endif;?>
                                            <?if(!empty($arItem['PROPERTIES']["GOROD"]['VALUE']) && in_array('GOROD', $arParams["PROPERTY_CODE"])):?>
                                                <span class="value" itemprop="addressLocality"><?=$arItem['PROPERTIES']["GOROD"]['VALUE']?></span>
                                                <span class="font-size-12">, </span>
                                            <?endif;?>
											<span class="value" itemprop="streetAddress"><?=$arItem['PROPERTIES']["ADDRESS"]['VALUE']?></span>
                                            <?if(!empty($arItem['PROPERTIES']["PLACE"]['VALUE']) && in_array('PLACE', $arParams["PROPERTY_CODE"])):?>
                                                <span class="font-size-12">, </span>
                                                <span class="value"><?=$arItem['PROPERTIES']["PLACE"]['VALUE']?></span>
                                            <?endif;?>
										</div>
										<div class="clear"></div>
									<?endif;?>
									<?if(!empty($arItem['PROPERTIES']["PHONE"]['VALUE']) && in_array('PHONE', $arParams["PROPERTY_CODE"])):?>
										<?if(is_array($arItem['PROPERTIES']["PHONE"]['VALUE'])):?>
											<?foreach ($arItem['PROPERTIES']["PHONE"]['VALUE'] as $key => $value) {
												?>
													<div class="store_text">
														<span class="title"><?=GetMessage('PHONE')?>: </span>
														<a href="tel:<?=$value?>">
			                                                <span class="value"itemprop="telephone"><?=$value?></span>
			                                            </a>
													</div>
												<?
											}?>
										<?else:?>
											<div class="store_text">
												<span class="title"><?=GetMessage('PHONE')?>: </span>
												<a href="tel:<?=$arItem['PROPERTIES']["PHONE"]['VALUE']?>">
	                                                <span class="value"itemprop="telephone"><?=$arItem['PROPERTIES']["PHONE"]['VALUE']?></span>
	                                            </a>
	                                            <?if(!empty($arItem['PROPERTIES']["DOB"]['VALUE']) && in_array('DOB', $arParams["PROPERTY_CODE"])):?>
	                                                <span class="font-size-12">, </span>
	                                                <span class="value">доб: <?=$arItem['PROPERTIES']["DOB"]['VALUE']?></span>
	                                            <?endif;?>
											</div>
										<?endif?>
										<div class="clear"></div>
									<?endif;?>
									<?if(!empty($arItem['PROPERTIES']["EMAIL"]['VALUE']) && in_array('EMAIL', $arParams["PROPERTY_CODE"])):?>
										<div class="store_text">
											<span class="title"><?=GetMessage('EMAIL')?> </span>
											<span class="value"itemprop="email"><?=$arItem['PROPERTIES']["EMAIL"]['VALUE']?></span>
										</div>
										<div class="clear"></div>
									<?endif;?>
									<?if($arItem['PROPERTIES']["METRO"]['VALUE'] && in_array('METRO', $arParams["PROPERTY_CODE"])):?>
										<div class="store_text metro">
											<?foreach($arItem['PROPERTIES']["METRO"]['VALUE'] as $metro):?>
												<span class="value"><i></i><?=$metro?></span>
											<?endforeach;?>
										</div>
										<div class="clear"></div>
									<?endif;?>
									<?if($arItem['PROPERTIES']["SCHEDULE"]['VALUE'] && !empty($arItem['PROPERTIES']["SCHEDULE"]['VALUE']['TEXT']) && in_array('SCHEDULE', $arParams["PROPERTY_CODE"])):?>
										<div class="store_text">
											<span class="title clear"><?=GetMessage('SCHEDULE')?>: </span>
											<span class="value"><?=($arItem['PROPERTIES']["SCHEDULE"]['VALUE']['TYPE'] == 'html' ? htmlspecialchars_decode($arItem['PROPERTIES']["SCHEDULE"]['VALUE']['TEXT']) : nl2br($arItem['PROPERTIES']["SCHEDULE"]['VALUE']['TEXT']))?></span>
										</div>
										<div class="clear"></div>
									<?endif;?>
								</div>
							</li>
						<?endforeach;?>
					</ul>
					<ul class="flex-control-nav flex-control-paging">
						<?for($i = 1; $i <= $count; ++$i):?>
							<li>
								<a></a>
							</li>
						<?endfor;?>
					</ul>
				</div>
			</div>
		</div>
	</div>
<?endif;?>
