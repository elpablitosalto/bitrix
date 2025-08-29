$(StartMediaTypeSliders);
function StartMediaTypeSliders() {
	var $mediaTypeSliders = $('.mediaType-slider');
	if ($mediaTypeSliders.length > 0 && typeof Swiper !== undefined) {
		$mediaTypeSliders.each(function () {
			var $slider = $(this).addClass('swiper-container');
			var $slides = $slider.find('.mediaTeaser').addClass('swiper-slide');
			$slides.wrapAll('<div class="swiper-wrapper"></div>');
			$slider.append('<div class="swiper-button prev"></div><div class="swiper-button next"></div>');
			
			var sw = new Swiper($slider[0], {
				slidesPerView: 'auto',
				slidesPerGroup: 1,
				spaceBetween: 40,
				navigation: {
					prevEl: $slider.find('.swiper-button.prev')[0],
					nextEl: $slider.find('.swiper-button.next')[0]
				}
			})
		});
	}
}

// YOTUBE VIDEO CONTAINER
$(WrapVideo);
function WrapVideo() {
	var $arrVideos = $('iframe[src*="youtube"]');
	$arrVideos.each(function () {
		$(this).wrap('<div class="youtube-video-fixed-container"></div>');
	});
}