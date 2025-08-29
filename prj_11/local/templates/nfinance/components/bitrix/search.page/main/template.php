<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
?>
<div class="section__cards-panel">
<?if($arResult["ERROR_CODE"]!=0):?>
	<p><?=GetMessage("SEARCH_ERROR")?></p>
	<?ShowError($arResult["ERROR_TEXT"]);?>
	<p><?=GetMessage("SEARCH_CORRECT_AND_CONTINUE")?></p>
	<br /><br />
	<p><?=GetMessage("SEARCH_SINTAX")?><br /><b><?=GetMessage("SEARCH_LOGIC")?></b></p>
	<table border="0" cellpadding="5">
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_OPERATOR")?></td><td valign="top"><?=GetMessage("SEARCH_SYNONIM")?></td>
			<td><?=GetMessage("SEARCH_DESCRIPTION")?></td>
		</tr>
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_AND")?></td><td valign="top">and, &amp;, +</td>
			<td><?=GetMessage("SEARCH_AND_ALT")?></td>
		</tr>
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_OR")?></td><td valign="top">or, |</td>
			<td><?=GetMessage("SEARCH_OR_ALT")?></td>
		</tr>
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_NOT")?></td><td valign="top">not, ~</td>
			<td><?=GetMessage("SEARCH_NOT_ALT")?></td>
		</tr>
		<tr>
			<td align="center" valign="top">( )</td>
			<td valign="top">&nbsp;</td>
			<td><?=GetMessage("SEARCH_BRACKETS_ALT")?></td>
		</tr>
	</table>
<?elseif(count($arResult["ITEMS"]) > 0):?>
	<div class="cards-panel cards-panel_layout_m cards-panel_role_articles cards-panel_panel-height_m">
		<div class="cards-panel__container">
			<div class="cards-panel__wrapper">
				<? foreach ($arResult["ITEMS"] as $arItem): ?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				$backgroundImg = SITE_TEMPLATE_PATH."/assets/blocks/service-item/images/16.png";
				if(!empty($arItem["PROPERTIES"]["FAVORITE_IMAGE"]["VALUE"])){
						$backgroundImg = \CFile::GetPath($arItem["PROPERTIES"]["FAVORITE_IMAGE"]["VALUE"]);
				}?>
						<a class="cards-panel__item cards-panel__item_type_service" href="<?= $arItem["DETAIL_PAGE_URL"] ?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
								<!-- begin .service-item-->
								<span class="service-item service-item_style_primary service-item_role_articles">
										<span class="service-item__content">
											<?if(!empty($backgroundImg)):?>
												<span class="service-item__background">
														<picture class="service-item__picture">
																<img
																		src="<?= $backgroundImg ?>"
																		alt="<?= $arItem["NAME"] ?>"
																		class="service-item__image" title=""
																/>
														</picture>
												</span>
											<?endif;?>
											<span class="service-item__header">
												<? if (!empty($arItem["SECTIONS"])): ?>
													<span class="service-item__tags">
														<? foreach($arItem["SECTIONS"] as $arSection): ?>
															<span class="service-item__tag">
																	<!-- begin .label-->
																	<div class="label label_style_dashed">
																			<?=$arSection["NAME"]?>
																	</div>
																	<!-- end .label-->
															</span>
														<? endforeach; ?>
													</span>
												<? endif; ?>
											</span>
											<span class="service-item__favorite">
													<!-- begin .button-->
													<?if(!empty($arItem["PROPERTIES"]["FAVORITE"]["VALUE"])):?>
															<button class="button button_size_sm button_style_bright" type="button"
																			aria-label="В избранное">
																<span class="button__holder">
																		<svg class="button__icon" x="0px"
																				y="0px" viewBox="-3 -3 30 30">
																			<path
																							class="button__icon-fill"
																							d="M10.2,1.6c0.7-1.5,2.9-1.5,3.6,0L15.9,6c0.3,0.6,0.9,1,1.5,1.1l4.8,0.7c1.6,0.2,2.3,2.3,1.1,3.4l-3.5,3.4c-0.5,0.5-0.7,1.1-0.6,1.8l0.8,4.8c0.3,1.6-1.4,2.9-2.9,2.1L12.9,21c-0.6-0.3-1.3-0.3-1.9,0l-4.3,2.3c-1.5,0.8-3.2-0.5-2.9-2.1l0.8-4.8c0.1-0.6-0.1-1.3-0.6-1.8l-3.5-3.4C-0.6,10,0.1,8,1.7,7.8l4.8-0.7C7.2,7,7.8,6.6,8.1,6L10.2,1.6z"/>
																			<path
																							fill="transparent" stroke="currentColor" stroke-width="2"
																							d="M11.1,2.1c0.4-0.7,1.4-0.7,1.8,0L15,6.4c0.4,0.9,1.3,1.5,2.3,1.6l4.8,0.7c0.8,0.1,1.1,1.1,0.6,1.7l-3.5,3.4c-0.7,0.7-1,1.7-0.9,2.7l0.8,4.8c0.1,0.8-0.7,1.4-1.5,1.1l-4.3-2.3c-0.9-0.5-1.9-0.5-2.8,0l-4.3,2.3c-0.7,0.4-1.6-0.2-1.5-1.1l0.8-4.8c0.2-1-0.2-2-0.9-2.7l-3.5-3.4C0.7,9.9,1.1,8.9,1.9,8.8l4.8-0.7c1-0.1,1.8-0.8,2.3-1.6L11.1,2.1z"/>
																		</svg>
																</span>
															</button>
													<? endif; ?>
													<!-- end .button-->
											</span>
											<span class="service-item__main">
												<span class="service-item__format"><?= $arItem["PROPERTIES"]["FORMAT"]["VALUE"] ?></span>
												<span class="service-item__title">
													<?= $arItem["NAME"] ?>
												</span>
												<span class="service-item__controls">
													<span class="service-item__control">
														<!-- begin .button-->
														<span class="button button_role_article">
															<span class="button__holder">
																<span class="button__text">Читать</span>
															</span>
														</span>
														<!-- end .button-->
													</span>
												</span>
											</span>
										</span>
								</span>
								<!-- end .service-item-->
						</a>
				<? endforeach; ?>
		</div>

		<?if(!empty($arResult["NAV_RESULT"]->NavPageCount) && $arResult["NAV_RESULT"]->NavPageCount > 0):?>
				<?=$arResult["NAV_STRING"]?>
		<?endif;?>
	</div>

<?else:?>
	<?ShowNote(GetMessage("SEARCH_NOTHING_TO_FOUND"));?>
<?endif;?>
</div>