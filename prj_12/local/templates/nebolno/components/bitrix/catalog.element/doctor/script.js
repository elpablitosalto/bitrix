$(function() {
    $('[data-entity="more-refresher"]').on('click', function() {
        var $wrapperList = $(this).closest('.nb-section__body');
        $wrapperList.find('.nb-refresher-item.d-none').removeClass('d-none');
        $wrapperList.find('.nb-refresher-wrapper').remove();
    });
});