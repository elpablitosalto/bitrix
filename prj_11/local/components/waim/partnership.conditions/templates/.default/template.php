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
<div class="page__section page__section_style_dark" id="conditionsSection">
	<div class="page__holder">
		<!-- begin .section-->
		<div class="section">
			<div class="section__wrapper">
				<div class="section__main">
					<div class="section__header">
						<div class="section__title">
							<!-- begin .title-->
							<h2 class="title title_size_sh3">Выбирайте бонус <br>за успешную рекомендацию <br>финансового директора
							</h2>
							<!-- end .title-->
						</div>
					</div>
					<div class="section__content">
						<?if(!empty($arResult["ITEMS"])):?>
							<div class="section__info-group">
								<?foreach($arResult["ITEMS"] as $arItem):?>
									<?if(!empty($arItem["TEXT"])):?>
										<div class="section__info-panel">
											<!-- begin .info-panel-->
											<div class="info-panel info-panel_text-size_l info-panel_spacing_s info-panel_style_dependent">
												<svg class="info-panel__icon">
													<use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/icon.svg#icon_tick"></use>
												</svg>
												<div class="info-panel__text"><?=htmlspecialchars_decode($arItem["TEXT"])?></div>
												<?if(!empty($arItem["PRICE"])):?>
													<div class="info-panel__labels">
														<div class="info-panel__label">
															<!-- begin .label-->
															<div class="label label_style_secondary-dashed"><?=$arItem["PRICE"]?></div>
															<!-- end .label-->
														</div>
													</div>
												<?endif;?>
											</div>
											<!-- end .info-panel-->
										</div>
									<?endif;?>
								<?endforeach;?>
							</div>
						<?endif;?>
					</div>
				</div>
				<div class="section__panel">
					<?if(!empty($arParams["WEB_FORM_ID"])):?>
						<?$APPLICATION->IncludeComponent(
							"waim:feedback.form",
							"partnership",
							array(
								"BACKGROUND_COLOR" => "#FFFFFF",
								"BUTTON_TEXT" => "Отправить",
								"DESCRIPTION" => "Наш менеджер свяжется с вами и проконсультирует по деталям записи!",
								"ERROR_DESCRIPTION" => "Попробуйте повторить отправку позднее",
								"ERROR_TITLE" => "Произошла ошибка :(",
								"FORM_TYPE" => "Запись на мероприятие",
								"POLICY_LINK" => "/policy/",
								"POLICY_LINK_CLASS" => "",
								"POLICY_LINK_TEXT" => "политикой конфиденциальности",
								"POLICY_TEXT" => "Нажимая на кнопку, вы соглашаетесь с %s",
								"SUCCESS_DESCRIPTION" => "<span class=\"modal__highlight\">В ближайшее время </span> <br> наш менеджер свяжется с вами",
								"SUCCESS_TITLE" => "<h2 class=\"title title_size_h2 title_style_highlight\">Спасибо!</h2><h2 class=\"title title_size_h2\">Мы получили <br> вашу заявку</h2>",
								"TITLE" => "Получить больше<br> информации об условиях",
								"TITLE_HIGHLIGHT" => "",
								"WEB_FORM_ID" => $arParams["WEB_FORM_ID"],
								"MODAL_ID" => "modalEvents",
								"COMPONENT_TEMPLATE" => "partnership"
							),
							false
						);?>
					<?endif;?>
				</div>
			</div>
		</div>
		<!-- end .section-->
	</div>
</div>