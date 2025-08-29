$(document).ready(function () {
    if ($('#js_cur_case').length > 0) {
        $('#js_gazeta_cases_button_' + $('#js_cur_case').val()).click();
    }
});

function updateAfterFilterClick(param, paramValue) {
    setTimeout(function () {
        updateParamUrl(param, paramValue);
        initPagination();
    }, 2000);
}