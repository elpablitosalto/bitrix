function ajaxCall(data, url) {
    return $.ajax({
        url: url,
        type: "POST",
        data: data
    })
}

function pluralize(count, words) {
    var cases = [2, 0, 1, 1, 1, 2];
    return words[(count % 100 > 4 && count % 100 < 20) ? 2 : cases[Math.min(count % 10, 5)]];
}

function mapTooltipCreate($tooltip, data, opts) {
    $tooltip.find('.region-tooltip__header-title').html('<span class="region-tooltip__header-title--cnt">' + countOfOject(data.items) + '</span> ' + pluralize(countOfOject(data.items), ['дистрибьютор', 'дистрибьютора', 'дистрибьюторов']));
    $tooltip.find('.region-tooltip__header-region').text(data.regionName);
    var slides = '';
    $.each(data.items, function (index, value) {
        slides += '<div class="swiper-slide">';
        slides += '<div class="region-tooltip__content">';
        slides += '<span class="region-tooltip__content-store">' + value.name + '</span>';
        slides += '<a href="tel:' + value.phone + '" class="phone-link">' + value.phone + '</a>';
        slides += '<a href="mailto:' + value.email + '" class="email-link">' + value.email + '</a>';
        if (value.site && value.url) {
            slides += '<a href="' + value.url + '" class="_link-reverse" target="_blank">' + value.site + '</a>';
        }
        slides += '</div>';
        slides += '</div>';
    });
    $tooltip.find('.swiper-wrapper').html(slides);
    $tooltip.css(opts);
    $tooltip.appendTo('#map-distributors').addClass('_active');
    $tooltip.fadeIn(500);
    tooltipSliderInit();
}

function mapPosCorrection() {
    if (window.innerWidth > 992) {
        var blockW = $('#map-distributors').width();
        var blockH = $('#map-distributors').height();
        var svgW = $('#map-distributors svg#map-distributors-svg').width();
        var svgH = $('#map-distributors svg#map-distributors-svg').height();
        var posCorrectionX = (blockW - svgW) / 2;
        var posCorrectionY = (blockH - svgH) / 2;

        $('#map-distributors svg#map-distributors-svg').css({
            'transform': 'translate(' + posCorrectionX + 'px,' + posCorrectionY + 'px)'
        });
    }
}

function tooltipSliderInit() {
    var tooltipSlider = new Swiper('.region-tooltip-slider', {
        slidesPerView: 1,
        navigation: {
            nextEl: '.region-tooltip .swiper-button-next',
            prevEl: '.region-tooltip .swiper-button-prev',
        },
        on: {
            init: function (swiper) {
                $('.region-tooltip .swiper-pagination').find('.swiper-pagination-current').text(1);
                $('.region-tooltip .swiper-pagination').find('.swiper-pagination-total').text(swiper.slides.length);
            },
            slideChange: function (swiper) {
                $('.region-tooltip .swiper-pagination').find('.swiper-pagination-current').text(swiper.activeIndex + 1);
            },
        },
    });
}

function checkDistributorsRegions() {
    var url = '/local/ajax/distributors/map.php';
    var data = {
        'TYPE': 'distributors'
    };
    var request = ajaxCall(data, url);
    request.done(function (resp) {
        var response = JSON.parse(resp);
        $.each(response, function (index, value) {
            var region = $('.map-distributors__map-svg').find('#' + index)[0];
            if (region) {
                region.setAttribute('data-distributors', 'on');
                region.setAttribute('data-title', value.regionName);
            }
        });
        $('#map-distributors svg').find('[data-distributors]').each(function () {
            $(this).addClass('_isset');
        });

    });
}

function updateResults($container, query) {
    var $list = $container.find('.js-map-distributors-list'),
        $items = $container.find('.js-map-distributors-item:not([hidden])'),
        $itemTpl = $container.find('.js-map-distributors-item[hidden]'),
        $message = $container.find('.js-map-distributors-message');

    var url = '/local/ajax/distributors/map.php';
    var data = {
        'TYPE': 'namequery',
        'NAME': query
    };
    var request = ajaxCall(data, url);
    request.done(function (resp) {
        var response = JSON.parse(resp);
        if (response) {
            var keys = Object.keys(response);

            if (keys.length > 0) {
                if (keys.length !== $items.length) {
                    clearResults($container);

                    for (var i = 0; i < keys.length; i++) {
                        var $clone = $itemTpl.clone(),
                            $link = $clone.find('.js-map-distributors-result');

                        $clone.prop('hidden', false);
                        $link.attr('href', '#' + keys[i]);
                        $link.text(response[keys[i]]);

                        $list.prepend($clone);
                    }
                }
            } else {
                emptyResults($container);
            }
        } else {
            emptyResults($container);
        }
    });
}

function clearResults($container) {
    var $items = $container.find('.js-map-distributors-item:not([hidden])'),
        $message = $container.find('.js-map-distributors-message');

    $message.prop('hidden', true);
    $items.remove();
}

function emptyResults($container) {
    var $items = $container.find('.js-map-distributors-item:not([hidden])'),
        $message = $container.find('.js-map-distributors-message');

    $message.prop('hidden', false);
    if ($items.length > 0) {
        $items.remove();
    }
}

function showResults() {
    $('.js-map-distributors-results').show();
}

function hideResults() {
    $('.js-map-distributors-results').hide();
}

$(document).ready(function () {
    if ($('#map-distributors').length > 0) {
        checkDistributorsRegions();
        mapPosCorrection();
    }
    $(this).on('click', '.map-distributors__panel .map-distributors__map-svg [data-distributors]', function (e) {
        $('#map-distributors').find('[data-distributors]._active').removeClass('_active');

        let $elem = $(this);
        $elem.toggleClass('_active');

        let $activeTooltip = $('#map-distributors').find('.region-tooltip._active');
        if ($activeTooltip.length > 0)
            $activeTooltip.fadeOut(300).remove();

        let $tooltip = $('#map-distributors').find('.region-tooltip[data-default]').clone();
        if (window.innerWidth > 992)
            var opts = {
                'left': e.offsetX + 30,
                'top': e.offsetY + 30
            };
        else
            var opts = {
                'left': e.offsetX + 30,
                'top': e.offsetY - 150
            };

        var url = '/local/ajax/distributors/map.php';
        var data = {
            'TYPE': 'distributors',
            'CODE': $elem.attr('id').toUpperCase()
        };

        var request = ajaxCall(data, url);
        request.done(function (resp) {
            var response = JSON.parse(resp);
            mapTooltipCreate($tooltip, response, opts);
            $(this).toggleClass('_active').siblings().removeClass('_active');
        });
    });

    $(this).on('mouseenter', '.map-distributors__panel .map-distributors__map-svg [data-distributors]', function (e) {
        if ($(window).innerWidth() >= 992) {
            var $label = $('.js-map-distributors-region-lable');

            $label.text(this.dataset.title);
            $label.css({
                top: e.offsetY - 10,
                left: e.offsetX + 40
            });
            $label.show();
        }
    });

    $(this).on('mousemove', '.map-distributors__panel .map-distributors__map-svg [data-distributors]', function (e) {
        if ($(window).innerWidth() >= 992) {
            var $label = $('.js-map-distributors-region-lable');

            $label.css({
                top: e.offsetY - 10,
                left: e.offsetX + 40
            });
        }
    });

    $(this).on('mouseleave', '.map-distributors__panel .map-distributors__map-svg [data-distributors]', function (e) {
        if ($(window).innerWidth() >= 992) {
            var $label = $('.js-map-distributors-region-lable');

            $label.hide();
        }
    });

    $('body').on('click', '.region-tooltip._active .close-button', function (e) {
        e.preventDefault();
        $('#map-distributors').find('[data-distributors]._active').removeClass('_active');
        $(this).closest('.region-tooltip').fadeOut(500);
    });

    $('body').on('input', '.js-map-distributors-search', function (e) {
        var input = this,
            value = input.value,
            $input = $(input),
            $map = $input.closest('.map-distributors'),
            $resultsContainer = $map.find('.js-map-distributors-results');

        if (value.length >= 3) {
            $resultsContainer.show();
            updateResults($resultsContainer, value);
        } else {
            $resultsContainer.hide();
            clearResults($resultsContainer);
        }
    });

    $('body').on('focus', '.js-map-distributors-search', function (e) {
        showResults();
    });

    $('body').on('blur', '.js-map-distributors-search', function (e) {
        setTimeout(function () {
            hideResults();
        }, 150);
    });

    $('body').on('click', '.js-map-distributors-result', function (e) {
        e.preventDefault();
        $('#map-distributors').find('[data-distributors]._active').removeClass('_active');

        let trigger = this,
            $elem = $(trigger.hash),
            mapBound = $('#map-distributors')[0].getBoundingClientRect();

        var areaID = $elem.attr('id').toUpperCase();
        mapID = areaID.substring(0, areaID.indexOf('-'));

        if (mapID.length === 0) mapID = 'RU';

        setCountry(mapID);

        let bounds = $elem[0].getBoundingClientRect();

        $elem.toggleClass('_active');

        let $activeTooltip = $('#map-distributors').find('.region-tooltip._active');
        if ($activeTooltip.length > 0)
            $activeTooltip.fadeOut(300).remove();

        let $tooltip = $('#map-distributors').find('.region-tooltip[data-default]').clone();
        if (window.innerWidth > 992)
            var opts = {
                'left': bounds.x + 30 - mapBound.x,
                'top': bounds.y + 10 - mapBound.y
            };
        else
            var opts = {
                'left': bounds.x + 30 - mapBound.x,
                'top': bounds.y - 150 - mapBound.y
            };

        var url = '/local/ajax/distributors/map.php';
        var data = {
            'TYPE': 'distributors',
            'CODE': $elem.attr('id').toUpperCase()
        };

        var request = ajaxCall(data, url);
        request.done(function (resp) {
            var response = JSON.parse(resp);
            mapTooltipCreate($tooltip, response, opts);
            $(this).toggleClass('_active').siblings().removeClass('_active');
        });

    });

    function initCountryMaps() {
        var $countrySelect = $('#distributorsCountry'),
            $maps = $('.map-distributors__map-svg');

        if ($maps.length === 1) {
            $maps.addClass('map-distributors__map-svg_state_active');
            $countrySelect.hide();
        } else if ($countrySelect.length) {
            setCountry('RU');
            $countrySelect.on('change', function () {
                selectCountry($countrySelect);
            });
        }
    }

    function selectCountry($countrySelect) {
        var $maps = $('.map-distributors__map-svg'),
            currentCountry = $countrySelect.val();

        if (currentCountry) {
            $сurrentMap = $('#map-distributors-' + currentCountry);
            $('.map-distributors__map-svg_state_active').removeClass('map-distributors__map-svg_state_active');
            $сurrentMap.addClass('map-distributors__map-svg_state_active');
        } else {
            $('.map-distributors__map-svg_state_active').removeClass('map-distributors__map-svg_state_active');
            $maps.first().addClass('map-distributors__map-svg_state_active');
        }
    }

    function setCountry(mapID) {
        var $countrySelect = $('#distributorsCountry');

        if ($countrySelect.length && typeof mapID !== 'undefined') {
            // $countrySelect.val(mapID);
            $countrySelect[0].selectize.setValue(mapID, false);
            selectCountry($countrySelect);
        }
    }

    initCountryMaps();
});
function countOfOject(obj) {
    var t = typeof (obj);
    var i = 0;
    if (t != "object" || obj == null) return 0;
    for (x in obj) i++;
    return i;
}
$(window).resize(function () {
    if ($('#map-distributors').length > 0)
        mapPosCorrection();
});


