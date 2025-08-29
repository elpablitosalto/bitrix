$(document).ready(function () {
    initCatalogPageHandlers();
});
function initCatalogPageHandlers() {
    $(".js-show-more").off("click");
    $(".js-show-more").on("click", function () {
        let $form = $('.smart-filter-form');
        var url = $form.attr('action');
        var data = $form.serialize();
        data +='&AJAX_CALL=Y&PAGEN_1=' + parseInt($(this).data("page-num"));

        $.ajax({
            method: "POST",
            url: url,
            data: data
        })
        .done(function( resp ) {
            var $html = $(new DOMParser().parseFromString(resp, 'text/html'));
            if($html) {
                var buttonHtml = $html.find(".product-grid__control").prop('outerHTML');
                if(!buttonHtml || typeof buttonHtml == "undefined"){
                    buttonHtml = "";
                }
                $html.find(".product-grid__control").remove();
                //
                $('body').find('[data-ajax-container]').append($html.find("body").html());
                $('body').find('.product-grid__controls').html(buttonHtml);
            }
            if(typeof initCatalogPageHandlers != "undefined"){
                initCatalogPageHandlers();
            }
        });
    });
}