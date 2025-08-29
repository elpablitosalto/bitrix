$(function() {

    function dateIsValid(date) {
        return date instanceof Date && !isNaN(date);
    }

    $('input[name="PERSONAL_BIRTHDAY"]').inputmask("99.99.9999");

    $('input[name="PERSONAL_BIRTHDAY"]').on('change', function() {
        var arDate = $(this).val().split('.');
        if (!dateIsValid(new Date(arDate[2] + '-' + arDate[1] + '-' + arDate[0])))
            $(this).val('');
    });
});