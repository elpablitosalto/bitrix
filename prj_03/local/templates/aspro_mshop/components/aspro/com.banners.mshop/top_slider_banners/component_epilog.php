<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<script type="text/javascript">
	function checkNavColor(slider) {
		var nav_color_flex = slider.find('.flex-active-slide').data('nav_color');
		if (nav_color_flex == 'dark')
			slider.find('.flex-control-nav').addClass('flex-dark');
		else
			slider.find('.flex-control-nav').removeClass('flex-dark');
	}
	$(document).ready(function() {

		if ($('.top_slider_wrapp .flexslider').length) {
			var config = {
				"controlNav": true,
				"animationLoop": true,
				"pauseOnHover": true
			};
			if (typeof(arMShopOptions['THEME']) != 'undefined') {
				var slideshowSpeed = Math.abs(parseInt(arMShopOptions['THEME']['BANNER_SLIDESSHOWSPEED']));
				var animationSpeed = Math.abs(parseInt(arMShopOptions['THEME']['BANNER_ANIMATIONSPEED']));
				//config["directionNav"] = (arMShopOptions['THEME']['BANNER_WIDTH'] == 'narrow' ? false : true);
				config["slideshow"] = (slideshowSpeed && arMShopOptions['THEME']['BANNER_ANIMATIONTYPE'].length ? true : false);
				config["animation"] = (arMShopOptions['THEME']['BANNER_ANIMATIONTYPE'] === 'FADE' ? 'fade' : 'slide');
				if (animationSpeed >= 0) {
					config["animationSpeed"] = animationSpeed;
				}
				if (slideshowSpeed >= 0) {
					config["slideshowSpeed"] = slideshowSpeed;
				}
				if (arMShopOptions['THEME']['BANNER_ANIMATIONTYPE'] !== 'FADE') {
					config["direction"] = (arMShopOptions['THEME']['BANNER_ANIMATIONTYPE'] === 'SLIDE_VERTICAL' ? 'vertical' : 'horizontal');
				}

				config.start = function(slider) {
					checkNavColor(slider);

					if (slider.count <= 1) {
						slider.find('.flex-direction-nav li').addClass('flex-disabled');
					}

					$.flexloader(slider, {
						'background_images': true
					});
				}
				config.after = function(slider) {
					checkNavColor(slider);

					$.flexloader(slider, {
						'background_images': true
					});
				}
			}

			setTimeout(function() {
				$(".top_slider_wrapp .flexslider").flexslider(config);
			}, 1000);
		}

	});
</script>

<style>
	@media (max-width: 540px) {
		<? $i = 1; ?><? foreach ($arResult["ITEMS"] as $arItem) { ?>.slide-<?= $i; ?>.flexloader-background-image-loaded {
			background-image: url('<?= $arItem['BACKGROUND_540'] ?>') !important;
		}

		<? $i++; ?><? } ?>
	}

	@media (min-width: 541px) and (max-width: 720px) {
		<? $i = 1; ?><? foreach ($arResult["ITEMS"] as $arItem) { ?>.slide-<?= $i; ?>.flexloader-background-image-loaded {
			background-image: url('<?= $arItem['BACKGROUND_720'] ?>') !important;
		}

		<? $i++; ?><? } ?>
	}

	@media (min-width: 721px) and (max-width: 900px) {
		<? $i = 1; ?><? foreach ($arResult["ITEMS"] as $arItem) { ?>.slide-<?= $i; ?>.flexloader-background-image-loaded {
			background-image: url('<?= $arItem['BACKGROUND_900'] ?>') !important;
		}

		<? $i++; ?><? } ?>
	}

	@media (min-width: 901px) {
		<? $i = 1; ?><? foreach ($arResult["ITEMS"] as $arItem) { ?>.slide-<?= $i; ?>.flexloader-background-image-loaded {
			background-image: url('<?= $arItem['BACKGROUND'] ?>') !important;
		}

		<? $i++; ?><? } ?>
	}
</style>