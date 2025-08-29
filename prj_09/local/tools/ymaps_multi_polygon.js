ymaps.ready(function () {
    // 0. Создаем карту
    var map,
        regionName = "Московская область, Одинцовский район",
        center = [37.6174976, 55.6506828],
        zoom = 7;
    map = new ymaps.Map('karta', {
        center: center,
        zoom: zoom,
        controls: []
    });
    // 1. Запрашиваем через геокодер район (у Яндекса этой возможности пока нет, придется пользоваться OSM)
    var url = "https://nominatim.openstreetmap.org/search";
    var jsondata = $.getJSON(url, {
        q: regionName,
        format: "json",
        polygon_geojson: 1
    })
        .then(function (data) {
            $.each(data, function (ix, place) {
                // 2. Если район состоит из нескольких полигонов - разбиваем мультиполигон на отдельные полигоны (API Яндекс.Карт не умеет рисовать мультиполигоны GeoJSON).
                if ("MultiPolygon" == place.geojson.type) {
                    place.geojson.coordinates.forEach(function (coords) {
                        var feat = {
                            'type': 'Polygon',
                            'coordinates': coords
                        };
                        var p = new ymaps.Polygon(feat.coordinates, {
                            hintContent: regionName
                        }, {
                            fillColor: '#6699ff',
                            interactivityModel: 'default#transparent',
                            strokeWidth: 2,
                            opacity: 0.3
                        });
                        // 2.1 Добавляем полигоны на карту
                        map.geoObjects.add(p);
                        map.setBounds(map.geoObjects.getBounds())
                    });
                    // 3. В другом случае создаем полигон с нужными координатами
                } else if ("relation" == place.osm_type) {
                    var p = new ymaps.Polygon(place.geojson.coordinates, {
                        hintContent: regionName
                    }, {
                        fillColor: '#6699ff',
                        interactivityModel: 'default#transparent',
                        strokeWidth: 2,
                        opacity: 0.3
                    });
                    // 3.1 Добавляем полигон на карту
                    map.geoObjects.add(p);
                    map.setBounds(map.geoObjects.getBounds())
                }
            });
        }, function (err) {
            console.log(err);
        });
});