$(document).ready(function () {

    var url_ajax = $('#MODAL_CONTEST_AJAX_PATH').val();

    /* Маски ввода --> */

    // Телефон -->
    $('#fcr-phone').inputmask("+7-999-999-99-99");
    //$('#fcr-phone').inputmask("+9{1,3}-999-999-99-99");
    // <-- Телефон 

    // Возраст -->
    $('#fcr-participantAge').inputmask("9{1,2}");
    // <--

    // Email -->
    $.fn.setCursorPosition = function (pos) {
        this.each(function (index, elem) {
            if (elem.setSelectionRange) {
                elem.setSelectionRange(pos, pos)
            }
            else if (elem.createTextRange) {
                var range = elem.createTextRange()
                range.collapse(true)
                range.moveEnd('character', pos)
                range.moveStart('character', pos)
                range.select()
            }
        })
        return this
    }
    $.fn.getCursorPosition = function () {
        var pos = 0,
            el = $(this).get(0)
        if (document.selection) {
            el.focus()
            var Sel = document.selection.createRange()
            var SelLength = document.selection.createRange().text.length
            Sel.moveStart('character', -el.value.length)
            pos = Sel.text.length - SelLength
        }
        else if (el.selectionStart || el.selectionStart == '0')
            pos = el.selectionStart
        return pos
    }
    $('#fcr-email').inputmask({
        alias: 'email',
        showMaskOnHover: false
    });
    $('#fcr-email').on('click touchpress', function () {
        var cursor_pos = $(this).getCursorPosition(),
            p_this = $(this)
        setTimeout(function () {
            // console.log(p_this.val())
            if (p_this.val() === '') {
                p_this.setCursorPosition(0)
                return
            }
            p_this.setCursorPosition(cursor_pos)
        }, 3)
    });
    /*
    //$("#fcr-email").inputmask("email");
    $("#fcr-email").inputmask({
        mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
        greedy: false,
        onBeforePaste: function (pastedValue, opts) {
            pastedValue = pastedValue.toLowerCase();
            return pastedValue.replace("mailto:", "");
        },
        definitions: {
            '*': {
                validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                casing: "lower"
            }
        }
    });
    */
    //$('#fcr-email').inputmask("*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]");
    // <-- Email

    /* <-- Маски ввода */


    /* Нажатие кнопки Зарегистрироваться --> */
    $('.ml-btn_submit_contest_reg').on('click', function (e) {
        e.preventDefault();
        var $submit = $(this);
        var $form = $submit.closest('form');
        var $modal = $form.closest('.ml-modal');
        var $errorContainer = $('#' + $modal[0].id + '-error');
        $errorContainer.css('display', 'none');

        if (validateForm_ContestReg($form[0])) {
            if ($submit.hasClass('ml-btn_anim-submit')) {
                animSubmitBtn($submit[0], 'proccessing');
            }

            // Форма -->
            var formData = new FormData($form.get(0));
            formData.append('action', 'send_form');

            /*
            // ID конкурса -->
            var CONTEST_ELEMENT_ID = $('#CONTEST_ELEMENT_ID').val();
            if (Number(CONTEST_ELEMENT_ID) > 0) {
                formData.append('CONTEST_ELEMENT_ID', CONTEST_ELEMENT_ID);
            }
            // <-- ID конкурса
            */

            /*
            // Добавление файла -->
            var files = $('#js-file').files;
            $.each( files, function( key, value ){
                formData.append( key, value );
                alert(key);
                alert(value);
            });
            // <-- Добавление файла
            */

            $.ajax({
                type: "POST",
                url: url_ajax,
                data: formData,
                contentType: false,
                processData: false,
                success: function (result) {
                    //$('#message').html(result);
                    //alert(result);
                    var obj = jQuery.parseJSON(result);
                    if (obj.RESULT === "ERROR") {
                        setTimeout(function () {
                            $errorContainer.css('display', 'block');
                            $errorContainer.html(obj.ERROR_HTML);
                            animSubmitBtn($submit[0], 'start');
                        }, 2000);
                    }
                    else if (obj.RESULT === "SUCCESS") {
                        setTimeout(function () {
                            animSubmitBtn($submit[0], 'complete');
                            setTimeout(function () {
                                animSubmitBtn($submit[0], 'start');
                                // clearForm($form[0]);
                                modalFormProccess();
                            }, 2000);
                        }, 1500);
                    }
                },
                error: function (jqXHR, exception) {
                    $errorContainer.html(exception);
                    setTimeout(function () {
                        animSubmitBtn($submit[0], 'complete');
                    }, 2000);
                }
            });
        }
        else {
            //modalFormProccess();
        }

        function modalFormProccess() {
            if ($modal.length) {
                var $modalSuccess = $('#' + $modal[0].id + '-success');
                if ($modalSuccess.length) {
                    $modal.fadeOut(200, function () {
                        clearForm($form[0]);
                        $modalSuccess.fadeIn(300);
                    });
                }
            }
            else {
                clearForm($form[0]);
            }
        }
    });
    /* <-- Нажатие кнопки Зарегистрироваться */


    var $formUploadWorkDropzone = $('.js-ml-dropzone-contest-reg');
    if ($formUploadWorkDropzone.length) {
        $formUploadWorkDropzone.dropzone({
            //url: '/upload/temp/',
            url: url_ajax,
            thumbnailWidth: 780,
            thumbnailHeight: 780,
            thumbnailMethod: 'contain',
            maxFiles: 1,
            acceptedFiles: 'image/jpg, image/png, image/jpeg',
            // maxFilesize: 10485760,
            maxFilesize: 10,
            autoProcessQueue: false,
            // addRemoveLinks: '<button class="ml-dropzone-remove" type="button"><svg class="icon icon-close"><use xlink:href="#close"></use></svg></button>',
            previewTemplate: '<div class="dz-preview dz-image-preview ml-dropzone-preview">' +
                '<div class="dz-image ml-dropzone-image"><img data-dz-thumbnail></div>' +
                /*'<div class="dz-details">' +
                '<div class="dz-size"><span data-dz-size></span></div>' +
                '<div class="dz-filename"><span data-dz-name></span></div>' +
                '</div>' +*/
                //'<div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>' +
                //'<div class="dz-success-mark"><svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <title>Check</title><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF"></path></g></svg></div>' +
                //'<div class="dz-error-mark"><svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <title>Error</title><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475"> <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z"></path></g></g></svg></div>' +
                //'<div class="dz-error-message"><span data-dz-errormessage></span></div>' +
                '<button class="ml-dropzone-remove" type="button" title="Удалить изображение" data-dz-remove><svg class="icon icon-close"><use xlink:href="#close"></use></svg></button>' +
                '</div>',
            dictDefaultMessage: 'Перетащите файл сюда для загрузки',
            dictFallbackMessage: 'Ваш браузер не поддерживает загрузку файлов перетаскиванием',
            dictFallbackText: 'Пожалуйста, используйте поле для загрузки фалов',
            dictFileTooBig: 'Файл слишком большой ({{filesize}} mb). Максимальный размер файла: {{maxFilesize}} mb.',
            // dictInvalidFileType: 'Вы не можете загрузить файл данного типа',
            dictInvalidFileType: 'Вы не можете загрузить данный файл. Допустимый формат JPEG, JPG, PNG',
            dictResponseError: 'Сервер ответил с кодом {{statusCode}}.',
            dictCancelUpload: 'Отмена загрузки',
            dictCancelUploadConfirmation: 'Вы уверены, что хотите отменить загрузку?',
            dictRemoveFile: 'Удалить файл',
            dictMaxFilesExceeded: 'Загружено максимально возможное количество файлов',

            //autoDiscover: false,
            accept: function (file, done) {
                /*
                //произвольная функция проверки загружаемых файлов
                if (file.type == "image/png") {
                    //сообщение без ошибки, если файл забракован
                    done("I don`t accept PNGs.");
                }
                //чтобы файл был принят, нужно вызвать done без параметров
                else { done(); }
                */
            },
            init: function () {
                this.on("addedfile", function (file) {
                    var $el = $(this.element);
                    var $parent = $el.parent('.ml-form-field');
                    if ($parent.hasClass('ml-form-field_error')) {
                        $parent.removeClass('ml-form-field_error');
                    }
                    var $error = $parent.find('.ml-form-error');
                    if ($error.length) {
                        $error.remove();
                    }

                    var formData = new FormData();
                    formData.append('file', file);
                    formData.append('action', 'send_file');
                    $.ajax({
                        type: "POST",
                        url: url_ajax,
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (result) {
                            //alert(result);
                            var obj = jQuery.parseJSON(result);
                            if (obj.RESULT === "ERROR") {
                                var $errorContainer = $('#' + $('SERVER_VALIDATE_ERROR_CONT_ID').val());
                                setTimeout(function () {
                                    $errorContainer.css('display', 'block');
                                    $errorContainer.html(obj.ERROR_HTML);
                                    //animSubmitBtn($submit[0], 'start');
                                }, 2000);
                            }
                            else if (obj.RESULT === "SUCCESS") {
                                $('#CONTEST_UPLOAD_FILE_NAME').val(obj.CONTEST_UPLOAD_FILE_NAME);
                            }
                        },
                        error: function (jqXHR, exception) {
                            //alert(exception);
                        }
                    });
                });
                this.on("removedfile", function (file) {
                    // if (file.previewElement == null) {
                    // 	var $el = $(this.element);
                    // 	if ($el.hasClass('ml-dropzone_error')) {
                    // 		$el.removeClass('ml-dropzone_error');
                    // 	}
                    // 	var $error = $el.parent('.ml-form-field').find('.ml-form-error');
                    // 	if ($error.length) {
                    // 		$error.remove();
                    // 	}
                    // }
                });
                this.on("error", function (file, message, xhr) {
                    var $el = $(this.element);
                    var $parent = $el.parent('.ml-form-field');
                    $parent.addClass('ml-form-field_error');
                    $el.after('<div class="ml-form-error">' + message + '</div>');
                    if (xhr == null) {
                        this.removeFile(file)
                    }
                });
            }
        });
    }
});


function validateForm_ContestReg(form) {

    var valid = true;
    var $form = $(form);
    var $reqFields = $form.find('[required]');
    $reqFields.closest('.ml-form-field').removeClass('ml-form-field_error');
    var $errors = $form.find('.ml-form-error');
    var bError = false;
    //var nameSelectorWithError;
    var $SelectorWithError;
    var flagError = false;
    // var $fields = $form.find('input, textarea');
    if ($errors.length) {
        $errors.remove();
    }
    // $(form).find('.syr-form-step__error').empty();

    for (var i = 0; i < $reqFields.length; i++) {
        var $currentField = $($reqFields[i]);
        var $fieldWrapper = $currentField.closest('.ml-form-field');
        //alert($currentField.attr('type'));
        switch ($currentField.attr('type')) {
            case 'email':
                break;
            case 'checkbox':
                if (!$currentField.prop('checked')) {
                    valid = false;
                    $fieldWrapper.addClass('ml-form-field_error');
                    if ($currentField.data('error')) {
                        $fieldWrapper.append('<div class="ml-form-error">' + $currentField.data('error') + '</div>');
                    }
                    else {
                        $fieldWrapper.append('<div class="ml-form-error">Это поле обязательное для заполнения</div>');
                    }
                    flagError = true;
                }
                break;
            default:
                if ($currentField.val().length < 1) {
                    valid = false;
                    $fieldWrapper.addClass('ml-form-field_error');
                    if ($currentField.data('error')) {
                        $fieldWrapper.append('<div class="ml-form-error">' + $currentField.data('error') + '</div>');
                    }
                    else {
                        $fieldWrapper.append('<div class="ml-form-error">Это поле обязательное для заполнения</div>');
                    }
                    flagError = true;
                }
                else {
                    if ($currentField.attr('name') == 'email') {
                        if (!validateFormEmail($currentField.val())) {
                            valid = false;
                            $fieldWrapper.addClass('ml-form-field_error');
                            if ($currentField.data('error')) {
                                $fieldWrapper.append('<div class="ml-form-error">' + $currentField.data('error') + '</div>');
                            }
                            else {
                                $fieldWrapper.append('<div class="ml-form-error">Указан некорректный email</div>');
                            }
                            flagError = true;
                        }
                    }
                }
        }
        if (flagError == true) {
            if (bError == false) {
                bError = true;
                //nameSelectorWithError = $currentField.attr('name');
                $SelectorWithError = $currentField;
            }
        }
    }
    // Переход к ошибке -->
    if (bError == true) {
        var MODAL_DIV_ID = $('#MODAL_DIV_ID').val();
        $('#' + MODAL_DIV_ID).animate({ scrollTop: $SelectorWithError.offset().top }, 'slow');
    }

    var $dropzone = $form.find('.ml-dropzone_required');
    if ($dropzone.length && !$dropzone.hasClass('dz-started')) {
        valid = false;
        $dropzoneParent = $dropzone.parent('.ml-form-field');
        $dropzoneParent.addClass('ml-form-field_error');
        if ($dropzone.data('error')) {
            $dropzoneParent.append('<div class="ml-form-error">' + $dropzone.data('error') + '</div>');
        }
        else {
            $dropzoneParent.append('<div class="ml-form-error">Загрузите изображения</div>');
        }
    }

    if (!valid) {
        // $(form).find('.syr-form-step__error').append('<p>Заполните обязательные поля</p>');
        var $btnSubmit = $form.find('.ml-btn_anim-submit');
        if ($btnSubmit.length) {
            animSubmitBtn($btnSubmit[0], 'start');
        }
    }

    return valid;
}