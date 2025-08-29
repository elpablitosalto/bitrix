$(function() {
    $( ".sum-button" ).on( "click", function(e) {
        e.preventDefault();
        $("#amount-num").val("");
        $(".sum-button").removeClass("active");
        $("[name='PROPERTY_SUM']").val($(this).prev().val());
    } );

    $( "#amount-num" ).on( "keyup", function(e) {
        $(".sum-button").removeClass("active");
        $("[name='PROPERTY_SUM']").val($(this).val());
    } );
});
function sumbitPayForm() {
    var $form = $(".ajax-form-pay");
    $form.find(".main_error, .msg").html("");
    $form.find("label.error").remove();
    $form.find(".error").removeClass("error");
    var formData = new FormData($form[0]);
    //PAGE_LOADING.Show();
    $.ajax({
        url: window.location.href,
        dataType: "json",
        data: formData,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (data) {
            if($form.find("[name='captchaWidget']").length > 0){
                window.smartCaptcha.reset($form.find("[name='captchaWidget']").val());
            }
            if (data.ID > 0) {
                var path = window.location.hostname+window.location.pathname;
                if(data["RETURN_FIELDS"]["PROPERTY_TYPE_XML_ID"] != "SUBSCRIPTION"){
                    var options = {
                        publicId: 'pk_aa5bb693d13865494535051f7f6ad', //id из личного кабинета
                        description: 'Платёж №'+data.ID+" Страница: "+path, //назначение
                        invoiceId: 'doroga_'+data.ID,
                        amount: Number(data["RETURN_FIELDS"]["PROPERTY_SUM"]), //сумма
                        currency: 'RUB', //валюта
                        requireEmail: false,
                        skin: "mini", //дизайн виджета (необязательно)
                        autoClose: 3, //время в секундах до авто-закрытия виджета (необязательный)
                        data: {
                            payId: data.ID,
                        },
                        /*payer: {
                            phone: '+79133273684',
                        }*/
                    };
                } else {
                    var dataPay = {payId: data.ID};
                    dataPay.CloudPayments = {
                        recurrent: {
                            interval: 'Month',
                            period: 1,
                        }
                    };
                    var options = {
                        accountId:  data["RETURN_FIELDS"]['sessid'],
                        publicId: 'pk_aa5bb693d13865494535051f7f6ad', //id из личного кабинета
                        description: 'Платёж №'+data.ID+" Страница: "+path, //назначение
                        invoiceId: 'doroga_'+data.ID,
                        amount: Number(data["RETURN_FIELDS"]["PROPERTY_SUM"]), //сумма
                        currency: 'RUB', //валюта
                        requireEmail: false,
                        skin: "mini", //дизайн виджета (необязательно)
                        autoClose: 3, //время в секундах до авто-закрытия виджета (необязательный)
                        data: dataPay
                    };
                }
                //console.log(options);
                var widget = new cp.CloudPayments();
                widget.pay('charge', // или 'charge'
                    options,
                    {
                        onSuccess: function (options) { // success
                            $form.find(".msg").html("Ваша заявка успешно принята!");
                            $form[0].reset();
                        },
                        onFail: function (reason, options) { // fail
                           // console.log(reason);
                            //console.log(options);
                            $form.find(".main_error").html("Ошибка оплаты");
                        },
                    }
                );
            } else {
                $.each(data.ERRORS, function (key, value) {
                    switch (key) {
                        case "MAIN":
                            $form.find(".main_error").append(value.join("<br>"));
                            break;
                        default:
                            var element = $form.find("[name='" + key + "']");
                            if (element.length > 0) {
                                element.addClass("error");
                                var errMsgBlock = '<label id="'+key+'-error" class="error" for="'+key+'">'+value.join("<br>")+'</label>';
                                $(errMsgBlock).insertAfter(element);
                            } else {
                                //console.log(key);
                                $form.find(".main_error").append(value.join("<br>"));
                            }
                    }
                });
            }
            //PAGE_LOADING.Hide();
        },
        fail: function () {
            alert("Ошибка получения данных! Пожалуйста обновите страницу и попробуйте ещё раз");
        }
    });
}