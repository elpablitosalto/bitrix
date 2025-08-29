(function page() {
	function debounce(func, wait, immediate) {
		var timeout;

		return function() {
			var context = this, args = arguments;
			var later = function() {
				timeout = null;
				if (!immediate) func.apply(context, args);
			};
			var callNow = immediate && !timeout;
			clearTimeout(timeout);
			timeout = setTimeout(later, wait);
			if (callNow) func.apply(context, args);
		}
	}
	window.addEventListener('scroll', debounce(function (e) {
		var hash = location.hash;
		var target = hash ? document.getElementById(hash.replace('#', '')) : null;
		var cr = target ? target.getBoundingClientRect() : null;

		if (!cr || Math.floor(cr.y) !== 0) {
			return;
		}

		var header = document.querySelector('.header');
		var headerCR = header ? header.getBoundingClientRect() : null;

		if (!headerCR || !headerCR.y === 0) {
			return;
		}

		window.scrollTo(0, window.scrollY - header.offsetHeight);
	}, 50));
})();