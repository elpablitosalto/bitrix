$(".group-info__controller").click(e => $(e.currentTarget.closest('.c-white-box')).addClass('c-white-box--edit'));

BX.ready(function() {
    BX.bindDelegate(
        document.body, 'submit', { className: "dp-form-profile" },
        function(e) {
            saveProfileData(e, $(this), "profileSave");
            return BX.PreventDefault(e);
        }
    );
    BX.bindDelegate(
        document.body, 'submit', { className: "dp-form-change-password" },
        function(e) {
            saveProfileData(e, $(this), "passwordSave");
            return BX.PreventDefault(e);
        }
    );
    BX.bindDelegate(
        document.body, 'click', { className: "dp-field-confirm__btn" },
        function(e) {

            var request = BX.ajax.runComponentAction('indexis:profile', "confirmEmail", {
                mode: 'class',
                cache: false,
            });

            request.then(function (response) {
                if(response.status != "success"){
                    $(".dp-field-confirm__msg").html("Ошибка отправки ссылки!");
                }
            }, function (response) {

            });

        }
    );
});

function saveProfileData(e, dataThis, method) {

    var arFormData = dataThis.serialize();
    var resultBlock = dataThis.find(".result");
    resultBlock.html("");
    dataThis.find(".dp-field").removeClass("error");
    dataThis.find(".c-error-form__text").remove();
    //console.log(arFormData);

    var request = BX.ajax.runComponentAction('indexis:profile', method, {
        mode: 'class',
        cache: false,
        data: arFormData,
    });

    request.then(function (response) {
        if(response.data["STATUS"] == "ok"){
            //console.log(resultBlock);
            //console.log(response);
            resultBlock.removeClass("error");
            resultBlock.html("Изменения успешно сохранены!");
        }  else {
            $.each(response.data["ERRORS"], function (key, value) {
                switch (key) {
                    case "MAIN":
                        resultBlock.append(value.join("<br>"));
                        break;
                    default:
                        var element = dataThis.find("[name='" + key + "']");
                        var errMsgBlock = '<span class="c-error-form__text">' + value.join("<br>") + '</span>';
                        $(errMsgBlock).insertAfter(element);
                        element.parent().addClass("c-error-form");
                }
            });
        }

    }, function (response) {

    });

    return BX.PreventDefault(e);

}