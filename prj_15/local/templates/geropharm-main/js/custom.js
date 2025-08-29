var ajaxTimerId = 0;
var ajaxIntervalId = 0;

$(document).ready(function () {

    $(".js-phone").inputmask("+7 (999) 999-99-99");
    $(".js-phone").on('blur', function () {
        if ($(this).val().replace(/[^0-9]/g, '').length != 11)
            $(this).val('');
    });
    /*
    $(".js_phone_country").on('blur', function () {
        if ($(this).val().replace(/[^0-9]/g, '').length != 11)
            $(this).val('');
    });
    */

    var $body = $('body');
    $body.on('change', '.theme-form input', function () {
        var $arrows = $(this).closest('.dp-section').find('.dp-slider-arrows');
        if ($(window).width() > 768) {
            var formData = $(this).parents(".theme-form").serialize();
            $.post("/?change_materials=y", formData, function (data) {
                if ($arrows.length) {
                    $arrows.remove();
                }
                $("#new_materials").html(data);
                var $slider = $("#new_materials_ajax .dp-slider");
                if ($slider.length) {
                    if ($slider.hasClass('dp-blog-slider') || $slider.hasClass('dp-new-blog-slider')) {
                        blogSlider($slider[0]);
                    }
                    if ($slider.hasClass('dp-home-events-slider')) {
                        homeEventSlider($slider[0]);
                    }
                    if ($slider.hasClass('dp-courses-slider')) {
                        coursesSlider($slider[0]);
                    }
                }
                filterSlider();
            });
        }
    });
    $body.on('change', '#compilation input', function () {
        var formData = $("#compilation form").serialize();
        // console.log(formData);
        $.post("/?change_compilation=y", formData, function (data) {
            $("#compilation").html(data);
            var $slider = $("#compilation .dp-slider");
            if ($slider.length) {
                blogSliderAutoplay($slider[0]);
            }
        });
    });
    $body.on('click', '.dp-form__submit ', function () {
        $('[name="REGISTER[LOGIN]"]').val($('[name="REGISTER[EMAIL]"]').val());
    });
    $body.on('change', '[name="REGISTER[LOGIN]"]', function () {
        $('[name="REGISTER[LOGIN]"]').val($('[name="REGISTER[EMAIL]"]').val());
    });
    $(".bottom-auth").click(function (event) {
        $("#form-auth [name='USER_LOGIN']").val($("#bottom_email").val());
    });

    $(".ajax-form").submit(function (event) {
        event.preventDefault();
        ajaxForm($(this));
    });

    initChangehideShowLearned();
    initChangeTheme();

    initShowLabelsArticles();
    initSortArticles();

    initAddArticleToSaved();
    initShowBookmarksArticles();

    initMarkArticleReaded();
    playWebinar();
    initChangeSpeaker();
    initChangeWithTranscript();
    initBuyCheckAuth();
    //initPhoneMaskCountry();
    //initPhoneMaskCountry_2();
});

// Показывать форму авторизации после нажатия на Купить у вебинара, если пользователь не авторизован -->
function initBuyCheckAuth() {
    $('.js_buy_check_auth').on("click", function (e) {
        //alert('!');
        $link = $(this);
        var url = '/local/ajax/check_auth.php';
        var ajaxData = {};
        let linkUrl = $link.data('link');
        //let linkUrl = $link.attr('href');
        var params = {
            url: url,
            ajaxData: ajaxData,
            //buyUrl: buyUrl,
            linkUrl: linkUrl,
        };
        if (Number(ajaxTimerId) > 0) {
            clearTimeout(ajaxTimerId);
        }
        ajaxTimerId = setTimeout(function () { ajaxBuyCheckAuth(params) }, 500);
        return false;
    });
}
function ajaxBuyCheckAuth(params) {
    $.ajax({
        type: 'POST',
        url: params.url,
        data: params.ajaxData,
        //contentType: false,
        //processData: false,
        dataType: 'json',
        success: function (result) {
            if (result.TYPE == 'NEED_AUTH') {
                //$('.js_auth_type').val('PARTNER');
                //initPopupAdd2BasketNoAuth();
                //initValidateAjaxForm();
                $('.js_auth_button').click();
                $('#js_buy_link').val(params.linkUrl);
                $('#js_buy_link').attr('data-go-link', 'Y');
            } else {
                window.open(params.linkUrl, '_blank').focus();
                //window.open(params.linkUrl, '_self').focus();
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
// <--

// Проверка вебинара куплен он или нет -->
function initCheckMaterialPurchased(materialId) {
    //$link = $(this);
    var url = '/local/ajax/check_purchased.php';
    var ajaxData = {
        materialId: materialId
    };
    let linkUrl = $('#js_material_detail_page_url').val();
    var params = {
        url: url,
        ajaxData: ajaxData,
        linkUrl: linkUrl,
    };
    if (Number(ajaxIntervalId) > 0) {
        clearInterval(ajaxIntervalId);
    }
    ajaxIntervalId = setInterval(function () {
        ajaxCheckMaterialPurchased(params);
    }, 30000);
}
function ajaxCheckMaterialPurchased(params) {
    $.ajax({
        type: 'POST',
        url: params.url,
        data: params.ajaxData,
        //contentType: false,
        //processData: false,
        dataType: 'json',
        success: function (result) {
            //alert(result.PURCHASED);
            if (result.PURCHASED == 'N') {
            } else if (result.PURCHASED == 'Y') {
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
// <-- Проверка вебинара куплен он или нет

// Добавление статьи в сохраненные --> 
function initAddArticleToSaved() {
    var ajaxTimerId_AddArticleToSaved = 0;
    $('.js_article_bookmark').on("click", function (e) {
        $link = $(this);
        var url = '/local/ajax/add_material_to_saved.php';
        var ELEMENT_ID = $link.data('id');
        var IBLOCK_ID = $link.data('iblock-id');
        var ACTIVE;
        if ($link.hasClass('dp-bookmark-btn_active')) {
            ACTIVE = 'Y';
        } else {
            ACTIVE = 'N';
        }
        var ajaxData = { ELEMENT_ID: ELEMENT_ID, ACTIVE: ACTIVE, MATERIAL_IBLOCK_ID: IBLOCK_ID };
        var params = {
            url: url,
            ajaxData: ajaxData,
        };
        if (Number(ajaxTimerId_AddArticleToSaved) > 0) {
            clearTimeout(ajaxTimerId_AddArticleToSaved);
        }
        ajaxTimerId_AddArticleToSaved = setTimeout(function () {
            ajaxAddArticleToSaved(params)
        }, 500);

        return false;
    });
}

function ajaxAddArticleToSaved(params) {
    $.ajax({
        type: 'POST',
        url: params.url,
        data: params.ajaxData,
        //contentType: false,
        //processData: false,
        dataType: 'json',
        success: function (result) {
            if (result.RESULT == 'SUCCESS') {
                /*
                $el = $('.js_article_bookmark_' + params.ajaxData.ELEMENT_ID);
                if (params.ajaxData.ACTIVE == 'N') {
                    $el.removeClass('dp-bookmark-btn_active');
                }
                else if (params.ajaxData.ACTIVE == 'Y') {
                    $el.addClass('dp-bookmark-btn_active');
                }
                */
            } else if (result.RESULT == 'ERROR') {
                //console.log(result.ERROR);
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

// <-- Добавление статьи в сохраненные

// Статья изучена -->
function initMarkArticleReaded() {
    var ajaxTimerId_MarkArticleReaded = 0;
    var url = '/local/ajax/mark_material_learned.php';
    var ELEMENT_ID = $('#js_material_id').val();
    var IBLOCK_ID = $('#js_material_iblock_id').val();
    var startCountdown = $('#js_learned_start_countdown').val();
    if (Number(IBLOCK_ID) > 0 && Number(ELEMENT_ID) > 0 && startCountdown == 'Y') {
        var ajaxData = { ELEMENT_ID: ELEMENT_ID, IBLOCK_ID: IBLOCK_ID };
        var params = {
            url: url,
            ajaxData: ajaxData
        };
        if (Number(ajaxTimerId_MarkArticleReaded) > 0) {
            clearTimeout(ajaxTimerId_MarkArticleReaded);
        }

        var learned_time = $('#js_learned_time').val();
        learned_time = Number(learned_time);
        if (Number(learned_time) <= 0) {
            learned_time = 30;
        }
        var time = 1000 * learned_time;
        ajaxTimerId_MarkArticleReaded = setTimeout(function () {
            ajaxMarkArticleReaded(params);
        }, time);
    }

    return false;
}

function ajaxMarkArticleReaded(params) {
    $.ajax({
        type: 'POST',
        url: params.url,
        data: params.ajaxData,
        //contentType: false,
        //processData: false,
        dataType: 'json',
        success: function (result) {
            if (result.RESULT == 'SUCCESS') {
            } else if (result.RESULT == 'ERROR') {
                //console.log(result.ERROR);
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

function playWebinar() {
    $(".js_play_webinar").click(function (event) {
        $("#js_learned_start_countdown").val('Y');
        initMarkArticleReaded();
    });
}

// <-- Статья изучена

// Установка закладок у статей -->
function initShowBookmarksArticles() {
    var ajaxTimerId_ShowBookmarksArticles = 0;
    var url = '/local/ajax/get_saved_materials.php';
    var ajaxData = new Object();
    ajaxData.IDS = new Array();
    $("button.js_article_bookmark").each(function () {
        ajaxData.IDS.push($(this).data('id'));
    });
    var params = {
        url: url,
        ajaxData: ajaxData
    };
    //console.log(params);
    if (Number(ajaxTimerId_ShowBookmarksArticles) > 0) {
        clearTimeout(ajaxTimerId_ShowBookmarksArticles);
    }
    ajaxTimerId_ShowBookmarksArticles = setTimeout(function () {
        ajaxShowBookmarksArticles(params)
    }, 500);
}

function ajaxShowBookmarksArticles(params) {
    //console.log(params);
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
                doShowBookmarksArticles(result);
                //console.log(result);
            } else if (result.RESULT == 'ERROR') {
                //console.log(result.ERROR);
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

function doShowBookmarksArticles(params) {
    $.each(params.ARTICLES, function (key, value) {
        //console.log(key + ': ' + value);
        if (value.SAVED == 'Y') {
            $('.js_article_bookmark_' + key).addClass('dp-bookmark-btn_active');
        } else {
            $('.js_article_bookmark_' + key).removeClass('dp-bookmark-btn_active');
        }
    });
}

// <-- Установка закладок у статей

// Показ лейблов у материалов -->
function initShowLabelsArticles() {
    var ajaxTimerId_ShowLabelsArticles = 0;
    var url = '/local/ajax/get_learned_materials.php';
    var ajaxData = new Object();
    ajaxData.IDS = new Array();
    $(".js_articles_list").each(function () {
        ajaxData.IDS.push($(this).data('id'));
        ajaxData.IBLOCK_ID = $(this).data('iblock-id');
    });
    var params = {
        url: url,
        ajaxData: ajaxData
    };
    if (Number(ajaxTimerId_ShowLabelsArticles) > 0) {
        clearTimeout(ajaxTimerId_ShowLabelsArticles);
    }
    ajaxTimerId_ShowLabelsArticles = setTimeout(function () {
        ajaxShowLabelsArticles(params)
    }, 500);
}

function ajaxShowLabelsArticles(params) {
    //console.log(params);
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
                doShowLabelsArticles(result);
                //console.log(result);
            } else if (result.RESULT == 'ERROR') {
                //console.log(result.ERROR);
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

function doShowLabelsArticles(params) {
    $.each(params.ARTICLES, function (key, value) {
        //console.log(key + ': ' + value);
        //console.log(key);
        //console.log(value);
        if (value.READ == 'Y') {
            $('.js_article_readed_' + key).removeClass('d-none');
        } else {
            $('.js_article_read_' + key).removeClass('d-none');
        }
    });
}

// <-- Показ лейблов у материалов

// Фильтр -->

// Выбор спикера -->
function initChangeSpeaker() {
    $('#sort-articles-form').on('change', '.js_select_speaker', function () {
        $('.js_filter_type').val('speaker');
        setSearchToForm($('.js_sort_articles_form'));
        $('.js_sort_articles_form').submit();
    });
}

// <-- Выбор спикера

// Сортировка материалов -->
function initSortArticles() {
    $('#sort-articles-form').on('change', '#js_sort_articles_select', function () {
        var jsSortBy;
        var jsSortOrder;
        var str = $(this).val();
        var arr = str.split(":");
        jsSortBy = arr[0];
        jsSortOrder = arr[1];
        //$('#ELEMENT_SORT_FIELD').val(jsSortCatalogBy);
        //$('#ELEMENT_SORT_ORDER').val(jsSortCatalogOrder);
        $.cookie('SORT_BY1', jsSortBy, { expires: 365, path: '/' });
        $.cookie('SORT_ORDER1', jsSortOrder, { expires: 365, path: '/' });
        //$('.js_sort_articles_form').submit();
        location.reload();
    });
}

// <-- Сортировка материалов

function setSearchToForm(currentForm) {
    if ($(".dp-sort-panel [name='q']").length > 0) {
        var searchVal = $(".dp-sort-panel [name='q']").val();
        var url = new URL(window.location.href);
        if (searchVal.length == 0) {
            url.searchParams.set('q', '');
            currentForm.attr("action", url)
        } else {
            url.searchParams.set('q', searchVal);
            currentForm.attr("action", url)
        }
    }
}

function initChangeWithTranscript() {
    $('.js_with_transcript').on("change", function () {
        setSearchToForm($('.js_sort_articles_form'));
        $('.js_filter_type').val('with_transcript');
        $('.js_sort_articles_form').submit();
    });
}

function initChangehideShowLearned() {
    $('.js_hide_show_learned').on("change", function () {
        setSearchToForm($('.js_hide_show_learned_form'));
        $('.js_hide_show_learned_form').submit();
    });
}

function initChangeTheme() {
    $('.js_themes_checkbox').on("change", function () {
        var $form = $('.js_themes_form');
        setSearchToForm($form);
        if (!$form.find('.dp-filter-form__actions').is(':visible')) {
            $form.submit();
        }
    });
}

// <-- Фильтр

function ajaxForm($form) {
    //alert('!');
    $form.find(".main_error, .msg").html("");
    $form.find("label.error").remove();
    $form.find(".error").removeClass("error");
    var formData = new FormData($form[0]);
    //PAGE_LOADING.Show();
    //alert('!');
    $.ajax({
        url: window.location.href,
        dataType: "json",
        data: formData,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (data) {
            //alert(data);
            if (data.ID > 0) {
                if ($form.attr("id") === "form-questionnaire") {
                    $form.find(".msg").html("Ваша заявка успешно принята!");
                    $form[0].reset();
                    window.location.href = "/recommendations/";
                } else if ($form.attr("id") === "form-subscribe-section" || $form.attr("id") === "footer-from-feedback") {
                    $form.find(".msg").html("Скорее проверяйте почту! На указанный вами e-mail мы отправили письмо для подтверждения подписки. Если не подтвердить подписку, письма от нас не придут.");
                    $form[0].reset();
                } else {
                    $form.find(".msg").html("Ваша заявка успешно принята!");
                    $form[0].reset();
                }
                if (typeof data['RETURN_FIELDS']['MINDBOX_ACTION'] !== 'undefined') {
                    //console.log(data['RETURN_FIELDS']);
                    window[data['RETURN_FIELDS']['MINDBOX_ACTION']](data['RETURN_FIELDS']);
                }
            } else {
                $.each(data.ERRORS, function (key, value) {
                    switch (key) {
                        case "MAIN":
                            $form.find(".main_error").append(value.join("<br>"));
                            break;
                        default:
                            var element = $form.find("[name='" + key + "']");
                            if (element.length > 0) {
                                element.addClass("error");
                                var errMsgBlock = '<label id="' + key + '-error" class="error" for="' + key + '">' + value.join("<br>") + '</label>';
                                ;
                                element.parents(".dp-form-field").append(errMsgBlock);
                            } else {
                                $form.find(".main_error").append(value.join("<br>"));
                            }
                    }
                });
            }
            //initPhoneMaskCountry_2();
        },
        fail: function () {
            //alert("Ошибка получения данных! Пожалуйста обновите страницу и попробуйте ещё раз");
            //initPhoneMaskCountry_2();
        },
        error: function (jqXHR, exception) {
            if (jqXHR.status === 0) {
                //console.log('Not connect. Verify Network.');
            } else if (jqXHR.status == 404) {
                //console.log('Requested page not found (404).');
            } else if (jqXHR.status == 500) {
                //console.log('Internal Server Error (500).');

            } else if (exception === 'parsererror') {
                //console.log('Requested JSON parse failed.');
            } else if (exception === 'timeout') {
                //console.log('Time out error.');
            } else if (exception === 'abort') {
                //console.log('Ajax request aborted.');
            } else {
                //console.log('Uncaught Error. ' + jqXHR.responseText);
            }
            //console.log(jqXHR.responseText);
            //initPhoneMaskCountry_2();
        }
    });
}

BX.ready(function () {
    BX.bindDelegate(
        document.body, 'submit', { className: "modal-registration-soc" },
        function (e) {
            saveSocProfileData(e, $(this));
            return BX.PreventDefault(e);
        }
    );
});

function saveSocProfileData(e, dataThis) {

    var arFormData = dataThis.serialize();
    var resultBlock = dataThis.find(".result");
    resultBlock.html("");
    dataThis.find(".dp-field").removeClass("error");
    dataThis.find(".c-error-form__text").remove();

    var request = BX.ajax.runComponentAction('indexis:soc.after.reg', 'profileSave', {
        mode: 'class',
        cache: false,
        data: arFormData,
    });

    request.then(function (response) {
        if (response.data["STATUS"] == "ok") {
            console.log(resultBlock);
            resultBlock.removeClass("error");
            resultBlock.html("Изменения успешно сохранены!");
            setTimeout(() => {
                window.location.href = "/";
            }, 1000);
        } else {
            $.each(response.data["ERRORS"], function (key, value) {
                switch (key) {
                    case "MAIN":
                        resultBlock.append(value.join("<br>"));
                        break;
                    default:
                        var element = dataThis.find("[name='" + key + "']");
                        var errMsgBlock = '<span class="c-error-form__text">' + value.join("<br>") + '</span>';
                        $(errMsgBlock).insertAfter(element);
                        element.parent().addClass("c-error-form");
                }
            });
        }

    }, function (response) {

    });

    return BX.PreventDefault(e);

}