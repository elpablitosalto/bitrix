<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if ($arResult["isFormNote"] != "Y")
{
	$formId = 'feedback_form_' . $arResult["PARAMS"]["FORM_ID"];
	$arResult["FORM_HEADER"] = preg_replace('/action="\/[^"]*"/', 'action="trap.php"', $arResult["FORM_HEADER"]);
?>
	<?=str_replace('<form', '<form  class="form form_type_close form_controls_full modal__form" id="'.$formId .'"', $arResult["FORM_HEADER"])?>
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
									console.log(xhr.responseText);
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
		<?foreach ($arResult["arQuestions"] as $fieldCode => $arField){
				$arQuestion = $arResult['QUESTIONS'][$fieldCode];
				$fieldID = $arQuestion['STRUCTURE'][0]['ID'];
				$fieldName = sprintf('form_%s_%s', $arField["TITLE_TYPE"], $fieldID);
				$arFieldDetail = is_array($arResult["arAnswers"][$fieldCode]) ? current($arResult["arAnswers"][$fieldCode]) : $arResult["arAnswers"][$fieldCode];
				if ($arFieldDetail["FIELD_TYPE"] == "hidden"){
						?><input type="hidden" name="<?=$fieldName?>" /><?
						unset($arResult["arQuestions"][$fieldCode]);
				}
		}?>
		<input type="hidden" name="web_form_submit" value="Y" />
		<!-- messages can be placed before or after the form-->
		<div class="form__messages">
				<!-- Modifiers-->
				<!-- form__message_style_error - red color-->
				<div class="form__message">
						<?=$arResult["FORM_ERRORS_TEXT"]?>
				</div>
		</div>
		<div class="form__main">
				<div class="form__inputs">
					<?foreach ($arResult["arQuestions"] as $fieldCode => $arField):?>
						<?
						$class = "";
						$type = "text";
						if ($arField["TITLE"] == "PHONE"){
								$arField["TITLE"] = "+7 (999) 999-99-99";
								$type = "tel";
								$class = " js-phone-input";
						}
						if ($arField["TITLE"] == "E-mail"){
								$type = "email";
								$arField["TITLE_TYPE"] = $type;
								$class = " js-email-input";
						}
						$arQuestion = $arResult['QUESTIONS'][$fieldCode];
						$fieldID = $arQuestion['STRUCTURE'][0]['ID'];
						$fieldName = sprintf('form_%s_%s', $arField["TITLE_TYPE"], $fieldID);
						?>
						<?if(!empty($arField["COMMENTS"]) && $arField["COMMENTS"] === "FORM_TYPE"):?>
							<input
								type="hidden"
								name="<?=$fieldName?>"
								value="<?=$arParams["FORM_TYPE"]?>"
							/>
						<?elseif(!empty($arField["COMMENTS"]) && $arField["COMMENTS"] === "ENTITY_NAME"):?>
							<input
								type="hidden"
								name="<?=$fieldName?>"
								class="form_entity_name"
								value=""
							>
						<?else:?>
							<div class="form__line">
									<!-- begin .form-control-->
									<div class="form-control">
											<label class="form-control__holder">
													<span class="form-control__field">
															<!-- Modifiers-->
															<!-- form-control__input_state_invalid - red border, one of the two options to show invalid field-->
															<input
																class="form-control__input<?=$class?>"
																name="<?=$fieldName?>"
																type="<?=$type?>"
																placeholder="<?=$arField["TITLE"]?>"
																<?if($arField["REQUIRED"] == "Y"):?>required="required"<?endif;?>
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
													<span class="form-control__messages">
															<span class="form-control__message form-control__message_style_error" style="display: none;">Ошибка поля</span>
													</span>
											</label>
									</div>
									<!-- end .form-control-->
							</div>
						<?endif;?>
					<?endforeach;?>
				</div>
				<div class="form__confirmation-check">
						<!-- begin .check-elem-->
						<label class="check-elem check-elem_text-size_s">
							<input class="check-elem__input js-disabling-checkbox" type="checkbox" name="agreement" required="required">
							<span class="check-elem__label"><?=htmlspecialchars_decode($arParams["POLICY_FULL_TEXT"])?></span>
						</label>
						<!-- end .check-elem-->
				</div>
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
				<div class="form__controls">
						<div class="form__control">
							<!-- begin .button-->
							<button
								class="button button_width_full"
								data-type="submit"
								type="submit"
								name="web_form_submit"
								disabled
								value="<?= htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]); ?>"
							>
								<span class="button__holder">
									<span class="button__text"><?=$arParams["BUTTON_TEXT"]?></span>
									<svg class="button__icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M14.3536 8.35355C14.5488 8.15829 14.5488 7.84171 14.3536 7.64645L11.1716 4.46447C10.9763 4.2692 10.6597 4.2692 10.4645 4.46447C10.2692 4.65973 10.2692 4.97631 10.4645 5.17157L13.2929 8L10.4645 10.8284C10.2692 11.0237 10.2692 11.3403 10.4645 11.5355C10.6597 11.7308 10.9763 11.7308 11.1716 11.5355L14.3536 8.35355ZM2 8.5L14 8.5L14 7.5L2 7.5L2 8.5Z" fill="currentColor"></path>
									</svg>
								</span>
						</div>
				</div>
				<input class="form__ps-message" name="form_message" />
		</div>
	<?=$arResult["FORM_FOOTER"]?>
<?
}else{  //endif (isFormNote)
	?>

	<?
}
?>