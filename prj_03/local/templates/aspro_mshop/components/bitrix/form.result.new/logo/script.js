function getListOfFiles(files) {
    let result = [];

    if (files.length) {
        for (let i = 0; i < files.length; i++) {
            if (typeof files[i] !== 'undefined') {
                result.push(files[i].name);
            }
        }
    }

    return result;
}
function removeFileFromFileList(input, index) {
    const dt = new DataTransfer();
    const { files } = input;

    for (let i = 0; i < files.length; i++) {
        const file = files[i]
        if (index !== i) {
            dt.items.add(file);
        }
    }
    input.files = dt.files;
}

$(document).ready(function(){

    $.validator.addClassRules({
        'phone_input':{
            regexp: arMShopOptions['THEME']['VALIDATE_PHONE_MASK']
        }
    });
    formSubmitHandler();
    if(BX) {
        BX.addCustomEvent(window, "onAjaxSuccess", function () {
            formSubmitHandler();
        });
    }
});

function formSubmitHandler() {
    let $input = $(".js-multiple-file-input");
    $input.on("change", function (){
        let listOfFiles = [];
        let $filesListWrapper = $input.parents(".file-input__panel").find(".list-of-files");
        if($filesListWrapper){
            $filesListWrapper.html("");
        }
        if (typeof $input[0].files !== 'undefined') {
            listOfFiles = getListOfFiles($input[0].files);
        }
        if(listOfFiles.length > 0){
            listOfFiles.forEach((element, index) => {
                $filesListWrapper.append('<div data-index="' + index + '" class="uploaded-file">\n' +
                    '    <div class="uploaded-file__name">\n' +
                    '        ' + element + '\n' +
                    '    </div>\n' +
                    '    <div class="uploaded-file__control input-file__control_state_selected">\n' +
                    '        <button type="button" class="input-file__clear"></button>\n' +
                    '    </div>\n' +
                    '</div>');
            });
            $filesListWrapper.find(".input-file__clear").each(function (){
                $(this).off("click");
                $(this).on("click", function (event){
                    event.stopPropagation();
                    let fileIndex = parseInt($(this).parents('.uploaded-file').data("index"));
                    removeFileFromFileList($input[0], fileIndex);
                    $input.trigger("change");
                    return false;
                });
            });
        }
    });

    $('form#logo-page-form').validate({
        highlight: function (element) {
            $(element).parent().addClass('error');
        },
        unhighlight: function (element) {
            $(element).parent().removeClass('error');
        },
        submitHandler: function (form) {
            if ($(form).valid()) {
                let checkResult = true;
                const fileField = document.querySelector("input[type='file']");
                if (parseInt(fileField .files.length)>5){//проверка на ко-во загруженных файлов
                    Fancybox.show([{ src: "#wrong__length", type: "inline" }]);
                    checkResult = false;
                } else{
                    for (let key in fileField.files) {
                        if(fileField.files[key] && typeof fileField.files[key] == "object") {
                            let type = fileField.files[key].type.split('/').pop();
                            let size = fileField.files[key].size / 1024 / 1024
                            if (type != "msword" && type != "jpg" && type != "jpeg" && type != "svg" && type != "png" && type != "pdf") {// проверка на соответствие формата
                                Fancybox.show([{src: "#wrong__ext", type: "inline"}]);
                                checkResult = false;
                                break
                            } else if (size > 0.5) {//проверка на соответствие максимальному размеру
                                Fancybox.show([{src: "#wrong__size", type: "inline"}]);
                                checkResult = false;
                                break
                            }
                        }
                    }
                }
                if(!checkResult){
                    return false;
                }
                /*form.submit();
                setTimeout(function() {
                    $(form).find('button[type="submit"]').attr("disabled", "disabled");
                }, 300);*/
                var eventdata = {
                    type: 'form_submit',
                    form: form,
                    form_name: 'logo-page-form'
                };
                BX.onCustomEvent('onSubmitForm', [eventdata]);
            }
        },
        errorPlacement: function (error, element) {
            error.insertBefore(element);
        },
        messages: {
            licenses_inline: {
                required: BX.message('JS_REQUIRED_LICENSES')
            }
        }
    });
}