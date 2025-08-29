(function range() {
	window.addEventListener('load', function () {
		function init() {
			var ranges = document.querySelectorAll('.js-range');
			if (ranges.length) {
				ranges.forEach(function (range) {
					var stepsSlider = range.querySelector('.range__slider'),
						inputFirst = range.querySelector('.range__input_type_visual-from'),
						inputSecond = range.querySelector('.range__input_type_visual-to'),
						start = Number(range.dataset['start']) || 0,
						stop = Number(range.dataset['stop']) || 100,
						min = Number(range.dataset['min']) || 0,
						max = Number(range.dataset['max']) || 100,
						unit = inputFirst.value.replace(/\d/g, '');

					if (stepsSlider && inputFirst && inputSecond) {
						var inputs = [inputFirst, inputSecond];
						try {
							noUiSlider.create(stepsSlider, {
								start: [start, stop],
								connect: true,
								range: {
									min,
									max
								},
								step: 1,
								tooltips: [
									wNumb({
										decimals: 0,
										thousand: ' ',
										suffix: ' р'
									}),
									wNumb({
										decimals: 0,
										thousand: ' ',
										suffix: ' р'
									})
								],
								// pips: {
								// 	mode: 'positions',
								// 	values: [0, 100],
								// 	density: 100,
								// 	format: wNumb({
								// 		decimals: 0,
								// 		thousand: ' ',
								// 		suffix: ' р'
								// 	})
								// },
								format: wNumb({
									decimals: 0,
									thousand: ' '
								})
							});

							stepsSlider.noUiSlider.on('update', function (values, handle) {
								inputs[handle].value = values[handle] + unit;
							});

							inputs.forEach(function (input, handle) {
								input.addEventListener('change', function () {
									console.log('text');
									stepsSlider.noUiSlider.setHandle(handle, this.value);
								});

								input.addEventListener('keydown', function (e) {

									var values = stepsSlider.noUiSlider.get(),
										value = Number(values[handle]),
										steps = stepsSlider.noUiSlider.steps(),
										step = steps[handle],
										position;

									// 13 is enter,
									// 38 is key up,
									// 40 is key down.
									switch (e.which) {

										case 13:
											stepsSlider.noUiSlider.setHandle(handle, this.value);
											break;

										case 38:

											position = step[1];

											if (position === false) {
												position = 1;
											}

											if (position !== null) {
												stepsSlider.noUiSlider.setHandle(handle, value + position);
											}

											break;

										case 40:

											position = step[0];

											if (position === false) {
												position = 1;
											}

											if (position !== null) {
												stepsSlider.noUiSlider.setHandle(handle, value - position);
											}

											break;
									}
								});
							});
						} catch (err) {
							console.log(err);
						}
					}
				});
			}
		}

		init();
	});
})();
