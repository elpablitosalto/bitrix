(function layoutGroup() {
	window.addEventListener('load', function () {
		var triggerSelector = '.js-layout-group-trigger',
			triggerScopeSelector = '.js-layout-group',
			scopeSelector = '.catalog',
			productContainerSelector = '.product-grid',
			productSelector = '.product-snippet',
			catalogCartPanel = '.catalog__cart-panel',
			cartPanelActiveClass = 'catalog__cart-panel_state_shown'
			triggerActiveClass = 'layout-group__trigger_state_active',
			productContainerListClass = 'product-grid_layout_list',
			productListClass = 'product-snippet_layout_list-item';

		function toggleList(trigger) {
			var triggerScope = trigger.closest(triggerScopeSelector),
				scope = trigger.closest(scopeSelector),
				container = scope ? scope.querySelector(productContainerSelector) : null,
				products = container ? container.querySelectorAll(productSelector) : null,
				isGrid = trigger.dataset.layout === 'grid' || trigger.attributes['aria-label'].value === 'Вид сетки';

			if (triggerScope && container && products.length) {
				var activeTrigger = triggerScope.querySelector('.' + triggerActiveClass);
				if (activeTrigger) {
					activeTrigger.classList.remove(triggerActiveClass);
				}
				trigger.classList.add(triggerActiveClass);
				container.classList.toggle(productContainerListClass, !isGrid);
				const cartPanel = document.querySelector(catalogCartPanel);
				if (container.classList.contains(productContainerListClass)) {
					if (catalogCartPanel) {
						cartPanel.classList.add(cartPanelActiveClass)
					}
				} else {
					cartPanel.classList.remove(cartPanelActiveClass)
				}
				products.forEach(function (product) {
					product.classList.toggle(productListClass, !isGrid);
				});
			}
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
