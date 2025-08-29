const WAOverflowingNav = (function overflowingNav () {
	const gl = {};

	function getSetting(type, val, fallback) {
		return typeof val === type ? val : fallback;
	}

	function getSettings(_st) {
		_st = _st || {};
		_st.selectors = _st.selectors || {};
		_st.templates = _st.templates || {};

		return {
			selectors: {
				root: getSetting('string', _st.selectors.root, '.nav'),
				list: getSetting('string', _st.selectors.list, '.nav__list'),
				item: getSetting('string', _st.selectors.item, '.nav__item'),
				link: getSetting('string', _st.selectors.link, '.nav__link'),
				burgerItem: getSetting('string', _st.selectors.burgerItem, '.nav__item_type_burger'),
				burger: getSetting('string', _st.selectors.burger, '.burger'),
			},
			templates: {
				item: getSetting('string', _st.templates.item, '<li class="nav__item nav__item_type_burger">%ITEM_LINK%%ITEM_SUB%</li>'),
				sub: getSetting('string', _st.templates.item, '<div class="nav__sub"><ul class="nav__list"></ul></div>'),
				burger: getSetting('string', _st.templates.burger, '<!-- begin .burger--><div class="nav__link nav__burger"><div class="burger"><div class="burger__bars">%BURGER_TEXT%</div></div></div><!-- end .burger-->'),
			},
			burgerText: getSetting('string', _st.burgerText, 'Больше элементов'),
			rebuildOnResize: getSetting('boolean', _st.rebuildOnResize, true),
		}
	}

	function getElements() {
		const list = gl.root.querySelector(gl.settings.selectors.list),
			items = list.children;

		return {
			root: gl.root,
			list: list,
			items: items,
		}
	}

	function reset() {
		const burgerItem = gl.elements.list.querySelector(gl.settings.selectors.burgerItem);

		if (!burgerItem) {
			return;
		}

		const burgerList = burgerItem.querySelector(gl.settings.selectors.list),
			burgerItems = burgerList.children;

		Array.from(burgerItems).forEach(function(item) {
			gl.elements.list.appendChild(item);
		});

		burgerItem.remove();
	}

	function update() {
		reset();

		const listWidth = gl.elements.list.offsetWidth,
			listScrollWidth = gl.elements.list.scrollWidth;

		if (listWidth >= listScrollWidth) {
			return;
		}

		const fragment = document.createDocumentFragment();
		let template = gl.settings.templates.item;

		template = template
			.replace('%ITEM_LINK%', gl.settings.templates.burger)
			.replace('%ITEM_SUB%', gl.settings.templates.sub)
			.replace('%BURGER_TEXT%', gl.settings.burgerText);

		fragment.append(stringToNode(template));
		gl.elements.list.appendChild(fragment);

		const burgerItem = gl.elements.list.querySelector(gl.settings.selectors.burgerItem),
			burgerList = burgerItem.querySelector(gl.settings.selectors.list),
			burgerItemWidth = burgerItem.offsetWidth;

		let itemWidthSum = burgerItem.offsetWidth;

		Array.from(gl.elements.items).forEach(function (item, i) {
			itemWidthSum += item.offsetWidth;

			if (itemWidthSum > listWidth && item !== burgerItem) {
				burgerList.appendChild(item);
			}
		});
	}

	function init() {
		update();

		if (gl.settings.rebuildOnResize) {
			window.addEventListener('resize', function () {
				update();
			});
		}
	}

	const OverflowingNav = function (root, _settings) {
		gl.root = root;
		gl.settings = getSettings(_settings);
		gl.elements = getElements();

		init();
	};

	OverflowingNav.prototype.disable = function () {
		Object.values(gl.data.flat).forEach(function (itemData) {
			itemData.els.input.disabled = true;
		});
	}

	return OverflowingNav;
})();