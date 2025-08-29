(function layoutGroup() {
	window.addEventListener('load', function () {
		var triggerSelector = '.js-catalog-layout-trigger',
			triggerScopeSelector = '.js-layout-group',
			scopeSelector = '.catalog',
			catalogPanelSelector = '.catalog__cart-panel',
			productContainerSelector = '.product-grid',
			productSelector = '.product-snippet',

			triggerActiveClass = 'layout-group__trigger_state_active',
			catalogPanelActiveClass = 'catalog__cart-panel_state_shown',
			productContainerListClass = 'product-grid_layout_list',
			productListClass = 'product-snippet_layout_list-item';

		function toggleList(trigger) {
			var triggerScope = trigger.closest(triggerScopeSelector),
				scope = trigger.closest(scopeSelector),
				container = scope ? scope.querySelector(productContainerSelector) : null,
				catalogPanel = scope ? scope.querySelector(catalogPanelSelector) : null,
				products = container ? container.querySelectorAll(productSelector) : null,
				isGrid = trigger.dataset.layout === 'grid' || trigger.attributes['aria-label'].value === 'Вид сетки';

			if (triggerScope && container && products.length) {
				var activeTrigger = triggerScope.querySelector('.' + triggerActiveClass);
				if (activeTrigger) {
					activeTrigger.classList.remove(triggerActiveClass);
				}
				trigger.classList.add(triggerActiveClass);
				container.classList.toggle(productContainerListClass, !isGrid);
				products.forEach(function (product) {
					product.classList.toggle(productListClass, !isGrid);
				});
			}

			if (catalogPanel) {
				if (!isGrid) {
					catalogPanel.classList.add(catalogPanelActiveClass);
				} else {
					catalogPanel.classList.remove(catalogPanelActiveClass);
				}
			}

			const layoutType = isGrid ? 'GRID' : 'LIST';
			setCookie('CATALOG_LAYOUT', layoutType);
		}

		function setCookie(name, value, days) {
			var expires = '';
			if (days) {
				var date = new Date();
				date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
				expires = '; expires=' + date.toUTCString();
			}
			document.cookie = name + '=' + (value || '') + expires + '; path=/';
		}

		document.body.addEventListener('click', function (e) {
			var trigger = e.target.closest(triggerSelector);

			if (trigger) {
				e.preventDefault();
				toggleList(trigger);
			}
		});
	}, false);
})();
