$(document).ready(function () {

    var url_ajax = $('#MODAL_CONTEST_WORKS_SLIDES_AJAX_PATH').val();

    /* Нажатие кнопки Загрузить фото с призом --> */
    $('.ml-work__upload-btn').on('click', function (e) {
        //alert('!!');
        var $modal = $(this).closest('.ml-modal');
        //alert($modal[0].id);
        if ($modal.length) {
            var $modalSuccess = $('#' + $modal[0].id + '-upload-photo');
            if ($modalSuccess.length) {
                $modal.fadeOut(200, function () {
                    //clearForm($form[0]);
                    $modalSuccess.fadeIn(300);
                });
            }
        }
        else {
            //clearForm($form[0]);
        }
    });
    /* <-- Нажатие кнопки Загрузить фото с призом */

    /* Нажатие кнопки Отправить --> */
    $('.js_ml_btn_submit_photo_with_prize').on('click', function (e) {
        e.preventDefault();
        var $submit = $(this);
        var $form = $submit.closest('form');
        var $modal = $form.closest('.ml-modal');
        var $errorContainer = $('#' + $modal[0].id + '-error');
        $errorContainer.css('display', 'none');

        if (validateForm($form[0])) {
            if ($submit.hasClass('ml-btn_anim-submit')) {
                animSubmitBtn($submit[0], 'proccessing');
            }

            // Форма -->
            var formData = new FormData($form.get(0));
            formData.append('action', 'send_form');

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
                                modalFormProccess_Works();
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
            //modalFormProccess_Works();
        }

        function modalFormProccess_Works() {
            if ($modal.length) {
                var $modalSuccess = $('#' + $modal[0].id + '-success');
                if ($modalSuccess.length) {
                    $modal.fadeOut(200, function () {
                        //clearForm($form[0]);
                        $modalSuccess.fadeIn(300);
                    });
                }
            }
            else {
                //clearForm($form[0]);
            }
        }
    });
    /* <-- Нажатие кнопки Отправить */

    /* Плагин загрузки файла --> */
    var $formUploadWorkDropzone = $('.js-ml-dropzone-photo-prize');
    if ($formUploadWorkDropzone.length) {
        $formUploadWorkDropzone.dropzone({
            url: url_ajax,
            thumbnailWidth: 780,
            thumbnailHeight: 780,
            thumbnailMethod: 'contain',
            maxFiles: 1,
            acceptedFiles: 'image/jpg, image/png, image/jpeg',
            maxFilesize: 10,
            autoProcessQueue: false,
            previewTemplate: '<div class="dz-preview dz-image-preview ml-dropzone-preview">' +
                '<div class="dz-image ml-dropzone-image"><img data-dz-thumbnail></div>' +
                '<button class="ml-dropzone-remove" type="button" title="Удалить изображение" data-dz-remove><svg class="icon icon-close"><use xlink:href="#close"></use></svg></button>' +
                '</div>',
            dictDefaultMessage: 'Перетащите файл сюда для загрузки',
            dictFallbackMessage: 'Ваш браузер не поддерживает загрузку файлов перетаскиванием',
            dictFallbackText: 'Пожалуйста, используйте поле для загрузки фалов',
            dictFileTooBig: 'Файл слишком большой ({{filesize}} mb). Максимальный размер файла: {{maxFilesize}} mb.',
            dictInvalidFileType: 'Вы не можете загрузить данный файл. Допустимый формат JPEG, JPG, PNG',
            dictResponseError: 'Сервер ответил с кодом {{statusCode}}.',
            dictCancelUpload: 'Отмена загрузки',
            dictCancelUploadConfirmation: 'Вы уверены, что хотите отменить загрузку?',
            dictRemoveFile: 'Удалить файл',
            dictMaxFilesExceeded: 'Загружено максимально возможное количество файлов',

            accept: function (file, done) {
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
                                $('#PHOTO_PRIZE_UPLOAD_FILE_NAME').val(obj.UPLOAD_FILE_NAME);
                            }
                        },
                        error: function (jqXHR, exception) {
                            //alert(exception);
                        }
                    });
                });
                this.on("removedfile", function (file) {
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
    /* <-- Плагин загрузки файла */

    /* Слайдер --> */
    modalWorksSlider_Winners_Custom();
    /* <-- Слайдер */
});

/* Слайдер --> */
function modalWorksSlider_Winners_Custom() {

    var $modalWorksSlider = $('.js-ml-works-slider-winners-custom');
    var modalWorksSliderArr = [];
    if ($modalWorksSlider.length) {
        $modalWorksSlider.each(function (i) {
            var $this = $(this);
            var $modalWorksSliderContainer = $this.find('.ml-works-slider__container');
            $modalWorksSliderContainer.addClass('swiper');
            $this.find('.ml-works-slider__list').addClass('swiper-wrapper');
            //$this.find('.ml-works-slider__item').addClass('swiper-slide');            
            $items = $this.find('.ml-works-slider__item');
            $items.addClass('swiper-slide');
            // $this.append("<div class='ml-slider-pagination'></div>");
            $this.append(
                '<div class="ml-slider-arrows">' +
                '<button type="button" class="ml-slider-arrow ml-slider-arrow_prev">' +
                '<svg class="icon icon-arrowLeft">' +
                '<use xlink:href="#arrowLeft"></use>' +
                '</svg>' +
                '</button>' +
                '<button type="button" class="ml-slider-arrow ml-slider-arrow_next">' +
                '<svg class="icon icon-arrowRight">' +
                '<use xlink:href="#arrowRight"></use>' +
                '</svg>' +
                '</button>' +
                '</div>'
            );

            modalWorksSliderArr[i] = new Swiper($modalWorksSliderContainer[0], {
                spaceBetween: 40,
                speed: 800,
                slidesPerView: 1,
                autoHeight: true,
                navigation: {
                    nextEl: $this.find(".ml-slider-arrow_next")[0],
                    prevEl: $this.find(".ml-slider-arrow_prev")[0],
                },
                // pagination: {
                // 	el: $this.find('.ml-slider-pagination')[0],
                // 	clickable: true,
                // }
            });

            /* Прокрутка слайдера --> */
            modalWorksSliderArr[i].on('slideChange', function () {
                //console.log('slide changed');
                const index_currentSlide = modalWorksSliderArr[i].realIndex;
                const currentSlide = modalWorksSliderArr[i].slides[index_currentSlide];
                const id = $(currentSlide).attr('data-elid');
                //const id = $item.attr('data-elid');    
                //alert(id);
                $('#CUR_WORK_ELEMENT_ID').val(id);
            });
            /* <-- Прокрутка слайдера */

            /* Нажатие на работу --> */
            $items.each(function (j) {
                var id = $(this).attr('data-elid');
                var slide_ind_str = $(this).attr('data-slideind');
                var slide_ind = Number(slide_ind_str) - 1;
                //alert(slide_ind);
                
                $('#work_tile_winners_'+id).on('click', function () {
                    //alert(slide_ind);
                    modalWorksSliderArr[i].slideTo(slide_ind, 0, false);
                    $('#CUR_WORK_ELEMENT_ID').val(id);
                });
            });
            /* <-- Нажатие на работу */
        });
    }
}
/* <-- Слайдер */