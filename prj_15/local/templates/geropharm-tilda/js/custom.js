$(document).ready(function () {
    $(".theme-form input").on("change", function () {
        if ($(window).width() > 768) {
            $(this).parents("form").submit();
        }
    });
    $('body').on('click', '.dp-form__submit ', function () {
        $('[name="REGISTER[LOGIN]"]').val($('[name="REGISTER[EMAIL]"]').val());
    });
    $('body').on('change', '[name="REGISTER[LOGIN]"]', function () {
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
    initChangeSpeaker();
    initChangeWithTranscript();

    //initReviewShowMore();
});

// Показать весь отзыв -->
function initReviewShowMore() {
    $('.js_review_show_more').on("click", function (e) {
        var id = $(this).data('id');
        alert($('#js_review_full_name_' + id).html());
        $('.js_review_full_name').html($('#js_review_full_name_' + id).html());
        $('.js_review_full_about').html($('#js_review_full_about_' + id).html());
        $('.js_review_full_text').html($('#js_review_full_text_' + id).html());
    });
}
// <-- Показать весь отзыв

// Добавление статьи в сохраненные --> 
function initAddArticleToSaved() {
    var ajaxTimerId_AddArticleToSaved = 0;
    $('.js_article_bookmark').on("click", function (e) {
        //alert('!');
        $link = $(this);
        var url = '/local/ajax/add_material_to_saved.php';
        var ELEMENT_ID = $link.data('id');
        var IBLOCK_ID = $link.data('iblock-id');
        var ACTIVE;
        if ($link.hasClass('dp-bookmark-btn_active')) {
            ACTIVE = 'Y';
        }
        else {
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
        ajaxTimerId_AddArticleToSaved = setTimeout(function () { ajaxAddArticleToSaved(params); }, 500);
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
    var ajaxData = { ELEMENT_ID: ELEMENT_ID, IBLOCK_ID: IBLOCK_ID };
    var params = {
        url: url,
        ajaxData: ajaxData
    };
    if (Number(ajaxTimerId_MarkArticleReaded) > 0) {
        clearTimeout(ajaxTimerId_MarkArticleReaded);
    }

    var learned_time = $('#js_learned_time').val();
    //alert(learned_time);
    learned_time = Number(learned_time);
    //alert(learned_time);
    if (Number(learned_time) <= 0) {
        learned_time = 30;
    }

    ajaxTimerId_MarkArticleReaded = setTimeout(ajaxMarkArticleReaded(params), (1000 * learned_time));

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
            //alert('!!');
            if (result.RESULT == 'SUCCESS') {
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
        }
    });
}
// <-- Статья изучена

// Установка закладок у статей -->
function initShowBookmarksArticles() {
    var ajaxTimerId_ShowBookmarksArticles = 0;
    var url = '/local/ajax/get_saved_materials.php';
    var ajaxData = new Object();
    ajaxData.IDS = new Array();
    //alert('!');
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
    ajaxTimerId_ShowBookmarksArticles = setTimeout(ajaxShowBookmarksArticles(params), 500);
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
            //alert('!!');
            //console.log(result);
            if (result.RESULT == 'SUCCESS') {
                doShowBookmarksArticles(result);
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
        }
    });
}

function doShowBookmarksArticles(params) {
    $.each(params.ARTICLES, function (key, value) {
        //console.log(key + ': ' + value);
        if (value.SAVED == 'Y') {
            $('.js_article_bookmark_' + key).addClass('dp-bookmark-btn_active');
        }
        else {
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
    //alert('!');
    $("a.js_articles_list").each(function () {
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
    ajaxTimerId_ShowLabelsArticles = setTimeout(ajaxShowLabelsArticles(params), 500);
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
            //alert('!!');
            //console.log(result);
            if (result.RESULT == 'SUCCESS') {
                doShowLabelsArticles(result);
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
        }
    });
}
function doShowLabelsArticles(params) {
    $.each(params.ARTICLES, function (key, value) {
        //console.log(key + ': ' + value);
        if (value.READ == 'Y') {
            $('.js_article_readed_' + key).removeClass('d-none');
        }
        else {
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
        //alert('!');
        //$('#ELEMENT_SORT_FIELD').val(jsSortCatalogBy);
        //$('#ELEMENT_SORT_ORDER').val(jsSortCatalogOrder);
        $.cookie('SORT_BY1', jsSortBy, { expires: 365, path: '/' });
        $.cookie('SORT_ORDER1', jsSortOrder, { expires: 365, path: '/' });
        //$('.js_sort_articles_form').submit();
        location.reload();
    });
}
// <-- Сортировка материалов

function initChangeWithTranscript() {
    $('.js_with_transcript').on("change", function () {
        $('.js_filter_type').val('with_transcript');
        $('.js_sort_articles_form').submit();
    });
}
function initChangehideShowLearned() {
    $('.js_hide_show_learned').on("change", function () {
        $('.js_hide_show_learned_form').submit();
    });
}
function initChangeTheme() {
    $('.js_themes_checkbox').on("change", function () {
        $('.js_themes_form').submit();
    });
}
// <-- Фильтр

function ajaxForm($form) {
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
            //console.log(data);
            if (data.ID > 0) {
                if (typeof data['RETURN_FIELDS']['MINDBOX_ACTION'] !== 'undefined') {
                    window[data['RETURN_FIELDS']['MINDBOX_ACTION']](data['RETURN_FIELDS']);
                }
                if ($form.attr("id") === "subscribe_kd_1") {
                    ym(88122786, 'reachGoal', 'Form_2_kodjizni');
                    console.log('Form_2_kodjizni');
                }
                if ($form.attr("id") === "subscribe_kd_2") {
                    ym(88122786, 'reachGoal', 'form_1_kodjizni');
                    console.log('form_1_kodjizni');
                }
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
            } else {
                $.each(data.ERRORS, function (key, value) {
                    //alert(value);
                    switch (key) {
                        case "MAIN":
                            $form.find(".main_error").append(value.join("<br>"));
                            break;
                        default:
                            var element = $form.find("[name='" + key + "']");
                            if (element.length > 0) {
                                element.addClass("error");
                                var errMsgBlock = '<label id="' + key + '-error" class="error" for="' + key + '">' + value.join("<br>") + '</label>';
                                element.parents(".dp-form-field").append(errMsgBlock);
                            } else {
                                $form.find(".main_error").append(value.join("<br>"));
                            }
                    }
                });
            }
        },
        fail: function () {
            alert("Ошибка получения данных! Пожалуйста обновите страницу и попробуйте ещё раз");
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
        }
    });
}