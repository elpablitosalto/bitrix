// LOAD YMAPS SCRIPT
if ($('#ymaps-api-script').length < 1) {
	$('head').append('<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&onload=InitObjectsMap" type="text/javascript"></script>');
}

var $mapContainers = [],
	map = false,
	$mapObjects = [],
	mapPlacemarks;

// INIT MAP
function InitObjectsMap(){
	
	$mapContainers = $('#objectsMap');
	if ($mapContainers.length > 0) {
		map = new ymaps.Map($mapContainers.attr('id'), {
			center: [55.755819, 37.617644],
			zoom: 14,
			controls: ['zoomControl']
		});

		map.behaviors.disable('scrollZoom');
	}
	
	$mapObjects = $('.map-objects-item');
	if ($mapObjects.length > 0 && $mapContainers.length > 0) {
		AddMapPoints();
	}
}

// ADD POINTS ON MAP
function AddMapPoints() {
	mapPlacemarks = new ymaps.GeoObjectCollection();
	
	$mapObjects.each(function() {
		
		var $cItem = $(this);
		//
		// var cPointCoords = $cItem.attr('data-coordinates').split(',');
		// //var cPointBalloonContent = $cItem.attr('data-balloonContent');
		// var cPointHint = $cItem.attr('data-city');
		//
		// var hintLayout = ymaps.templateLayoutFactory.createClass("<div class='contacts-map-hint'>" + cPointHint + "</div>");
		// var defaultPlacemarkLayout = ymaps.templateLayoutFactory.createClass('<div class="contacts-map-pointer"></div>');
		// var hoverPlacemarkLayout = ymaps.templateLayoutFactory.createClass('<div class="contacts-map-pointer hover"></div>');
		
		var cItemTitle = $cItem.find('[data-map-title]').length > 0 ? ('<b>' + $cItem.find('[data-map-title]').html() + '</b><br>') : false;
		var cItemAddress = $cItem.find('[data-map-address]').length > 0 ? ('Адрес: ' + $cItem.find('[data-map-address]').html() + '<br>') : false;
		var cItemPhones = $cItem.find('[data-map-phone]').length > 0 ? 'Телефон: ' : false;
		if (cItemPhones) {
			var i=0;
			$cItem.find('[data-map-phone]').each(function () {
				cItemPhones += (i>0 ? ', ' : '') + '<a href="' + $(this).attr('href') + '">' + $(this).html() + '</a>';
				++i;
			});
			cItemPhones += '<br>'
		}
		var cItemEmail = $cItem.find('[data-map-email]').length > 0 ? ('Email: <a href="mailto:' + $cItem.find('[data-map-email]').html() + '">' + $cItem.find('[data-map-email]').html() + '</a><br>') : false;
		var cItemSite = $cItem.find('[data-map-site]').length > 0 ? ('Сайт: <a target="_blank" href="' + $cItem.find('[data-map-site]').attr('href') + '">' + $cItem.find('[data-map-site]').html() + '</a><br>') : false;
		
		var cPlacemark = new ymaps.Placemark({
			type: "Point",
			coordinates: [+$cItem.attr('data-map-lat'), +$cItem.attr('data-map-lng')]
		}, {
			balloonContent: (cItemTitle ? cItemTitle : '') +
				(cItemAddress ? cItemAddress : '') +
				(cItemPhones ? cItemPhones : '') +
				(cItemEmail ? cItemEmail : '') +
				(cItemSite ? cItemSite : ''),
		}, {
			cursor: 'pointer',
			hideIconOnBalloonOpen: false,
			openBalloonOnClick: true,
			iconLayout: 'default#image',
			iconImageHref: '/local/templates/kamvek/images/marker-small.png',
			iconImageSize: [30, 41],
			iconImageOffset: [-15, -41]
		});
		
		// cPlacemark.events.add("mouseenter", function (e) {
		// 	e.get('target').options.set('iconLayout', hoverPlacemarkLayout);
		// });
		// cPlacemark.events.add("mouseleave", function (e) {
		// 	e.get('target').options.set('iconLayout', defaultPlacemarkLayout);
		// });
		
		mapPlacemarks.add(cPlacemark);
	});
	
	map.geoObjects.add(mapPlacemarks);
	
	if (mapPlacemarks.getLength() > 1) {
		map.setBounds(mapPlacemarks.getBounds());
	}
	else {
		map.setCenter(mapPlacemarks.get(0).geometry.getCoordinates());
		map.setZoom(14);
	}
}

// PLACEMARKS FILTER
$(document).on('click', '.map-objects-region__label', function () {
	$(this).closest('.map-objects-region').toggleClass('active')
});
$(document).on('click', '.map-objects-region__list li', function () {
	var $listItem = $(this);
	var $block = $listItem.closest('.map-objects-region');
	var $label = $block.find('.map-objects-region__label');
	
	$label.html($listItem.html());
	$listItem.addClass('selected').siblings().removeClass('selected');
	$block.removeClass('active').trigger('select');
});
$(document).on('select', '.map-objects-region', function () {
	var $selectedItem = $(this).find('.map-objects-region__list li.selected');
	if ($selectedItem.attr('data-lat') !== undefined && $selectedItem.attr('data-lng') !== undefined && $selectedItem.attr('data-zoom') !== undefined) {
		map.setCenter([+$selectedItem.attr('data-lat'), +$selectedItem.attr('data-lng')]);
		map.setZoom(+$selectedItem.attr('data-zoom'));
		$mapObjects.each(function () {
			var $cItem = $(this);
			if ($cItem.attr('data-map-region-id') === $selectedItem.attr('data-region-id')) $cItem.css('display', 'block');
			else $cItem.css('display', 'none');
		});
	}
	else {
		map.setBounds(mapPlacemarks.getBounds());
		$mapObjects.each(function () {
			var $cItem = $(this);
			$cItem.css('display', 'block');
		});
	}
});