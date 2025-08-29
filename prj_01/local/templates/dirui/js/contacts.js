// Yandex maps
function InitContactsMap(){
    ymaps = window.ymaps;
    ymaps.ready(function () {
        myMap = new ymaps.Map('contacts-map', {
            center: [55.664096, 37.536526],
            zoom: 12
        }, {
            searchControlProvider: 'yandex#search'
        });
        myMap.geoObjects
            .add(new ymaps.Placemark([55.664096, 37.536526], {
                balloonContent: '117630, г. Москва, Вн.Тер.Г. Муниципальный Округ Обручевский, ул. Воронцовские Пруды, д.3,помещ.Г2/Н'
            }))
    });
}
InitContactsMap();