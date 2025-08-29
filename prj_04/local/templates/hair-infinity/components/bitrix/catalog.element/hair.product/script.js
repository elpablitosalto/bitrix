$(document).ready(function () {
    $(".choice-group__input").each(function () {
        $(this).on("change", function () {
            $.ajax({
                method: "POST",
                url: "/local/templates/hair-infinity/components/bitrix/catalog.element/hair.product/ajax.php",
                data: {
                    productId: $(this).data("product-id"),
                    propertyCode: $(this).data("property-code"),
                    propertyValue: $(this).data("property-value"),
                }
            })
            .done(function( jsonResponse ) {
                var response = JSON.parse(jsonResponse);
                if(typeof response.popupLinksHtml != "undefined"){
                    $("#whereBuy .links").html(response.popupLinksHtml);
                }
                if(typeof response.colorSelectHtml != "undefined"){
                    $(".product-card__select .choices-select").html(response.colorSelectHtml);
                    let select = $(".product-card__select .choices-select select");
                    if(select[0]){
                        select[0].choiceInstance = new Choices(select[0], {
                            searchEnabled: false,
                            shouldSort: false,
                            loadingText: 'Загрузка...',
                            noResultsText: 'Результатов не найдено',
                            noChoicesText: 'Нет опций для выбора',
                            itemSelectText: '',
                            placeholder: true,
                            placeholderValue: null
                        });
                    }
                }
            });
        });
    });
});