var templatePath = '/local/templates/stroyservis/';
if (window.location.hostname === 'stroyservis-layout.indexis.ru' || window.location.hostname === 'localhost') {
    templatePath = '/';
}

const office = {
    name: 'Офис и склад Стройсервис',
    description: "Адрес: г. Москва, поселок Московский, Киевское шоссе, 22-й километр, домовладение 4, строение 2, блок Г, подъезд 11, этаж 4 , офис 420Г\nтел. +7 (495) 229-30-20\nпочта: mail@stroyservis.su",
    coords: [55.63510751787184, 37.43698960585215]
};

class DCalculator {
    constructor(data, areas) {
        this._cars = data;
        this._renderItems();
    }

    _renderItems() {
        const calcContainerEl = document.getElementById('delivery-map-calculator');
        let weightItems = '';
        this._cars.forEach((item, i) => {
            weightItems +=
                '<li data-id="' + i + '">' +
                '<input value="' + item.weight + '" type="radio" id="weight-' + item.weight + '" name="weight"' + ((i < 1) ? ' checked' : '') + '>' +
                '<label for="weight-' + item.weight + '">До ' + numberWithSpaces(+item.weight) + ' кг</label>' +
                '</li>';
        });
        calcContainerEl.innerHTML =
            '<div class="delivery-map-calculator-section">' +
            '<p class="delivery-map-calculator-section__title">Вес заказа</p>' +
            '<ul class="delivery-map-calculator-weight">' + weightItems + '</ul>' +
            '</div>' +
            '<div class="delivery-map-calculator-section delivery-map-calculator-section-price">' +
            '<p class="delivery-map-calculator-section__title">Стоимость: ' +
            '<span class="delivery-map-calculator-price">от&nbsp;' + this._cars[0].price + '</span>&nbsp;' +
            '<span class="delivery-map-calculator-currency">₽</span>' +
            '</p>' +
            '</div>' +
            '<div class="delivery-map-calculator-section-error">' +
            '<p class="delivery-map-calculator-error">ВНИМАНИЕ! <br>Данный адрес находится за пределами зон доставки. Стоимость и возможность доставки вы можете уточнить у менеджера.</p>' +
            '</div>';

        function numberWithSpaces(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
        }

        return this;
    }

    renderPrice(carPrice, pricePerKm, distance, outofzone) {
        const calcPriceEl = document.querySelector('.delivery-map-calculator-price');
        const calcPriceCurrencyEl = document.querySelector('.delivery-map-calculator-currency');
        const calcPriceErrorEl = document.querySelector('.delivery-map-calculator-section-error');

        if (outofzone) {
            calcPriceEl.innerHTML = '<span>По согласованию</span>';
            calcPriceCurrencyEl.style.display = 'none';
            calcPriceErrorEl.style.display = 'block';
        }
        else {
            calcPriceErrorEl.style.display = 'none';
            if (carPrice === 0) {
                calcPriceEl.innerHTML = '<span>По согласованию</span>';
                calcPriceCurrencyEl.style.display = 'none';
            }
            else {
                calcPriceCurrencyEl.style.display = 'inline';
                if (distance === 0) {
                    calcPriceEl.innerHTML = 'от&nbsp;' + carPrice;
                }
                else {
                    calcPriceEl.innerText = Math.round(pricePerKm * (distance / 1000) + carPrice);
                }
            }
        }
    }
}

class RCalculator
{
    constructor(priceKm, carsList, areasList, callback, closeSuggestions) {
        this.map = new ymaps.Map("delivery-map", {
            center: (window.innerWidth > 1200) ? [55.757795, 37.202733] : [55.755864, 37.617698],
            zoom: 10,
            controls: ['geolocationControl', 'zoomControl'],
        });

        const z = new ymaps.Placemark(office.coords, {
            iconCaption: office.name,
            iconContent: '',
        }, {
            hasHint: false,
            iconLayout: 'default#imageWithContent',
            iconImageHref: templatePath + 'img/design/placemark.svg',
            iconImageSize: [52, 52],
            iconImageOffset: [-27, -50]
        });
        this.map.geoObjects.add(z);

        this.areas = [];
        this.cars = {};

        areasList.forEach(area => {
            const newa = new ymaps.Polygon([area.coordinates], {hintContent: area.description}, {
                hasHint: true,
                fillColor: area.fillColor || '#b51eff',
                fillOpacity: area.fillOpacity || 0.4,
                strokeColor: area.strokeColor || '#b51eff',
                strokeWidth: area.strokeWidth || 3,
                strokeOpacity: area.strokeOpacity || 0.8,
                interactivityModel: 'default#transparent'
            });

            this.map.geoObjects.add(newa);
            this.areas.push({key: area.id, geometry: newa.geometry});
        });

        carsList.forEach(car => {
            this.cars['w' + car.weight] = +car.price;
        });

        this.route;
        this.closeSuggestions = closeSuggestions;
        this.callback = callback;
        this.pricePerKm = priceKm;
        this.calcDistance = 0;
        this.outOfZone = false;
        this.destCoordinates = [];

        this.map.events.add('click', (event) => {
            const coords = event.get('coords');
            this.buildRoute(coords);
            this.destCoordinates = coords;
            ymaps.geocode(coords).then(res => {
                document.getElementById('delivery-address').value = res.geoObjects.get(0).getAddressLine();
                this.closeSuggestions();
            });
        })
    }

    getDestCoordinates() {
        return this.destCoordinates;
    }

    setDestCoordinates(coord) {
        this.destCoordinates = coord || [];
    }

    getCalcDistance() {
        return this.calcDistance;
    }

    getCarPrice(weight) {
        return this.cars['w' + weight];
    }

    getPricePerKm() {
        return this.pricePerKm;
    }

    getOutOfZone() {
        return this.outOfZone;
    }

    buildRoute(address) {
        if(this.locked) {
            return;
        }

        this.destRoute && this.destRoute.removeFromMap(this.map);
        this.map.geoObjects.remove(this.destPlacemark);

        if(!address) {
            this.callback(this.cars['w' + $('input[name="weight"]:checked').val()], this.pricePerKm, 0, this.outOfZone);
            return;
        }

        this.locked = true;

        ymaps.geocode(address, {results: 1}).then(res => {
            const o = res.geoObjects.get(0);
            if (o) {
                ymaps.route([office.coords, address], {mapStateAutoApply: true, 'strokeWidth': 3,}).then(route => {

                    const points = route.getWayPoints();
                    const dest_point = points.get(points.getLength() - 1);
                    dest_point.properties.set("iconCaption", o.getAddressLine().replace('Россия, Москва ', ''));
                    dest_point.properties.set("balloonContentBody", o.getAddressLine());
                    const c2p = [];
                    route.getPaths().each(z => c2p.push(...z.geometry.getCoordinates()));

                    this.calcDistance = 0;
                    let prevPoint = null;
                    for(const m of c2p.reverse()) {
                        if(prevPoint) {this.calcDistance += ymaps.coordSystem.geo.getDistance(m, prevPoint);}
                        prevPoint = m;
                    }

                    let destinationAreaIndex = undefined;

                    for(let i = 0; i < this.areas.length; i++) {
                        if ( this.areas[i].geometry.contains(dest_point.geometry.getCoordinates()) ) {
                            destinationAreaIndex = i;
                            this.callback(this.cars['w' + $('input[name="weight"]:checked').val()], this.pricePerKm, this.calcDistance, this.outOfZone);
                            break;
                        }
                    }

                    if (destinationAreaIndex === undefined) {
                        this.outOfZone = true;
                        this.callback(this.cars['w' + $('input[name="weight"]:checked').val()], this.pricePerKm, this.calcDistance, this.outOfZone);
                    } else {
                        this.outOfZone = false;
                        this.callback(this.cars['w' + $('input[name="weight"]:checked').val()], this.pricePerKm, this.calcDistance, this.outOfZone);
                        this.destPlacemark = dest_point;
                        this.map.geoObjects.add(dest_point);
                    }

                    this.destRoute = ymaps.geoQuery(route.getPaths())
                        .setOptions({
                            strokeColor: '#F35E19',
                            'strokeWidth': 4
                        })
                        .addToMap(this.map);
                });

            } else {
                this.callback(this.cars['w' + $('input[name="weight"]:checked').val()], this.pricePerKm, 0, this.outOfZone);
                console.log("address not found");
            }
        },
        ee => {
            console.log("Error: ", ee)
        }, this);

        this.locked = false;
    }
}

document.addEventListener("DOMContentLoaded",function() {

    const deliveryAssetsJson = (templatePath === '/') ? '/js/delivery-assets.json' : '/local/ajax/delivery-assets.php';
    let fetchJob = fetch(deliveryAssetsJson);

    ymaps.ready(() => {
        fetchJob.then((response) => {
            return response.json();
        }).then((jsonData) => {
            const cars = (typeof deliveryCars !== 'undefined') ?  deliveryCars : jsonData.cars;
            const priceKm = (typeof deliveryPricePerKm !== 'undefined') ?  +deliveryPricePerKm : +jsonData.pricePerKm;
            const calc = new DCalculator(cars, jsonData.areas);
            const router = new RCalculator(priceKm, cars, jsonData.areas, (carPrice, pricePerKm, distance, outofzone) => calc.renderPrice(carPrice, pricePerKm, distance, outofzone), closeSuggest);

            const suggestions = new ymaps.SuggestView('delivery-address', {
                offset: [-1,2],
                zIndex: 1000
            });
            suggestions.events.add('select', function(event) {
                router.buildRoute(event.get('item').value);
                router.setDestCoordinates([]);
            });

            function closeSuggest() {
                suggestions.state.set({
                    open: false
                });
            }

            $('input[name="weight"]').on('click', function(){
                calc.renderPrice(router.getCarPrice(this.value), router.getPricePerKm(), router.getCalcDistance(), router.getOutOfZone());
            });

            $('#delivery-map-calculator-search').on('submit', function(e) {
                e.preventDefault();
                if (router.getDestCoordinates().length < 2) {
                    router.buildRoute($('#delivery-address').val());
                }
            });

            $('#delivery-address').on('input', function(e) {
                e.preventDefault();
                if (router.getDestCoordinates().length !== 0) {
                    router.setDestCoordinates([]);
                }
            });

        });
    });

});