$(document).ready(function () {
    initShowPopupReagent();
    initAddReagentToOrder();
    initClickShowMore();
    initValidateAjaxForm();
    initMaskPhone();
    initCheckStengthPassword();
    initCheckPhone();
    initBasket();
    initOfferProduct();
    initValidateNotOnlySpaces();
    initDelAccount();
    initCheckAuthPartner();
    initAuthPopup();
    //initSendFormCallback();
    initShowMegaMenu();

    BX.addCustomEvent('onAjaxSuccess', function () {
        //alert('!');
        initOnAjaxSuccess();
    });
});

function initShowMegaMenu() {
    $('.js_show_mega_menu').on('click', function (e) {
        //alert('!');
        //$('.js_result_form_callback').html('');
        const headerHamburger = $(".header__hamburger");
        if ($(headerHamburger).hasClass("burger--active")) {
            $(".c-menu").fadeOut()
            $(headerHamburger).toggleClass("burger--active")
        }
        else {
            $(headerHamburger).toggleClass("burger--active")
            $(".c-menu").fadeIn('medium', function () {
                $(this).css('display', 'inline-block');
            })
        }

        return false;
    });
}

function initOnAjaxSuccess() {
    //initSendFormCallback();
    //alert('!');
    initMaskPhone();
}

// Корзина -->
function initBasket() {
    initPopupOrderOpen();
    initChangeCountInList();
    initChangeQuantityInBasket();
    initDelItemFromBasket();
    initSelectrics();
    initFilterOrder();
    initGoTo();
    initSendOrderRequest();
    initDadataSuggestions();
    initSearchInputs();
}
// <-- Корзина

/*
// Отправка формы обратной связи -->
function initSendFormCallback() {
    $('.js_send_form_callback').on('click', function (e) {
        alert('!');
        //$('.js_result_form_callback').html('');
    });
}
// <-- Отправка формы обратной связи
/**/


// Проверка на то, чтобы в строке были не только пробелы -->
function initValidateNotOnlySpaces() {
    //alert('!!');
    // add a method. calls one built-in method, too.
    jQuery.validator.addMethod("notonlyspaces", function (value, element) {
        let result = true;
        if (value.length) {
            let str = value.split(' ').join('');
            let length = str.length;
            result = length > 0;
        }

        return result;
    }, "The text should not contain only spaces"
    );

    // connect it to a css class
    jQuery.validator.addClassRules({
        notonlyspaces: { notonlyspaces: true }
    });
}
// <-- Проверка на то, чтобы в строке были не только пробелы

// Dadata -->
function initDadataSuggestions() {
    //$('.js_buyer_legal_entity').on('keypress', function (e) {
    $('.js_buyer_legal_entity').on('keyup', function (e) {
        //alert('1');
        let funcParams = new Object();
        funcParams['value'] = $(this).val();
        beforeDadataSuggestions(funcParams);
    });
    /*
    $('.js_buyer_legal_entity').on('change', function (e) {
        let funcParams = new Object();
        funcParams['value'] = $(this).val();
        //alert($(this).val());
        beforeDadataSuggestions(funcParams);
    });
    */
}
var ajaxTimerId_initDadataSuggestions = 0;
function beforeDadataSuggestions(params) {
    //$('.js_suggestions_container').addClass('display-none');
    //$('.js_suggestions_container').html('');
    initSearchInputs();
    var url = '/local/ajax/dadata.php';
    //console.log(params.value);
    var ajaxData = { value: params.value };
    var params = {
        url: url,
        ajaxData: ajaxData,
    };
    if (Number(ajaxTimerId_initDadataSuggestions) > 0) {
        clearTimeout(ajaxTimerId_initDadataSuggestions);
    }
    ajaxTimerId_initDadataSuggestions = setTimeout(function () {
        ajaxDadataSuggestions(params);
    }, 500);
    return false;
}
function ajaxDadataSuggestions(params) {
    $.ajax({
        type: 'POST',
        url: params.url,
        data: params.ajaxData,
        //contentType: false,
        //processData: false,
        dataType: 'json',
        success: function (result) {
            //console.log(result);
            if (result.RESULT == 'SUCCESS') {
                let funcParams = new Object();
                funcParams['arr'] = result.SUGGESTIONS;
                afterDadataSuggestions(funcParams);
                //console.log(result);
            }
            else if (result.RESULT == 'ERROR') {
                //console.log(result.ERROR);
            }
        },
        error: function (xhr, str) {
            console.error(xhr.responseText);
            return false;
        },
        complete: function () {
            return false;
        }
    });
}
function afterDadataSuggestions(params) {
    let arr = params.arr;
    //console.log(params);
    $('.js_suggestions_container').html('');
    $('.js_send_order_request').addClass('link-button_password');
    $('.js_send_order_request').prop("disabled", true);
    for (var key in arr) {
        //console.log('value' + ': ' + arr[key]['value'] + ', inn:' + arr[key]['inn']);
        $('.js_suggestions_container').append('<a href="#" data-value="' + arr[key]['value'] + '" data-inn="' + arr[key]['inn'] + '" class="js_suggestions_link suggestions_link"><p>' + arr[key]['value'] + '</p><p>ИНН: ' + arr[key]['inn'] + '</p></a>');
    }
    initDropDownSuggestions();
}
function initDropDownSuggestions() {
    $('.js_suggestions_link').on("click", function (e) {
        let value = $(this).data('value');
        let inn = $(this).data('inn');

        $('.js_buyer_legal_entity').val(value + ' (ИНН ' + inn + ')');

        $('.js_suggestions_container').addClass('display-none');

        $('.js_send_order_request').removeClass('link-button_password');

        $('.js_send_order_request').prop("disabled", false);

        clearTimeout(ajaxTimerId_initDadataSuggestions);

        return false;
    });
}
// <-- Dadata

// Отправка заказа -->
function initSendOrderRequest() {
    var ajaxTimerId_initSendOrderRequest = 0;
    $('.js_send_order_request').on("click", function (e) {
        //$link = $(this);
        //alert('!');
        var url = '/local/ajax/order_send_req.php';
        //var ELEMENT_ID = $link.data('element');
        //let q = $('.js_order_search_query_popup').val();
        var ajaxData = { BUYER_LEGAL_ENTITY: $('.js_buyer_legal_entity').val() };
        var params = {
            url: url,
            ajaxData: ajaxData,
        };
        if (Number(ajaxTimerId_initSendOrderRequest) > 0) {
            clearTimeout(ajaxTimerId_initSendOrderRequest);
        }
        ajaxTimerId_initSendOrderRequest = setTimeout(function () { ajaxSendOrderRequest(params); }, 500);
        return false;
    });
}
function ajaxSendOrderRequest(params) {
    $.ajax({
        type: 'POST',
        url: params.url,
        data: params.ajaxData,
        //contentType: false,
        //processData: false,
        dataType: 'json',
        success: function (result) {
            //alert(result.RESULT);
            if (result.RESULT == 'SUCCESS') {
                openPopupOrderSendSuccess();
                refreshBasket();
            }
            else if (result.RESULT == 'ERROR') {
                console.log(result.ERROR);
            }
        },
        error: function (xhr, str) {
            console.error(xhr.responseText);
            return false;
        },
        complete: function () {
            return false;
        }
    });
}
function openPopupOrderSendSuccess() {
    const popup = document.querySelector('.js_popup_order_send_success');
    const popupClose = document.querySelector('.js_popup_close_order_send_success');
    if (popup && popupClose) {
        openPopup_custom(popup, popupClose)
    }
}
// <-- Отправка заказа

// Удаление аккаунта -->
var ajaxTimerId_initDelAccount = 0;
function initDelAccount() {
    $('.js_delete_account').on("click", function (e) {
        if (confirm('Удалить аккаунт?')) {
            var url = '/local/ajax/del_account.php';
            var ajaxData = { DEL: 'Y' };
            var params = {
                url: url,
                ajaxData: ajaxData,
            };
            if (Number(ajaxTimerId_initDelAccount) > 0) {
                clearTimeout(ajaxTimerId_initDelAccount);
            }
            ajaxTimerId_initDelAccount = setTimeout(function () { ajaxSendDelAccount(params); }, 500);
            return false;
        }
    });
}
function ajaxSendDelAccount(params) {
    $.ajax({
        type: 'POST',
        url: params.url,
        data: params.ajaxData,
        //contentType: false,
        //processData: false,
        dataType: 'json',
        success: function (result) {
            //alert(result.RESULT);
            afterDelAccount(result);
        },
        error: function (xhr, str) {
            console.error(xhr.responseText);
            return false;
        },
        complete: function () {
            return false;
        }
    });
}
function afterDelAccount(result) {
    if (result.RESULT == 'SUCCESS') {
        alert('Аккаунт успешно удалён.');
        setTimeout(function () { afterDelAccountReloadPage(); }, 2000);
    }
    else if (result.RESULT == 'ERROR') {
        alert('Не удалось удалить аккаунт.');
    }
}
function afterDelAccountReloadPage() {
    window.location.reload();
}
// <-- Удаление аккаунта

// Фильтр -->
function initFilterOrder() {
    var $sortSelect = $('.js_filter_order');
    if ($sortSelect.length > 0) {
        $sortSelect.selectric({
            onOpen: function () {
                //alert('Open');
            },
            onChange: function (event, element, selectric) {
                //alert('!');
                doFilterOrder();
            },
            onClose: function () {
                //alert('Close');
            }
        });
    }
}
function doFilterOrder() {
    var ajaxTimerId_doFilterOrder = 0;
    //$link = $(this);
    //var url = window.location.pathname + window.location.search;
    let url = window.location.href;
    var DIRECTION = $('.js_direction').val();
    var PRODUCT_TYPE = $('.js_product_type').val();
    //console.log(PRODUCT_TYPE);
    var ajaxData = { DIRECTION: DIRECTION, PRODUCT_TYPE: PRODUCT_TYPE };
    var params = {
        url: url,
        ajaxData: ajaxData,
    };
    if (Number(ajaxTimerId_doFilterOrder) > 0) {
        clearTimeout(ajaxTimerId_doFilterOrder);
    }
    ajaxTimerId_doFilterOrder = setTimeout(function () { ajaxRefreshBasket(params); }, 500);
    return false;
}
function ajaxFilterOrder() {

}
// <-- Фильтр

// Корзина -->
function refreshBasket() {
    var ajaxTimerId_refreshBasket = 0;
    //$link = $(this);
    //var url = window.location.pathname + window.location.search;
    let url = window.location.href;
    //var ELEMENT_ID = $link.data('element');
    var ajaxData = {};
    var params = {
        url: url,
        ajaxData: ajaxData,
    };
    if (Number(ajaxTimerId_refreshBasket) > 0) {
        clearTimeout(ajaxTimerId_refreshBasket);
    }
    ajaxTimerId_refreshBasket = setTimeout(function () { ajaxRefreshBasket(params); }, 500);
    return false;
}
function ajaxRefreshBasket(params) {
    //alert(params.url);
    //console.log(params.ajaxData);
    $.ajax({
        type: 'GET',
        url: params.url,
        data: params.ajaxData,
        //contentType: false,
        //processData: false,
        dataType: 'html',
        success: function (result) {
            //console.log(result);
            //alert('!');
            $('.js_basket_wrapper').html($('<div>' + result + '</div>').find('.js_basket_wrapper').html());
            $('.js_personal_left_menu').html($('<div>' + result + '</div>').find('.js_personal_left_menu').html());
            $('.js_basket_line_1').html($('<div>' + result + '</div>').find('.js_basket_line_1').html());
            $('.js_basket_line_2').html($('<div>' + result + '</div>').find('.js_basket_line_2').html());
        },
        error: function (xhr, str) {
            console.error(xhr.responseText);
            return false;
        },
        complete: function () {
            initBasket();
            return false;
        }
    });
}
// <-- Корзина

// Удаление из корзины -->
function initDelItemFromBasket() {
    var ajaxTimerId_initDelItemFromBasket = 0;
    $('.js_del_item_from_basket').on("click", function (e) {
        if (confirm('Удалить позицию из заказа?')) {
            $link = $(this);
            var url = '/local/ajax/del_item_from_basket.php';
            var ELEMENT_ID = $link.data('element');
            var ajaxData = { ELEMENT_ID: ELEMENT_ID };
            var params = {
                url: url,
                ajaxData: ajaxData,
            };
            if (Number(ajaxTimerId_initDelItemFromBasket) > 0) {
                clearTimeout(ajaxTimerId_initDelItemFromBasket);
            }
            ajaxTimerId_initDelItemFromBasket = setTimeout(function () { ajaxDelItemFromBasket(params); }, 500);
            return false;
        }
    });
}
function ajaxDelItemFromBasket(params) {
    $.ajax({
        type: 'POST',
        url: params.url,
        data: params.ajaxData,
        //contentType: false,
        //processData: false,
        dataType: 'json',
        success: function (result) {
            if (result.RESULT == 'SUCCESS') {
                refreshBasket();
            }
            else if (result.RESULT == 'ERROR') {
                console.log(result.ERROR);
            }
        },
        error: function (xhr, str) {
            console.error(xhr.responseText);
            return false;
        },
        complete: function () {
            return false;
        }
    });
}
// <-- Удаление из корзины

// Попап поиска в корзине -->
var ajaxTimerId_initPopupOrderOpen = 0;
function initPopupOrderOpen() {
    $('.js_open_order_popup').on("click", function (e) {
        doPopupOrderOpen();
    });
    $('.js_order_search_query').on('keypress', function (e) {
        if (e.which == 13 /*&& $(this).val().length > 3*/) {
            doPopupOrderOpen();
            return false;
        }
    });
}
function doPopupOrderOpen() {
    //$link = $(this);
    var url = '/local/ajax/order_popup.php';
    //var ELEMENT_ID = $link.data('element');
    let q = $('.js_order_search_query').val();
    var ajaxData = { q: q };
    var params = {
        url: url,
        ajaxData: ajaxData,
    };
    if (Number(ajaxTimerId_initPopupOrderOpen) > 0) {
        clearTimeout(ajaxTimerId_initPopupOrderOpen);
    }
    ajaxTimerId_initPopupOrderOpen = setTimeout(function () { ajaxPopupOrderOpen(params); }, 500);
    return false;
}
function ajaxPopupOrderOpen(params) {
    $.ajax({
        type: 'GET',
        url: params.url,
        data: params.ajaxData,
        //contentType: false,
        //processData: false,
        dataType: 'html',
        success: function (result) {
            $('.js_popup_order').html($('<div>' + result + '</div>').find('.js_popup_order').html());
        },
        error: function (xhr, str) {
            console.error(xhr.responseText);
            return false;
        },
        complete: function () {
            initPopupOrder_custom();
            initAddToBasket();
            initChangeCountInList();
            initAddReagentToOrder();
            initSearchInPopup();
            return false;
        }
    });
}
function initPopupOrder_custom() {
    const popup = document.querySelector('.js_popup_order');
    const popupClose = document.querySelector('.js_popup_close_order');
    if (popup && popupClose) {
        openPopup_custom(popup, popupClose)
    }
}
function initAddToBasket() {
}
function initChangeCountInList() {
    $('.js_list_minus_quantity, .js_list_plus_quantity').on("click", function (e) {
        var elId = $(this).data('el-id');
        var inputIdPrefix = $(this).data('inputidprefix');
        var quantity_str = $('#' + inputIdPrefix + elId).val();
        var quantity_num = Number(quantity_str);
        if ($(this).data('action') == 'minus') {
            quantity_num--;
        }
        else if ($(this).data('action') == 'plus') {
            quantity_num++;
        }
        if (quantity_num <= 1) {
            quantity_num = 1;
        }
        quantity_str = String(quantity_num);
        $('#' + inputIdPrefix + elId).val(quantity_str);
        doChangeQuantityInBasket($('#' + inputIdPrefix + elId));
        return false;
    });
}
// <-- Попап поиска в корзине


// Поднимать попап авторизации -->
function initAuthPopup() {
    $('.js_auth_popup').on("click", function (e) {
        initPopupAdd2BasketNoAuth();
        initValidateAjaxForm();
        return false;
    });
}
// <-- Поднимать попап авторизации

// Проверка на авторизацию и партнерство -->
function initCheckAuthPartner() {
    var ajaxTimerId_CheckAuthPartner = 0;
    $('.js_check_auth_partner').on("click", function (e) {
        $link = $(this);
        var url = '/local/ajax/check_auth_partner.php';
        //var ELEMENT_ID = $link.data('element');
        //var QUANTITY = $('#' + $link.data('quantity-input-id')).val();
        //if (Number(QUANTITY) < 1) {
        //    QUANTITY = '1';
        //}
        //var fromPopup = $link.data('from-popup');
        //var ajaxData = { ELEMENT_ID: ELEMENT_ID, QUANTITY: QUANTITY };
        var ajaxData = {};
        //var hideButtonClass = $link.data('hide-button-class');
        //var showButtonClass = $link.data('show-button-class');
        let regUrl = '/registration/partner/';
        let linkUrl = $link.attr('href');
        var params = {
            url: url,
            ajaxData: ajaxData,
            //hideButtonClass: hideButtonClass,
            //showButtonClass: showButtonClass,
            regUrl: regUrl,
            linkUrl: linkUrl,
            //fromPopup: fromPopup
        };
        if (Number(ajaxTimerId_CheckAuthPartner) > 0) {
            clearTimeout(ajaxTimerId_CheckAuthPartner);
        }
        ajaxTimerId_CheckAuthPartner = setTimeout(function () { ajaxCheckAuthPartner(params); }, 500);
        return false;
    });
}
function ajaxCheckAuthPartner(params) {
    $.ajax({
        type: 'POST',
        url: params.url,
        data: params.ajaxData,
        //contentType: false,
        //processData: false,
        dataType: 'json',
        success: function (result) {
            if (result.TYPE == 'NEED_AUTH') {
                $('.js_auth_type').val('PARTNER');
                initPopupAdd2BasketNoAuth();
                initValidateAjaxForm();
            } else if (result.TYPE == 'NEED_PARTNER_REG') {
                window.open(params.regUrl, '_blank').focus();
            } else {
                window.open(params.linkUrl, '_self').focus();
            }
        },
        error: function (xhr, str) {
            console.error(xhr.responseText);
            return false;
        },
        complete: function () {
        }
    });
}
// <-- Проверка на авторизацию и партнерство


// Добавление реагента в корзину из списка -->
function initAddReagentToOrder() {
    var ajaxTimerId_AddReagentToOrder = 0;
    $('.js_add_reagent_to_order').on("click", function (e) {
        //alert('!');
        $link = $(this);
        var url = '/local/ajax/reagent_add2order.php';
        var ELEMENT_ID = $link.data('element');
        var QUANTITY = $('#' + $link.data('quantity-input-id')).val();
        if (Number(QUANTITY) < 1) {
            QUANTITY = '1';
        }
        var fromPopup = $link.data('from-popup');
        var ajaxData = { ELEMENT_ID: ELEMENT_ID, QUANTITY: QUANTITY };
        var hideButtonClass = $link.data('hide-button-class');
        var showButtonClass = $link.data('show-button-class');
        var params = {
            url: url,
            ajaxData: ajaxData,
            hideButtonClass: hideButtonClass,
            showButtonClass: showButtonClass,
            regUrl: $link.data('reg-url'),
            fromPopup: fromPopup
        };
        if (Number(ajaxTimerId_AddReagentToOrder) > 0) {
            clearTimeout(ajaxTimerId_AddReagentToOrder);
        }
        ajaxTimerId_AddReagentToOrder = setTimeout(function () { ajaxReagentAddToOrder(params); }, 500);
        return false;
    });
}
function ajaxReagentAddToOrder(params) {
    $.ajax({
        type: 'POST',
        url: params.url,
        data: params.ajaxData,
        //contentType: false,
        //processData: false,
        dataType: 'json',
        success: function (result) {
            //console.log(result.RESULT);
            if (result.RESULT == 'SUCCESS') {
                $('.' + params.hideButtonClass).removeClass('display-none');
                $('.' + params.showButtonClass).addClass('display-none');
            }
            else if (result.RESULT == 'ERROR') {
                console.log(result.ERROR);
                /*
                if (result.ERROR_TYPE == 'NEED_PARTNER_REG' && params.regUrl.length > 0) {
                    window.open(params.regUrl, '_blank').focus();
                }
                */
                if (result.ERROR_TYPE == 'NEED_PARTNER_REG') {
                    $('.js_auth_type').val('PARTNER');
                    initPopupAdd2BasketNoAuth();
                    initValidateAjaxForm();
                }
            }
        },
        error: function (xhr, str) {
            console.error(xhr.responseText);
            return false;
        },
        complete: function () {
            if (params.fromPopup == 'Y') {
                refreshBasket();
            }
        }
    });
}
function initPopupAdd2BasketNoAuth() {
    const popupWindow = document.querySelector('.popup-authorization');
    const popupClose = document.querySelector('.popup-authorization .popup_close');
    if (popupWindow && popupClose) {
        openPopup_custom(popupWindow, popupClose)
    }
}
function initShowPopupReagent() {
    var ajaxTimerId_ShowPopupReagent = 0;
    $('.js_reagent_link').on("click", function (e) {
        //alert('!');
        var $link = $(this);
        var url = '/local/ajax/reagent_popup.php';
        var IBLOCK_ID = $link.data('iblock-id');
        var IBLOCK_CODE = $link.data('iblock-code');
        var ELEMENT_ID = $link.data('element');
        var ELEMENT_NAME = $link.data('name');
        //ELEMENT_NAME = translit(ELEMENT_NAME);
        //alert(ELEMENT_NAME);
        var ajaxData = {
            IBLOCK_ID: IBLOCK_ID,
            ELEMENT_ID: ELEMENT_ID,
            IBLOCK_CODE: IBLOCK_CODE,
            ELEMENT_NAME: ELEMENT_NAME
        };

        var params = {
            url: url,
            ajaxData: ajaxData
        };
        //console.log(params);
        if (Number(ajaxTimerId_ShowPopupReagent) > 0) {
            clearTimeout(ajaxTimerId_ShowPopupReagent);
        }
        ajaxTimerId_ShowPopupReagent = setTimeout(function () { ajaxOpenPopupReagent(params); }, 500);

        return false;
    });
}
function ajaxOpenPopupReagent(params) {
    $.ajax({
        type: 'POST',
        url: params.url,
        data: params.ajaxData,
        //contentType: false,
        //processData: false,
        dataType: 'html',
        success: function (result) {
            //$('.js_popup_reagent').html(result);
            $('.popup-reagent__wrapper').html($('<div>' + result + '</div>').find('.popup-reagent__wrapper').html());
            $('.popup-reagent__title').html($('<div>' + result + '</div>').find('.popup-reagent__title').html());
            openPopupReagentCustomDo();
            //return false;
        },
        error: function (xhr, str) {
            console.error(xhr.responseText);
            return false;
        },
        complete: function () {
            initSelectrics();
            addParamToUrl(params.ajaxData.ELEMENT_NAME);
            initAddReagentToOrder();
            return false;
        }
    });
}
// <-- Добавление реагента в корзину из списка

// Поиск в попап окне -->
var ajaxTimerId_initSearchInPopup = 0;
function initSearchInPopup() {
    $('.js_popup_search_button').on("click", function (e) {
        doSearchInPopup();
    });
    $('.js_order_search_query_popup').on('keypress', function (e) {
        if (e.which == 13 /*&& $(this).val().length > 3*/) {
            doSearchInPopup();
        }
    });
    initSearchInputs();
    initSearchInputOrderPopup();
}
function initSearchInputOrderPopup() {
    let length = $('.js_order_search_query_popup').val().length;
    if (length > 0) {
        $('.js_popup_search_clear').removeClass('display-none');
    } else {
        $('.js_popup_search_clear').addClass('display-none');
    }
}
function doSearchInPopup() {
    //$link = $(this);
    var url = '/local/ajax/order_popup.php';
    //var ELEMENT_ID = $link.data('element');
    let q = $('.js_order_search_query_popup').val();
    var ajaxData = { q: q };
    var params = {
        url: url,
        ajaxData: ajaxData,
    };
    if (Number(ajaxTimerId_initSearchInPopup) > 0) {
        clearTimeout(ajaxTimerId_initSearchInPopup);
    }
    ajaxTimerId_initSearchInPopup = setTimeout(function () { ajaxPopupOrderOpen(params); }, 500);
    return false;
}
// <-- Поиск в попап окне

// Валидация форм -->
function initValidateAjaxForm() {
    $('form.js_validate_ajax:not(.validate-installed)').each(function () {

        //$('form.js_validate_ajax').validate({
        $(this).validate({
            errorClass: 'c-form__error',
            errorElement: 'div',
            focusInvalid: false,
            ignore: [],
            errorPlacement: function (error, element) {
                //element.addClass('dp-input-error');
                //element.closest('.js_validate_field_container').append(error);
                element.closest('.js_validate_field_container').after(error);
            },
            submitHandler: function (form) {
                var $form = $(form);
                var formData = new FormData($form[0]);
                var container_id = $(form).data('container-id');
                var scroll_to = $(form).data('scroll-to');
                var typeForm = $(form).data('type-form');


                $form.find('input,textarea,select,button').attr('disabled', 'disabled');

                // Лоадер -->    
                var $formButtonSubmit = $form.find('[type="submit"]');
                var formButtonSubmitHtml = $formButtonSubmit.html();
                var str = ''.repeat(formButtonSubmitHtml.length);
                var width = $formButtonSubmit.width();
                var height = $formButtonSubmit.height();
                $formButtonSubmit.width(width);
                $formButtonSubmit.height(height);
                $formButtonSubmit.addClass('btn--loading').prop('disabled', true);
                $formButtonSubmit.html(str);
                // <-- Лоадер

                //alert($form.attr('action'));

                $.ajax({
                    type: 'POST',
                    url: $form.attr('action'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'html',
                    success: function (result) {
                        if (scroll_to) {
                            scrollTo(scroll_to);
                        }
                        let funcParams = new Object();
                        funcParams['typeForm'] = typeForm;
                        funcParams['result'] = result;
                        funcParams['container_id'] = container_id;
                        afterSendValidateForm(funcParams);

                        initAfterValidateForm();
                    },
                    error: function (xhr, str) {
                        console.error(xhr.responseText);
                        initAfterValidateForm();
                    },
                    complete: function () {
                        //$form.trigger('reset');
                        $formButtonSubmit.removeClass('btn--loading').prop('disabled', false);
                        $formButtonSubmit.html(formButtonSubmitHtml);

                        $form.find('input,textarea,select,button').attr('disabled', false);
                    }
                });

                return false;
            }
        });

        $(this).addClass('validate-installed');
    });
}
function afterSendValidateForm(params) {
    //console.log(params.container_id);
    //console.log(params);

    switch (params.typeForm) {
        case 'OFFER':
            //alert(params.result.match(/SUCCESS/));
            if (params.result.match(/SUCCESS/)) {
                openPopupOfferSuccess();
            }
            $('#' + params.container_id).html($('<div>' + params.result + '</div>').find('#' + params.container_id).html());
            break;

        case 'PARTNER_REG':
            if (params.result.match(/REG_SUCCESS/)) {
                initPopupConfirmation_custom();
            }
            $('#' + params.container_id).html($('<div>' + params.result + '</div>').find('#' + params.container_id).html());
            break;

        case 'CHANGE_PASSWORD':
            if (params.result.match(/SUCCESS/)) {
                openChangePasswordPopup();
            }
            $('#' + params.container_id).html($('<div>' + params.result + '</div>').find('#' + params.container_id).html());
            break;

        case 'PROFILE_PERSONAL':
        case 'PROFILE_CH_PAS':
        case 'AUTH_POPUP':
            //alert(params.container_id);
            //alert($('<div>' + params.result + '</div>').find('#' + params.container_id).html());
            $('#' + params.container_id).html($('<div>' + params.result + '</div>').find('#' + params.container_id).html());
            break;
    }
}
function initShowPasswords() {
    const showPasswordButtons = document.querySelectorAll('.registration-form__show-password')
    if (showPasswordButtons) {
        showPasswordButtons.forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault()
                item.parentNode.querySelector('.registration-input').type = 'text'
                item.classList.add('display-none')
                item.parentNode.querySelector('.registration-form__hide-password').classList.remove('display-none')
            })
        })
    }
}
function initAfterValidateForm() {
    initValidateAjaxForm();
    initMaskPhone();
    initSelectrics();
    initOfferProduct();
    initShowPasswords();
}
// <-- Валидация форм

// Заявка на КП -->
function initOfferProduct() {
    let $select = $('.js_offer_product_select');
    var str = $select.val();
    $('.js_offer_product_name').val(str);
    if ($select.length > 0) {
        $select.selectric({
            onOpen: function () {
                //alert('Open');
            },
            onChange: function (event, element, selectric) {
                //alert('!');
                var str = $(this).val();
                //alert(str);
                $('.js_offer_product_name').val(str);
            },
            onClose: function () {
                //alert('Close');
            }
        });
    }
}
function openPopupOfferSuccess() {
    const popup = document.querySelector('.js_popup_offer_success');
    const popupClose = document.querySelector('.js_popup_offer_success_close');
    if (popup && popupClose) {
        openPopup_custom(popup, popupClose)
    }
}
// <-- Заявка на КП


// Изменение пароля -->
function openChangePasswordPopup() {
    const popup = document.querySelector('.js_popup_change_password');
    const popupClose = document.querySelector('.js_popup_change_password_close');
    if (popup && popupClose) {
        openPopup_custom(popup, popupClose)
    }
}
// <-- Изменение пароля

// Попап подтверждения -->
function initPopupConfirmation_custom() {
    const popupConfirmation = document.querySelector('.popup-confirmation');
    const popupClose = document.querySelector('.popup_close');
    if (popupConfirmation /*&& popupConfirmationOpen*/ && popupClose) {
        openPopup_custom(popupConfirmation, popupClose)
    }
}
// <-- Попап подтверждения

// Открытие попап окна -->
function openPopup_custom(popupName, buttonClose) {
    if (popupName && buttonClose) {
        popupName.classList.add('display-on')
        overlay.classList.add('display-on')
        closePopup(popupName, buttonClose, overlay)
    }
}
// <-- Открытие попап окна


// Изменение количества товаров в корзине -->
function initChangeQuantityInBasket() {
    $('.js_list_input_quantity_basket').on("change", function (e) {
        //alert('!');
        $input = $(this);
        doChangeQuantityInBasket($input);
    });
}
function doChangeQuantityInBasket(element) {
    var ajaxTimerId_initChangeQuantityInBasket = 0;
    $input = $(element);
    var url = '/local/ajax/reagent_add2order.php';
    var ELEMENT_ID = $input.data('el-id');
    //alert(ELEMENT_ID);
    var QUANTITY = $input.val();
    if (Number(QUANTITY) < 1) {
        QUANTITY = '1';
    }
    var ajaxData = { ELEMENT_ID: ELEMENT_ID, QUANTITY: QUANTITY, ACTION: 'CHANGE_QUANTITY' };
    var params = {
        url: url,
        ajaxData: ajaxData,
    };
    if (Number(ajaxTimerId_initChangeQuantityInBasket) > 0) {
        clearTimeout(ajaxTimerId_initChangeQuantityInBasket);
    }
    ajaxTimerId_initChangeQuantityInBasket = setTimeout(function () { ajaxChangeQuantityInBasket(params); }, 500);
    return false;
}
function ajaxChangeQuantityInBasket(params) {
    $.ajax({
        type: 'POST',
        url: params.url,
        data: params.ajaxData,
        //contentType: false,
        //processData: false,
        dataType: 'json',
        success: function (result) {
            //console.log(result.RESULT);
            if (result.RESULT == 'SUCCESS') {
                //$('.' + params.hideButtonClass).removeClass('display-none');
                //$('.' + params.showButtonClass).addClass('display-none');
            }
            else if (result.RESULT == 'ERROR') {
                console.log(result.ERROR);
            }
        },
        error: function (xhr, str) {
            console.error(xhr.responseText);
            return false;
        },
        complete: function () {
        }
    });
}
// <-- Изменение количества товаров в корзине




function addParamToUrl(name) {

    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('consumable', name);
    window.history.pushState("object or string", "Title", '?' + urlParams);

    /*
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('consumable', name);
    window.location.search = urlParams;
    */

    /*
    if (history.pushState) {
        var baseUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
        var newUrl = baseUrl + '?consumable=' + name;
        history.pushState(null, null, newUrl);
    }
    else {
        console.warn('History API не поддерживается');
    }
    */

    /*
    const url = new URL(window.location.href);
    url.searchParams.set('consumable', name);
    url.searchParams.delete('consumable');
    window.history.replaceState(null, null, url);
    alert('!');
    */
}

function setCssToPopup() {
    var $el = $('.js_popup_reagent .popup-reagent__wrapper');
    $el.css('display', 'block');
    $el.css('overflow-y', 'auto');
    $el.css('-webkit-overflow-scrolling', 'touch');
}

function openPopupReagentCustomDo() {
    const overlay = document.querySelector('.overlay');
    const popupName = document.querySelector('.popup-reagent');
    const buttonClose = document.querySelector('.popup-reagent .popup_close');
    if (popupName && buttonClose) {
        popupName.classList.add('display-on');
        overlay.classList.add('display-on');
        closePopup(popupName, buttonClose, overlay);
    }
}

function initMaskPhone() {
    $('.js_phone_class').inputmask("+7-999-999-99-99");
}


function initCheckStengthPassword() {
    // add a method. calls one built-in method, too.
    jQuery.validator.addMethod("stength", function (value, element) {
        var stength = 1;

        //contains characters
        if (value.match(/[a-z]+/)) {
            stength++;
        }

        //contains characters
        if (value.match(/[A-Z]+/)) {
            stength++;
        }

        //contains digits
        if (value.match(/[0-9]+/)) {
            stength++;
        }

        return stength == 4;
    }, "The password must contain numbers and Latin characters, lowercase (a-z) and uppercase (A-Z)"
    );

    // connect it to a css class
    jQuery.validator.addClassRules({
        stength: { stength: true }
    });
}

function initCheckPhone() {
    // add a method. calls one built-in method, too.
    jQuery.validator.addMethod("phone", function (value, element) {
        var phone = 1;
        let numbers = value.replace(/\D/g, '');
        let length = numbers.length;

        return length == 11;
    }, "Phone length must be 11 digits"
    );

    // connect it to a css class
    jQuery.validator.addClassRules({
        phone: { phone: true }
    });
}

function initClickShowMore() {
    $('.js_more_items').on('click', function (e) {
        e.preventDefault();
        var idNav = $(this).data('id-nav');
        var NavNum = $(this).data('nav-num');
        var NavPageNomer = $(this).data('page-nomer');
        var NavPageCount = $(this).data('max-page');

        //alert(NavNum);

        var btn = $('#' + idNav);
        var content = $('.js_nav_result_' + NavNum);
        var nav = {
            this_page: NavPageNomer,
            max_page: NavPageCount
        };

        if (!btn.hasClass('loading') && content.length > 0) {

            btn.addClass('loading');
            if (nav.this_page < nav.max_page) {
                nav.this_page++;
                var url = window.location.pathname + window.location.search;
                //alert(url);
                var data = new Object();
                data['PAGEN_' + NavNum] = nav.this_page;
                data['AJAX_LOAD'] = 'Y';
                //alert(url);
                $.ajax({
                    dataType: 'html',
                    url: url,
                    data: data,
                    success: function (r) {
                        //alert('.js_nav_result_' + NavNum);
                        var append = $(r).find('.js_nav_result_' + NavNum).html();
                        //alert(append);
                        $('.js_nav_result_' + NavNum).append(append);
                        $('.js_nav_string_' + NavNum).html($(r).find('.js_nav_string_' + NavNum).html());
                        btn.removeClass('loading');
                        initClickShowMore();
                    }
                });
            }
        }
    });
}

function translit(word) {
    var answer = '';
    var converter = {
        'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd',
        'е': 'e', 'ё': 'e', 'ж': 'zh', 'з': 'z', 'и': 'i',
        'й': 'y', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n',
        'о': 'o', 'п': 'p', 'р': 'r', 'с': 's', 'т': 't',
        'у': 'u', 'ф': 'f', 'х': 'h', 'ц': 'c', 'ч': 'ch',
        'ш': 'sh', 'щ': 'sch', 'ь': '', 'ы': 'y', 'ъ': '',
        'э': 'e', 'ю': 'yu', 'я': 'ya',

        'А': 'A', 'Б': 'B', 'В': 'V', 'Г': 'G', 'Д': 'D',
        'Е': 'E', 'Ё': 'E', 'Ж': 'Zh', 'З': 'Z', 'И': 'I',
        'Й': 'Y', 'К': 'K', 'Л': 'L', 'М': 'M', 'Н': 'N',
        'О': 'O', 'П': 'P', 'Р': 'R', 'С': 'S', 'Т': 'T',
        'У': 'U', 'Ф': 'F', 'Х': 'H', 'Ц': 'C', 'Ч': 'Ch',
        'Ш': 'Sh', 'Щ': 'Sch', 'Ь': '', 'Ы': 'Y', 'Ъ': '',
        'Э': 'E', 'Ю': 'Yu', 'Я': 'Ya'
    };

    for (var i = 0; i < word.length; ++i) {
        if (converter[word[i]] == undefined) {
            answer += word[i];
        } else {
            answer += converter[word[i]];
        }
    }

    return answer;
}
function scrollTo(hash) {
    //location.hash = "#" + hash;
    //alert('!');
    //document.getElementById(hash).scrollIntoView();
    $('html, body').animate({
        scrollTop: $("#" + hash).offset().top
    }, 100);
}
function initGoTo() {
    $('.js_go_to').on("click", function (e) {
        $link = $(this);
        var anchor = $link.data('anchor');
        if (anchor) {
            scrollTo(anchor);
        }
    });
}