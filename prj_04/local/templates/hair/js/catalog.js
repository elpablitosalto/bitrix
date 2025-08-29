function in_array(needle, haystack) {
    var found = 0;
    for (var i = 0, len = haystack.length; i < len; i++) {
        if (haystack[i] == needle) return i;
        found++;
    }
    return -1;
}

function getSKU() {
    var $colorSelect = $('select[name="palette"]');
    var $volumeInput = $('input[name="volume"]');
    let $SKUChooseForm = $('#SKUChoose');
    $SKUChooseForm.submit(function (e) {
        e.preventDefault();
        var data = $SKUChooseForm.serializeArray();
        var url = '/local/ajax/catalog/getSKU.php';

        $.ajax({
            method: "POST",
            url: url,
            data: data
        })
            .done(function (resp) {
                console.log(resp);
                var resp = JSON.parse(resp);
                console.log(resp);
                if (resp.STATUS == 'Y') {
                    if (resp.TYPE == 'palette') {
                        $colorSelect.selectize()[0].selectize.destroy();
                        $colorSelect.find('option:first-child').prop('selected', true);
                        $colorSelect.find('option').each(function () {
                            $(this).prop('disabled', false);
                            if (in_array($(this).val(), resp.ITEMS) == -1)
                                $(this).prop('disabled', true);
                        });
                        $colorSelect.selectize();
                    } else if (resp.TYPE == 'volume') {
                        $volumeInput.each(function () {
                            $(this).prop('disabled', false).parent().removeClass('_disabled');
                            if (in_array($(this).val(), resp.ITEMS) == -1) {
                                $(this).prop('disabled', true).parent().addClass('_disabled');
                            }
                        });
                    } else {
                        $('.product-detail__description [data-buy]').attr('href', resp.LINK);

                        //скрываем все неподходящие объемы
                        $volumeInput.each(function () {
                            $(this).prop('disabled', false).parent().removeClass('_disabled');
                            if (in_array($(this).val(), resp.VOLUMES) == -1) {
                                $(this).prop('disabled', true).parent().addClass('_disabled');
                            }
                        });

                        let currentVal = $colorSelect.val();
                        $colorSelect.selectize()[0].selectize.destroy();
                        $colorSelect.find('option').each(function () {
                            $(this).prop('disabled', false);
                            if (in_array($(this).val(), resp.COLORS) == -1 && $(this).val() !== '0')
                                $(this).prop('disabled', true);
                        });
                        if (currentVal === '0') {
                            $colorSelect.find('option:first-child').prop('selected', true);
                        } else {
                            $colorSelect.val(currentVal);
                        }
                        $colorSelect.selectize();
                    }
                } else {
                    //alert(resp.MESSAGE);
                    console.log(resp.MESSAGE);
                }
            });

    })
    //click volume
    $('body').on('change', '.product-detail__volume-item input,select[name="palette"]', function () {
        $SKUChooseForm.submit();
    });
}

$(document).ready(function () {
    getSKU();

})