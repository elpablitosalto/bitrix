$(document).ready(function () {
    initMapsContacts();
});

function initMapsContacts() {
    $('.js_maps_contacts').each(function () {
        //var yMapsBlockId;
        var blockId = $(this).attr('id');
        var longitude = $(this).data('longitude');
        var latitude = $(this).data('latitude');
        var hintContent = $(this).data('hint');
        var marker_img = $(this).data('marker-img');
        //alert(marker_img);
        //alert(blockId);
        //var yMapsBlockId = document.querySelector('#' + blockId);
        var yMapsBlockId = $('#' + blockId);
        if (yMapsBlockId) {
            //alert(yMapsBlockId);
            ymaps.ready(function () {
                var myMap = new ymaps.Map(blockId, {
                    center: [Number(longitude), Number(latitude)],
                    zoom: 14,
                }, {
                    searchControlProvider: 'yandex#search'
                });

                var myPlacemarkFirst = new ymaps.Placemark(myMap.getCenter(), {
                    hintContent: hintContent
                }, {
                    iconLayout: 'default#image',
                    iconImageHref: marker_img,
                    iconImageSize: [40, 40],
                    iconImageOffset: [0, 5]
                });

                /*
                myPlacemarkSecond = new ymaps.Placemark([55.615641, 37.274374], {
                    hintContent: 'Стройсервис во Внуково',
                }, {
                    iconLayout: 'default#image',
                    iconImageHref: './img/design/marker-map.svg',
                    iconImageSize: [40, 40],
                })
                */

                myPlacemarkFirst.events.add('click', function () {
                    myMap.setCenter([Number(longitude), Number(latitude)], 14, {
                        checkZoomRange: true
                    });
                });

                /*
                myPlacemarkSecond.events.add('click', function () {
                    myMap.setCenter([55.615641, 37.274374], 14, {
                        checkZoomRange: true
                    });
                });
                */

                myMap.geoObjects
                    .add(myPlacemarkFirst);
                //.add(myPlacemarkSecond)
            });
        }
    });
}