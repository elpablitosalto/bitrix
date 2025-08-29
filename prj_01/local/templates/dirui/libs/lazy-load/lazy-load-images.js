// LAZY LOAD IMAGES
$(LoadImagesLazy);
$(document).on('reload', LoadImagesLazy);
function LoadImagesLazy() {
	if ("loading" in HTMLImageElement.prototype) {
		var images = document.querySelectorAll('img[loading="lazy"]:not(.lazyloaded)');
		var sources = document.querySelectorAll("source[data-srcset]:not(.lazyloaded)");
		sources.forEach(function (source) {
			source.srcset = source.dataset.srcset;
			$(source).addClass('lazyloaded');
		});
		images.forEach(function (img) {
			img.src = img.dataset.src;
			$(img).addClass('lazyloaded');
		});
	}
	else {
		if ($('#lazy-load-script').length < 1) {
			var script = document.createElement("script");
			script.setAttribute("id", "lazy-load-script");
			script.src = $("body").data('site-template-path') + "libs/lazysizes/lazysizes.min.js";
			document.body.appendChild(script);
		}
	}
}

// LAZY LOAD BACKGROUNDS
$(LoadBackgroundsLazy);
$(document).on('reload', LoadBackgroundsLazy);
$(window).on('load scroll resize', LoadBackgroundsLazy);
function LoadBackgroundsLazy() {
	var $lazyBackgrounds = $("[data-lazy-bg]");
	if ($lazyBackgrounds.length > 0) {
		$lazyBackgrounds.each(function() {
			var $el = $(this);
			var imgSrc = $el.attr("data-lazy-bg");
			
			if (IsVisible($el)) {
				var img = new Image();
				img.onload = function() {
					$el.css("background-image", "url(" + imgSrc + ")")
						.removeAttr("data-lazy-bg")
						.addClass("lazyloaded").trigger("lazyloaded");
				};
				img.src = imgSrc;
			}
		});
	}
}
function IsVisible($element) {
	return ($element.is(':visible') &&
		$(window).scrollTop() < ($element.offset().top + $element.outerHeight()) &&
		($(window).scrollTop() + $(window).height()) >= $element.offset().top);
}