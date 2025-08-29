$(function() {
    $(window).on('load', function () {
        var hash= window.location.hash.toString();
        if (hash == '#closed_selection') {
            var position = $('.dp-compilation-section').position();
            $("html, body").animate({scrollTop: position.top}, 0);
        }
    });
});