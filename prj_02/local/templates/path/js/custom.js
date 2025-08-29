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
                if ($form.find("[name='captchaWidget']").length > 0) {
                    window.smartCaptcha.reset($form.find("[name='captchaWidget']").val());
                }
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
            //alert(Number($(this).height()));
            if (Number($(this).height()) == 0) {
                $(this).height(103);
            }
        });
    }

}