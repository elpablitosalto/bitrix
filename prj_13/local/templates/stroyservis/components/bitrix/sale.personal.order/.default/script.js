$(function() {
    $('.orders__head-line').on('change', function() {
        $(this).submit();
    });

    $('select[data-entity="filter-order-type"]').on('change', function() {
        $('input[name="filter_history"]').val($(this).val()).trigger('change');
    });

    $('select[data-entity="filter-order-status"]').on('change', function() {
        $('input[name="filter_status"]').val($(this).val()).trigger('change');
    });

    // $('input[data-entity="filter-order-id"]').on('change', function() {
    //     location.href = location.pathname + '?filter_id=' + $(this).val();
    // });
});