(function catalog() {
	window.addEventListener('load', function () {
		var addSelector = '.js-catalog-add-trigger',
			addAllSelector = '.js-catalog-add-all',
			catalogSelector = '.catalog',
			amountSelector = '.js-catalog-cart-product-amount',
			catalogCartShownClass = 'catalog_cart-panel_shown';

		function toggleItem(trigger, affectAll) {
			var catalog = document.querySelector(catalogSelector),
				allTrigger = affectAll ? trigger : document.querySelector(addAllSelector),
				items = catalog ? catalog.querySelectorAll(addSelector) : null,
				amountEl = catalog ? catalog.querySelector(amountSelector) : null,
				totalAmount = 0;

			if (!allTrigger || !catalog || !items.length) {
				return;
			}

			if (affectAll) {
				items.forEach(function (el) {
					el.checked = trigger.checked;
				});
				totalAmount = trigger.checked ? items.length : 0;
			} else {
				items.forEach(function (el) {
					totalAmount += Number(el.checked);
				});
			}

			catalog.classList.toggle(catalogCartShownClass, totalAmount > 0);
			console.log(allTrigger);
			allTrigger.checked = totalAmount === items.length;

			if (amountEl) {
				amountEl.innerText = totalAmount;
			}
		}

		document.body.addEventListener('change', function (e) {
			var isTrigger = e.target.matches(addSelector),
				isAllTrigger = e.target.matches(addAllSelector);

			if (isTrigger) {
				toggleItem(e.target);
			} else if (isAllTrigger) {
				toggleItem(e.target, true);
			}
		});
	}, false);
})();
