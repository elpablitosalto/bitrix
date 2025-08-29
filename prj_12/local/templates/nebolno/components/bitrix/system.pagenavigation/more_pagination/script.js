$(function() {
    $('body').on('click', '[data-entity="load-more"]', function(e) {
        e.preventDefault();
        var $currentPageLoadMore = $(this);
        var $currentPageItems = $('[data-entity="items"]');
        var $currentPagePagination = $('[data-entity="pagination"]');
        $currentPageLoadMore.text('Загрузка');

        $.ajax({
            url: $currentPageLoadMore.data('href'),
            type: "GET",
            dataType: "html",
            success: function(res){
                var $html = $('<div>' + res + '</div>');
                var $nextPageItems = $html.find('[data-entity="items"]');
                if ($nextPageItems.length > 0)
                    $currentPageItems.append($nextPageItems.html());

                var $nextPagePagination = $html.find('[data-entity="pagination"]');
                if ($nextPagePagination.length > 0)
                    $currentPagePagination.html($nextPagePagination.html());
                else
                    $currentPagePagination.remove();
            }
        });
    });
});