$('.search-line__close').on('click', function(event) {
    event.preventDefault();
    $(this).closest('.search-line').find(".search-line__input").val('').trigger('change');
    //$(".search-popular__tags a").siblings().removeClass('active')
    //$(".search-line__close").css({'z-index': '-1'})
});

$(CheckSearchButtonsVisibility);
$(document).on('reload', CheckSearchButtonsVisibility);
$(document).on('change keyup', '.search-line__input', CheckSearchButtonsVisibility);

function CheckSearchButtonsVisibility() {
    var $inputs = $(".search-line__input");
    $inputs.each(function () {
        var $input = $(this);
        var $close = $input.closest('.search-line').find(".search-line__close");
    
        if ($input.val().length > 0) {
            $close.css({'display': 'block'});
        }
        else {
            $close.css({'display': 'none'});
        }
    });
};