if (typeof (ymaps) != "undefined" && ymaps !== null && $('#map_delivery_zones').length) {
    ymaps.ready(init);
}

function init() {

    var myMap = new ymaps.Map('map_delivery_zones', {
        //center: [38.89165, 47.361466],
        center: [55.75583, 37.6173],
        zoom: 6,
        controls: []
    });
    /*
    var zoom = new ymaps.Zoom({
        customTips: [
            { index: 1, value: "Мелко" },
            { index: 9, value: "Средне" },
            { index: 16, value: "Крупно" }
        ]
    });
    //Добавление элемента управления на карту
    myMap.addControl(zoom);
    /**/
    
    /* */
    myMap.controls.add('zoomControl', {
        size: "large"
    });
    /**/


    function onZonesLoad(json) {
        //alert('!');
        //console.log(json);
        // Добавляем зоны на карту.
        var deliveryZones = ymaps.geoQuery(json).addToMap(myMap);

        // Задаём цвет и контент балунов полигонов.
        deliveryZones.each(function (obj) {
            obj.options.set({
                fillColor: obj.properties.get('fill'),
                fillOpacity: obj.properties.get('fill-opacity'),
                strokeColor: obj.properties.get('stroke'),
                strokeWidth: obj.properties.get('stroke-width'),
                strokeOpacity: obj.properties.get('stroke-opacity')
            });
            obj.properties.set('balloonContent', obj.properties.get('description'));
        });

        /* */
        // Проверим попадание результата поиска в одну из зон доставки.
        if (typeof searchControl !== 'undefined') {
            searchControl.events.add('resultshow', function (e) {
                highlightResult(searchControl.getResultsArray()[e.get('index')]);
            });
        }

        // Проверим попадание метки геолокации в одну из зон доставки.
        if (typeof myMap.controls.get('geolocationControl') !== 'undefined') {
            myMap.controls.get('geolocationControl').events.add('locationchange', function (e) {
                highlightResult(e.get('geoObjects').get(0));
            });
        }

        // При перемещении метки сбрасываем подпись, содержимое балуна и перекрашиваем метку.
        if (typeof deliveryPoint !== 'undefined') {
            deliveryPoint.events.add('dragstart', function () {
                deliveryPoint.properties.set({ iconCaption: '', balloonContent: '' });
                deliveryPoint.options.set('iconColor', 'black');
            });
        }

        // По окончании перемещения метки вызываем функцию выделения зоны доставки.
        if (typeof deliveryPoint !== 'undefined') {
            deliveryPoint.events.add('dragend', function () {
                highlightResult(deliveryPoint);
            });
        }

        function highlightResult(obj) {
            // Сохраняем координаты переданного объекта.
            var coords = obj.geometry.getCoordinates(),
                // Находим полигон, в который входят переданные координаты.
                polygon = deliveryZones.searchContaining(coords).get(0);

            if (polygon) {
                // Уменьшаем прозрачность всех полигонов, кроме того, в который входят переданные координаты.
                deliveryZones.setOptions('fillOpacity', 0.4);
                polygon.options.set('fillOpacity', 0.8);
                // Перемещаем метку с подписью в переданные координаты и перекрашиваем её в цвет полигона.
                deliveryPoint.geometry.setCoordinates(coords);
                deliveryPoint.options.set('iconColor', polygon.properties.get('fill'));
                // Задаем подпись для метки.
                if (typeof (obj.getThoroughfare) === 'function') {
                    setData(obj);
                } else {
                    // Если вы не хотите, чтобы при каждом перемещении метки отправлялся запрос к геокодеру,
                    // закомментируйте код ниже.
                    ymaps.geocode(coords, { results: 1 }).then(function (res) {
                        var obj = res.geoObjects.get(0);
                        setData(obj);
                    });
                }
            } else {
                // Если переданные координаты не попадают в полигон, то задаём стандартную прозрачность полигонов.
                deliveryZones.setOptions('fillOpacity', 0.4);
                //deliveryZones.setOptions('fillOpacity', 0);
                // Перемещаем метку по переданным координатам.
                deliveryPoint.geometry.setCoordinates(coords);
                // Задаём контент балуна и метки.
                deliveryPoint.properties.set({
                    iconCaption: 'Доставка транспортной компанией',
                    balloonContent: 'Cвяжитесь с оператором',
                    balloonContentHeader: ''
                });
                // Перекрашиваем метку в чёрный цвет.
                deliveryPoint.options.set('iconColor', 'black');
            }

            function setData(obj) {
                var address = [obj.getThoroughfare(), obj.getPremiseNumber(), obj.getPremise()].join(' ');
                if (address.trim() === '') {
                    address = obj.getAddressLine();
                }
                var price = polygon.properties.get('description');
                price = price.match(/<strong>(.+)<\/strong>/)[1];
                deliveryPoint.properties.set({
                    iconCaption: address,
                    balloonContent: address,
                    balloonContentHeader: price
                });
            }
        }
        /**/
    }

    $.ajax({
        url: '/local/ajax/handler_delivery_zone.php',
        dataType: 'json',
        success: function (result) {
            onZonesLoad(result);

            /*
            //console.log(result.RESULT);
            if (result.RESULT == 'SUCCESS') {
                //$('.' + params.hideButtonClass).removeClass('display-none');
                //$('.' + params.showButtonClass).addClass('display-none');
            }
            else if (result.RESULT == 'ERROR') {
                console.log(result.ERROR);
            }
            */
        },
        error: function (xhr, str) {
            console.error(xhr.responseText);
            return false;
        },
        complete: function () {
        }
        //success: onZonesLoad
    });
}