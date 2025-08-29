<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc;

// Для генерации уже существующих данных
$arProfileFields = [
	"NAME" => ["required" => true, "name" => "Название компании", "type" => "text"],
	"ADDRESS"=> ["required" => true, "name" => "Юридический адрес", "type" => "text"],
	"TIN"=> ["required" => true, "name" => "ИНН", "type" => "text", "minlength" => "10", "maxlength" => "12", "multiline" => "start"],
	"COR" => ["required" => false, "name" => "КПП (если есть)", "type" => "text", "multiline" => "end"],
];

$arAddressFields = [
	"PVZ_ADDRESS" => ["required" => true, "name" => "Населенный пункт", "type" => "text", "multiline" => "start"],
	"STREET" => ["required" => true, "name" => "Улица", "type" => "text", "multiline" => "end"],
	"HOUSE" => ["required" => true, "name" => "Дом", "type" => "text", "multiline" => "start", "permanent-multiline" => true],
	"BUILDING" => ["required" => false, "name" => "Корпус", "type" => "text"],
	"FLOOR" => ["required" => false, "name" => "Этаж", "type" => "text", "multiline" => "end"],
];

$arOrderProps = array_values($arResult['ORDER_PROPS']);
$arProfileProps = $arOrderProps[0]["PROPS"];
$arAddressProps = $arOrderProps[1]["PROPS"];
?>
<div class="profile-list__item js-profile-panel-item">
	<!-- begin .profile-panel-->
	<div class="profile-panel js-profile-panel" data-open-modifier="profile-panel_state_open">
		<div class="profile-panel__header">
			<div class="profile-panel__title">
				<?=$arResult['NAME']?>
			</div>
			<div class="profile-panel__link profile-panel__remove">
				<!-- begin .link-item-->
				<a class="link-item link-item_icon-size_m js-profile-panel-remove js-modal" href="#modalConfirmProfileDeletion">
					<div class="link-item__icon-wrapper">
						<svg class="link-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M4.99935 15.8333C4.99935 16.75 5.74935 17.5 6.66602 17.5H13.3327C14.2493 17.5 14.9993 16.75 14.9993 15.8333V5.83333H4.99935V15.8333ZM6.66602 7.5H13.3327V15.8333H6.66602V7.5ZM12.916 3.33333L12.0827 2.5H7.91602L7.08268 3.33333H4.16602V5H15.8327V3.33333H12.916Z"/>
						</svg>
					</div>
					<div class="link-item__label">
						Удалить профиль
					</div>
				</a>
				<!-- end .link-item-->
			</div>
			<button type="button" class="profile-panel__trigger js-profile-panel-trigger">
				Открыть / закрыть
			</button>
		</div>
		<div class="profile-panel__body">
			<form class="profile-panel__main js-profile-panel-form">
				<div class="profile-panel__inputs">
					<?
						$arProfilePropCodes = array_column($arProfileProps, 'CODE');
					?>
					<?foreach ($arProfileFields as $fieldName => $fieldData):?>
						<?
							$multilineStart = (isset($fieldData['multiline']) && $fieldData['multiline'] === 'start');
							$multilineEnd = (isset($fieldData['multiline']) && $fieldData['multiline'] === 'end');
							$arPropIndex = array_search($fieldName, $arProfilePropCodes);
							if ($arPropIndex !== false) {
								$arProp = $arProfileProps[$arPropIndex];
								$arPropName = "ORDER_PROP_".$arProp['ID'];
								$arPropValue = $arResult["ORDER_PROPS_VALUES"][$arPropName];
							}
						?>
						<?if($multilineStart):?>
							<div class="profile-panel__multiline">
						<?endif;?>
						<!-- begin .form-control-->
						<div class="form-control profile-panel__line" <?if(!isset($arProp)):?> style="opacity: .3;" title="Поля с таким кодом не существует"<?endif;?>>
							<label class="form-control__holder">
								<span class="form-control__label">
									<?=$fieldData['name']?>
								</span>
								<span class="form-control__field">
									<input
										<?if($fieldData["type"] == "tel"):?>
											type="tel"
											class="form-control__input js-phone-input"
										<?else:?>
											type="<?=$fieldData["type"]?>"
											class="form-control__input"
										<?endif;?>
										<?if($fieldData["required"]):?>required="required"<?endif;?>
										<?if($fieldData["minlength"]):?>minlength="<?=$fieldData["minlength"]?>"<?endif;?>
										<?if($fieldData["maxlength"]):?>maxlength="<?=$fieldData["maxlength"]?>"<?endif;?>
										value="<?=$arPropValue?>"
										name="<?=$fieldName?>"
									/>
								</span>
								<span class="form-control__messages">
								</span>
							</label>
						</div>
						<!-- end .form-control-->
						<?if($multilineEnd):?>
							</div><!-- end .profile-panel__multiline-->
						<?endif;?>
						<?if(isset($arProp)):?>
							<?unset($arProp);?>
						<?endif;?>
					<?endforeach;?>
				</div>
				<div class="profile-panel__controls">
					<div class="profile-panel__control">
						<!-- begin .button-->
						<button class="button button_width_full button_size_s" type="submit">
							<span class="button__holder">
								Сохранить
							</span>
						</button>
						<!-- end .button-->
					</div>
					<div class="profile-panel__link profile-panel__remove">
						<!-- begin .link-item-->
						<a class="link-item link-item_icon-size_m js-profile-panel-remove js-modal" href="#modalConfirmProfileDeletion">
							<div class="link-item__icon-wrapper">
								<svg class="link-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M4.99935 15.8333C4.99935 16.75 5.74935 17.5 6.66602 17.5H13.3327C14.2493 17.5 14.9993 16.75 14.9993 15.8333V5.83333H4.99935V15.8333ZM6.66602 7.5H13.3327V15.8333H6.66602V7.5ZM12.916 3.33333L12.0827 2.5H7.91602L7.08268 3.33333H4.16602V5H15.8327V3.33333H12.916Z"/>
								</svg>
							</div>
							<div class="link-item__label">
								Удалить профиль
							</div>
						</a>
						<!-- end .link-item-->
					</div>
				</div>
			</form>
			<div class="profile-panel__sub">
				<div class="profile-panel__heading">
					<div class="profile-panel__title">
						Адрес доставки:
					</div>
					<div class="profile-panel__link">
						<!-- begin .link-item-->
						<button class="link-item link-item_icon-size_m link-item_style_primary js-profile-panel-address-add" type="button">
							<div class="link-item__icon-wrapper">
								<svg class="link-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M14.2857 10.7143H10.7143V14.2857C10.7143 14.4752 10.639 14.6568 10.5051 14.7908C10.3711 14.9247 10.1894 15 10 15C9.81056 15 9.62888 14.9247 9.49492 14.7908C9.36097 14.6568 9.28571 14.4752 9.28571 14.2857V10.7143H5.71429C5.52485 10.7143 5.34316 10.639 5.20921 10.5051C5.07526 10.3711 5 10.1894 5 10C5 9.81056 5.07526 9.62888 5.20921 9.49492C5.34316 9.36097 5.52485 9.28571 5.71429 9.28571H9.28571V5.71429C9.28571 5.52485 9.36097 5.34316 9.49492 5.20921C9.62888 5.07525 9.81056 5 10 5C10.1894 5 10.3711 5.07525 10.5051 5.20921C10.639 5.34316 10.7143 5.52485 10.7143 5.71429V9.28571H14.2857C14.4752 9.28571 14.6568 9.36097 14.7908 9.49492C14.9247 9.62888 15 9.81056 15 10C15 10.1894 14.9247 10.3711 14.7908 10.5051C14.6568 10.639 14.4752 10.7143 14.2857 10.7143Z"/>
								</svg>
							</div>
							<div class="link-item__label">
								Добавить адрес
							</div>
						</button>
						<!-- end .link-item-->
					</div>
				</div>
				<div class="profile-panel__address-group">
					<div class="profile-panel__address-list js-profile-panel-address-list">
						<?if(!empty($arAddressProps)):?>
							<!-- Тут должен быть foreach, но его на данный момент не из чего делать -->
							<?$addressIndex = 0;?>
							<div class="profile-panel__address-item js-profile-panel-address-item">
								<!-- begin .address-option-->
								<div class="address-option js-profile-panel-address" data-open-modifier="address-option_state_open">
									<div class="address-option__main">
										<div class="address-option__check">
											<!-- begin .check-elem-->
											<label class="check-elem">
												<input class="check-elem__input" type="radio" name="<?='address-'.$arResult["ID"].'-'.$addressIndex?>" checked="checked"/>
												<span class="check-elem__label" style="opacity: .3;" title="Это захардкоженное название">
													Потенциальный адрес
												</span>
											</label>
											<!-- end .check-elem-->
										</div>
										<div class="address-option__link">
											<!-- begin .link-item-->
											<button class="link-item link-item_type_transforming link-item_icon-size_m js-profile-panel-address-edit" type="button">
												<div class="link-item__icon-wrapper">
													<svg class="link-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M4.16667 15.8333H5.33333L12.5208 8.64583L11.3542 7.47917L4.16667 14.6667V15.8333ZM16.0833 7.4375L12.5417 3.9375L13.7083 2.77083C14.0278 2.45139 14.4203 2.29167 14.8858 2.29167C15.3508 2.29167 15.7431 2.45139 16.0625 2.77083L17.2292 3.9375C17.5486 4.25694 17.7153 4.6425 17.7292 5.09417C17.7431 5.54528 17.5903 5.93056 17.2708 6.25L16.0833 7.4375ZM14.875 8.66667L6.04167 17.5H2.5V13.9583L11.3333 5.125L14.875 8.66667ZM11.9375 8.0625L11.3542 7.47917L12.5208 8.64583L11.9375 8.0625Z"/>
													</svg>
												</div>
												<div class="link-item__label">
													Редактировать
												</div>
											</button>
											<!-- end .link-item-->
										</div>
										<div class="address-option__link">
											<!-- begin .link-item-->
											<button class="link-item link-item_type_transforming link-item_icon-size_m js-profile-panel-address-remove" type="button">
												<div class="link-item__icon-wrapper">
													<svg class="link-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M4.99935 15.8333C4.99935 16.75 5.74935 17.5 6.66602 17.5H13.3327C14.2493 17.5 14.9993 16.75 14.9993 15.8333V5.83333H4.99935V15.8333ZM6.66602 7.5H13.3327V15.8333H6.66602V7.5ZM12.916 3.33333L12.0827 2.5H7.91602L7.08268 3.33333H4.16602V5H15.8327V3.33333H12.916Z"/>
													</svg>
												</div>
												<div class="link-item__label">
													Удалить
												</div>
											</button>
											<!-- end .link-item-->
										</div>
									</div>
									<form class="address-option__form js-profile-panel-address-form">
										<div class="address-option__inputs">
											<?
												$arAddressPropCodes = array_column($arAddressProps, 'CODE');
											?>
											<?foreach ($arAddressFields as $fieldName => $fieldData):?>
												<?
													$multilineStart = (isset($fieldData['multiline']) && $fieldData['multiline'] === 'start');
													$multilineEnd = (isset($fieldData['multiline']) && $fieldData['multiline'] === 'end');
													$multilinePermanent = (isset($fieldData['permanent-multiline']) && $fieldData['multiline']);
													$arPropIndex = array_search($fieldName, $arAddressPropCodes);
													if ($arPropIndex !== false) {
														$arProp = $arAddressProps[$arPropIndex];
														$arPropName = "ORDER_PROP_".$arProp['ID'];
														$arPropValue = $arResult["ORDER_PROPS_VALUES"][$arPropName];
													}
												?>
												<?if($multilineStart):?>
													<div class="address-option__multiline<?if($multilinePermanent):?> address-option__multiline_type_permanent<?endif;?>">
												<?endif;?>
												<!-- begin .form-control-->
												<div class="form-control address-option__line" <?if(!isset($arProp)):?> style="opacity: .3;" title="Поля с таким кодом не существует"<?endif;?>>
													<label class="form-control__holder">
														<span class="form-control__label">
															<?=$fieldData['name']?>
														</span>
														<span class="form-control__field">
															<input
																<?if($fieldData["type"] == "tel"):?>
																	type="tel"
																	class="form-control__input js-phone-input"
																<?else:?>
																	type="<?=$fieldData["type"]?>"
																	class="form-control__input"
																<?endif;?>
																<?if($fieldData["required"]):?>required="required"<?endif;?>
																<?if($fieldData["minlength"]):?>minlength="<?=$fieldData["minlength"]?>"<?endif;?>
																<?if($fieldData["maxlength"]):?>maxlength="<?=$fieldData["maxlength"]?>"<?endif;?>
																value="<?=$arPropValue?>"
																name="<?=$fieldName?>"
															/>
														</span>
														<span class="form-control__messages">
														</span>
													</label>
												</div>
												<!-- end .form-control-->
												<?if($multilineEnd):?>
													</div><!-- end .address-option__multiline-->
												<?endif;?>
											<?endforeach;?>
										</div>
										<div class="address-option__controls">
											<div class="address-option__control">
												<!-- begin .button-->
												<button class="button button_width_full button_size_s" type="submit">
													<span class="button__holder">
														Сохранить
													</span>
												</button>
												<!-- end .button-->
											</div>
											<div class="address-option__control address-option__control_width_s">
												<!-- begin .button-->
												<button class="button button_width_full button_size_s button_style_light js-profile-panel-address-close" type="button">
													<span class="button__holder">
														Отмена
													</span>
												</button>
												<!-- end .button-->
											</div>
										</div>
									</form>
								</div>
								<!-- end .address-option-->
							</div>
						<?endif;?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end .profile-panel-->
</div>