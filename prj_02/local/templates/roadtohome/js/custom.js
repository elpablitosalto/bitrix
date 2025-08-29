$(function () {
    $(".ajax-form").submit(function (event) {
        event.preventDefault();
        var $form = $(this);
        $form.find(".main_error").html("");
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
                //console.log(data.RESULT);
                /* */
                if ($form.find("[name='captchaWidget']").length > 0) {
                    window.smartCaptcha.reset($form.find("[name='captchaWidget']").val());
                }
                /**/
                //alert(data.ERRORS);
                //alert(data.RETURN_FIELDS.TEST);
                //alert(data.RETURN_FIELDS.TEST);
                //alert(data.RETURN_FIELDS.TEST_NAME_POST);
                //alert(data.RETURN_FIELDS.TEST_NAME_DATA);
                if (data.ID > 0) {
                    $form.find(".msg").html("Ваша заявка успешно принята!");
                    $form[0].reset();
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
                                    var errMsgBlock = '<label id="' + key + '-error" class="error" for="' + key + '">' + value.join("<br>") + '</label>';
                                    $(errMsgBlock).insertAfter(element);
                                } else {
                                    $form.find(".main_error").append(value.join("<br>"));
                                }
                        }
                    });
                }
                //PAGE_LOADING.Hide();
            },
            fail: function () {
                alert("Ошибка получения данных! Пожалуйста обновите страницу и попробуйте ещё раз");
            },
            error: function (jqXHR, exception) {
                /*if (jqXHR.status === 0) {
                    console.log('Not connect. Verify Network.');
                } else if (jqXHR.status == 404) {
                    console.log('Requested page not found (404).');
                } else if (jqXHR.status == 500) {
                    console.log('Internal Server Error (500).');

                } else if (exception === 'parsererror') {
                    console.log('Requested JSON parse failed.');
                } else if (exception === 'timeout') {
                    console.log('Time out error.');
                } else if (exception === 'abort') {
                    console.log('Ajax request aborted.');
                } else {
                    console.log('Uncaught Error. ' + jqXHR.responseText);
                }
                console.log(jqXHR.responseText);*/
            }
        });

    });

    $(".sumbit-pay-form").click(function (event) {
        event.preventDefault();

        if (!window.smartCaptcha) {
            //console.log("captcha!");
            return;
        }
        var $form = $(".ajax-form-pay");
        window.smartCaptcha.execute($form.find("[name='captchaWidget']").val());

    });

});

function showHiddenCaptcha() {
    if (!window.smartCaptcha) {
        return;
    }

    if ($('.captcha-container-hidden').length > 0) {
        $('.captcha-container-hidden').each(function () {
            var $container = $(this);
            var el = $container[0];
            var widgetId = window.smartCaptcha.render(el, {
                sitekey: 'ysc1_dPA7yYYE1zOuLu20Zk5ShRWfwefPmIteq1VzAb5rb2da5a0f',
                invisible: true, // Сделать капчу невидимой
                hideShield: true
            });
            $container.append("<input type='hidden' value='" + widgetId + "' name='captchaWidget'>");

            window.smartCaptcha.subscribe(
                widgetId,
                'success',
                () => {
                    //console.log("c-sucess!");
                    sumbitPayForm();
                }
            );

        });
    }

    if ($('.smart-captcha').length > 0) {
        $('.smart-captcha').each(function () {
            var el = $(this)[0];
            var widgetId = window.smartCaptcha.render(el, {
                sitekey: 'ysc1_dPA7yYYE1zOuLu20Zk5ShRWfwefPmIteq1VzAb5rb2da5a0f',
                hl: 'ru',
            });
            $(this).append("<input type='hidden' value='" + widgetId + "' name='captchaWidget'>");
            /*if ($(this).height() == 0) {
                $(this).height(103);
            }*/
        });
        $( "[data-modal]" ).on( "click", function() {
            var modal = $($(this).attr("href"));
            if(modal.find(".smart-captcha").length > 0){
                modal.find(".smart-captcha").height(103);
            }
        } );
    }

}