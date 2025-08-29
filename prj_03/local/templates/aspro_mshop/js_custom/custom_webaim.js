var firstClickParams = {
    isFirstClick: false,
    idFirstClickMenuTopCatalogItem: '0'
};

$(document).ready(function () {
    $(document).one({
        'scroll touchstart mouseenter click': function () {
            initLazyLoad();
        }
    });

    initLoadOnUserAction();

    initActionsIsMobile();
});

function initActionsIsMobile() {
    if ($('.js_show_top_menu_first_level').val() == 'Y') {
        initFirstClick();

        initFirstClickTopCatalogMenu();
    }
}

function initFirstClick() {
    $(document).on({
        'click': function () {
            setTimeout(function () {
                firstClickParams.isFirstClick = true;
            }, 500);
        }
    });
}

function initFirstClickTopCatalogMenu() {
    $('.js_menu_top_catalog_item_level_1').click(function () {
        if (firstClickParams.isFirstClick == false) {
            firstClickParams.idFirstClickMenuTopCatalogItem = $(this).attr('id');
        }
    });
}

function initLoadOnUserAction() {
    $(document).on({
        'scroll touchstart mouseenter click': function () {
            initLoadTopCatalogMenu();
        }
    });
}

function initLoadTopCatalogMenu() {
    if ($('.js_show_top_menu_first_level').val() == 'Y') {
        var params = new Object();
        params.url = '/local/ajax/menu.top_catalog_multilevel.php';
        params.ajaxData = {};
        ajaxLoadTopCatalogMenu(params);
    }
}

function ajaxLoadTopCatalogMenu(params) {
    $.ajax({
        type: 'POST',
        url: params.url,
        data: params.ajaxData,
        //contentType: false,
        //processData: false,
        dataType: 'html',
        success: function (result) {
            $('.js_catalog_top_menu').html(result);
            if (Number(firstClickParams.idFirstClickMenuTopCatalogItem) > 0) {
                $('#' + firstClickParams.idFirstClickMenuTopCatalogItem).click();
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

function initLazyLoad() {

    $('.js_lazy').lazy();


    /*
    $(window).scroll(function () {
        $('.js_lazy').lazy({
            bind: "event"
        });
    });

    $(document).on({ 'touchstart' : function() {
        $('.js_lazy').lazy({
            bind: "event"
        });
    });
    */
}

/*
var funcDefined = function (func) {
	try {
		if (typeof func == 'function') {
			return true;
		} else {
			return typeof window[func] === "function";
		}
	} catch (e) {
		return false;
	}
}
*/