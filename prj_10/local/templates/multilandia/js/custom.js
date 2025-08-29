$(function () {
    var cookieTimezone = $.cookie('BITRIX_SM_USER_TIMEZONE');
    var userTimezone = moment.tz.guess();

    $('time[datetime]').each(function () {
        var movieTime = moment($(this).attr('datetime') + '+03:00', null).tz(userTimezone).format('HH:mm');
        $(this).children('.time_js_change_timezone').text(movieTime);
    });

    if (userTimezone != cookieTimezone) {
        $.cookie('BITRIX_SM_USER_TIMEZONE', userTimezone, { expires: 365, path: '/' });

        if (location.pathname.indexOf('/guide/') === 0)
            location.reload();
    }

    $('body').on('click', '.js--hidden_popup_after_auth_social', function (e) {
        var current_check_politic = $('.js--auth_check_politic_agreement > input').prop('checked');

        console.log(current_check_politic);

        if (current_check_politic === false) {
            $('.social_auth_error').show();
        } else {
            $('.social_auth_error').hide();
            $(".ml-modals > .ml-modal").removeClass("ml-modal_active").fadeOut(300, function () {
                $('body').removeClass("overflow-hidden");
            });
        }
    });


    $('.js--auth_check_politic_agreement').click(function () {
        if ($(this).children('#auth-agreement').prop('checked') === true) {
            $('#form-auth > .ml-form__body').removeClass('disable_href_click_form');
            $('.social_auth_error').hide();
        } else {
            $('.social_auth_error').show();
            $('#form-auth > .ml-form__body').addClass('disable_href_click_form');
        }
    });

    /* Избранное --> */
    $('body').on('click', '.js--add_favorite_catalog_item_cookie > input[type="checkbox"]', function () {
        var $this = $(this);
        var isCheckedHeart = $this.is(':checked');

        var idCatalogItem = $(this).val();
        //let nodeContainFavCount = $('.top-action-fav-count');
        //var currentCountFavorites = nodeContainFavCount.html();

        //nodeContainFavCount.show();

        if (!isCheckedHeart) {
            $.cookie('favorites_' + idCatalogItem + '', idCatalogItem, { expires: -1, path: '/' });
            //Cookies.set('favorites_'+idCatalogItem+'', idCatalogItem, { expires: -1 });
            //currentCountFavorites--;
            //$(this).siblings('.projfav-text').html('Добавить в избранное');
        } else {
            $.cookie('favorites_' + idCatalogItem + '', idCatalogItem, { expires: 365, path: '/' });
            //Cookies.set('favorites_'+idCatalogItem+'', idCatalogItem, { expires: 999 });
            //currentCountFavorites++;
            //$(this).siblings('.projfav-text').html('Добавлен в избранное');

            //$('.top-action-heart-gray').hide();
            //$('.top-action-heart-red').show();
        }

        //nodeContainFavCount.text(currentCountFavorites);
    });
    $('body').on('click', '.js--add_favorite_catalog_item_cookie_button', function () {
        var $this = $(this);
        var isCheckedHeart = $this.hasClass('ml-btn-favorite_active');
        var idCatalogItem = $(this).attr('name');
        var ar_params = new Object();

        ar_params.url_ajax = $('#FAVORITES_ADD_REMOVE_AJAX').val();
        ar_params.movie_id = idCatalogItem;
        ar_params.button_obj = this;
        ar_params.button_class = 'ml-btn-favorite_active';

        if (!isCheckedHeart) {
            ar_params.action = 'add';
        } else {
            ar_params.action = 'remove';
        }
        AddRemoveMovieToFavorites(ar_params);
    });
    /*
    $('body').on('click', '.js--add_favorite_catalog_item_cookie_button', function () {
        if (!isCheckedHeart) {
            $.cookie('favorites_' + idCatalogItem + '', idCatalogItem, { expires: 365, path: '/' });
            $this.addClass('ml-btn-favorite_active');
        } else {
            $.cookie('favorites_' + idCatalogItem + '', idCatalogItem, { expires: -1, path: '/' });
            $this.removeClass('ml-btn-favorite_active');
        }  
    });
    */
    /* <-- Избранное */


    var $body = $("body");
    if ($body.hasClass('home-page')) {
        $('.ml-footer-logo').on('click', function () {
            $("body, html").animate({ scrollTop: 0 }, 500);
        });
        /*var _isScrolling = false;
        var $scrollTopBtn = $("<button id='scrollTop' class='ml-scroll-top' type='button'><svg class='icon icon-arrowRight'><use xlink:href='#arrowRight'></use></svg></button>");
        $body.append($scrollTopBtn);
        $(document).on("click", "#scrollTop", function(e) {
            e.preventDefault();
            $("body, html").animate({scrollTop: 0}, 500);
            return false;
        });

        if ($(window).scrollTop() > 150) {
            $scrollTopBtn.addClass("ml-scroll-top_show");
        }

        $(window).scroll(function() {
            if (!_isScrolling) {
                _isScrolling = true;
                if ($(window).scrollTop() > 150) {
                    $scrollTopBtn.stop(true, true).addClass("ml-scroll-top_show");
                    _isScrolling = false;
                } else {
                    $scrollTopBtn.stop(true, true).removeClass("ml-scroll-top_show");
                    _isScrolling = false;
                }
            }
        });*/
    }

});

$(document).ready(function () {

    /* Select. Сортировка конкурсных работ --> */
    ContestWorksSortSelectInit();
    BX.addCustomEvent('onAjaxSuccess', function () {
        //alert('!!!');
        ContestWorksSortSelectInit();
    });
    /* <-- Select. Сортировка конкурсных работ */

});

function ContestWorksSortSelectInit() {
    var $sortSelect = $('#contest_works_sort_select');
    if ($sortSelect.length > 0) {
        $sortSelect.selectric({
            onOpen: function () {
                //alert('Open');
            },
            onChange: function (event, element, selectric) {
                var href = $(this).val();
                //alert(href);
                $.get(
                    href,
                    function (data) {
                        //alert(data);
                        $('#contest_works_participants').html($(data).find('#contest_works_participants').html());
                    }
                );
            },
            onClose: function () {
                //alert('Close');
            }
        });
    }
}

function AddRemoveMovieToFavorites(arParams) {
    var arResult = new Object();
    var url_ajax = arParams.url_ajax;
    var movie_id = arParams.movie_id;
    var button_obj = arParams.button_obj;
    var button_class = arParams.button_class;
    var action = arParams.action;
    var formData = new FormData();

    formData.append('action', action);
    formData.append('movie_id', movie_id);

    //alert(url_ajax);

    $.ajax({
        type: "POST",
        url: url_ajax,
        data: formData,
        contentType: false,
        processData: false,
        success: function (result) {
            //alert(result);
            var obj = jQuery.parseJSON(result);
            if (obj.RESULT === "ERROR") {
            }
            else if (obj.RESULT === "SUCCESS") {
                if (action == 'add') {
                    $(button_obj).addClass(button_class);
                }
                else if (action == 'remove') {
                    $(button_obj).removeClass(button_class);
                }
            }
        },
        error: function (jqXHR, exception) {
        }
    });

    return arResult;
}

$(document).ready(function(){
    $(".ml-sidebar-menu-b2b").on("click","a.link", function (event) {
        event.preventDefault();
        var id  = $(this).attr('href'), top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 1500);
    });
});