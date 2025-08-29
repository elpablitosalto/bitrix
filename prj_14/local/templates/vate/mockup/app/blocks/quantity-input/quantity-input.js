(function quantityInput() {
	window.addEventListener('load', function () {
		function init() {
			var containerSelector = '.js-quantity-container',
				inputSelector = '.js-quantity-input',
				decreaseSelector = '.js-quantity-decrease',
				increaseSelector = '.js-quantity-increase',
				inputs = document.querySelectorAll(inputSelector),
				triggers = document.querySelectorAll('.js-quantity-decrease, .js-quantity-increase');

			function decrease(container, input, cur, min, max) {
				var dec = container.querySelector(decreaseSelector),
					inc = container.querySelector(increaseSelector),
					ratio = Number(input.dataset.ratio) || 1,
					newValue = cur - ratio;

				input.value = newValue;
				input.dataset.lastVal = newValue;

				if (cur === max) {
					inc.disabled = false;
				} else if (newValue === min) {
					dec.disabled = true;
				}
			}

			function increase(container, input, cur, min, max) {
				var dec = container.querySelector(decreaseSelector),
					inc = container.querySelector(increaseSelector),
					ratio = Number(input.dataset.ratio) || 1,
					newValue = cur + ratio;

				input.value = newValue;
				input.dataset.lastVal = newValue;

				if (newValue === max) {
					inc.disabled = true;
				} else if (cur === min) {
					dec.disabled = false;
				}
			}

			function update(input) {
				var container = input.closest(containerSelector),
					dec = container.querySelector(decreaseSelector),
					inc = container.querySelector(increaseSelector),
					cur = Number(input.value),
					min = Number(input.dataset.min),
					max = Number(input.dataset.max),
					last = Number(input.dataset.lastVal) || 0;

				if (Number.isNaN(cur)) {
					cur = last;
				}

				if (Number.isNaN(min)) {
					min = 0;
				}

				if (Number.isNaN(max)) {
					max = 99;
				}

				if (cur <= min) {
					cur = min;
					dec.disabled = true;
				} else if (cur >= max) {
					cur = max;
					inc.disabled = true;
				}

				input.value = cur;
				input.dataset.lastVal = cur;

				if (cur > min && dec.disabled) {
					dec.disabled = false;
				} else if (cur < max && inc.disabled) {
					inc.disabled = false;
				}
			}

			triggers.forEach(function (trigger) {
				if (!trigger.quantityTriggerInit) {
					trigger.quantityTriggerInit = true;
					trigger.addEventListener('click', function () {

						var container = trigger.closest(containerSelector),
							input = container.querySelector(inputSelector),
							cur = Number(input.value),
							min = Number(input.dataset.min),
							max = Number(input.dataset.max);

						if (Number.isNaN(min)) {
							min = 0;
						}

						if (Number.isNaN(max)) {
							max = 99;
						}

						if (trigger.matches(decreaseSelector) && cur !== min) {
							decrease(container, input, cur, min, max);
						} else if (trigger.matches(increaseSelector) && cur !== max) {
							increase(container, input, cur, min, max);
						}

						if ('createEvent' in document) {
							var evt = document.createEvent('HTMLEvents');
							evt.initEvent('change', true, true);
							input.dispatchEvent(evt);
						} else {
							input.fireEvent('onchange');
						}
					});
				}
			});

			inputs.forEach(function (input) {
				if (!input.quantityInputInit) {
					input.quantityInputInit = true;
					update(input);
					input.addEventListener('change', function () {
						update(input);
					});
				}
			});
		}

		init();

		window.initQuantityInputs = init;

		window.addEventListener('popstate', function () {
			init();
		});
	});
})();
