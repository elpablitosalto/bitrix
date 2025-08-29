if ($('#ymaps-api-script').length < 1) {
    $('head').append('<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&onload=InitContactsMap" type="text/javascript"></script>');
}

function InitContactsMap(){
    var contactsMap = new ymaps.Map("contacts-map", {
        center: [$("#lat").val(), $("#lon").val()],
        zoom: 14,
        controls: []
    });

    var contactsPlacemarks = new ymaps.GeoObjectCollection();
    var contactsPlacemarkLayout = ymaps.templateLayoutFactory.createClass(
        '<div class="contacts-map-pointer">' +
        '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-home"><use xlink:href="#home"></use></svg>' +
        '</div>');
    var contactsBalloonLayout = ymaps.templateLayoutFactory.createClass(
        '<div class="contacts-map-balloon">' +
        '<div class="contacts-map-balloon__close">' +
        '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-close"><use xlink:href="#close"></use></svg>' +
        '</div>' +
        '$[[options.contentLayout]]' +
        '</div>',
        {
            build: function () {
                this.constructor.superclass.build.call(this);
                this._$element = $('.contacts-map-balloon', this.getParentElement());
                this._$element.find('.contacts-map-balloon__close')
                    .on('click', $.proxy(this.onCloseClick, this));
            },
            clear: function () {
                this._$element.find('.contacts-map-balloon__close')
                    .off('click');
                this.constructor.superclass.clear.call(this);
            },
            onCloseClick: function (e) {
                e.preventDefault();
                this.events.fire('userclose');
            },
        });
    var contactsBalloonContentLayout = ymaps.templateLayoutFactory.createClass(
        '<h6 class="contacts-map-balloon__title">$[properties.balloonHeader]</h6>' +
        '<div class="contacts-map-balloon__content">$[properties.balloonContent]</div>');

    var cPlacemark = new ymaps.Placemark({
        type: "Point",
        coordinates: [$("#lat").val(), $("#lon").val()]
    }, {
        balloonHeader: $("#balloonHeader").val(),
        balloonContent: $("#balloonContent").val()
    }, {
        cursor: 'pointer',
        hideIconOnBalloonOpen: false,
        openBalloonOnClick: true,
        openHintOnHover: false,
        balloonLayout: contactsBalloonLayout,
        balloonContentLayout: contactsBalloonContentLayout,
        iconLayout: contactsPlacemarkLayout,
        iconShape: {
            type: 'Circle',
            coordinates: [0,0],
            radius: 21,
        },
    });

    contactsPlacemarks.add(cPlacemark);
    contactsMap.geoObjects.add(contactsPlacemarks);
}