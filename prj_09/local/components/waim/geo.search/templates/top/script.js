$(document).ready(function () {
    initCitiesClickHandler();
    $('#modalGeoSelect .js-search-with-results').on("keyup", function () {
        let $input = $(this);
        let $wrapper = $input.parents('#modalGeoSelect');
        let result = window.BX.ajax.runComponentAction("waim:geo.search", "searchCity", {
            mode: 'class',
            data: {
                searchQuery: $input.val()
            }
        }).then(function (response) {
            if (response.data.status && Object.keys(response.data.cities).length > 0) {
                let $clone = $wrapper.find(".geo-list__list .geo-list__item:first-child");
                let $list = $wrapper.find(".geo-list__list");
                $list.html("");
                for (let key in response.data.cities) {
                    let element = response.data.cities[key];
                    if (element.ID) {
                        let $elementClone = $clone.clone();
                        $elementClone.find('.geo-list__link ').data("region-id", element.ID);
                        $elementClone.find('.geo-list__label').html(element.NAME);
                        $list.append($elementClone);
                    }
                }
                initCitiesClickHandler();
            }
        }, function (response) {
            //сюда будут приходить все ответы, у которых status !== 'success'
            console.error(response);
        });
    });
});

function initCitiesClickHandler() {
    $('#modalGeoSelect .geo-list__link').each(function () {
        let $cityItem = $(this);
        $cityItem.on("click", function () {
            selectCity($cityItem.data("region-id"));
        });
    });
}

window.selectCity = function (cityId = null) {
    console.log("selectCity", cityId);
    if (cityId) {
        let result = window.BX.ajax.runComponentAction("waim:geo.search", "selectCity", {
          mode: "class",
          data: {
            cityId: parseInt(cityId),
          },
        })
        .then(
          function (response) {
            if (response.data.status) {
              Fancybox.close();
              $(".geo-selector .geo-selector__label").html(response.data.cityName);
              if (
                response.data.deletedProducts &&
                Object.keys(response.data.deletedProducts).length > 0
              ) {
                let products = [];
                Object.keys(response.data.deletedProducts).forEach(function (key) {
                  products.push(response.data.deletedProducts[key]);
                });
                new Fancybox(
                  [
                    {
                      src:
                        "" +
                        '<div class="popup-message">' +
                        "<h2>Внимание!</h2>" +
                        "<p><strong>В данном регионе некоторые товары не доступны для покупки и были удалены из корзины!</strong></p>" +
                        "<p>" +
                        products.join("<br>") +
                        "</p>" +
                        "</div>",
                      type: "html",
                    },
                  ],
                  {
                    on: {
                      destroy: (fancybox, slide) => {
                        window.location.replace(window.location.href);
                      },
                    },
                  }
                );
                setTimeout(() => {
                  Fancybox.close();
                }, 10000);
              } else {
                window.location.replace(window.location.href);
              }
            }
          },
          function (response) {
            //сюда будут приходить все ответы, у которых status !== 'success'
            console.error(response);
          }
        );
    }
}