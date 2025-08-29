var urlBasketActions = '/local/ajax/basket_actions.php';
var ajaxTimerId = new Map();

$(document).ready(function () {
    initChangeCountInBasket();
});

function initChangeCountInBasket() {
    $('.js_input_quantity').on("change", function (e) {
        doChangeQuantityInBasket($(this));
        initDecreaseQuantity($(this));
    });

    $('.js_input_quantity').on("keyup", function (e) {
        doChangeQuantityInBasket($(this));
        initDecreaseQuantity($(this));
    });

    $('.js_button_add_to_basket').on("click", function (e) {
        //if( $(this).hasClass('button_state_alt-content') )
        var $input_quantity = $(this).closest('.js_quantity_els_container').find('.js_input_quantity');
        doChangeQuantityInBasket($input_quantity, 1);
        initDecreaseQuantity($input_quantity);
    });
}

function initDecreaseQuantity($element) {

    var $button_decrease_quantity = $element.closest('.js_quantity_els_container').find('.js_decrease_quantity');
    var $input_quantity = $element.closest('.js_quantity_els_container').find('.js_input_quantity');

    //console.log($element);
    //console.log($button_decrease_quantity);
    //console.log($button_decrease_quantity.length);
    //console.log($input_quantity.length);

    if ($button_decrease_quantity.length > 0) {
        $button_decrease_quantity.attr('disabled', false);
    }
    if ($input_quantity.length > 0) {
        $input_quantity.attr('min', '0');
        $input_quantity.attr('data-min', '0');
    }
}

function doChangeQuantityInBasket($input_quantity, timeout = 1500) {
    var url = urlBasketActions;
    var productId = $input_quantity.data('product-id');
    var quantity_str = $input_quantity.val();
    var quantity_num = Number(quantity_str);
    //console.log(ajaxTimerId);
    var timerId = ajaxTimerId.get(productId);
    if (Number(timerId) > 0) {
        clearTimeout(timerId);
    }
    //alert(quantity_num);
    if (quantity_num < 1) {
        $button = $input_quantity.closest('.js_quantity_els_container').find('button.js_decrease_quantity');
        //delProductFromBasket($button, productId);

        var timerId = ajaxTimerId.get(productId);
        if (Number(timerId) > 0) {
            clearTimeout(timerId);
        }
        timerId = setTimeout(function () {
            ajaxDelProductFromBasket(url, productId, $button);
        }, timeout);
        ajaxTimerId.set(productId, timerId);
    } else {
        quantity_str = String(quantity_num);
        timerId = setTimeout(function () {
            ajaxChangeQuantityInBasket(url, productId, quantity_str, $input_quantity);
        }, timeout);
        ajaxTimerId.set(productId, timerId);
    }
}

function ajaxChangeQuantityInBasket(url, productId, quantity, $element) {
    console.log('send ajax request');
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'html',
        data: { action: 'change_quantity', productId: productId, quantity: quantity },
        success: function (data) {
            initDecreaseQuantity($element);
            return false;
        },
        error: function (xhr, str) {
            console.error(xhr.responseText);
            return false;
        },
        complete: function () {
        }
    });
}

function doAfterAdd2BasketInDetail($button) {
    $button.closest('.js_quantity_els_container').find('input.js-quantity-input').addClass('js_input_quantity');
    $button.closest('.js_quantity_els_container').find('button.js-quantity-decrease').addClass('js_decrease_quantity');
    initChangeCountInBasket();
}

// Удаление товара из корзины -->
/*
function delProductFromBasket($button, productId) {
    var url = urlBasketActions;
    var timerId = ajaxTimerId.get(productId);
    if (Number(timerId) > 0) {
        clearTimeout(timerId);
    }
    timerId = setTimeout(function () {
        ajaxDelProductFromBasket(url, productId, $button);
    }, 1500);
    ajaxTimerId.set(productId, timerId);
}
*/

function ajaxDelProductFromBasket(url, productId, $button) {
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'html',
        data: { action: 'del_product_from_basket', productId: productId },
        success: function (data) {
            doAfterBasketQuantityEqualZero($button, productId)
            return false;
        },
        error: function (xhr, str) {
            console.error(xhr.responseText);
            return false;
        },
        complete: function () {
        }
    });
}

function doAfterBasketQuantityEqualZero($button, productId) {
    if ($button != undefined) {
        var $buttonAddToBasket = $button.closest('.js_quantity_els_container').find('button.js_button_add_to_basket');
        $buttonAddToBasket.removeClass('button_state_alt-content');
        var $input_quantity = $button.closest('.js_quantity_els_container').find('input.js-quantity-input');
        $input_quantity.val('1');
    }
    var $button_decrease_quantity = $button.closest('.js_quantity_els_container').find('.js_decrease_quantity');
    var $input_quantity = $button.closest('.js_quantity_els_container').find('.js_input_quantity');

    if ($button_decrease_quantity.length > 0) {
        $button_decrease_quantity.attr('disabled', 'disabled');
        $button_decrease_quantity.removeClass('js_decrease_quantity');
    }
    if ($input_quantity.length > 0) {
        $input_quantity.attr('min', '1');
        $input_quantity.attr('data-min', '1');
        $input_quantity.removeClass('js_input_quantity');
    }
}
// <-- Удаление товара из корзины