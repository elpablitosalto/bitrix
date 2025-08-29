(function tabs() {
	window.addEventListener('load', function () {
		function changeTab(tabsBlocks, triggers, panels, activeIndex) {
			if (tabsBlocks && triggers.length && panels.length) {
				var activeTrigger = triggers.item(activeIndex);

				triggers.forEach(function (item) {
					item.classList.remove('tabs__label_state_active');
				});
				activeTrigger.classList.add('tabs__label_state_active');

				panels.forEach(function (item) {
					item.classList.remove('tabs__panel_state_active');
				});
				panels.item(activeIndex).classList.add('tabs__panel_state_active');

				if (activeTrigger.dataset.hrefSwitch) {
					var href = activeTrigger.dataset.hrefSwitch,
						id = activeTrigger.dataset.hrefSwitchTarget,
						targets = document.body.querySelectorAll('[data-href-switch-id="' + id + '"]');

					if (targets.length) {
						targets.forEach(function (target) {
							if (target.attributes.href) {
								target.attributes.href.value = href;
							}
						});
					}
				}
			}
		}

		function getActiveIndex(tabsBlocks, triggers, currentTrigger) {
			let activeIndex = 0;
			triggers.forEach(function (item, i) {
				if (item === currentTrigger) {
					activeIndex = i;
				}
			});
			return activeIndex;
		}


		const containerSelector = '.js-tabs',
			triggerSelector = '.js-tabs-trigger',
			panelSelector = '.js-tabs-panel',
			panelHiddenClass = 'tabs__panel_state_hidden',
			panelActiveClass = 'tabs__label_state_active',
			tabsBlocks = document.querySelectorAll(containerSelector);

		if (tabsBlocks.length) {
			tabsBlocks.forEach(function (tabSet) {
				const triggers = tabSet.querySelectorAll(triggerSelector);
				let panels = tabSet.querySelectorAll(panelSelector);
				let currentTrigger;
				let activeIndex = 0;

				if (!triggers.length) {
					return;
				}

				if (!panels.length) {
					var targetQuery = tabSet.dataset.tabsFor,
						target = targetQuery ? document.querySelector(targetQuery) : null;

					if (target) {
						panels = target.querySelectorAll(panelSelector);
					}

					if (!panels.length) {
						return;
					}
				}

				triggers.forEach(function (item) {
					if (item.matches('.' + panelActiveClass)) {
						currentTrigger = item;
					}
				});

				if (currentTrigger) {
					activeIndex = getActiveIndex(tabSet, triggers, currentTrigger);
				}

				panels.forEach(function (item) {
					item.classList.add(panelHiddenClass);
				});

				changeTab(tabSet, triggers, panels, activeIndex);

				triggers.forEach(function (item) {
					item.addEventListener('click', function (e) {
						e.preventDefault();
						activeIndex = getActiveIndex(tabSet, triggers, this);
						changeTab(tabSet, triggers, panels, activeIndex);
						return false;
					});
				});
			});
		}
	}, false);
})();
