<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if ($arResult["isFormNote"] != "Y")
{

	$formId = 'partnership_form_' . $arResult["PARAMS"]["FORM_ID"];
	$arResult["FORM_HEADER"] = preg_replace('/action="\/[^"]*"/', 'action="trap.php"', $arResult["FORM_HEADER"]);
?>

	<?= str_replace('<form', '<form id="'.$formId.'" class="form form_spacing_l section__form '.$arResult["WEB_FORM_NAME"].'"', $arResult["FORM_HEADER"]) ?>
		<script>
			(function() {
				var formDisabled = false;

				function callEvent(status, formId, form) {
					var event = new CustomEvent("formSubmit", { "detail": {
							formCallbackId: "<?=(!empty($arParams["FORM_CALLBACK_ID"]) ? $arParams["FORM_CALLBACK_ID"] : $arParams["FORM_TYPE"])?>",
							status: status,
							formId: formId,
							form: form
						}
					});

					document.dispatchEvent(event);

				}
				function successHandler(formId, form) {
					if(typeof formId !== 'undefined') {
						window.openModal(formId+'_success');
						window.resetForm(form);
					}
					callEvent(true, formId, form);
					setTimeout(() => {
						formDisabled = false;
						setLoading(false, form);
					}, 500);
				}
				function errorHandler(formId, form) {
					if(typeof formId !== 'undefined') {
						window.openModal(formId+'_error');
						// window.resetForm(form);
					}
					callEvent(false, formId, form);
					setTimeout(() => {
						formDisabled = false;
						setLoading(false, form);
					}, 500);
				}
				function setLoading(status = true, formNode) {
					var submitButton = formNode.querySelector('button[type="submit"]');
					if(submitButton) {
						if(status) {
							submitButton.classList.add('button_state_loading');
							submitButton.disabled = true;
						} else {
							submitButton.classList.remove('button_state_loading');
							submitButton.disabled = false;
						}
					}
				}
				function ajaxFormHandler(formId, link) {
					var formNode = document.getElementById(formId);

					if (formNode && !formDisabled) {
						formDisabled = true;
						var form = StandardForm();
						form.init(formNode);

						form.onSuccess(function (e) {
							e.preventDefault();
							setLoading(true, formNode);

							let xhr = new XMLHttpRequest();
							xhr.open("POST", link);

							xhr.onload = function () {
								if (xhr.status != 200) {
									// alert(`Ошибка ${xhr.status}: ${xhr.statusText}`);
									errorHandler(formId, formNode);
								} else {
									var json = JSON.parse(xhr.responseText);

									if (!json.success) {
										let errorStr = "";
										for (let fieldKey in json.errors) {
											errorStr += json.errors[fieldKey] + "<br>";
										}

										// Ошибки вывести в элемент с классом error-msg
										var messageNode = formNode.querySelector(".form__message");
										if(messageNode) {
											formNode.getElementsByClassName("form__message")[0].innerHTML = errorStr;
										}

										errorHandler(formId, formNode);
									} else {
										// Показываем сообщение об успешной отправке
										// formNode.classList.add("form_state_sent");
										successHandler(formId, formNode);
									}
								}
								const recaptchaReloadEvent = new Event('recaptchaReloadEvent');
								document.dispatchEvent(recaptchaReloadEvent);
							};

							xhr.onerror = function () {
								console.log("Запрос не удался");
								errorHandler(formId, formNode);
							};

							var formData = new FormData(formNode),
							validateRules = getValidateRules(formNode);

							formData.append('validate_rules', JSON.stringify(validateRules))

							xhr.send(formData);
						});
					}
				}
				function getValidateRules(formNode) {
					var result = {}
					if(formNode) {
						var inputs = formNode.querySelectorAll('input, textarea');
						if(inputs.length) {
							inputs.forEach(function (item) {
								result[item.name] = [];

								if(item.type === 'tel' || item.type === 'email') {
									result[item.name].push(item.type);
								}

								if(item.getAttribute('required')) {
									result[item.name].push('required');
								}

								if(!result[item.name].length) {
									delete result[item.name];
								}
							})
						}
					}
					return result
				}
				function addUTMFields(formId) {
					var formNode = document.getElementById(formId);

					if (
						formNode
						&& !formDisabled
						&& window.utm
						&& window.utm.addFields
					) {
						window.utm.addFields(formNode);
					}

				}
				callOnWindowLoad(function () {
					var formNode = document.getElementById('<?=$formId?>');

					if (formNode && formNode.noValidate) {
						return;
					}

					window.updateFormFields();
					addUTMFields('<?=$formId?>');
					ajaxFormHandler('<?=$formId?>', '<?=$templateFolder?>/ajax.php')
				});
			})();
		</script>
		<?
			if ($arResult["isFormDescription"] == "Y" && !empty($arResult["FORM_DESCRIPTION"])) {
				?>
				<p class="form__description"><?= $arResult["FORM_DESCRIPTION"] ?></p>
				<?
			}
		?>
		<div class="form__main">
			<?if(!empty($arParams["NAME"])):?>
				<div class="form__title">
					<!-- begin .title-->
					<h2 class="title title_size_lh4 title_style_primary">
						<?=htmlspecialchars_decode($arParams["NAME"])?>
					</h2>
					<!-- end .title-->
				</div>
			<?endif;?>
			<div class="form__inputs">
				<?
					foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
						switch ($arQuestion['STRUCTURE'][0]['FIELD_TYPE']){
							case "text":
                $class = "";
                $type = "text";
                if ($arQuestion["CAPTION"] === "PHONE") {
                    $arQuestion["CAPTION"] = "+7 (999) 999-99-99";
                    $type = "tel";
                    $class = " js-phone-input";
                }
								?>
								<div class="form__line">
									<!-- begin .form-control-->
									<div class="form-control form-control_size_m form-control_style_outline form-control_background_light <?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>form-control__input_state_invalid<?endif;?>">
										<label class="form-control__holder">
											<span class="form-control__field">
												<input
													type="<?=$type?>"
													class="form-control__input<?=$class?>"
													placeholder="<?=$arQuestion["CAPTION"]?>"
													id="<?=$formId?>_<?=$arResult["arForm"]["SID"]?>_<?=$FIELD_SID?>"
													<?if ($arQuestion["REQUIRED"] == "Y"):?>required="required"<?endif;?>
													name="form_<?=strtolower($arQuestion["STRUCTURE"][0]["FIELD_TYPE"])?>_<?=$arQuestion["STRUCTURE"][0]["ID"]?>"
													<?if(!empty($arResult["PARAMS"]["PLACEHOLDER"])):?>placeholder="<?=$arResult["PARAMS"]["PLACEHOLDER"]?>"<?endif;?>
													<?if(
														!empty($arResult["arrVALUES"]["form_".strtolower($arQuestion["STRUCTURE"][0]["FIELD_TYPE"])."_".$arQuestion["STRUCTURE"][0]["ID"]])
													):?>
														value="<?=$arResult["arrVALUES"]["form_".strtolower($arQuestion["STRUCTURE"][0]["FIELD_TYPE"])."_".$arQuestion["STRUCTURE"][0]["ID"]]?>"
													<?endif;?>
												/>
												<!-- Иконка показывается, когда поле прошло валидацию и инпут имеет класс form-control__input_state_success-->
												<svg class="form-control__icon form-control__icon_success" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M16 10L11 15L8 12M12 21C7.029 21 3 16.971 3 12C3 7.029 7.029 3 12 3C16.971 3 21 7.029 21 12C21 16.971 16.971 21 12 21Z" stroke="#1D1814" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
												</svg>
												<!-- Иконка показывается, когда поле не прошло валидацию и инпут имеет класс form-control__input_state_error-->
												<svg class="form-control__icon form-control__icon_error" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M14.83 9.17L9.17 14.83M14.83 14.83L9.17 9.17M12 21C7.029 21 3 16.971 3 12C3 7.029 7.029 3 12 3C16.971 3 21 7.029 21 12C21 16.971 16.971 21 12 21Z" stroke="#1D1814" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
												</svg>
											</span>
										</label>
									</div>
									<!-- end .form-control-->
								</div>
								<?
								break;
							case "email":
								?>
								<div class="form__line">
									<!-- begin .form-control-->
									<div class="form-control form-control_size_m form-control_style_outline form-control_background_light <?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>form-control__input_state_invalid<?endif;?>">
										<label class="form-control__holder">
											<span class="form-control__field">
												<input
													type="email"
													placeholder="<?=$arQuestion["CAPTION"]?>"
													class="form-control__input"
													id="<?=$formId?>_<?=$arResult["arForm"]["SID"]?>_<?=$FIELD_SID?>"
													<?if ($arQuestion["REQUIRED"] == "Y"):?>required="required"<?endif;?>
													name="form_<?=strtolower($arQuestion["STRUCTURE"][0]["FIELD_TYPE"])?>_<?=$arQuestion["STRUCTURE"][0]["ID"]?>"
													<?if(!empty($arResult["PARAMS"]["PLACEHOLDER"])):?>placeholder="<?=$arResult["PARAMS"]["PLACEHOLDER"]?>"<?endif;?>
													<?if(
														!empty($arResult["arrVALUES"]["form_".strtolower($arQuestion["STRUCTURE"][0]["FIELD_TYPE"])."_".$arQuestion["STRUCTURE"][0]["ID"]])
													):?>
														value="<?=$arResult["arrVALUES"]["form_".strtolower($arQuestion["STRUCTURE"][0]["FIELD_TYPE"])."_".$arQuestion["STRUCTURE"][0]["ID"]]?>"
													<?endif;?>
												/>
												<!-- Иконка показывается, когда поле прошло валидацию и инпут имеет класс form-control__input_state_success-->
												<svg class="form-control__icon form-control__icon_success" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M16 10L11 15L8 12M12 21C7.029 21 3 16.971 3 12C3 7.029 7.029 3 12 3C16.971 3 21 7.029 21 12C21 16.971 16.971 21 12 21Z" stroke="#1D1814" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
												</svg>
												<!-- Иконка показывается, когда поле не прошло валидацию и инпут имеет класс form-control__input_state_error-->
												<svg class="form-control__icon form-control__icon_error" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M14.83 9.17L9.17 14.83M14.83 14.83L9.17 9.17M12 21C7.029 21 3 16.971 3 12C3 7.029 7.029 3 12 3C16.971 3 21 7.029 21 12C21 16.971 16.971 21 12 21Z" stroke="#1D1814" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
												</svg>
											</span>
										</label>
									</div>
									<!-- end .form-control-->
								</div>
								<?
								break;
							case "dropdown":
								?>
								<div class="form__line">
									<!-- begin .form-control-->
									<div class="form-control form-control_size_m form-control_style_outline form-control_background_light">
										<label class="form-control__holder">
											<span class="form-control__field">
												<!-- begin .choices-select-->
												<span class="choices-select form-control__choices-select">
													<select
														class="choices-select__select js-select"
														<?if ($arQuestion["REQUIRED"] == "Y"):?>required="required"<?endif;?>
														id="<?=$formId?>_<?=$arResult["arForm"]["SID"]?>_<?=$FIELD_SID?>"
														<?if ($arQuestion["REQUIRED"] == "Y"):?>required="required"<?endif;?>
														name="form_dropdown_<?=$FIELD_SID?>"
													>
														<option class="choices-select__option" value="" selected="selected" disabled="disabled" hidden="hidden"><?=$arQuestion["CAPTION"]?></option>
														<?foreach($arQuestion["STRUCTURE"] as $arOption):?>
															<option class="choices-select__option" value="<?=$arOption['ID']?>"><?=$arOption['MESSAGE']?></option>
														<?endforeach;?>
													</select>
												</span>
												<!-- end .choices-select-->
											</span>
										</label>
									</div>
									<!-- end .form-control-->
								</div>
							<?
						}
					} //endwhile
				?>

				<?
					$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_TEMPLATE_PATH."/include/form/captcha/field.php",
						"AREA_FILE_RECURSIVE" => "N",
						"EDIT_MODE" => "html",
						),
					  false,
					  array('HIDE_ICONS' => 'Y')
					);
				?>
			</div>
			<div class="form__confirmation-check">
				<!-- begin .check-elem-->
				<label class="check-elem check-elem_text-size_sm">
					<input class="check-elem__input js-disabling-checkbox" type="checkbox" name="agreement" required="required">
					<span class="check-elem__label"><?=htmlspecialchars_decode($arParams["POLICY_FULL_TEXT"])?></span>
				</label>
				<!-- end .check-elem-->
			</div>
			<div class="form__controls">
				<div class="form__control">
					<!-- begin .button-->
					<button
						class="button button_width_full button_style_dark button_style_shadowless"
						data-type="submit"
						type="submit"
						name="web_form_submit"
						disabled
						value="<?= htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]); ?>"
					>
						<span class="button__holder"><?=$arResult["PARAMS"]["BUTTON_TEXT"]?></span>
					</button>
					<!-- end .button-->
				</div>
			</div>
		</div>
		<?=$bxajaxid?>
		<input class="form__ps-message" name="form_message" />
	<?= $arResult["FORM_FOOTER"] ?>
<?
}else{  //endif (isFormNote)
	?>

	<?
}
?>