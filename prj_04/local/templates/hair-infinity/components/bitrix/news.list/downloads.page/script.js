$(document).ready(function () {
    initDownloadsPageHandlers();
});
function initDownloadsPageHandlers() {
    var $form = $('#events-filter-form');
    $(".js-show-more").off("click");
    $(".js-show-more").on("click", function () {
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
                    var buttonHtml = $html.find(".entity-grid__control").prop('outerHTML');
                    if(!buttonHtml || typeof buttonHtml == "undefined"){
                        buttonHtml = "";
                    }
                    $html.find(".entity-grid__control").remove();
                    //
                    $('body').find('[data-ajax-container]').append($html.find("body").html());
                    $('body').find('.entity-grid__controls').html(buttonHtml);
                }
                if(typeof initDownloadsPageHandlers != "undefined"){
                    initDownloadsPageHandlers();
                }
            });
    });


    $('#events-filter-form select').off("change");
    $('#events-filter-form select').on("change", function(e){
        e.preventDefault();
        $form.submit();
    });

    $form.off("submit");
    $form.on("submit", function(e){
        e.preventDefault();
        var url = $form.attr('action');
        var data = $form.serialize();
        data +='&AJAX_CALL=Y';

        $.ajax({
            method: "POST",
            url: url,
            data: data
        })
            .done(function( resp ) {
                let $html = $(new DOMParser().parseFromString(resp, 'text/html'));
                if($html) {
                    var buttonHtml = $html.find(".entity-grid__control").prop('outerHTML');
                    if(!buttonHtml || typeof buttonHtml == "undefined"){
                        buttonHtml = "";
                    }
                    $html.find(".entity-grid__control").remove();
                    //
                    $('body').find('[data-ajax-container]').html($html.find("body").html());
                    $('body').find('.entity-grid__controls').html(buttonHtml);
                }
                if(typeof initDownloadsPageHandlers != "undefined"){
                    initDownloadsPageHandlers();
                }
            });
    })
}