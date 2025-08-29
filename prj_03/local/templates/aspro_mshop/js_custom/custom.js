(function () {
	console.log('custom.js is ready');
	(function sizeTable() {
		var checkboxSelector = '.js-size-table-checkbox';
		$('html').on('change', checkboxSelector, function () {
			var $trigger = $(this),
				$container = $trigger.closest('.size-table__row');

			//alert(this.checked);

			var $inputCount = $(this).parents(".size-table__row").find('.js-size-table-quantity');
			var val = $inputCount.val();
			if (this.checked) {
				$container.addClass('size-table__row_state_checked');
				if (Number(val) <= 0) {
					$inputCount.val('1');
				}
			} else {
				$container.removeClass('size-table__row_state_checked');
				if (Number(val) > 0) {
					$inputCount.val('0');
				}
			}
		});
	})();
	//
	jQuery.fn.extend({
		live: function (event, callback) {
			if (this.selector) {
				jQuery(document).on(event, this.selector, callback);
			}
			return this;
		}
	});
	// document.addEventListener('DOMContentLoaded', ()=>{
	// 	const hideContent = Array.from(document.querySelectorAll('.content-hidden'));
	// 	hideContent.forEach(item=>{
	// 		let cur = item.parentNode.querySelector('.js-height-trigger.cur');
	// 		if (!cur){
	// 			item.style.height = '0px';
	// 		}

	// 	})
	// })
	document.addEventListener('DOMContentLoaded', () => {
		const hideContent = Array.from(document.querySelectorAll('.content-hidden'));
		if (hideContent) {
			hideContent.forEach(item => {
				if (!item.classList.contains('cur') && !item.parentElement.classList.contains('cur')) {
					item.style.height = '0px';
				}
			})
		}

	})
	function setHeight(event) {

		const trigger = event.target.closest('.js-height-trigger');
		if (!trigger) return; // Если клик не на триггере, ничего не делаем
		const parent = trigger.closest('.js-height-parent')
		const main = parent.querySelector('.js-height-main');
		if (main) {
			// console.log(parent.parentNode.closest('.js-height-parent'));
			event.preventDefault();
			// console.log(trigger);
			let preparent = parent.parentElement;
			if (trigger.classList.contains('menu_item')) {
				preparent = parent.parentElement.parentElement
			}
			const children = Array.from(preparent.children);

			// console.log(children);
			children.forEach(child => {
				const mainchild = child.querySelector('.js-height-main');
				const triggerchild = child.querySelector('.js-height-trigger');
				// console.log(triggerchild);
				// console.log(trigger);
				// trigger.classList.remove('content-show')
				// console.log(mainchild);
				if (mainchild) {
					if (main !== mainchild && !mainchild.classList.contains('content-hidden')) {
						mainchild.classList.add('content-hidden');
						mainchild.style.height = `${mainchild.scrollHeight}px`;
						console.log(triggerchild);
						triggerchild.classList.remove('content-show');
						window.getComputedStyle(mainchild, null).getPropertyValue('height');
						mainchild.style.height = '0';
						mainchild.style.overflow = 'hidden';
					}
				}
			});
			main.classList.toggle('content-hidden');
			trigger.classList.toggle('content-show');

			if (main.style.height === '0px') {
				main.style.height = `${main.scrollHeight}px`;
			} else {
				main.style.height = `${main.scrollHeight}px`;
				window.getComputedStyle(main, null).getPropertyValue('height');
				main.style.height = '0';
				main.style.overflow = 'hidden';
			}

			main.addEventListener('transitionend', () => {
				if (main.style.height !== '0px') {
					main.style.height = 'auto';
					main.style.overflow = 'visible';
				}
			});
		}

		// if (!main.classList.contains('content-hidden')){
		// 	trigger.classList.toggle('content-open');
		// }
		// else{
		// 	trigger.classList.toggle('content-hidden');
		// }

	}
	document.addEventListener('DOMContentLoaded', () => {
		const mains = Array.from(document.querySelectorAll('.js-height-main.cur'));
		const parents = Array.from(document.querySelectorAll('.js-height-parent.cur'))
		mains.forEach(main => {
			if (main.classList.contains("content-hidden")) {
				main.classList.remove('content-hidden')
			}
		})

		const triggers = Array.from(document.querySelectorAll('.js-height-trigger.cur'));
		triggers.forEach(trigger => {
			console.log(trigger);
			if (!trigger.classList.contains("content-show")) {
				trigger.classList.add('content-show')
			}
		})

		/*
		// LazyLoad -->
		const lazy = Array.from(document.querySelectorAll('.lazy'));
		lazy.forEach(item => {
			var image_url = item.getAttribute('data-src');
			item.setAttribute( 'style', "background-image: url('" + image_url + "') !important;" );
		});
		// <-- LazyLoad
		*/

		// const subTriggers =Array.from(document.querySelectorAll('.menu_item.js-height-trigger.cur'));
		// subTriggers.forEach(subTrigger => {
		// 	if (!subTrigger.classList.contains("content-show")){
		// 		subTrigger.classList.add('content-show')
		// 	}
		// });
	})
	document.addEventListener('click', event => {
		setHeight(event)
	});
})();