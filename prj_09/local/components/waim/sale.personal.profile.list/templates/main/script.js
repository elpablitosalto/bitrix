'use strict';
(function profileForms() {
	window.addEventListener('load', function () {
		window.initProfileForms = function () {
			var profileSelector            = '.js-profile-scope',

				addressesScopeSelector       = '.js-profile-panel-address-list',
				addressScopeSelector         = '.js-profile-panel-address-item',
				addressCloneSelector         = '.js-profile-panel-address-clone',
				addressFormScopeSelector     = '.js-profile-panel-address',
				addressFormSelector          = '.js-profile-panel-address-form',
				addressEditSelector          = '.js-profile-panel-address-edit',
				addressCloseSelector         = '.js-profile-panel-address-close',
				addressAddSelector           = '.js-profile-panel-address-add',
				addressRemoveSelector        = '.js-profile-panel-address-remove',
				addressRemoveConfirmSelector = '.js-profile-panel-address-remove-confirm',

				panelsScopeSelector        = '.js-profile-panel-list',
				panelScopeSelector         = '.js-profile-panel-item',
				panelCloneSelector         = '.js-profile-panel-clone',
				panelFormScopeSelector     = '.js-profile-panel',
				panelFormSelector          = '.js-profile-panel-form',
				panelToggleSelector        = '.js-profile-panel-trigger',
				panelAddSelector           = '.js-profile-panel-add',
				panelRemoveSelector        = '.js-profile-panel-remove',
				panelRemoveConfirmSelector = '.js-profile-panel-remove-confirm',

				lastRemoveTrigger = null;



			function dispatchProfileEvent(eventName, data) {
				var evt = document.createEvent('HTMLEvents'),
					profile = document.querySelector(profileSelector);

				if (profile) {
					evt.initEvent(eventName, true, true);
					evt.data = data;
					profile.dispatchEvent(evt);
				}
			}

			function openAddressFromTrigger(trigger) {
				var scope = trigger.closest(addressFormScopeSelector),
					modifier = scope.dataset.openModifier || 'open';

				if (!scope.classList.contains(modifier)) {
					scope.classList.add(modifier);
					dispatchProfileEvent('profile:address:open', {
						trigger: trigger,
						formScope: scope
					});
				}
			}

			function closeAddressFromTrigger(trigger) {
				var scope = trigger.closest(addressFormScopeSelector),
					modifier = scope.dataset.openModifier || 'open';

				scope.classList.remove(modifier);
				dispatchProfileEvent('profile:address:close', {
					trigger: trigger,
					formScope: scope
				});
			}

			function togglePanelFromTrigger(trigger) {
				var scope = trigger.closest(panelFormScopeSelector),
					modifier = scope.dataset.openModifier || 'open';

				scope.classList.toggle(modifier);

				if (scope.classList.contains(modifier)) {
					dispatchProfileEvent('profile:panel:open', {
						trigger: trigger,
						formScope: scope
					});
				} else {
					dispatchProfileEvent('profile:panel:close', {
						trigger: trigger,
						formScope: scope
					});
				}
			}

			function removeAddressFromTrigger(trigger) {
				if (lastRemoveTrigger) {
					var itemScope = lastRemoveTrigger.closest(addressScopeSelector);

					itemScope.remove();
					dispatchProfileEvent('profile:address:remove', {
						trigger: lastRemoveTrigger,
						itemScope: itemScope
					});

					lastRemoveTrigger = null;
				}
			}

			function removePanelFromTrigger(trigger) {
				if (lastRemoveTrigger) {
					var itemScope = lastRemoveTrigger.closest(panelScopeSelector),
						listScope = itemScope.closest(panelsScopeSelector);

					BX.ajax.runComponentAction('waim:sale.personal.profile.list', 'deleteProfile', {
						mode: 'class',
						data: {
							profileId: $(itemScope).data("profile-id"),
						}
					}).then(function (response) {
						if(response.data) {
							itemScope.remove();
							if (listScope.childElementCount === 0) {
								listScope.innerHTML = '';
							}

							dispatchProfileEvent('profile:panel:remove', {
								trigger: trigger,
								itemScope: itemScope
							});

							lastRemoveTrigger = null;
						}else{
							console.error(response);
						}
					});
				}
			}

			function addAddressFromTrigger(trigger) {
				var profile = trigger.closest(profileSelector),
					panel = trigger.closest(panelFormScopeSelector),
					itemsScope = panel.querySelector(addressesScopeSelector),
					cloneSource = profile.querySelector(addressCloneSelector),
					clone = cloneSource.cloneNode();

				clone.innerHTML = cloneSource.innerHTML;
				clone.classList.remove(addressCloneSelector.replace('.', ''));

				itemsScope.appendChild(clone);

				// input masks and check-disable
				if (window.updateFormFields) {
					window.updateFormFields();
				}

				dispatchProfileEvent('profile:address:add', {
					trigger: trigger,
					itemScope: clone
				});
			}

			function addPanelFromTrigger(trigger) {
				var profile = trigger.closest(profileSelector),
					itemsScope = profile.querySelector(panelsScopeSelector),
					cloneSource = profile.querySelector(panelCloneSelector),
					clone = cloneSource.cloneNode();

				clone.innerHTML = cloneSource.innerHTML;
				clone.classList.remove(panelCloneSelector.replace('.', ''));

				itemsScope.appendChild(clone);

				// input masks and check-disable
				if (window.updateFormFields) {
					window.updateFormFields();
				}

				dispatchProfileEvent('profile:panel:add', {
					trigger: trigger,
					itemScope: clone
				});
			}



			function operateAddressForm(form) {
				var passedValidationRaw = form.dataset.passedValidation,
					passedValidation = passedValidationRaw ? JSON.parse(passedValidationRaw) : false;

				var scope = form.closest(addressFormScopeSelector),
					modifier = scope.dataset.openModifier || 'open';

				if (passedValidation) {
					scope.classList.remove(modifier);
					dispatchProfileEvent('profile:address:submitSuccess', {
						form: form,
						formScope: scope
					});
				} else {
					dispatchProfileEvent('profile:address:submitFail', {
						form: form,
						formScope: scope
					});
				}
			}

			function operatePanelForm(form) {
				var passedValidationRaw = form.dataset.passedValidation,
					passedValidation = passedValidationRaw ? JSON.parse(passedValidationRaw) : false;

				var scope = form.closest(panelFormScopeSelector),
					modifier = scope.dataset.openModifier || 'open';

				if (passedValidation) {
					scope.classList.remove(modifier);
					BX.ajax.runComponentAction('waim:sale.personal.profile.list', 'updateProfile', {
						mode: 'class',
						data: {
							profileId: $(form).parents(".js-profile-panel-item").data("profile-id"),
							profileData: $(form).serializeArray()
						}
					}).then(function (response) {
						if(response.data) {
							// var profileName = $(form).find(".js-profile-name").val();
							// if (profileName) {
							//     $(form).parents(".js-profile-panel").find(".profile-panel__title").html(profileName)
							// }
					dispatchProfileEvent('profile:panel:submitSuccess', {
						form: form,
						formScope: scope
					});
						}else{
							console.error(response);
						}
					});
				} else {
					dispatchProfileEvent('profile:panel:submitFail', {
						form: form,
						formScope: scope
					});
				}
			}

			document.body.addEventListener('click', function (e) {
				var addressEditTrigger = e.target.closest(addressEditSelector),
					addressCloseTrigger = e.target.closest(addressCloseSelector),
					panelToggleTrigger = e.target.closest(panelToggleSelector),

					addressRemoveTrigger = e.target.closest(addressRemoveSelector),
					panelRemoveTrigger = e.target.closest(panelRemoveSelector),
					addressRemoveConfirmTrigger = e.target.closest(addressRemoveConfirmSelector),
					panelRemoveConfirmTrigger = e.target.closest(panelRemoveConfirmSelector),

					addressAddTrigger = e.target.closest(addressAddSelector),
					panelAddTrigger = e.target.closest(panelAddSelector);

				if (addressEditTrigger) {
					openAddressFromTrigger(addressEditTrigger);
				} else if (addressCloseTrigger) {
					closeAddressFromTrigger(addressCloseTrigger);
				} else if (panelToggleTrigger) {
					togglePanelFromTrigger(panelToggleTrigger);
				} if (addressRemoveConfirmTrigger) {
					removeAddressFromTrigger(addressRemoveConfirmTrigger);
				} else if (panelRemoveConfirmTrigger) {
					removePanelFromTrigger(panelRemoveConfirmTrigger);
				} if (addressAddTrigger) {
					addAddressFromTrigger(addressAddTrigger);
				} else if (panelAddTrigger) {
					addPanelFromTrigger(panelAddTrigger);
				} else if (addressRemoveTrigger) {
					lastRemoveTrigger = addressRemoveTrigger;
				} else if (panelRemoveTrigger) {
					lastRemoveTrigger = panelRemoveTrigger;
				}
			});

			document.body.addEventListener('submit', function (e) {
				var addressForm = e.target.closest(addressFormSelector),
					panelForm = e.target.closest(panelFormSelector);

				if (addressForm) {
					operateAddressForm(addressForm);
				} else if (panelForm) {
					operatePanelForm(panelForm);
				}
			});
		};

		window.initProfileForms();

		const validateForm = function (form, onSuccess, onFail) {
			var formValidation = StandardForm();

			formValidation.init(form);

			if (onSuccess) {
				formValidation.onSuccess(onSuccess);
			}

			if (onFail) {
				formValidation.onFail(onFail);
			}
		}

		const validateFormGroup = function (selector, onSuccess, onFail) {
			var forms = document.querySelectorAll(selector);

			if (forms.length) {
				forms.forEach(function(form) {
					validateForm(form, onSuccess, onFail);
				});
			}
		}

		const validateProfile = function () {
			validateFormGroup(
				'.js-profile-panel-address-form',
				function (e, form, validation) {
					console.log('validation address sent');
					form.submit();
				},
				null // onFail()
			);

			validateFormGroup(
				'.js-profile-panel-form',
				function (e, form, validation) {
					console.log('validation panel sent');
					form.submit();
				},
				null // onFail()
			);
		}

		validateProfile();

		document.body.addEventListener('profile:address:add', function (e) {
			var form = e.data.itemScope.querySelector('.js-profile-panel-address-form');

			validateForm(
				form,
				function (e, form, validation) {
					console.log('validation address sent');
					form.submit();
				},
				null // onFail()
			);
		});

		document.body.addEventListener('profile:panel:add', function (e) {
			var form = e.data.itemScope.querySelector('.js-profile-panel-form');

			validateForm(
				form,
				function (e, form, validation) {
					console.log('validation panel sent');
					form.submit();
				},
				null // onFail()
			);
		});
	}, false);
})();
