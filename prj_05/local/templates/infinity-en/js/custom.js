function useFilter() {
    let $form = $('.js-smart-filter-form');

    if ($('[data-filter-button]').length > 0) {
        $('[data-filter-button]').click(function (e) {
            e.preventDefault();
            $form.submit();
        });
        $('[data-refresh-button]').click(function (e) {
            e.preventDefault();
            $form.find('input[type="text"]').val('');
            $form.find('input[type="checkbox"]').each(function () {
                $(this).prop('checked', false);
            })
            $form.submit();
        });
    } else {
        $('.js_radio_filter_span').click(function (e) {
            $('#' + $(this).data('radio-id')).attr('checked', true);
            if (Number(timeoutAjaxId) > 0) {
                clearTimeout(timeoutAjaxId);
            }
            var timeoutAjaxId = setTimeout(function () {
                $form.submit();
            }, 500);
        });
    }

    $form.submit(function (e) {
        e.preventDefault();
        var url = $form.attr('action');
        var data = $form.serialize();
        data += '&AJAX_CALL=Y';

        objFormFilterData = $form.serializeJSON();
        objFormFilterData.AJAX_CALL = 'Y';
        //console.log(objFormFilterData);

        $.ajax({
            method: "POST",
            url: url,
            data: data
        })
            .done(function (resp) {
                var html;
                html = $('<div>' + resp + '</div>').find('[data-ajax-container]').html();
                $('body').find('[data-ajax-container]').html(html);
                //useFilter();
                initScrollPager();
            });
    })
}