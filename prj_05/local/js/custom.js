var timeoutAjaxId = 0;
var objFormFilterData = new Object();

$(document).ready(function () {
    useFilter();

    initScrollPager();
});

function initScrollPager() {
    // Выборка сетки элементов
    const grid = document.querySelector('.js-entry-grid');
    const pager = document.querySelector('.js-entry-grid-trigger-line');

    // Выход из функции, если сетки нет на странице
    if (!grid) return;

    // Выход из функции, если пагинации нет на странице
    if (!pager) return;

    grid.addEventListener('entryGrid:loadTriggerOnScreen', function (e) {
        // Включение визуального состояния загрузки
        e.data.grid.classList.toggle('entry-grid_state_loading');

        // Timeout для симуляции отправки запроса на сервер. Необходимо заменить на получение и вставку разметки
        setTimeout(function () {
            // ...
            // обработка и размещение разметки новых элементов тут
            // ...
            var nowMoreItems = initAutoLoadShowMore();

            //console.log('New page');

            // Выключение визуального состояния загрузки. Необходимо вызвать по окончанию обработки запроса
            e.data.grid.classList.toggle('entry-grid_state_loading');

            // Включение вызова события снова. Без данной строки событие entryGrid:loadTriggerOnScreen происходить больше не будет. Необходимо вызывать по окончанию обработки запроса, если еще остаются элементы для будущей загрузки. Если были загружены последние элементы, то вызов не требуется
            //e.data.trigger.dataset.reached = "N";
            e.data.trigger.dataset.reached = nowMoreItems;
        }, 2000);
    });
}

function initAutoLoadShowMore() {

    var nowMoreItems = 'Y';

    var $obj_more_items = $('.js_more_items');

    var idNav = $obj_more_items.data('id-nav');
    var NavNum = $obj_more_items.data('nav-num');
    var NavPageNomer = $obj_more_items.data('page-nomer');
    var NavPageCount = $obj_more_items.data('max-page');

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
            nowMoreItems = 'N';
            nav.this_page++;
            var url = window.location.pathname + window.location.search;
            //console.log(url);
            var data = new Object();
            data['PAGEN_' + NavNum] = nav.this_page;
            data['AJAX_LOAD'] = 'Y';

            //console.log(objFormFilterData);

            var dataAssign = Object.assign(data, objFormFilterData);
            //console.log(dataAssign);

            $.ajax({
                dataType: 'html',
                url: url,
                data: dataAssign,
                success: function (r) {
                    var append = $('<div>' + r + '</div>').find('.js_nav_result_' + NavNum).html();
                    $('.js_nav_result_' + NavNum).append(append);
                    $('.js_nav_string_' + NavNum).html($('<div>' + r + '</div>').find('.js_nav_string_' + NavNum).html());
                    initScrollPager();
                    btn.removeClass('loading');
                }
            });
        } else {
            nowMoreItems = 'Y';
        }
    }

    return nowMoreItems;
}

function goToAnchor(anchor) {
    var loc = document.location.toString().split('#')[0];
    document.location = loc + '#' + anchor;
    return false;
}

function scrollToAnchorId(anchor) {
    var anchor = $("#" + anchor);
    $("html, body").animate({
        scrollTop: anchor.offset().top
    }, 1000);
}

function scrollToAnchorClass(anchor, offset = 0) {
    var anchor = $("." + anchor);
    $("html, body").animate({
        scrollTop: (anchor.offset().top - offset)
    }, 1000);
}