$(document).ready(function(){
    if ($('#map').length) {
        var objects = [
            {
                coordinates: [55.784599, 37.608806],
                title: 'Представительство в Москве',
                address: 'г. Москва, ул. Пушкина, дом 1',
                //metro: 'Савеловская',
                //parking: 'Бесплатная парковка',
                phone: '8 495 940-95-70',
                shedule: 'С 9:00 до 18:00 по мск'
            },
            {
                coordinates: [55.994260, 37.204365],
                title: 'Производство в Зеленограде',
                address: 'Березовая аллея, строение 65',
                // metro: 'Савеловская',
                // parking: 'Бесплатная парковка',
                phone: '8 800 707-42-70',
                shedule: 'С 9:00 до 18:00 по мск'
            }
        ];
        function initContactsMap() {
            initMap('map', [55.76, 37.64], 9, objects);
        }
        ymaps.ready(initContactsMap);
    }
});

// Common init map function
function initMap(containerId, centerCoordinates, zoom, objects) {

    var storesMap = new ymaps.Map(containerId, {
        center: centerCoordinates,
        zoom: zoom,
        controls: []
        // controls: ['geolocationControl', 'zoomControl']
        // controls: ['routeButtonControl']
    });

    storesMap.behaviors.disable('scrollZoom');
    // storesMap.behaviors.disable('drag');

    // Создадим пользовательский макет ползунка масштаба.
    var ZoomLayout = ymaps.templateLayoutFactory.createClass('<div class="dp-map-zoom">' +
        '<div id="' + containerId + '--zoom-in" class="dp-map-zoom__btn dp-map-zoom__up"></div>' +
        '<div id="' + containerId + '--zoom-out" class="dp-map-zoom__btn dp-map-zoom__down"></div>' +
        '</div>', {

        // Переопределяем методы макета, чтобы выполнять дополнительные действия
        // при построении и очистке макета.
        build: function () {
            // Вызываем родительский метод build.
            ZoomLayout.superclass.build.call(this);

            // Привязываем функции-обработчики к контексту и сохраняем ссылки
            // на них, чтобы потом отписаться от событий.
            this.zoomInCallback = ymaps.util.bind(this.zoomIn, this);
            this.zoomOutCallback = ymaps.util.bind(this.zoomOut, this);

            // Начинаем слушать клики на кнопках макета.
            $('#' + containerId + '--zoom-in').bind('click', this.zoomInCallback);
            $('#' + containerId + '--zoom-out').bind('click', this.zoomOutCallback);
        },

        clear: function () {
            // Снимаем обработчики кликов.
            $('#' + containerId + '--zoom-in').unbind('click', this.zoomInCallback);
            $('#' + containerId + '--zoom-out').unbind('click', this.zoomOutCallback);

            // Вызываем родительский метод clear.
            ZoomLayout.superclass.clear.call(this);
        },

        zoomIn: function () {
            var map = this.getData().control.getMap();
            map.setZoom(map.getZoom() + 1, {checkZoomRange: true});
        },

        zoomOut: function () {
            var map = this.getData().control.getMap();
            map.setZoom(map.getZoom() - 1, {checkZoomRange: true});
        }
    });

    var mapHeight = storesMap.container.getSize()[1];

    var zoomControl = new ymaps.control.ZoomControl({
        options: {
            layout: ZoomLayout,
            position: {
                right: '12px',
                top: mapHeight / 2 - 36 + 'px',
            }
        }
    });

    storesMap.controls.add(zoomControl);

    storesMap.events.add('sizechange', function (e) {
        mapHeight = e.get('newSize')[1];
        zoomControl.options.set({position: {right: '12px', top: mapHeight / 2 - 36 + 'px'}});
    });

    var nbPlacemarkLayout = ymaps.templateLayoutFactory.createClass('<div class="dp-map-placemark-icon"></div>');

    // Создание макета балуна
    var nbBalloonLayout = ymaps.templateLayoutFactory.createClass(
        '<div class="dp-map-balloon">' +
        '<button class="dp-map-balloon__close" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" width="14" height="14"><path fill-rule="evenodd" d="M14 .7l-.7-.7L7 6.3.7 0 0 .7 6.3 7 0 13.3l.7.7L7 7.7l6.3 6.3.7-.7L7.7 7z" clip-rule="evenodd"/></svg></button>' +
        '<div class="dp-map-balloon__arrow"></div>' +
        '<div class="dp-map-balloon__inner">' +
        '$[[options.contentLayout observeSize minWidth=280 maxWidth=300 minHeight=100 maxHeight=240]]' +
        '</div>' +
        '</div>', {
            build: function () {
                this.constructor.superclass.build.call(this);
                this._$element = $('.dp-map-balloon', this.getParentElement());
                this.applyElementOffset();
                this._$element.find('.dp-map-balloon__close').on('click', $.proxy(this.onCloseClick, this));
            },
            clear: function () {
                this._$element.find('.dp-map-balloon__close').off('click');
                this.constructor.superclass.clear.call(this);
            },
            onSublayoutSizeChange: function () {
                nbBalloonLayout.superclass.onSublayoutSizeChange.apply(this, arguments);
                if(!this._isElement(this._$element)) {return;}
                this.applyElementOffset();
                this.events.fire('shapechange');
            },
            applyElementOffset: function () {
                this._$element.css({
                    left: -(this._$element[0].offsetWidth / 2),
                    top: -(this._$element[0].offsetHeight + 12)
                });
            },
            onCloseClick: function (e) {
                e.preventDefault();
                this.events.fire('userclose');
            },
            getShape: function () {
                if(!this._isElement(this._$element)) {
                    return nbBalloonLayout.superclass.getShape.call(this);
                }
                var position = this._$element.position();
                return new ymaps.shape.Rectangle(new ymaps.geometry.pixel.Rectangle([
                    [position.left, position.top],
                    [position.left + this._$element[0].offsetWidth, position.top + this._$element[0].offsetHeight]
                ]));
            },
            _isElement: function (element) {
                return element && element[0] && element.find('.dp-map-balloon__arrow')[0];
            }
        });

    // Создание вложенного макета содержимого балуна.
    var nbBalloonContentLayout = ymaps.templateLayoutFactory.createClass(
        '<div class="dp-map-balloon__header">$[properties.balloonHeader]</div>' +
        '<div class="dp-map-balloon__content">$[properties.balloonContent]</div>'
    );

    var nbPlacemark = [];
    if (objects.length > 0) {
        for(var ind = 0; ind < objects.length; ind++) {
            nbPlacemark[ind] = new ymaps.Placemark(
                objects[ind].coordinates,
                {
                    balloonHeader: objects[ind].title,
                    balloonContent:
                        '<span class="dp-map-balloon__address">' + objects[ind].address + '</span>' +
                        //'<span class="dp-map-balloon__metro">' + objects[ind].metro + '</span>' +
                        //'<span class="dp-map-balloon__parking">' + objects[ind].parking + '</span>' +
                        '<span class="dp-map-balloon__shedule">' + objects[ind].shedule + '</span>' +
                        '<a href="tel:' + objects[ind].phone + '" class="dp-map-balloon__phone">' + objects[ind].phone + '</a>'
                },
                { // Опции
                    iconLayout: nbPlacemarkLayout,
                    iconShape: {type: 'Rectangle', coordinates: [[-23, 0], [23, -55]]},
                    balloonLayout: nbBalloonLayout,
                    balloonContentLayout: nbBalloonContentLayout,
                    // balloonPanelMaxMapArea: 0
                }
            );
            storesMap.geoObjects.add(nbPlacemark[ind]);
        }
    }
    // storesMap.options.set({balloonPanelMaxMapArea:'Infinity'});

}