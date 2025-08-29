$(document).ready(function () {
    clickOurEvents();
});

function clickOurEvents() {
    var click = $('.js_our_events').val();
    if (click == 'Y') {
        $('.js_our_events_button').click();
    }
}


