$(document).ready(function () {
    init();
    initMobileCart();

    $.validator.addMethod(
        'phone',
        function (value, element) {
            return (value.replace(/\D/g, '').length == 11) || value == '';
        },
        'Phone number is incorrect'
    );

    $.each($.validator.methods, function (key, value) {
        $.validator.methods[key] = function () {
            if (arguments.length > 0) {
                arguments[0] = $.trim(arguments[0]);
            }

            return value.apply(this, arguments);
        };
    });

    BX.addCustomEvent('onAjaxSuccess', function () {
        initOnAjaxSuccess();
        alignHeightElement();
        initPriceDivisionIntoRanks();
    });

    $('#basket-choose-all').on('change', function () {
        $('.basket__goods .js-choose-basket-item').prop('checked', $(this).is(':checked')).trigger('change');
    });

    $('body').on('change', '.js-choose-basket-item', function () {
        var chooseItemCheckedCount = $('.basket__goods .js-choose-basket-item:checked').length;
        var chooseItemAllCount = $('.basket__goods .js-choose-basket-item').length;

        if (chooseItemCheckedCount > 0) {
            $('.basket__delete').fadeIn(200);
        } else {
            $('.basket__delete').fadeOut(200);
            $('#basket-choose-all').prop('checked', false);
        }

        if (chooseItemCheckedCount == chooseItemAllCount)
            $('#basket-choose-all').prop('checked', true);
    });

    $('.basket__delete').on('click', function () {
        $('.basket__goods .js-choose-basket-item:checked').each(function () {
            var $row = $(this).closest('[data-entity="basket-item"]');
            $row.find('[data-entity="basket-item-delete"]').trigger('click');
        });
    });

    $('[data-entity="mobile-basket-checkout-button"]').on('click', function () {
        $('[data-entity="basket-checkout-button"]').trigger('click');
    });

    $('[data-entity="mobile-basket-one-click"]').on('click', function () {
        $('#js_quick_order').trigger('click');
    });
});

function initMobileCart() {
    var $basketLabel = $('.header__search .header__search_basket span');
    if ($basketLabel.length > 0) {
        $('.header__bottom .header__search_basket span').remove();
        $('.header__bottom .header__search_basket svg').after($basketLabel.clone());
    }
}

function init() {
    initValidateNotOnlySpaces();
    initFilterClickValue();
    initSortCatalog();
    initClickButtons();
    getFilters();
    initClickShowMore();
    initClickColorsWeightsPopup();
    initClickColorsWeightsInOpenPopup();
    //initRegClick();
}

BX.addCustomEvent('onAjaxSuccess', function (res) {
    getFilters();
});

/*
function initRegClick() {
    $('.js_header__registration').on('click', function (e) {
        e.preventDefault();

        registrationPopup.classList.add('display-on')
        overlay.classList.add('display-on')
    });

    $('.js_header__registration_mobile').on('click', function (e) {
        e.preventDefault();

        registrationPopup.classList.add('display-on')
        overlay.classList.add('display-on')
    });
}
*/

// Попап выбора цветов и весов -->
var ajaxTimerId_ClickColorsWeightsInOpenPopup = 0;

function initClickColorsWeightsPopup() {
    $('.js_popup_colors_weights_link').on('click', function (e) {
        e.preventDefault();
        var url = $(this).data('url');
        var weight = $(this).data('weight');

        if ($(this).hasClass('js_popup_weights_link')) {
            $('.js_popup_colors_link[data-weight]').each(function () {
                var $colorItem = $(this).closest('.card-title__colors');
                if ($(this).data('weight') == weight) {
                    $colorItem.removeClass('display-none');
                } else {
                    $colorItem.addClass('display-none');
                }
            });

            var $lastColorActive = $('.order-color .card-title__colors-active').removeClass('card-title__colors-active').closest('.js_popup_colors_weights_link');
            var $currentColorActive = $('.order-color .js_popup_colors_weights_link[data-color="' + $lastColorActive.data('color') + '"]:visible').eq(0);
            if ($currentColorActive.length == 0) {
                $currentColorActive = $('.order-color .card-title__colors:visible:first');
            }

            url = $currentColorActive.data('url');
            $currentColorActive.find('.card-title__colors-block').addClass('card-title__colors-active');
        }

        if (typeof url != 'undefined') {
            $('#js_id_popup_colors_weights_link').val(url);
            initClickColorsWeightsInOpenPopup(url);
        }
    });

    $('.js_popup_colors_weights_choose_button').on('click', function (e) {
        e.preventDefault();
        var url = $('#js_id_popup_colors_weights_link').val();
        window.location.href = url;
    });
}
function initClickColorsWeightsInOpenPopup(url) {
    var click = $('#click_popup_colors_weights').val();
    if (click == 'Y') {
        $('#click_popup_colors_weights').val('N');
        var ajaxData = new Object();
        var params = {
            url: url,
            ajaxData: ajaxData
        };
        if (Number(ajaxTimerId_ClickColorsWeightsInOpenPopup) > 0) {
            clearTimeout(ajaxTimerId_ClickColorsWeightsInOpenPopup);
        }
        ajaxTimerId_ClickColorsWeightsInOpenPopup = setTimeout(function () { ajaxClickColorsWeightsInOpenPopup(params); }, 500);
    }
}
function ajaxClickColorsWeightsInOpenPopup(params) {

    var cacheItemData = {};
    if (typeof params.url != 'undefined') {

        $.each(window.arProductsGroup, function (index, item) {
            if (item.DETAIL_PAGE_URL == params.url) {
                cacheItemData = item;
                return false;
            }
        });
    }

    if (Object.keys(cacheItemData).length > 0 && cacheItemData.constructor === Object) {

        if (typeof cacheItemData.DETAIL_PICTURE_SRC != 'undefined' && cacheItemData.DETAIL_PICTURE_SRC.length > 0)
            $('.js_popup_colors_weights_name_wrapper img').attr('src', cacheItemData.DETAIL_PICTURE_SRC);

        if (typeof cacheItemData.NAME != 'undefined' && cacheItemData.NAME.length > 0)
            $('.js_popup_colors_weights_name_wrapper .order-color__title').text(cacheItemData.NAME);

        if (typeof cacheItemData.PRICE != 'undefined') {
            $('.js_popup_colors_weights_name_wrapper .order-color__price_coast').text(cacheItemData.PRICE);

            if (cacheItemData.PRICE.length > 0) {
                $('.js_popup_colors_weights_name_wrapper .order-color__price').removeClass('display-none');
            } else {
                $('.js_popup_colors_weights_name_wrapper .order-color__price').addClass('display-none');
            }
        }

        if (typeof cacheItemData.COLOR != 'undefined' && typeof cacheItemData.COLOR.UF_NAME != 'undefined')
            $('.js_popup_colors_weights_color_wrapper span').text(cacheItemData.COLOR.UF_NAME);


        $('#click_popup_colors_weights').val('Y');
    } else {
        $.ajax({
            type: 'POST',
            url: params.url,
            data: params.ajaxData,
            //contentType: false,
            //processData: false,
            dataType: 'html',
            success: function (result) {
                $('.js_popup_colors_weights_name_wrapper').html($(result).find('.js_popup_colors_weights_name_wrapper').html());
                $('.js_popup_colors_weights_color_wrapper').html($(result).find('.js_popup_colors_weights_color_wrapper').html());
                $('#click_popup_colors_weights').val('Y');
            },
            error: function (xhr, str) {
                console.error(xhr.responseText);
                return false;
            },
            complete: function () {
            }
        });
    }
}
// <-- Попап выбора цветов и весов

function initClickShowMore() {
    $('.js_more_items').on('click', function (e) {
        e.preventDefault();
        var idNav = $(this).data('id-nav');
        var NavNum = $(this).data('nav-num');
        var NavPageNomer = $(this).data('page-nomer');
        var NavPageCount = $(this).data('max-page');

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
                var data = new Object();
                data['PAGEN_' + NavNum] = nav.this_page;
                data['AJAX_LOAD'] = 'Y';
                $.ajax({
                    dataType: 'html',
                    url: url,
                    data: data,
                    success: function (r) {
                        var append = $(r).find('.js_nav_result_' + NavNum).html();
                        $('.js_nav_result_' + NavNum).append(append);
                        $('.js_nav_string_' + NavNum).html($(r).find('.js_nav_string_' + NavNum).html());
                        btn.removeClass('loading');
                        initClickShowMore();
                        initShowImagePopup();
                    }
                });
            }
        }
    });
}


function initShowImagePopup() {
    const popupCertificate = document.querySelector('.popup-certificate')
    const buttonCardCertificate = document.querySelector('.card-title__characteristics-certificate')

    if (popupCertificate && buttonCardCertificate) {
        const popupCertificateClose = popupCertificate.querySelector('.popup-form__popup_close')
        if (typeof getLinkCertificate != 'undefined')
            getLinkCertificate(popupCertificate, buttonCardCertificate, popupCertificateClose)
    }
    const buttonsCardCertificate = document.querySelectorAll('.certificates__button')
    if (popupCertificate && buttonsCardCertificate) {
        buttonsCardCertificate.forEach((element) => {
            const popupCertificateClose = popupCertificate.querySelector('.popup-form__popup_close')
            if (typeof getLinkCertificate != 'undefined')
                getLinkCertificate(popupCertificate, element, popupCertificateClose)
        })
    }
    const buttonCertificates = document.querySelectorAll('.certificate__button')
    if (popupCertificate && buttonCertificates) {
        const popupCertificateClose = popupCertificate.querySelector('.popup-form__popup_close')
        buttonCertificates.forEach((element) => {
            if (typeof getLinkCertificate != 'undefined')
                getLinkCertificate(popupCertificate, element, popupCertificateClose)
        })
    }
}

function initOnAjaxSuccess() {
    init();
    filterAccordionInside();
    filterAccordion();
    initSliderInList();
    initMobileCart();
    initShowImagePopup();
}

function initSliderInList() {
    if ($('#js_run_filter').val() == 'Y') {
        hvrSliderCards = true;
        setTimeout(hvrSliderCard, 2000);
        $('#js_run_filter').val('N');
    }
}
function initClickButtons() {
    initClickProductOnOrder();
    initClickRequestWholesalePrice();
    initClickChooseAnalogue();
    initClickQuickOrder();
}

// Фильтр -->
function initFilterClickValue() {
    $('.filter__item input').on("click", function (e) {
        $('#js_run_filter').val('Y');
    });
}
function runFilter() {
    $('#js_run_filter').val('Y');
    $('#checkbox_start_filter').click();
}
// <-- Фильтр

// Быстрый заказ -->
function initClickQuickOrder() {
    $('#js_quick_order').on("click", function (e) {
        const product_id = $(this).data('product-id');
        var $button = $(this);
        if (!$button.hasClass('js_click')) {
            $button.addClass('js_click');
            quickOrderOpenPopup(product_id, $button);
        }
    });
}
function quickOrderOpenPopup(product_id, $button) {
    const url = $('#jsOrderAjaxUrl').val();
    const data = { productId: product_id, action: 'show_popup_form' };

    quickOrderAjaxCall(url, data, $button);
}
function quickOrderAjaxCall(url, data, $button) {
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'html',
        data: data,
        success: function (data) {
            $('#js_popup_quick_order').html(data);

            initPopupOrderFast();
            initPriceDivisionIntoRanks();
            initClickButtons();
            showPopupQuickOrder();
            initChangeCountInBasket();
            initQuickOrderPopupForm();
            initPopupToCard();

            BX.onCustomEvent('OnBasketChange');

            $button.removeClass('js_click');
        }
    });
}
function closePopupQuickOrder() {
    const order = $('.popup.order-card');
    order.removeClass('display-on');
    $('.overlay').removeClass('display-on');
}
function showPopupQuickOrder() {
    $('.overlay').addClass('display-on');
    const order = $('.popup.order-card');
    order.addClass('display-on');
    const closeBtn = order.find(".popup-form__popup_close");
    closeBtn.on('click', e => {
        order.removeClass('display-on');
        $('.overlay').removeClass('display-on');
    })
    window.addEventListener("keydown", function (event) {
        if (event.keyCode === 27) {
            event.preventDefault();
            order.removeClass('display-on');
            $('.overlay').removeClass('display-on');
        }
    })
}
function initQuickOrderPopupForm() {
    $('.order-card__form .js_phone_class').inputmask("+7-999-999-99-99");

    $('input[name="PERSON_TYPE_ID"]').on('click', function () {
        if ($('input[name="PERSON_TYPE_ID"]:checked').val() == '1') {
            $('#order-entity__inn').val('');
        }
    });

    qickOrderValidate();
}
function qickOrderValidate() {
    $('.order-card form').each(function () {
        $(this).validate({
            errorClass: 'form__error',
            focusInvalid: false,
            ignore: [],
            submitHandler: function (form) {
                //alert('!');
                return sendAjaxQuickOrder(form);
            }
        });
    });
}
function sendAjaxQuickOrder(form) {
    var $form = $(form);
    var formData = new FormData($form[0]);

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

    var url = $('#jsOrderAjaxUrl').val();
    formData.append('action', 'add');

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'html',
        success: function (result) {
            if (location.path == "/personal/cart/") {
                ym(16721107, 'reachGoal', 'buy_1_send_form_cart');
            } else {
                ym(16721107, 'reachGoal', 'buy_1_send_form');
            }
            $('.js_quick_order_container').html(result);
            reloadPageAfterAddOrder();
            return false;
        },
        error: function (xhr, str) {
            console.error(xhr.responseText);
            return false;
        },
        complete: function () {
            $formButtonSubmit.removeClass('btn--loading').prop('disabled', false);
            $formButtonSubmit.html(formButtonSubmitHtml);
        }
    });

    return false;
}
function reloadPageAfterAddOrder() {
    var order_add = $('#order_add').val();
    if (order_add == 'SUCCESS') {
        setTimeout(locationReload, 2000);
    }
}
function locationReload() {
    location.reload();
}
// <-- Быстрый заказ

// Формы заказа товара -->
function showPopupProductOnOrder() {
    initPopupOrderOrder();

    $('.overlay').addClass('display-on');
    const order = $('.popup.order-order')
    order.addClass('display-on');
    const closeBtn = order.find(".popup-form__popup_close")
    closeBtn.on('click', e => {
        //order.removeClass('display-on')
        //$('.overlay').removeClass('display-on')
        closePopup(order, 'js_popup_order_order', 'order');
    })
    window.addEventListener("keydown", function (event) {
        if (event.keyCode === 27) {
            event.preventDefault()
            //order.removeClass('display-on')
            //$('.overlay').removeClass('display-on')
            closePopup(order, 'js_popup_order_order', 'order');
        }
    })
}

function showPopupChooseAnalogue() {
    $('.overlay').addClass('display-on');
    const order = $('.popup.order-analog')
    order.addClass('display-on');
    const closeBtn = order.find(".popup-form__popup_close")
    closeBtn.on('click', e => {
        //order.removeClass('display-on')
        //$('.overlay').removeClass('display-on')
        closePopup(order, 'js_popup_order_analog', 'analogue');
    })
    window.addEventListener("keydown", function (event) {
        if (event.keyCode === 27) {
            event.preventDefault()
            //order.removeClass('display-on')
            //$('.overlay').removeClass('display-on')
            closePopup(order, 'js_popup_order_analog', 'analogue');
        }
    })
}

function showPopupRequestWholesalePrice() {
    $('.overlay').addClass('display-on');
    const order = $('.popup.order-wholesale')
    order.addClass('display-on');
    const closeBtn = order.find(".popup-form__popup_close")
    closeBtn.on('click', e => {
        //order.removeClass('display-on')
        //$('.overlay').removeClass('display-on')
        closePopup(order, 'js_popup_order_wholesale', 'wholesale');
    })
    window.addEventListener("keydown", function (event) {
        if (event.keyCode === 27) {
            event.preventDefault()
            //order.removeClass('display-on')
            //$('.overlay').removeClass('display-on')
            closePopup(order, 'js_popup_order_wholesale', 'wholesale');
        }
    })
}

function closePopup(container, wrapperId, typeForm) {
    container.removeClass('display-on');
    $('.overlay').removeClass('display-on');

    loadPopupForm(wrapperId, typeForm);
}
var timerId_loadPopupForm = 0;
var click_loadPopupForm = 'Y';
function loadPopupForm(wrapperId, typeForm) {
    //alert(click_loadPopupForm);
    if (click_loadPopupForm == 'Y') {
        click_loadPopupForm = 'N';

        var ajaxData = new Object();
        ajaxData['AJAX_LOAD'] = 'Y';
        ajaxData['TYPE_FORM'] = typeForm;
        //alert(typeForm);
        //var url = window.location.href;
        var url = '/local/ajax/form_popup.php';
        var params = {
            url: url,
            ajaxData: ajaxData,
            wrapperId: wrapperId,
            typeForm: typeForm,
        };
        if (Number(timerId_loadPopupForm) > 0) {
            clearTimeout(timerId_loadPopupForm);
        }
        timerId_loadPopupForm = setTimeout(function () { ajaxLoadPopupForm(params); }, 1);
    }
}
function ajaxLoadPopupForm(params) {
    $.ajax({
        url: params.url,
        method: 'get',
        dataType: 'html',
        data: params.ajaxData,
        success: function (data) {
            data = '<div>' + data + '</div>';
            let html = $(data).find('.' + params.wrapperId).html();
            //alert(params.wrapperId);
            //alert(data);
            if (html) {
                $('.' + params.wrapperId).html(html);
            }
            click_loadPopupForm = 'Y';
            return false;
        }
    });
}

function initClickProductOnOrder() {
    $('.js_product_on_order').on("click", function (e) {
        e.preventDefault();

        var product_name = $(this).data('product-name');
        if (product_name.length) {
            $('.js_product_name_form_product_on_order').val(product_name);
        }
        closePopupAdd2Basket();
        //showPopupProductOnOrder();
        showPopupForm('js_popup_order_order', 'order');
        if (typeof initProductOnOrderPopupForm === 'function') {
            initProductOnOrderPopupForm();
        }

        return false;
    });
}

function initClickRequestWholesalePrice() {
    $('.js_request_wholesale_price').on("click", function (e) {
        e.preventDefault();

        var product_name = $(this).data('product-name');
        if (product_name.length) {
            $('.js_product_name_form_request_wholesale_price').val(product_name);
        }
        var formType = 'wholesale';
        var formTypeData = $(this).data('formtype');
        //alert(formTypeData);
        if (formTypeData.length && formTypeData != 'undefined') {
            formType = formTypeData;
        }
        //alert(formType);
        closePopupAdd2Basket();
        //showPopupRequestWholesalePrice();
        showPopupForm('js_popup_order_wholesale', formType);
        if (typeof initRequestWholesalePricePopupForm === 'function') {
            initRequestWholesalePricePopupForm();
        }

        return false;
    });
}

function initClickChooseAnalogue() {
    $('.js_choose_analogue').on("click", function (e) {
        e.preventDefault();

        var product_name = $(this).data('product-name');
        if (product_name.length) {
            $('.js_product_name_form_choose_analogue').val(product_name);
        }
        closePopupAdd2Basket();
        showPopupForm('js_popup_order_analog', 'analogue');
        if (typeof initChooseAnaloguePopupForm === 'function') {
            initChooseAnaloguePopupForm();
        }

        return false;
    });
}

function showPopupForm(wrapperId, typeForm) {
    showSwitchPopupForm(typeForm);
}

var timerId_showPopupForm = 0;
var click_showPopupForm = 'Y';
function showPopupForm_old(wrapperId, typeForm) {
    if (click_showPopupForm == 'Y') {
        click_showPopupForm = 'N';

        var ajaxData = new Object();
        ajaxData['AJAX_LOAD'] = 'Y';
        ajaxData['TYPE_FORM'] = typeForm;
        //var url = window.location.href;
        var url = '/local/ajax/form_popup.php';
        var params = {
            url: url,
            ajaxData: ajaxData,
            wrapperId: wrapperId,
            typeForm: typeForm,
        };
        if (Number(timerId_showPopupForm) > 0) {
            clearTimeout(timerId_showPopupForm);
        }
        timerId_showPopupForm = setTimeout(function () { ajaxClickshowPopupForm(params); }, 1);
    }
}
function ajaxClickshowPopupForm(params) {
    //showSwitchPopupForm(params.typeForm);
    $.ajax({
        url: params.url,
        method: 'get',
        dataType: 'html',
        data: params.ajaxData,
        success: function (data) {
            data = '<div>' + data + '</div>';
            let html = $(data).find('.' + params.wrapperId).html();
            if (html) {
                $('.' + params.wrapperId).html(html);
            }
            //showSwitchPopupForm(params.typeForm);
            return false;
        }
    });
}
function showSwitchPopupForm(typeForm) {
    switch (typeForm) {
        case 'order':
            showPopupProductOnOrder();
            initProductOnOrderPopupForm();
            break;
        case 'analogue':
            showPopupChooseAnalogue();
            initChooseAnaloguePopupForm();
            break;
        case 'wholesale':
        case 'know':
            showPopupRequestWholesalePrice();
            initRequestWholesalePricePopupForm();
            $('.js_h2_wholesale_know').addClass('display-none');
            $('.js_h2_' + typeForm).removeClass('display-none');
            break;
    }

    click_showPopupForm = 'Y';
}
// <-- Формы заказа товара

function initFilterTopPanelAddDel() {
}

function initSortCatalog() {
    var $sortSelect = $('#jsSortCatalog');
    if ($sortSelect.length > 0) {
        $sortSelect.selectric({
            onOpen: function () {
            },
            onChange: function (event, element, selectric) {
                /*var jsSortCatalogBy;
                var jsSortCatalogOrder;
                var str = $(this).val();
                var arr = str.split(":");
                jsSortCatalogBy = arr[0];
                jsSortCatalogOrder = arr[1];
                $('#ELEMENT_SORT_FIELD').val(jsSortCatalogBy);
                $('#ELEMENT_SORT_ORDER').val(jsSortCatalogOrder);
                $.cookie('ELEMENT_SORT_FIELD', jsSortCatalogBy, { expires: 365, path: '/' });
                $.cookie('ELEMENT_SORT_ORDER', jsSortCatalogOrder, { expires: 365, path: '/' });
                runFilter();*/
                $(this).trigger('change');
            },
            onClose: function () {
            }
        });

        $sortSelect.on('change', function () {
            var jsSortCatalogBy;
            var jsSortCatalogOrder;
            var str = $(this).val();
            var arr = str.split(":");
            jsSortCatalogBy = arr[0];
            jsSortCatalogOrder = arr[1];
            $('#ELEMENT_SORT_FIELD').val(jsSortCatalogBy);
            $('#ELEMENT_SORT_ORDER').val(jsSortCatalogOrder);
            $.cookie('ELEMENT_SORT_FIELD', jsSortCatalogBy, { expires: 365, path: '/' });
            $.cookie('ELEMENT_SORT_ORDER', jsSortCatalogOrder, { expires: 365, path: '/' });
            runFilter();
        });
    }
}

// Добавить в корзину, Купить -->
function addToBasketOpenPopup(product_id, typeAdd, add, setQuantity = 'N', quantity = '1') {
    var url = $('#jsBasketAjaxUrl').val();
    var data = { action: 'add', productId: product_id, add: add, setQuantity: setQuantity, quantity: quantity };

    add2BasketAjaxCall(url, data, typeAdd);
}
function add2BasketAjaxCall(url, data, typeAdd) {
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'html',
        data: data,
        success: function (data) {
            if (typeAdd == 'full') {
                $('#js_popup_order_basket').html(data);

                initPopupToBasket();
                initPopupAddToBasketSlider();
                initPriceDivisionIntoRanks();
                initClickButtons();
                showPopupAdd2Basket();
                initClickContinueShopping();
            }
            else if (typeAdd == 'half') {
                $('#js_product_in_basket_wrapper').html($(data).find('#js_product_in_basket_wrapper').html());
            }
            initChangeCountInBasket();
        }
    });
}
function showPopupAdd2Basket() {
    const basket = $('#js_popup_order_basket .order-basket')
    basket.addClass('display-on');
    $('.overlay').addClass('display-on');
    const closeBtn = basket.find(".popup-form__popup_close")
    closeBtn.on('click', e => {
        basket.removeClass('display-on')
        $('.overlay').removeClass('display-on')
    })
    window.addEventListener("keydown", function (event) {
        if (event.keyCode === 27) {
            event.preventDefault()
            basket.removeClass('display-on')
            $('.overlay').removeClass('display-on')
        }
    });
}
function initClickContinueShopping() {
    $('#js_continue_shopping').on('click', function () {
        closePopupAdd2Basket();
        return false;
    });
}
function closePopupAdd2Basket() {
    const basket = $('#js_popup_order_basket .order-basket');
    basket.removeClass('display-on');
    $('.overlay').removeClass('display-on');
}
// <-- Добавить в корзину, Купить

function initChangeCountInBasket() {
    var url = $('#jsBasketAjaxUrl').val();
    $('.js_popup_basket_minus_quantity, .js_popup_basket_plus_quantity').on("click", function (e) {
        var basketElId = $(this).data('el-basket-id');
        var quantitySelId = $(this).data('id-item-input-qt');
        var quantity_str = $('#js_popup_input_quantity_' + quantitySelId).val();
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
        $('#js_popup_input_quantity_' + quantitySelId).val(quantity_str);
        changeQuantityInBasket(url, basketElId, quantity_str, 'buttons');

        return false;
    });

    $('.js_popup_input_quantity').on("keyup", function (e) {
        var basketElId = $(this).data('el-basket-id');
        var quantity_str = $(this).val();
        changeQuantityInBasket(url, basketElId, quantity_str, 'input');
    });
}

function initChangeCountInList() {
    $('.js_list_minus_quantity, .js_list_plus_quantity').on("click", function (e) {
        var elId = $(this).data('el-id');
        var quantity_str = $('#js_list_input_quantity_' + elId).val();
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
        $('#js_list_input_quantity_' + elId).val(quantity_str);
        return false;
    });
}

function initPriceDivisionIntoRanks() {
    const productPriceSum = document.querySelectorAll('.prices, .product__price_sum');
    if (productPriceSum) {
        productPriceSum.forEach(element => {
            element.innerText = prettify(element.innerText)
        })
    }
}

function changeQuantityInBasket(url, basketElId, quantity, from) {
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'html',
        data: { action: 'change_quantity', basketElId: basketElId, quantity: quantity },
        success: function (data) {
            return false;
        }
    });
}

$(".review-popup__wrapper-stars span").hover(e => {
    const parent = $(e.currentTarget).closest('.review-popup__star-input')
    if (!parent.hasClass('reviewed')) {
        const rating = e.currentTarget.dataset.rating;
        const elements = $(e.currentTarget).parent().children();
        for (let i = 0; i < rating; i++) {
            $(elements[i]).addClass('star-fill')
        }
    }
}, e => {
    const parent = $(e.currentTarget).closest('.review-popup__star-input')
    if (!parent.hasClass('reviewed')) {
        const elements = $(e.currentTarget).parent().children();
        elements.each((z, x) => $(x).removeClass('star-fill'))
    }
})

$(".review-popup__wrapper-stars span").click(e => {
    const parent = $(e.currentTarget).closest('.review-popup__star-input')
    const rating = e.currentTarget.dataset.rating;
    const input = parent.find(".js--review-star-rating");
    const elements = $(e.currentTarget).parent().children();
    elements.each((z, x) => $(x).removeClass('star-fill'))
    for (let i = 0; i < rating; i++) {
        $(elements[i]).addClass('star-fill')
    }
    parent.addClass("reviewed");
    input.val(rating);
})

$(".card-main__reviews-button").click(e => {
    const basket = $('.review-popup')
    basket.addClass('display-on');
    $('.overlay').addClass('display-on');
    const closeBtn = basket.find(".popup-form__popup_close")
    closeBtn.on('click', e => {
        basket.removeClass('display-on')
        $('.overlay').removeClass('display-on')
    })
    window.addEventListener("keydown", function (event) {
        if (event.keyCode === 27) {
            event.preventDefault()
            basket.removeClass('display-on')
            $('.overlay').removeClass('display-on')
        }
    })
})

$(".card-main__questions-button").click(e => {
    const basket = $('.faq-popup')
    basket.addClass('display-on');
    $('.overlay').addClass('display-on');
    const closeBtn = basket.find(".popup-form__popup_close")
    closeBtn.on('click', e => {
        basket.removeClass('display-on')
        $('.overlay').removeClass('display-on')
    })
    window.addEventListener("keydown", function (event) {
        if (event.keyCode === 27) {
            event.preventDefault()
            basket.removeClass('display-on')
            $('.overlay').removeClass('display-on')
        }
    })
})


// Валидация форм -->
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
// <-- Валидация форм


function scrollTo(hash) {
    if ($("#" + hash).length > 0) {
        $('html, body').animate({
            scrollTop: $("#" + hash).offset().top
        }, 100);
    }
}

// Выводим Jivo-чат только на десктопах
document.addEventListener('DOMContentLoaded', function () {
    if (window.innerWidth > 1200) {
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = '//code.jivo.ru/widget/RCBxSt5Uec';
        document.body.appendChild(script);
    }
});