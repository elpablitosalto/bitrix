$(document).ready(function () {
    $(document).on("click", 'input[name="specialization"]', function (e) {
        //e.preventDefault();

        //alert($(this).val());

        $('#SPECIALIZATION').val($(this).val());

        Filter_A_2();
    });

    $(document).on("click", 'input[name="clinics"]', function (e) {
        //e.preventDefault();

        //alert($(this).val());

        $('#ADDRESS').val($(this).val());

        Filter_A_2();
    });

    $(document).on("click", '#a_2_show_more', function (e) {
        //e.preventDefault();

        var page_number = Number($('#PAGE_COUNT_A_2').val());
        page_number++;

        $('#PAGE_COUNT_A_2').val(String(page_number));

        Filter_A_2();
    });
});


function Filter_A_2() {
    var url_ajax = $('#AJAX_PATH_A_2').val();
    var formData = $("#filter_form_a_2").serialize();
    var postfix = '?';
    if (url_ajax.indexOf('?') > -1)
    {
        postfix = '&';
    }
    url_ajax = url_ajax + postfix + formData;

    $.get(
        url_ajax,
        function (data) {
            $('#a_2_elements_wrapper').html($(data).find('#a_2_elements_wrapper').html());

            $('#a_2_pager_wrapper').html($(data).find('#a_2_pager_wrapper').html());
        }
    );    

    /*
    $.ajax({
        type: "POST",
        url: url_ajax,
        data: formData,
        //contentType: 'html',
        //processData: false,
        dataType: 'html',
        success: function (result) {
            //alert($(result).find('#a_2_elements_wrapper').html());
            $('#a_2_elements_wrapper').html($(result).find('#a_2_elements_wrapper').html());

            $('#a_2_pager_wrapper').html($(result).find('#a_2_pager_wrapper').html());
        }
    });
    */
}