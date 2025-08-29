var isTouchScreen = window.matchMedia('(hover:none)').matches;

// LAZY LOAD IMAGES
$(LoadImagesLazy);
$(document).on('reload', LoadImagesLazy);
function LoadImagesLazy() {
	if ("loading" in HTMLImageElement.prototype) {
		var images = document.querySelectorAll('img[loading="lazy"][src*="loader.svg"]');
		var sources = document.querySelectorAll('source[data-srcset][srcset*="loader.svg"]');
		sources.forEach(function (source) {
			source.srcset = source.dataset.srcset;
		});
		images.forEach(function (img) {
			img.src = img.dataset.src;
		});
	}
	else {
		if ($('#lazy-load-script').length < 1) {
			var script = document.createElement("script");
			script.setAttribute("id", "lazy-load-script");
			script.src = "../libs/lazysizes/lazysizes.min.js";
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

// GET SVG SPRITE
$(LoadSvgIcons);
$(document).on("reload", LoadSvgIcons);
function LoadSvgIcons() {
	if ($("#svg-icons-sprite").length < 1) {
		$.get('/local/templates/roadtohome/images/svg-sprite.svg', function(data) {
			var sprite = document.createElement("div");
			sprite.setAttribute("id", "svg-icons-sprite");
			$(sprite).css({
				position: 'absolute',
				width: 0,
				height: 0
			});
			sprite.innerHTML = new XMLSerializer().serializeToString(data.documentElement);
			document.body.appendChild(sprite);
		});
	}
}

// TOGGLE ACTIVITY
$(document).on("click", "[data-toggle-activity]", function(evt) {
	evt.preventDefault();
	var targetId = $(this).attr("data-toggle-activity");
	var $target = $(targetId);
	var closeOnOutsideClick = !!$target.attr("data-close-on-outside-click");
	
	if ($target.length > 0) {
		if ($target.is(".active")) Deactivate($target, closeOnOutsideClick);
		else Activate($target, closeOnOutsideClick);
	}
});
function Activate($block, closeOnOutsideClick) {
	var targetId = $block.attr('id');
	$block.addClass("active").trigger("activate");
	
	if (closeOnOutsideClick) {
		var hasclick = false;
		$("body").bind("click.blockactivity", function(evt) {
			if ($(evt.target) != $block && $(evt.target).closest($block).length < 1 &&
				!$(evt.target).is('[data-toggle-activity="#' +  targetId + '"]') && $(evt.target).closest('[data-toggle-activity="#' +  targetId + '"]').length < 1) {
				Deactivate($block, closeOnOutsideClick);
			}
			hasclick = true;
		});
	}
	
	var $links = $('[data-toggle-activity="#' +  targetId + '"]');
	$links.each(function() {
		$(this).addClass('active').trigger('activate');
	});
}
function Deactivate($block, closeOnOutsideClick) {
	var targetId = $block.attr('id');
	$block.removeClass("active").trigger("deactivate");
	if (closeOnOutsideClick) $("body").unbind("click.blockactivity");
	
	var $links = $('[data-toggle-activity="#' +  targetId + '"]');
	$links.each(function() {
		$(this).removeClass('active').trigger('deactivate');
	});
}
$(document).on("activate deactivate", '*', function(evt) {
	evt.stopPropagation();
});

// FANCYBOX DEFAULTS
if (typeof($.fancybox) !== 'undefined') {
	$.fancybox.defaults.loop = true;
	$.fancybox.defaults.infobar = false;
	$.fancybox.defaults.toolbar = true;
	$.fancybox.defaults.buttons = ["close"];
	$.fancybox.defaults.animationEffect = "fade";
	$.fancybox.defaults.autoFocus = false;
	$.fancybox.defaults.backFocus = false;
	$.fancybox.defaults.clickOutside = "close";
	$.fancybox.defaults.clickSlide = "close";
	$.fancybox.defaults.btnTpl = {
		close: '<button data-fancybox-close class="fancybox-button fancybox-button-close" title=""><svg class="icon" xmlns="http://www.w3.org/2000/svg"><use xlink:href="#close"/></svg></button>',
		arrowLeft: '<button data-fancybox-prev class="fancybox-button fancybox-button-prev" title=""><svg class="icon" xmlns="http://www.w3.org/2000/svg"><use xlink:href="#drop-light"/></svg></button>',
		arrowRight: '<button data-fancybox-next class="fancybox-button fancybox-button-next" title=""><svg class="icon" xmlns="http://www.w3.org/2000/svg"><use xlink:href="#drop-light"/></svg></button>'
	};
	
	$(document).on('click', '[data-modal]', function(evt) {
		var modalId = $(this).data('modal');
		if ($(modalId).length > 0) {
			evt.preventDefault();
			ShowModal(modalId);
		}
		
	})
}
function ShowModal(modalId) {
	$.fancybox.close();
	
	var $modal = $(modalId);
	$.fancybox.open({
		src: modalId,
		arrows: false,
		modal: true,
		afterShow: function() {
			$modal.trigger('modal.show');
			$(document).bind('click.fancyboxOutside', function(evt) {
				var $target = $(evt.target);
				if (($target.is('.fancybox-slide') || $target.closest('.fancybox-slide').length > 0)
					&& !($target.is('.modal') || $target.closest('.modal').length > 0)) {
					$.fancybox.close();
					$modal.trigger('modal.hide');
				}
			})
		},
		beforeClose: function() {
			$modal.trigger('modal.hide');
			$(document).unbind('click.fancyboxOutside');
		}
	});
}

// SCROLL LINK
var transforming = false;
$(document).on('click', '[data-scroll-to]', function(event) {
	event.preventDefault();
	
	var $link = $(this);
	var $target = $($link.attr('data-scroll-to'));
	
	if ($target.length > 0 && !transforming) {
		$link.trigger('runscroll');
		scrollDocumentTo($target)
	}
});
function scrollDocumentTo($block) {
	var targetTop = $block.offset().top;
	var cPos = $(window).scrollTop();
	var time = Math.abs(cPos - targetTop) * 0.4;
	transforming = true;
	$('html, body').animate({scrollTop: targetTop}, time, 'swing', function() {
		transforming = false;
	});
}