const isElementLoaded = async (selector) => {
	while (document.querySelector(selector) === null) {
		await new Promise((resolve) => requestAnimationFrame(resolve));
	}
	return document.querySelector(selector);
};


// HEADER MENU
if (isTouchScreen) {
	$(document).on('click', '.header__menu > li > a', function(evt) {
		var $this = $(this).closest('li');
		if ($this.find('.submenu').length > 0) {
			evt.preventDefault();
			CloseHeaderSubmenus();
			$this.addClass('open');
			$(document).on('click.headerMenuOpen', function (evt) {
				if (!$(evt.target).is('.header__menu > li') && $(evt.target).closest('.header__menu > li').length < 1) {
					CloseHeaderSubmenus();
					$(document).off('click.headerMenuOpen');
				}
			});
		}
	});
}
else {
	var hideSubmenuTimeout = false;
	var showSubmenuTimeout = false;

	$(document).on('mouseenter', '.header__menu > li', function (evt) {
		clearTimeout(hideSubmenuTimeout);
		CloseHeaderSubmenus();
		var $this = $(this);
		if ($this.find('.submenu').length > 0) {
			showSubmenuTimeout = setTimeout(function () {
				$this.addClass('open');
				clearTimeout(showSubmenuTimeout);
			}, 200);
		}
	});
	$(document).on('mouseleave', '.header__menu > li', function () {
		clearTimeout(showSubmenuTimeout);
		var $this = $(this);
		if ($this.find('.submenu').length > 0) {
			hideSubmenuTimeout = setTimeout(function () {
				$this.removeClass('open');
				clearTimeout(hideSubmenuTimeout);
			}, 200);
		}
	});
}
function CloseHeaderSubmenus() {
	var $openMenus = $('.header__menu li.open');
	if ($openMenus.length > 0) $openMenus.removeClass('open');
}

// MAIN MENU
$(document).on('activate', '#main-menu', function (evt) {
	$('body').addClass('main-menu-active');
});
$(document).on('deactivate', '#main-menu', function (evt) {
	$('body').removeClass('main-menu-active');
});

// MAIN NEWS SLIDER
$(InitMainNewsSlider);
$(document).on("reload", InitMainNewsSlider);
function InitMainNewsSlider() {
	var $sliders = $('.main-news-slider:not(.js-swiper-initialized)');
	if ($sliders.length > 0) {
		$sliders.each(function () {
			var $swiperBlock = $(this);
			var swiperOpts = {
				init: true,
				loop: false,
				speed: 300,
				navigation: {
					prevEl: $swiperBlock.find('.swiper-button.prev'),
					nextEl: $swiperBlock.find('.swiper-button.next')
				},
				initialSlide: 0,
				slidesPerView: 2,
				slidesPerGroup: 1,
				spaceBetween: 40,
				pagination: {
					el: $swiperBlock.find('.swiper-pagination'),
					clickable: true,
					type: 'bullets'
				},
				breakpoints: {
					1599: {
						slidesPerView: 2,
						spaceBetween: 30,
					},
					1279: {
						slidesPerView: 3,
						spaceBetween: 24,
					},
					1023: {
						slidesPerView: 2,
						spaceBetween: 24,
					},
					767: {
						slidesPerView: 'auto',
						spaceBetween: 16,
					}
				}
			};
			var sw = new Swiper($swiperBlock.find('.swiper-container'), swiperOpts);
			$swiperBlock.addClass('js-swiper-initialized').data('swiper', sw);
		});
	}
}

// MAIN STORIES SLIDER
$(InitMainStoriesSlider);
$(document).on("reload", InitMainStoriesSlider);
function InitMainStoriesSlider() {
	var $sliders = $('.main-stories-slider:not(.js-swiper-initialized)');
	if ($sliders.length > 0) {
		$sliders.each(function () {
			var $swiperBlock = $(this);
			var swiperOpts = {
				init: true,
				loop: false,
				speed: 300,
				navigation: {
					prevEl: $swiperBlock.find('.swiper-button.prev'),
					nextEl: $swiperBlock.find('.swiper-button.next')
				},
				initialSlide: 0,
				slidesPerView: 4,
				slidesPerGroup: 1,
				spaceBetween: 40,
				pagination: {
					el: $swiperBlock.find('.swiper-pagination'),
					clickable: true,
					type: 'bullets'
				},
				breakpoints: {
					1599: {
						slidesPerView: 4,
						spaceBetween: 30,
					},
					1279: {
						slidesPerView: 3,
						spaceBetween: 24,
					},
					1023: {
						slidesPerView: 2,
						spaceBetween: 24,
					},
					767: {
						slidesPerView: 'auto',
						spaceBetween: 16,
					}
				}
			};
			var sw = new Swiper($swiperBlock.find('.swiper-container'), swiperOpts);
			$swiperBlock.addClass('js-swiper-initialized').data('swiper', sw);
		});
	}
}

// MAIN VOLUNTEERS SLIDER
$(InitMainVolunteersSlider);
$(document).on("reload", InitMainVolunteersSlider);
function InitMainVolunteersSlider() {
	var $sliders = $('.main-volunteers-slider:not(.js-swiper-initialized)');
	if ($sliders.length > 0) {
		$sliders.each(function () {
			var $swiperBlock = $(this);
			var swiperOpts = {
				init: true,
				loop: false,
				speed: 300,
				navigation: {
					prevEl: $swiperBlock.find('.swiper-button.prev'),
					nextEl: $swiperBlock.find('.swiper-button.next')
				},
				initialSlide: 0,
				slidesPerView: 4,
				slidesPerGroup: 1,
				spaceBetween: 40,
				pagination: {
					el: $swiperBlock.find('.swiper-pagination'),
					clickable: true,
					type: 'bullets'
				},
				breakpoints: {
					1599: {
						slidesPerView: 4,
						spaceBetween: 30,
					},
					1279: {
						slidesPerView: 'auto',
						spaceBetween: 24,
					},
					1023: {
						slidesPerView: 'auto',
						spaceBetween: 24,
					},
					767: {
						slidesPerView: 'auto',
						spaceBetween: 16,
					}
				}
			};
			var sw = new Swiper($swiperBlock.find('.swiper-container'), swiperOpts);
			$swiperBlock.addClass('js-swiper-initialized').data('swiper', sw);
		});
	}
}

// MAIN PARTNERS SLIDER
$(InitMainPartnersSlider);
$(document).on("reload", InitMainPartnersSlider);
function InitMainPartnersSlider() {
	var $sliders = $('.main-partners-slider:not(.js-swiper-initialized)');
	if ($sliders.length > 0) {
		$sliders.each(function () {
			var $swiperBlock = $(this);
			var swiperOpts = {
				init: true,
				loop: false,
				speed: 300,
				navigation: {
					prevEl: $swiperBlock.find('.swiper-button.prev'),
					nextEl: $swiperBlock.find('.swiper-button.next')
				},
				initialSlide: 0,
				slidesPerView: 'auto',
				slidesPerGroup: 1,
				spaceBetween: 40,
				pagination: {
					el: $swiperBlock.find('.swiper-pagination'),
					clickable: true,
					type: 'bullets'
				},
				breakpoints: {
					1599: {
						slidesPerView: 'auto',
						spaceBetween: 30,
					},
					1279: {
						slidesPerView: 'auto',
						spaceBetween: 24,
					},
					1023: {
						slidesPerView: 'auto',
						spaceBetween: 24,
					},
					767: {
						slidesPerView: 1,
						spaceBetween: 16,
					}
				}
			};
			var sw = new Swiper($swiperBlock.find('.swiper-container'), swiperOpts);
			$swiperBlock.addClass('js-swiper-initialized').data('swiper', sw);
		});
	}
}

// MAIN CHILDREN SLIDER
$(InitMainChildrenSlider);
$(document).on("reload", InitMainChildrenSlider);
function InitMainChildrenSlider() {
	var $sliders = $('.main-children-slider:not(.js-swiper-initialized)');
	if ($sliders.length > 0) {
		$sliders.each(function () {
			var $swiperBlock = $(this);
			var swiperOpts = {
				init: true,
				loop: false,
				speed: 300,
				navigation: {
					prevEl: $swiperBlock.find('.swiper-button.prev'),
					nextEl: $swiperBlock.find('.swiper-button.next')
				},
				initialSlide: 0,
				slidesPerView: 4,
				slidesPerGroup: 1,
				spaceBetween: 40,
				pagination: {
					el: $swiperBlock.find('.swiper-pagination'),
					clickable: true,
					type: 'bullets'
				},
				breakpoints: {
					1599: {
						slidesPerView: 4,
						spaceBetween: 30,
					},
					1279: {
						slidesPerView: 3,
						spaceBetween: 24,
					},
					1023: {
						slidesPerView: 2,
						spaceBetween: 24,
					},
					767: {
						slidesPerView: 'auto',
						spaceBetween: 16,
					}
				}
			};
			var sw = new Swiper($swiperBlock.find('.swiper-container'), swiperOpts);
			$swiperBlock.addClass('js-swiper-initialized').data('swiper', sw);
		});
	}
}

// ADD YA.SHARE SCRIPT
$(AddYaShareScript);
$(document).on("reload", AddYaShareScript);
function AddYaShareScript() {
	if ($(".ya-share2").length > 0 && $("#ya-share2-script").length < 1) {
		$('body').append('<script id="ya-share2-script" src="https://yastatic.net/share2/share.js"></script>')
	}
}

// MAIN PROGRAMS ITEM
$(document).on('click', '.main-programs-item__toggler', function (evt) {
	evt.preventDefault();
	var $item = $(this).closest('.main-programs-item');
	if ($item.is('.active')) Deactivate($item);
	else Activate($item);
});

// MAIN NEWS LIST
$(InitMainNewsListSlider);
$(document).on("reload", InitMainNewsListSlider);
$(window).on("load resize resizeend", InitMainNewsListSlider);
function InitMainNewsListSlider() {
	var $sliders = $('.main-news-list');
	if ($sliders.length > 0) {
		$sliders.each(function () {
			var $swiperBlock = $(this);
			var swiperOpts = {
				init: true,
				loop: false,
				speed: 300,
				navigation: {
					prevEl: $swiperBlock.find('.swiper-button.prev'),
					nextEl: $swiperBlock.find('.swiper-button.next')
				},
				initialSlide: 0,
				slidesPerView: 3,
				slidesPerGroup: 1,
				spaceBetween: 24,
				pagination: {
					el: $swiperBlock.find('.swiper-pagination'),
					clickable: true,
					type: 'bullets'
				},
				breakpoints: {
					1023: {
						slidesPerView: 2,
					},
					767: {
						slidesPerView: 'auto',
						spaceBetween: 16,
					}
				}
			};

			if (window.matchMedia('(min-width: 1280px)').matches) {
				if ($swiperBlock.is('.js-swiper-initialized')) {
					$swiperBlock.removeClass('js-swiper-initialized').data('swiper').destroy();
				}
			}
			else {
				if ($swiperBlock.is('.js-swiper-initialized')) {
					$swiperBlock.data('swiper').update();
				}
				else {
					var sw = new Swiper($swiperBlock.find('.swiper-container'), swiperOpts);
					$swiperBlock.addClass('js-swiper-initialized').data('swiper', sw);
				}
			}
		});
	}
}

// DETAIL REPORT DIAGRAMS
if (typeof google !== 'undefined') {
	google.charts.load('current', {'packages': ['corechart']});
	google.charts.setOnLoadCallback(InitDetailReportDiagrams);
	function InitDetailReportDiagrams() {
		var $charts = $('.report-detail-chart:not(.js-chart-initialized)');
		var charOpts = {
			legend: 'none',
			width: 500,
			height: 500,
			pieHole: 0.5,
			pieStartAngle: 0,
			pieSliceText: 'none',
			tooltip: {
				isHtml: true
			},
			chartArea: {
				top: 0,
				left: 0,
				width: '100%',
				height: '100%'
			}
		};
		$charts.each(function () {
			var $chart = $(this);
			var $table = $($chart.attr('data-source-table'));
			//var tableData = [['Title', 'Value']];
			var tableData = [];
			var slicesData = {};

			var chartData = new google.visualization.DataTable();
			chartData.addColumn({id: 'title', label: 'Title', type: 'string'});
			chartData.addColumn({id: 'value', label: 'Value', type: 'number'});
			chartData.addColumn({id: 'tooltip', label: 'Tooltip', type: 'string', role: 'tooltip', p: {'html': true}});

			if ($table.length > 0) {
				$table.find('tbody tr').each(function () {
					var $cRow = $(this);

					slicesData[tableData.length] = {
						color: $cRow.find('[data-color]').attr('data-color')
					};

					var title = $cRow.find('[data-label]').attr('data-label') || false;
					var value = parseFloat($cRow.find('[data-value]').attr('data-value')) || 0;
					tableData[tableData.length] = [title, value, title];
				});
				chartData.addRows(tableData);

				charOpts['slices'] = slicesData;

				var chart = new google.visualization.PieChart($chart[0]);
				google.visualization.events.addListener(chart, 'ready', function () {
					$chart.find('svg')[0].setAttribute('viewBox', '0 0 500 500');
				});
				chart.draw(chartData, charOpts);

				$charts.addClass('js-chart-initialized');
			}
		});

	}

	var chartCursorCoordX = -1, chartCursorCoordY = -1;
	$(document).on('mouseenter.chartTooltip', '.report-detail-chart g path', function (e) {
		chartCursorCoordX = e.pageX;
		chartCursorCoordY = e.pageY;
	});
	$(document).on('mouseleave.chartTooltip', '.report-detail-chart g path', function (e) {
		chartCursorCoordX = -1;
		chartCursorCoordY = -1;
	});
	$(document).on('DOMNodeInserted.chartTooltip', function (e) {
		var $t = $(e.target);
		var $container = $t.closest('.report-detail-chart');
		if ($t.is(".google-visualization-tooltip") && $container.length > 0) {
			$t.css({visibility: 'hidden'});
			var containerRect = $container.offset();
			var cLeft = chartCursorCoordX - containerRect.left;
			if (chartCursorCoordX + $t.outerWidth() > $(window).width()) {
				cLeft -= $t.outerWidth();
				$t.addClass('left')
			}
			var cTop = chartCursorCoordY - containerRect.top - $t.outerHeight();
			if (chartCursorCoordY - $t.outerHeight() < $(window).scrollTop()) {
				cTop += $t.outerHeight();
				$t.addClass('bottom')
			}
			setTimeout(function () {
				$t.css({
					left: cLeft,
					top: cTop,
					visibility: 'visible'
				})
			}, 10)

		}
	});
}

// SITE ACCORDEON
$(document).on('click', '.site-accordeon__item-head', function(e) {
	e.preventDefault();
	var $block = $(this).closest('.site-accordeon__item');
	if ($block.is('.active')) Deactivate($block);
	else Activate($block);
});

// NAV TABS
$(document).on('click', '[data-tab]', function(evt) {
	evt.preventDefault();
	var $toggler = $(this);
	var tabId = $toggler.attr('data-tab');
	if ($(tabId).length > 0) ShowTab(tabId);
});
function ShowTab(tabId) {
	var $tab = $(tabId);

	$tab.closest('.tab-container').find('.tab-pane.active').removeClass('active').trigger('tab.hide');
	$tab.addClass('active').trigger('tab.show');
	LoadBackgroundsLazy();
	LoadImagesLazy();

	var $links = $('[data-tab="' +  tabId + '"]');
	$links.each(function() {
		var $link = $(this);
		var $parentList = $link.closest('ul');
		if ($parentList.length > 0) $parentList.find('[data-tab].active').removeClass('active').trigger('tab.deactivate');
		$link.addClass('active').trigger('tab.activate');
	});
}

// NAV TABS SCROLLING
$(InitNavTabsScrolling);
$(document).on("reload", InitNavTabsScrolling);
$(window).on("load resize resizeend", InitNavTabsScrolling);
function InitNavTabsScrolling() {
	var $sliders = $('.nav-tabs-container');
	if ($sliders.length > 0) {
		$sliders.find('li').addClass('nav-tabs__item');
		$sliders.each(function () {
			var $swiperBlock = $(this);
			var swiperOpts = {
				init: true,
				loop: false,
				speed: 300,
				navigation: false,
				initialSlide: 0,
				slidesPerView: 'auto',
				slidesPerGroup: 1,
				spaceBetween: 60,
				pagination: false,
				wrapperClass: 'nav-tabs',
				slideClass: 'nav-tabs__item',
				breakpoints: {
					1599: {
						spaceBetween: 36,
					},
					1279: {
						spaceBetween: 40,
					},
					767: {
						spaceBetween: 40,
					}
				},
			};

			if ($swiperBlock.is('.js-swiper-initialized')) {
				$swiperBlock.data('swiper').update();
			}
			else {
				var sw = new Swiper($swiperBlock, swiperOpts);
				$swiperBlock.addClass('js-swiper-initialized').data('swiper', sw);
			}
		});
	}
}

// NAV TABS UNDERLINE
$(InitNavTabsUnderline);
function InitNavTabsUnderline() {
	$('ul.nav-tabs a').append('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-tab-underline"><use xlink:href="#tab-underline"></use></svg>');
}

// PROJECT DETAIL HIDDEN NAV
$(function () {
	var $pdhn = $('#projects-detail-hidden-nav');
	var $pdm = $('#projects-detail-main');
	if ($pdhn.length > 0 && $pdm.length > 0) {
		CheckProjectPageNavVisibility();
		$(window).on('load scroll resize resizeend', CheckProjectPageNavVisibility);
	}
	function CheckProjectPageNavVisibility() {
		if ($(window).scrollTop() >= ($pdm.offset().top + $pdm.innerHeight())) $pdhn.addClass('visible');
		else $pdhn.removeClass('visible')
	}
});

// PROJECT DETAIL GALLERY
$(InitProjectDetailGallery);
$(document).on("reload", InitProjectDetailGallery);
function InitProjectDetailGallery() {
	var $sliders = $('.projects-detail-gallery-slider:not(.js-swiper-initialized)');
	if ($sliders.length > 0) {
		$sliders.each(function () {
			var $swiperBlock = $(this);
			var swiperOpts = {
				init: false,
				loop: false,
				speed: 300,
				navigation: {
					prevEl: $swiperBlock.find('.swiper-button.prev'),
					nextEl: $swiperBlock.find('.swiper-button.next')
				},
				initialSlide: 0,
				//slidesPerView: 'auto',
				slidesPerView: 2,
				slidesPerGroup: 1,
				spaceBetween: 40,
				pagination: false,
				autoHeight: false,
				breakpoints: {
					1599: {
						spaceBetween: 30,
					},
					767: {
						slidesPerView: 1,
						spaceBetween: 16,
					}
				}
			};

			var sw = new Swiper($swiperBlock.find('.swiper-container'), swiperOpts);

			sw.on('init', pdgParallax);
			sw.on('slideChange', pdgParallax);
			sw.init();

			$swiperBlock.addClass('js-swiper-initialized').data('swiper', sw);
			var updateAfterLoad = setInterval(function () {
				if ($swiperBlock.find('img[src*="loader.svg"]').length < 1) {
					sw.update();
					clearInterval(updateAfterLoad);
				}
			}, 3000);

			function pdgParallax() {
				var activeIndex = sw.realIndex;

				if (activeIndex > 0) {
					$swiperBlock.find('.swiper-slide').eq(activeIndex - 1).find('img').css({
						'-webkit-transform': 'translate(50%, 0)',
						'transform': 'translate(50%, 0)',
					});
				}

				$swiperBlock.find('.swiper-slide').eq(activeIndex).find('img').css({
					'-webkit-transform': 'translate(25%, 0)',
					'transform': 'translate(25%, 0)'
				});

				if (activeIndex < $swiperBlock.find('.swiper-slide').length - 1) {
					$swiperBlock.find('.swiper-slide').eq(activeIndex + 1).find('img').css({
						'-webkit-transform': 'translate(0%, 0)',
						'transform': 'translate(0%, 0)'
					});
				}
			}
		});
	}
}
// PROJECTS DETAIL GALLERY PARALLAX
function PDGalleryParallax() {
	// var $pdgi = $('.projects-detail-gallery-item');
	// if ($pdgi.length > 0 && $('.projects-detail-gallery-item__parallax-image').length === 0) {
	// 	$pdgi.each(function () {
	// 		var $cItem = $(this);
	// 		var imgSrc = $cItem.find('img').attr('data-src');
	// 		$cItem.append('<img src="' + imgSrc + '" class="projects-detail-gallery-item__parallax-image" />')
	// 	});
	// }
}

// PROJECT DETAIL NEWS
$(InitProjectDetailNews);
$(document).on("reload", InitProjectDetailNews);
$(window).on("load resize resizeend", InitProjectDetailNews);
function InitProjectDetailNews() {
	var $sliders = $('.projects-detail-news-slider');
	if ($sliders.length > 0) {
		$sliders.each(function () {
			var $swiperBlock = $(this);
			var swiperOpts = {
				init: true,
				loop: false,
				speed: 300,
				navigation: {
					prevEl: $swiperBlock.find('.swiper-button.prev'),
					nextEl: $swiperBlock.find('.swiper-button.next')
				},
				initialSlide: 0,
				slidesPerView: 3,
				slidesPerGroup: 1,
				spaceBetween: 40,
				pagination: false,
				breakpoints: {
					1599: {
						spaceBetween: 30,
					},
					1279: {
						slidesPerView: 2,
						spaceBetween: 30,
					},
					767: {
						slidesPerView: 'auto',
						spaceBetween: 16,
					}
				},
			};

			if (window.matchMedia('(min-width: 1280px)').matches) {
				if ($swiperBlock.is('.js-swiper-initialized')) {
					$swiperBlock.removeClass('js-swiper-initialized').data('swiper').destroy();
				}
			}
			else {
				if ($swiperBlock.is('.js-swiper-initialized')) {
					$swiperBlock.data('swiper').update();
				}
				else {
					var sw = new Swiper($swiperBlock.find('.swiper-container'), swiperOpts);
					$swiperBlock.addClass('js-swiper-initialized').data('swiper', sw);
				}
			}
		});
	}
}
function CheckNavAbility($swiperBlock) {
	var $nav = $swiperBlock.find('.swiper-nav');
	if ($swiperBlock.find('.swiper-button:not(.swiper-button-disabled)').length < 1) {
		$nav.addClass('swiper-nav-disabled');
	}
	else $nav.removeClass('swiper-nav-disabled');
}

// PROJECT DETAIL TEAM SLIDER
$(InitProjectDetailTeamSlider);
$(document).on("reload", InitProjectDetailTeamSlider);
function InitProjectDetailTeamSlider() {
	var $sliders = $('.projects-detail-team-slider:not(.js-swiper-initialized)');
	if ($sliders.length > 0) {
		$sliders.each(function () {
			var $swiperBlock = $(this);
			var swiperOpts = {
				init: true,
				loop: false,
				speed: 300,
				navigation: {
					prevEl: $swiperBlock.find('.swiper-button.prev'),
					nextEl: $swiperBlock.find('.swiper-button.next')
				},
				initialSlide: 0,
				slidesPerView: 4,
				slidesPerGroup: 1,
				spaceBetween: 40,
				pagination: false,
				breakpoints: {
					1599: {
						spaceBetween: 30,
					},
					1279: {
						slidesPerView: 3,
						spaceBetween: 30,
					},
					767: {
						slidesPerView: 'auto',
						spaceBetween: 16,
					}
				},
			};

			var sw = new Swiper($swiperBlock.find('.swiper-container'), swiperOpts);

			CheckNavAbility($swiperBlock);
			sw.on('resize', function () {
				CheckNavAbility($swiperBlock);
			});

			$swiperBlock.addClass('js-swiper-initialized').data('swiper', sw);
		});
	}
}

// HEADER
$(CheckIfHeaderScrolled);
$(document).on("reload", CheckIfHeaderScrolled);
$(window).on("scroll load resize resizeend", CheckIfHeaderScrolled);
function CheckIfHeaderScrolled() {
	var $h = $('#header');
	var $b = $('body');
	if ($(window).scrollTop() >= $h.innerHeight()) $b.addClass('header-scrolled');
	else $b.removeClass('header-scrolled')
}

// DATEPICKER
if (!!$.fn.datepicker) {

	// LOCALS
	$.fn.datepicker.language['en'] = {
		days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
		daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
		daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
		months: ['January','February','March','April','May','June', 'July','August','September','October','November','December'],
		monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
		today: 'Today',
		clear: 'Clear',
		dateFormat: 'mm/dd/yyyy',
		timeFormat: 'hh:ii aa',
		firstDay: 0
	};
	$.fn.datepicker.language['ru'] =  {
		days: ['Воскресенье','Понедельник','Вторник','Среда','Четверг','Пятница','Суббота'],
		daysShort: ['Вос','Пон','Вто','Сре','Чет','Пят','Суб'],
		daysMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
		months: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
		monthsShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
		today: 'Сегодня',
		clear: 'Очистить',
		dateFormat: 'dd.mm.yyyy',
		timeFormat: 'hh:ii',
		firstDay: 1
	};

	// INPUTS WITH DATES
	InitDatepicker();
	$(document).on("reload", InitDatepicker);
	function InitDatepicker() {
		var $inputsDates = $(".js-datepicker:not(.js-datepicker-initialized)");
		var dplanguage = $('html').attr('lang') || 'ru';
		if($inputsDates.length > 0) {
			$inputsDates.each(function() {
				var $this = $(this);
				$this.datepicker({
					offset: 0,
					language: dplanguage,
					position: "bottom left",
					range: $this.attr('data-range') || false,
					//minDate: Date(Date.parse($this.val()))
				});
				$this.addClass('js-datepicker-initialized');
				//$this.data('datepicker').selectDate(new Date(Date.parse($this.val())));
			});
		}
	}

}

// NEWS DETAIL GALLERY
$(InitNewsDetailMainSlider);
$(document).on("reload", InitNewsDetailMainSlider);
function InitNewsDetailMainSlider() {
	var $sliders = $('.news-detail-gallery__main-slider:not(.js-swiper-initialized)');
	if ($sliders.length > 0) {
		$sliders.each(function () {
			var $swiperBlock = $(this);
			var swiperOpts = {
				init: false,
				loop: false,
				speed: 300,
				navigation: {
					prevEl: $swiperBlock.find('.swiper-button.prev'),
					nextEl: $swiperBlock.find('.swiper-button.next')
				},
				initialSlide: 0,
				slidesPerView: 1,
				slidesPerGroup: 1,
				spaceBetween: 0,
				pagination: false,
				effect: "fade",
				fadeEffect: {
					crossFade: true
				}
			};
			var mainSW = new Swiper($swiperBlock.find('.swiper-container'), swiperOpts);
			mainSW.on('init', activateNavSlide);
			mainSW.on('slideChange', activateNavSlide);
			mainSW.init();
			$swiperBlock.addClass('js-swiper-initialized').data('swiper', mainSW);

			function activateNavSlide() {
				var $navSlider = $swiperBlock.siblings('.news-detail-gallery__nav-slider');
				var navSW = ($navSlider.length > 0) ? ($navSlider.data('swiper') || false) : false;
				if (navSW) navSW.slideTo(mainSW.realIndex);
			}
		});
	}
}

$(InitNewsDetailNavSlider);
$(document).on("reload", InitNewsDetailNavSlider);
function InitNewsDetailNavSlider() {
	var $sliders = $('.news-detail-gallery__nav-slider:not(.js-swiper-initialized)');
	if ($sliders.length > 0) {
		$sliders.each(function () {
			var $swiperBlock = $(this);
			var swiperOpts = {
				init: true,
				loop: false,
				speed: 300,
				navigation: false,
				initialSlide: 0,
				slidesPerView: 4,
				slidesPerGroup: 1,
				spaceBetween: 20,
				pagination: {
					el: $swiperBlock.find('.swiper-pagination'),
					clickable: true,
					type: 'bullets'
				},
				breakpoints: {
					1599: {
						slidesPerView: 4,
						spaceBetween: 20,
					},
					1279: {
						slidesPerView: 4,
						spaceBetween: 20,
					},
					1023: {
						slidesPerView: 3,
						spaceBetween: 20,
					},
					767: {
						slidesPerView: 'auto',
						spaceBetween: 10,
					}
				}
			};
			var navSW = new Swiper($swiperBlock.find('.swiper-container'), swiperOpts);
			$swiperBlock.addClass('js-swiper-initialized').data('swiper', navSW);
			$swiperBlock.find('.news-detail-gallery__nav-slider__item').on('click', function (e) {
				var $this = $(this);
				var $mainSlider = $swiperBlock.siblings('.news-detail-gallery__main-slider');
				var mainSW = ($mainSlider.length > 0) ? ($mainSlider.data('swiper') || false) : false;
				if (mainSW) mainSW.slideTo($this.closest('.swiper-slide').index());
			});
		});
	}
}

// NEWS SLIDER
$(InitNewsSlider);
$(document).on("reload", InitNewsSlider);
function InitNewsSlider() {
	var $sliders = $('.news-slider:not(.js-swiper-initialized)');
	if ($sliders.length > 0) {
		$sliders.each(function () {
			var $swiperBlock = $(this);
			var swiperOpts = {
				init: true,
				loop: false,
				speed: 300,
				navigation: {
					prevEl: $swiperBlock.find('.swiper-button.prev'),
					nextEl: $swiperBlock.find('.swiper-button.next')
				},
				initialSlide: 0,
				slidesPerView: 3,
				slidesPerGroup: 1,
				spaceBetween: 40,
				pagination: false,
				breakpoints: {
					1599: {
						spaceBetween: 30,
					},
					1279: {
						slidesPerView: 2,
						spaceBetween: 30,
					},
					767: {
						slidesPerView: 'auto',
						spaceBetween: 16,
					}
				},
			};
			var sw = new Swiper($swiperBlock.find('.swiper-container'), swiperOpts);
			$swiperBlock.addClass('js-swiper-initialized').data('swiper', sw);
		});
	}
}

// NEWS DETAIL SHARE
$(function () {
	var $nds = $('#news-detail-share');
	var $p = $('.news-detail-content');
	if ($nds.length > 0 && $p.length > 0) {
		FixNewsDetailShare();
		$(window).on('load scroll resize resizeend', FixNewsDetailShare);
	}
	function FixNewsDetailShare() {
		if ($(window).scrollTop() < $p.offset().top) {
			$nds.removeClass('fixed').css({
				position: 'absolute',
				top: 0,
				right: 0
			});
		}
		else if ($(window).scrollTop() > ($p.offset().top + $p.innerHeight() - $nds.innerHeight())) {
			var t = $p.innerHeight() - $nds.innerHeight();
			$nds.removeClass('fixed').css({
				position: 'absolute',
				top: t,
				right: 0
			});
		}
		else {
			var r = $(window).innerWidth() - ($nds.offset().left + $nds.innerWidth());
			$nds.addClass('fixed').css({
				position: 'fixed',
				top: 0,
				right: r
			});
		}
	}
});

// NEWS DETAIL NAV
$(function () {
	var $target = $('#news-detail-hidden-nav');
	var $original = $('#news-detail-share');
	if ($target.length > 0 && $original.length > 0) {
		CheckNewsPageNavVisibility();
		$(window).on('load scroll resize resizeend', CheckNewsPageNavVisibility);
	}
	function CheckNewsPageNavVisibility() {
		if ($(window).scrollTop() >= ($original.offset().top + $original.innerHeight())) $target.addClass('visible');
		else $target.removeClass('visible')
	}
});

// FOR PARENTS GALLERY
$(InitForParentsGallery);
$(document).on("reload", InitForParentsGallery);
function InitForParentsGallery() {
	var $sliders = $('.for-parents-gallery:not(.js-swiper-initialized)');
	if ($sliders.length > 0) {
		$sliders.each(function () {
			var $swiperBlock = $(this);
			var swiperOpts = {
				init: true,
				loop: false,
				speed: 300,
				navigation: {
					prevEl: $swiperBlock.find('.swiper-button.prev'),
					nextEl: $swiperBlock.find('.swiper-button.next')
				},
				initialSlide: 0,
				slidesPerView: 2,
				slidesPerGroup: 1,
				spaceBetween: 174,
				pagination: false,
				breakpoints: {
					1599: {
						spaceBetween: 134,
						slidesPerView: 2,
					},
					1279: {
						slidesPerView: 2,
						spaceBetween: 24,
					},
					767: {
						slidesPerView: 'auto',
						spaceBetween: 16,
					}
				}
			};
			var sw = new Swiper($swiperBlock.find('.swiper-container'), swiperOpts);
			$swiperBlock.addClass('js-swiper-initialized').data('swiper', sw);
		});
	}
}

// REVIEWS SLIDER
$(InitReviewsSlider);
$(document).on("reload", InitReviewsSlider);
function InitReviewsSlider() {
	var $sliders = $('.reviews-slider:not(.js-swiper-initialized)');
	if ($sliders.length > 0) {
		$sliders.each(function () {
			var $swiperBlock = $(this);
			var swiperOpts = {
				init: true,
				loop: false,
				speed: 300,
				navigation: {
					prevEl: $swiperBlock.find('.swiper-button.prev'),
					nextEl: $swiperBlock.find('.swiper-button.next')
				},
				initialSlide: 0,
				slidesPerView: 2,
				slidesPerGroup: 1,
				spaceBetween: 40,
				pagination: false,
				breakpoints: {
					1599: {
						spaceBetween: 30,
						slidesPerView: 2,
					},
					1279: {
						slidesPerView: 'auto',
						spaceBetween: 30,
					},
					767: {
						slidesPerView: 1,
						spaceBetween: 16,
					}
				},
			};
			var sw = new Swiper($swiperBlock.find('.swiper-container'), swiperOpts);
			$swiperBlock.addClass('js-swiper-initialized').data('swiper', sw);
		});
	}
}

// HISTORY SLIDER
$(InitHistorySlider);
$(document).on("reload", InitHistorySlider);
function InitHistorySlider() {
	var $sliders = $('.about-history-slider:not(.js-swiper-initialized)');
	if ($sliders.length > 0) {
		$sliders.each(function () {
			var $swiperBlock = $(this);
			var swiperOpts = {
				init: true,
				loop: true,
				speed: 300,
				navigation: {
					prevEl: $swiperBlock.find('.swiper-button.prev'),
					nextEl: $swiperBlock.find('.swiper-button.next')
				},
				initialSlide: 0,
				slidesPerView: 'auto',
				slidesPerGroup: 1,
				spaceBetween: 0,
				pagination: false,
				breakpoints: {
					767: {
						slidesPerView: 1,
						spaceBetween: 24
					}
				},
			};
			var sw = new Swiper($swiperBlock.find('.swiper-container'), swiperOpts);
			$swiperBlock.addClass('js-swiper-initialized').data('swiper', sw);
		});
	}
}

// REVIEWS ITEM
$(document).on('click', '.reviews-item__text-toggler a', function(e) {
	e.preventDefault();
	var $block = $(this).closest('.reviews-item');
	if ($block.is('.active')) Deactivate($block);
	else Activate($block);
});

// PARTNER SLOGOS
$(InitPartnersLogosTicker);
$(document).on("reload", InitPartnersLogosTicker);
$(window).on("scroll load resize resizeend", InitPartnersLogosTicker);
function InitPartnersLogosTicker() {
	var $sliders = $('.main-partners__logos-block');
	if ($sliders.length > 0) {
		$sliders.each(function () {
			var $swiperBlock = $(this);
			var swiperOpts = {
				init: true,
				loop: true,
				speed: 2000,
				navigation: false,
				initialSlide: 0,
				slidesPerView: 'auto',
				slidesPerGroup: 1,
				spaceBetween: 0,
				pagination: false,
				wrapperClass: 'row',
				slideClass: 'main-partners-logo-wrapper',
				autoplay: {
					delay: 0,
					disableOnInteraction: false
				}
			};

			if ($swiperBlock.is('.js-swiper-initialized')) {
				$swiperBlock.data('swiper').update();
			}
			else {
				var sw = new Swiper($swiperBlock, swiperOpts);
				$swiperBlock.addClass('js-swiper-initialized').data('swiper', sw);
			}
		});
	}
}

// TAGS SCROLLING
$(InitTagsSlider);
$(document).on("reload", InitTagsSlider);
$(window).on("load resize resizeend", InitTagsSlider);
function InitTagsSlider() {
	var $sliders = $('.tags-slider');
	if ($sliders.length > 0) {
		$sliders.each(function () {
			var $swiperBlock = $(this);
			var swiperOpts = {
				init: true,
				loop: false,
				speed: 300,
				navigation: false,
				initialSlide: 0,
				slidesPerView: 'auto',
				slidesPerGroup: 1,
				spaceBetween: 10,
				pagination: false,
				wrapperClass: 'buttons-line',
				slideClass: 'tag'
			};

			if ($swiperBlock.is('.js-swiper-initialized')) {
				$swiperBlock.data('swiper').update();
			}
			else {
				var sw = new Swiper($swiperBlock, swiperOpts);
				$swiperBlock.addClass('js-swiper-initialized').data('swiper', sw);
			}
		});
	}
}

// HELP ITEM. OTHER SUM
$(document).on('keyup', '.main-help-item .sum-line .form-control-sum', function () {
	var $input = $(this);
	var $container = $input.closest('.sum-line');
	var $selectedSum = $container.find('input[type="radio"]:checked');
	var $lastSelectedSum = ($selectedSum.length > 0) ? $selectedSum : $container.find('input[type="radio"][data-last-user-select]');

	if ($input.val().length > 0) {
		$input.addClass('filled');
		$lastSelectedSum[0].checked = false;
		$lastSelectedSum.attr('data-last-user-select', true);
	}
	else {
		$input.removeClass('filled');
		$lastSelectedSum[0].checked = true;
		$lastSelectedSum.removeAttr('data-last-user-select');
	}

	$input.closest('form').trigger('change');
});
$(document).on('click', '.main-help-item .sum-line .label-like-btn', function (evt) {
	evt.preventDefault();

	var $targetRadio = $('#' + $(this).attr('for'));
	var $container = $targetRadio.closest('.sum-line');
	var $input = $container.find('.form-control-sum');
	var $selectedSum = $container.find('input[type="radio"]:checked');
	var $lastSelectedSum = ($selectedSum.length > 0) ? $selectedSum : $container.find('input[type="radio"][data-last-user-select]');

	if ($input.is('.filled')) {
		$lastSelectedSum.removeAttr('data-last-user-select');
		$input.removeClass('filled').val('');
	}
	$lastSelectedSum[0].checked = false;
	$targetRadio[0].checked = true;
	$input.closest('form').trigger('change');
});

// PAGE NAV LINKS
/*$(document).on('runscroll', '.nav-tabs [data-scroll-to]', function () {
	var $this = $(this);
	var target = $this.attr('data-scroll-to');
	$this.closest('.nav-tabs').find('.active').removeClass('active');
	$this.addClass('active')
});*/
$(document).on('runscroll', '.hidden-page-nav-popup .nav-tabs [data-scroll-to]', function () {
	Deactivate($(this).closest('.hidden-page-nav-popup'));
});

// ANIMATE TEXT
$(InitTextAnimation);
$(document).on("reload", InitTextAnimation);
function InitTextAnimation() {
	var $textBlocks = $('[data-animate-to-text]:not(.js-text-animation-initialized)');
	if ($textBlocks.length > 0) {
		$textBlocks.each(function () {
			var $this = $(this);
			AnimateText($this);
			$this.addClass('js-text-animation-initialized')
		});
	}
}
function AnimateText($block) {
	setInterval(function () {
		var defaultText = $block.html();
		var newText = $block.attr('data-animate-to-text');
		$block.attr('data-animate-to-text', defaultText);
		CleanText($block, defaultText, 700);
		setTimeout(function () {
			PrintText($block, newText, 700);
		}, 700);
	}, 3000);

	function CleanText($container, text, time) {
		var timer = Math.floor(time / text.length);
		var _text = text;
		var clean = setInterval(function () {
			_text = text.substr(0,_text.length - 1);
			$container.html(_text);
			if (_text.length === 0) clearInterval(clean);
		}, timer);
	}
	function PrintText($container, text, time) {
		var timer = Math.floor(time / text.length);
		var _text = '';
		var print = setInterval(function () {
			_text = text.substr(0,_text.length + 1);
			$container.html(_text);
			if (_text.length === text.length) clearInterval(print);
		}, timer);
	}
}

// ANIMATE SVG
$(InitSvgAnimation);
$(document).on("reload", InitSvgAnimation);
$(window).on("load resize scroll", InitSvgAnimation);
function InitSvgAnimation() {
	var $arrAnimSvg = $('.animate-svg-image:not(.achieved)');
	if ($arrAnimSvg.length > 0) {
		$arrAnimSvg.each(function () {
			var $cSVG = $(this);
			if (ImageInViewport($cSVG)) $cSVG.addClass('achieved');
		});
	}
}
function ImageInViewport($img) {
	var bH = $img.height();
	var bT = $img.offset().top;
	var wH = $(window).height();
	var wT = $(window).scrollTop();
	return (((bT + bH) < (wT + wH)));
}

// PROJECTS DETAIL DONATE FORM BIRD
$(SetPDBirdPosition);
$(document).on("reload", SetPDBirdPosition);
function SetPDBirdPosition() {
	var $bird = $(".projects-detail-help-decor__bird");
	var $home = $(".projects-detail-help-decor__home");
	var $form = $bird.closest('form');

	var achievedMax = false;

	if (!achievedMax) calcBirdPosition();
	if ($bird.length > 0 && $home.length > 0 && $form.length > 0) {
		if (!$form.is('.js-decor-initialized')) {
			$form.on('change', function () {
				if (!achievedMax) calcBirdPosition();
			});
			$form.addClass('js-decor-initialized');
		}
	}

	function calcBirdPosition() {
		var vLength = $form.find('.sum-line input[type="radio"]').length - 1;
		var $cvItem = $form.find('.sum-line input[type="radio"]:checked').length > 0 ? $form.find('.sum-line input[type="radio"]:checked') : $form.find('.sum-line input[type="radio"][data-last-user-select]');
		var cvIndex = $cvItem.index('.sum-line input[type="radio"]');

		if (vLength === cvIndex) achievedMax = true;

		var t = -20 * cvIndex / vLength;
		var l = 576 * cvIndex / vLength;
		$bird.css({
			'-webkit-transform': 'translate(' + l + 'px,' + t + 'px)',
			'transform': 'translate(' + l + 'px,' + t + 'px)',
		});
	}
}

// PROJECTS DETAIL HEAD BIRD PARALLAX
$(PDHBirdParallax);
$(document).on("reload", PDHBirdParallax);
$(window).on("load resize scroll", PDHBirdParallax);
function PDHBirdParallax() {
	var $pdmp = $('.projects-detail-main__pattern');
	if ($pdmp.length > 0) {
		$pdmp.each(function () {
			var $t = $(this);
			var $c = $t.closest('.section__image');
			var $w = $(window);
			var $h = $('#header');

			var vT = 0;
			var vB = $c.offset().top + $c.innerHeight();

			var wT = $w.scrollTop();

			var s = 0;
			var e = $c.innerHeight() - $t.innerHeight() - s;
			var t = e - ((e - s) * (wT / (vB - vT - $h.innerHeight())) * 1.25);
			t = Math.min(e, Math.max(s, t));

			$t.css({
				'-webkit-transform': 'translate(0,' + t + 'px)',
				'transform': 'translate(0,' + t + 'px)',
			})
		});
	}
}

// PROJECTS DETAIL HEAD IMAGE PARALLAX
$(PDHImageParallax);
$(document).on("reload", PDHImageParallax);
$(window).on("load resize scroll", PDHImageParallax);
function PDHImageParallax() {
	var $arrBlocks = $('.projects-detail-main__image');
	if ($arrBlocks.length > 0) {
		$arrBlocks.each(function () {
			var $c = $(this);
			var $t = $c.find('img');
			var $w = $(window);
			var $h = $('#header');

			var vT = 0;
			var vB = $c.offset().top + $c.innerHeight();

			var wT = $w.scrollTop();

			var s = $c.innerHeight() - $t.innerHeight();
			var e = 0;
			var t = (s - e) * (wT / (vB - vT - $h.innerHeight())) * 0.8;
			t = Math.min(e, Math.max(s, t));

			$t.css({
				'-webkit-transform': 'translate(0,' + t + 'px)',
				'transform': 'translate(0,' + t + 'px)',
			})
		});
	}
}

// TARGET HELP HEAD PATTERN PARALLAX
$(THHPatternParallax);
$(document).on("reload", THHPatternParallax);
$(window).on("load resize scroll", THHPatternParallax);
function THHPatternParallax() {
	var $pdmp = $('.target-help-page .page-head .section__pattern');
	if ($pdmp.length > 0) {
		$pdmp.each(function () {
			var $t = $(this);
			var $c = $t.closest('.section__image-block');
			var $w = $(window);
			var $h = $('#header');

			var vT = 0;
			var vB = $c.offset().top + $c.innerHeight();

			var wT = $w.scrollTop();

			var s = 0;
			var e = $c.innerHeight() - $t.innerHeight() - s;
			var t = e - ((e - s) * (wT / (vB - vT - $h.innerHeight())) * 1.25);
			t = Math.min(e, Math.max(s, t));

			$t.css({
				'-webkit-transform': 'translate(0,' + t + 'px)',
				'transform': 'translate(0,' + t + 'px)',
			})
		});
	}
}

// TARGET HELP HEAD IMAGE PARALLAX
$(THHImageParallax);
$(document).on("reload", THHImageParallax);
$(window).on("load resize scroll", THHImageParallax);
function THHImageParallax() {
	var $arrBlocks = $('.target-help-page .page-head .section__image');
	if ($arrBlocks.length > 0) {
		$arrBlocks.each(function () {
			var $c = $(this);
			var $t = $c.find('img');
			var $w = $(window);
			var $h = $('#header');

			var vT = 0;
			var vB = $c.offset().top + $c.innerHeight();

			var wT = $w.scrollTop();

			var s = $c.innerHeight() - $t.innerHeight();
			var e = 0;
			var t = (s - e) * (wT / (vB - vT - $h.innerHeight())) * 0.8;
			t = Math.min(e, Math.max(s, t));

			$t.css({
				'-webkit-transform': 'translate(0,' + t + 'px)',
				'transform': 'translate(0,' + t + 'px)',
			})
		});
	}
}

// BECOME PARTNER HEAD PATTERN PARALLAX
$(BPHPatternParallax);
$(document).on("reload", BPHPatternParallax);
$(window).on("load resize scroll", BPHPatternParallax);
function BPHPatternParallax() {
	var $pdmp = $('.become-partner-first__pattern');
	if ($pdmp.length > 0) {
		$pdmp.each(function () {
			var $t = $(this);
			var $c = $t.closest('.section__inner');
			var $w = $(window);
			var $h = $('#header');

			var vT = 0;
			var vB = $c.offset().top + $c.innerHeight();

			var wT = $w.scrollTop();

			var s = -$c.innerHeight();
			var e = 0;
			var t = e - ((e - s) * (wT / (vB - vT - $h.innerHeight())) * 1.25);
			t = Math.min(e, Math.max(s, t));

			$t.css({
				'-webkit-transform': 'translate(0,' + t + 'px)',
				'transform': 'translate(0,' + t + 'px)',
			})
		});
	}
}

// BECOME PARTNER HEAD IMAGE PARALLAX
$(VGImageParallax);
$(document).on("reload", VGImageParallax);
$(window).on("load resize scroll", VGImageParallax);
function VGImageParallax() {
	var $arrBlocks = $('.volunteerism-gallery-item');
	if ($arrBlocks.length > 0) {
		$arrBlocks.each(function () {
			var $c = $(this);
			if ($c.find('.image-parallax').length < 1) {
				$c.append('<img src="' + $c.find('img').attr('data-src') + '" class="image-parallax"/>');
			}
			var $t = $c.find('.image-parallax');
			var $w = $(window);
			var $h = $('#header');

			var vT = $c.offset().top;
			var vB = vT + $c.innerHeight();

			var wT = $w.scrollTop();
			var wB = wT + $w.innerHeight();

			var s = - $t.innerHeight()/2;
			var e = 0;
			var t = (s - e) / (((wT + $h.innerHeight() - vB) - (wB - vT)) / (wT + $h.innerHeight() - vB));
			t = Math.min(e, Math.max(s, t));

			$t.css({
				'-webkit-transform': 'translate(0,' + t + 'px)',
				'transform': 'translate(0,' + t + 'px)',
			})
		});
	}
}

// PROJECTS DETAIL HEAD BIRD PARALLAX
$(VGBirdParallax);
$(document).on("reload", VGBirdParallax);
$(window).on("load resize scroll", VGBirdParallax);
function VGBirdParallax() {
	var $pdmp = $('.volunteerism-gallery__pattern');
	if ($pdmp.length > 0) {
		$pdmp.each(function () {
			var $t = $(this);
			var $c = $t.closest('.volunteerism-gallery');
			var $w = $(window);
			var $h = $('#header');

			var vT = $c.offset().top;
			var vB = vT + $c.innerHeight();

			var wT = $w.scrollTop();
			var wB = wT + $w.innerHeight();

			var s = 0;
			var e = $c.innerHeight() - $t.innerHeight();
			var t = (e - s) / (((wT + $h.innerHeight() - vB) - (wB - vT)) / (wT + $h.innerHeight() - vB));
			t = Math.min(e, Math.max(s, t));

			$t.css({
				'-webkit-transform': 'translate(0,' + t + 'px)',
				'transform': 'translate(0,' + t + 'px)',
			})
		});
	}
}

/*// NEWS FILTER
$(CheckNewsFilterBottomVisibility);
$(document).on("reload", CheckNewsFilterBottomVisibility);
$(document).on("change customchange blur", '#news-filter', CheckNewsFilterBottomVisibility);
function CheckNewsFilterBottomVisibility() {
	var $nf = $('#news-filter');
	var nfvisibility = false;
	
	if ($nf.find('option:not(.placeholder-option):selected').length > 0) nfvisibility = true;
	$nf.find('input[type="text"]').each(function () {
		if ($(this).val().length > 0) nfvisibility = true;
	});
	
	$('.news-filter__bottom').css({display: (nfvisibility ? 'block' : 'none')});
}

// NEWS FILTER RESET
$(document).on('click', '.news-filter__btn-reset', function (e) {
	e.preventDefault();
	var $nf = $('#news-filter');
	
	$nf.find('input[type="text"]').each(function () {
		$(this).val('').trigger('change');
	});
	$nf.find('select').each(function () {
		var $s = $(this);
		if ($s.is('[multiple]')) {
			$s.find('option').each(function () {
				this.selected = false;
			});
		}
		else $s[0].selectedIndex = -1;
		var $po = $s.find('.placeholder-option');
		if ($po.length > 0) $po[0].selected = true;
		$s.trigger('customchange');
		$('#news-filter').trigger('customchange');
	});
});

// NEWS FILTER CHIPS
$(document).on("change customchange", '#news-filter select', UpdateNewsFilterChips);
$(document).on("change blur", '#news-filter input[type="text"]', UpdateNewsFilterChips);
function UpdateNewsFilterChips() {
	$('.news-filter-chips').remove();
	var $chipsContainer = $('.news-filter__bottom .buttons-line');
	
	$('#news-filter option').each(function () {
		var $o = $(this);
		if (!$o.is('.placeholder-option') && $o.is(':selected')) {
			$chipsContainer.append(RenderNewsFilterChip($o.html(), $o.attr('id')));
		}
	})
	
	$('#news-filter input[type="text"]').each(function () {
		var $i = $(this);
		if ($i.val().length > 0) {
			$chipsContainer.append(RenderNewsFilterChip($i.val(), $i.attr('id')));
		}
	})
}
function RenderNewsFilterChip(text, originalId) {
	return '<div class="btn news-filter-chips" data-original="#' + originalId + '">' +
		text +
		'<button type="button" class="news-filter-chips__remove">' +
			'<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-close">' +
				'<use xlink:href="#close"></use>' +
			'</svg>' +
		'</button>' +
	'</div>';
}

// NEWS FILTER CHIPS REMOVE
$(document).on('click', '.news-filter-chips__remove', function (e) {
	e.preventDefault();
	var $target = $($(this).closest('.news-filter-chips').attr('data-original'));
	
	if ($target.is('option')) {
		var $s = $target.closest('select');
		if ($s.is('[multiple]')) $target[0].selected = false;
		else $s[0].selectedIndex = -1;
		var $po = $s.find('.placeholder-option');
		if ($po.length > 0) $po[0].selected = true;
		$s.trigger('customchange');
		$('#news-filter').trigger('customchange');
	}
	
	else if ($target.is('input[type="text"]')) {
		$target.val('').trigger('change');
	}
});*/
const html = document.documentElement;
const body = document.body;
const header = document.querySelector(".header");
const menu = document.querySelector(".menu");
const handlePreloader = () => {
	isElementLoaded(".preloader").then((selector) => {
		$("body").addClass("page-loaded");
		$(".preloader").delay(1000).fadeOut(0);
	});
};
/**
 * Он устанавливает пользовательскую переменную CSS в значение 1% от высоты окна просмотра.
 */
const setViewportProperty = (doc) => {
	const customViewportCorrectionVariable = "vh";
	let prevClientHeight;
	const customVar = "--" + (customViewportCorrectionVariable || "vh");

	const handleResize = () => {
		const clientHeight = doc.clientHeight;
		if (clientHeight === prevClientHeight) return;
		requestAnimationFrame(function updateViewportHeight() {
			doc.style.setProperty(customVar, `${clientHeight * 0.01}px`);
			prevClientHeight = clientHeight;
		});
	};

	handleResize();
	return handleResize;
};

setTimeout(function () {
	setViewportProperty(document.documentElement);
}, 500);
window.addEventListener("resize load", setViewportProperty(document.documentElement));

// Проверка браузера на поддержку .webp изображений ======================================================
const isWebp = () => {
	// Проверка поддержки webp
	const testWebp = (callback) => {
		const webP = new Image();

		webP.onload = webP.onerror = () => callback(webP.height === 2);
		webP.src = "data:image/webp;base64,UklGRjoAAABXRUJQVlA4IC4AAACyAgCdASoCAAIALmk0mk0iIiIiIgBoSygABc6WWgAA/veff/0PP8bA//LwYAAA";
	};
	// Добавление класса _webp или _no-webp для HTML
	testWebp((support) => {
		const className = support ? "webp" : "no-webp";
		html.classList.add(className);

		// MAMO(support ? "webp поддерживается" : "webp не поддерживается");
	});
};

/* Проверка мобильного браузера */
const isMobile = {
	Android: () => navigator.userAgent.match(/Android/i),
	BlackBerry: () => navigator.userAgent.match(/BlackBerry/i),
	iOS: () => navigator.userAgent.match(/iPhone|iPad|iPod/i),
	Opera: () => navigator.userAgent.match(/Opera Mini/i),
	Windows: () => navigator.userAgent.match(/IEMobile/i),
	any: () => isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows(),
};

// Скрываем меню при ресайзе
/**
 * Функция настраивает макет меню в зависимости от ширины окна, перемещая элементы в список мобильных меню, если это
 * необходимо, и скрывая элементы, которые превышают максимальную ширину меню.
 * @returns В этом коде ничего не возвращается. Это функция, которая выполняет некоторые действия в зависимости от ширины
 * окна и элементов меню заголовка.
 */
const responseMenu = () => {
	const windowWidth = $(window).width();
	const items = $(".rs__header .rs__menu--item");
	const mobileMenuList = $(".rs__header .rs__mobile--menu-list");
	const menu = $(".rs__header .rs__menu");
	const menuBurger = $(".rs__menu--burger");
	$(".rs__menu--item-sub").removeClass('is-active')

	if (windowWidth < 1024) {
		items.appendTo(mobileMenuList);
		menuBurger.show();
	} else {
		mobileMenuList.find(".rs__menu--item").appendTo(menu);

		const maxMenuWidth = menu.outerWidth(true);
		let menuWidth = 0;
		let hideFromIndex = 0;

		items.each(function (index) {
			const menuItem = $(this);
			const menuItemWidth = menuItem.outerWidth(true);

			if (menuWidth + menuItemWidth > maxMenuWidth) {
				return false;
			} else {
				hideFromIndex = index;
				menuWidth += menuItemWidth;
			}
		});

		if (hideFromIndex < items.length - 1) {
			items.slice(hideFromIndex + 1).appendTo(mobileMenuList);
			items.slice(0, hideFromIndex + 1).each(function () {
				const menuItem = $(this).find(".rs__menu--link");
				const menuItemWidth = menuItem.outerWidth(true);
			});
			menuBurger.show();
		} else {
			menuBurger.hide();
		}
	}
};
const scrollFunction = () => {
	isElementLoaded(".progress").then((selector) => {
		let elementScroll = document.body.scrollTop || document.documentElement.scrollTop;
		let windowHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
		let scrollPos = (elementScroll / windowHeight) * 100;
		document.getElementById("progBar").style.width = scrollPos + "%";
	});
};

const modalCustom = (title, text, type) => {
	let modalForm = `<div class="rs__form--send">
                  <div class="rs__form rs__form--${type}">
                      <div class="rs__form--title">${title}</div>
                      <div class="rs__form--text">${text}</div>
                      <div class="rs__form--item rs__form--buttons">
                          <div class="rs__button__group rs__button__default--full">
                              <button class="rs__button__default modal__close">Закрыть</button>
                          </div>
                      </div>
                  </div>
                </div>`;
	$(modalForm).modal({
		cache: false,
		container: true,
	});
};
const stickyHeader = () => {
	const heightT = $(".rs__header").height();
	if ($(window).scrollTop() >= 100) {
		$(".header").addClass("rs__header--sticky");
		$("body").css("padding-top", heightT);
	} else {
		$(".header").removeClass("rs__header--sticky");
		$("body").css("padding-top", 0);
	}
};
handlePreloader();
$(window)
	.on("load", function () {
		scrollFunction();
		stickyHeader();
		isWebp();
		handlePreloader();
	})
	.on("scroll", function () {
		scrollFunction();
		stickyHeader();
	})
	.on("load resize resizeend", function () {
		responseMenu();
		if ($(".rs__menu--mobile-checkbox").prop("checked")) {
			$(".rs__menu--mobile-checkbox").prop("checked", false);
		}
	});

$(document)
	.on("click", ".js--search-trigger", function () {
		$(this).closest(".rs__header").addClass("is-search--active");
		if ($(".rs__menu--mobile-checkbox").prop("checked")) {
			$(".rs__menu--mobile-checkbox").prop("checked", false);
		}
	})
	.on("mouseup touchstart", function (e) {
		if (!$(".is-search--active").has(e.target).length > 0) {
			$(".rs__header").removeClass("is-search--active");
		}
	})
	.on("click", ".rs__menu--burger", function (e) {
		if ($(window).width() < 575) {
			e.preventDefault();
			$(".rs__menu--mobile-checkbox").prop("checked", false);
			const menuClone = $(".rs__mobile--menu").clone();
			$(menuClone).modal({
				cache: false,
				container: true,
				class: "rs__modal-menu",
				afterOpen: function () {
					$(".rs__modal-menu").closest(".rs__modal__row").addClass("rs__modal__row--top");
				},
			});
			return false;
		}
	})
	.on("mouseenter", ".rs__menu .rs__menu--item-sub", function (e) {
		if (!$(this).hasClass("is-hover")) {
			e.preventDefault();
			$(this).addClass("is-hover");
			return false;
		}
	})
	.on("mouseleave", ".rs__menu .rs__menu--item-sub", function (e) {
		if ($(this).hasClass("is-hover")) {
			$(this).removeClass("is-hover");
		}
	})
	.on("click touchend", ".rs__menu--item-sub", function (e) {
		$(".rs__mobile--menu-list .rs__menu--item-sub").removeClass("is-active");
		$(this).toggleClass("is-active");
	})
	.on("submit", "#feedbackForm", function (e) {
		e.preventDefault();
		const data = $(this).serializeArray();
		$.ajax({
			type: "POST",
			// url: "",
			data: data,
			dataType: "json",
			encode: true,
		})
			.done(function (data) {
				modalCustom("Мы получили ваш вопрос", "И свяжемся с вами в ближайшее время\n", "success");
			})
			.fail(function (data) {
				modalCustom("Мы получили ваш вопрос", "И свяжемся с вами в ближайшее время\n", "success");
				// modalCustom("Мы не получили ваш вопрос", "Что то пошло не так", "error");
			});
	})
	.on("submit", "#subscribe", function (e) {
		e.preventDefault();
		const data = $(this).serializeArray();
		$.ajax({
			type: "POST",
			// url: "",
			data: data,
			dataType: "json",
			encode: true,
		})
			.done(function (data) {
				modalCustom("Ваша заявка принята", "", "success");
			})
			.fail(function (data) {
				modalCustom("Ваша заявка принята", "", "success");
				// modalCustom("Мы не смогли получить вашу заявку", "Что то пошло не так", "error");
			});
	})
