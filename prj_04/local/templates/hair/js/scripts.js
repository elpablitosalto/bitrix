function initCaptcha() {
    grecaptcha.ready(function () {
        if (window.recaptchaCode) {
            grecaptcha.execute(window.recaptchaCode, { action: 'sendForm' }).then(function (token) {
                var recaptchaResponse = document.getElementById('recaptchaResponse');
                recaptchaResponse.value = token;
            });
        }
    });
}

function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function useFilter() {
    let $form = $('.smart-filter-form');

    if ($('[data-filter-button]').length > 0) {
        $('[data-filter-button]').click(function (e) {
            e.preventDefault();
            $form.submit();
        });
        $('[data-refresh-button]').click(function (e) {
            e.preventDefault();
            $form.find('input[type="text"]').val('');
            $form.find('input[type="checkbox"]').each(function () {
                $(this).prop('checked', false);
            })
            $form.submit();
        });
    } else {
        $('.smart-filter-form input[type="checkbox"]').change(function (e) {
            e.preventDefault();
            $form.submit();
        });
    }

    $('.smart-filter-form input[type="checkbox"]').change(function (e) {
        e.preventDefault();
        $form.submit();
    });

    $form.submit(function (e) {
        e.preventDefault();
        var url = $form.attr('action');
        var data = $form.serialize();
        data += '&AJAX_CALL=Y';

        $.ajax({
            method: "POST",
            url: url,
            data: data
        })
            .done(function (resp) {
                $('body').find('[data-ajax-container]').html(resp);
            });
    })
}

function fileInputInit() {
    if ($("#aks-file-upload").length > 0) {
        $("#aks-file-upload").aksFileUpload({
            input: "#PHOTOS",
            fileType: ['jpg', 'jpeg', 'png'],
            dragDrop: true,
            maxSize: "10 MB",
            multiple: true,
            maxFile: 15,
            label: "Загрузить фото",
            ajaxUpload: false
        });
    }
}

function addFormInit() {
    var $form = $('[data-form-ajax]');

    $form.submit(function (e) {
        $currentForm = $(this);
        e.preventDefault();
        var url = $currentForm.attr('action');
        var data = $currentForm.serialize();

        $currentForm.find('._error').each(function () {
            $(this).removeClass('_error');
        });

        $.ajax({
            method: "POST",
            url: url,
            data: data
        })
            .done(function (resp) {
                var response = JSON.parse(resp);
                if (response.TYPE == 'ERROR') {
                    var $inputs = response.FIELDS;
                    if ($form.find('[name="' + response.FIELDS + '"]').length > 0) {
                        $form.find('[name="' + response.FIELDS + '"]').closest('.form-wrapper__item').addClass('_error').find('.error').html(response.MESSAGE);
                    } else {
                        showSucessPopup(response.MESSAGE, 'error');
                    }
                } else {
                    $.magnificPopup.close();
                    showSucessPopup(response.MESSAGE);
                    $currentForm.find('input,textarea').val('');
                }
            });
    })
}

function maskInputInit() {
    $('[type="phone"]').mask("+7 (999) 999-99-99");
}

function moreDescriptionInit() {
    $('.product-detail__text .button').click(function (e) {
        e.preventDefault();
        $(this).prev().addClass('_active');
        $(this).remove();
    });
}

function imageGalleryPopupInit() {
    $('[data-image-gallery-popup]').magnificPopup({
        type: 'image',
        removalDelay: 300,
        mainClass: 'mfp-fade',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
        },
    });
    $('[data-image-gallery-popup-product]').magnificPopup({
        type: 'image',
        removalDelay: 300,
        mainClass: 'mfp-fade',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
        },
    });
}

function showSucessPopup(html, type = 'success', reload = false) {
    Fancybox.show([
        {
            src: '#modalFormStatus'
        }
    ], {
        closeExisting: true,
        autoFocus: false,
        touch: false,
        on: {
            init(inst) {
                var modal = document.querySelector('#modalFormStatus'),
                    message = document.querySelector('#modalFormStatusContent');

                if (type === 'success') {
                    modal.classList.remove('modal_state_error');
                } else {
                    modal.classList.add('modal_state_error');
                }
                if (message) {
                    message.innerHTML = html;
                }
            },
            shouldClose(inst) {
                initCaptcha();
                if (reload) {
                    window.location.reload();
                }
            }
        }
    });
}

function ajaxDownloadInit() {
    $('body').on('change', '[data-dowloaded-file]', function () {
        let $filesField = $('#filesToDownload');
        var currentFiles = $filesField.val();
        if (currentFiles !== '')
            currentFiles = currentFiles.split(',');
        else
            currentFiles = [];
        if ($(this).prop('checked') == true) {
            currentFiles.push($(this).val());
        } else {
            var key = currentFiles.indexOf($(this).val());
            currentFiles.splice(key, 1);
        }
        currentFiles.join(',');
        $filesField.val(currentFiles);
    });
    $('body').on('click', '[data-ajax-download]', function (e) {
        let $filesField = $('#filesToDownload');
        e.preventDefault()
        var url = '/local/ajax/downloads/download.php';
        var data = 'FILES=' + $filesField.val();

        $.ajax({
            method: "POST",
            url: url,
            data: data
        })
            .done(function (resp) {
                var response = JSON.parse(resp);
                if (response.SUCCESS == 'Y') {
                    window.open(response.MESSAGE, "_blank");
                } else {
                    showSucessPopup(response.MESSAGE, 'error');
                }
            });
    });
}

function downloadsPopupInit() {
    $('body').on('click', '[data-downloads-popup]', function (e) {
        e.preventDefault();

        var hash = $(this).attr('href');
        let $popup = $(hash);

        var url = '/local/ajax/downloads/popup.php';
        var data = 'FILE_ID=' + $(this).closest('.downloads-item').data('id');

        $.ajax({
            method: "POST",
            url: url,
            data: data
        })
            .done(function (resp) {
                console.log(resp);
                var response = JSON.parse(resp);
                if (response.MODIFICATOR)
                    $popup.addClass(response.MODIFICATOR);

                $('.downloads-popup').html(response.CONTENT);
                $.magnificPopup.open({
                    items: {
                        src: hash,
                        type: 'inline'
                    },
                    midClick: true,
                    removalDelay: 300,
                    mainClass: 'mfp-fade'
                });
            });

    });
}

function downloadsPageInit() {
    $('body').on('change', '.downloads-item input[type="checkbox"]', function () {
        var $totalCntObj = $('.downloads-cnt i');
        var totalCnt = parseInt($totalCntObj.text());
        if ($(this).prop('checked') == true)
            totalCnt++;
        else
            totalCnt--;

        $totalCntObj.text(totalCnt);
    });
}

function defaultFileFieldInit() {
    $('.form-wrapper__item-file__default input[type="file"]').change(function () {
        var fileName = $(this).get(0).files.item(0).name;
        $(this).parent().find('.add-file-text').text(fileName);
    })
}

function formWithFileInit() {

    $('body').on('submit', '[data-form-with-file]', function (e) {
        e.preventDefault();
        let $form = $(this);
        let url = $form.attr('action');

        var fd = new FormData();
        $.each($form.find("input[type='file']"), function (i, tag) {
            $.each($(tag)[0].files, function (i, file) {
                fd.append(tag.name, file);
            });
        });
        var params = $form.serializeArray();
        $.each(params, function (i, val) {
            fd.append(val.name, val.value);
        });
        $form.find('._error').each(function () {
            $(this).removeClass('_error');
        });

        $.ajax({
            method: "POST",
            url: url,
            data: fd,
            processData: false,
            contentType: false,
        })
            .done(function (resp) {
                var response = JSON.parse(resp);
                if (response.TYPE == 'INPUT_ERROR') {
                    $form.find('[name="' + response.FIELDS + '"]').closest('.form-wrapper__item').addClass('_error').find('.error').html(response.MESSAGE);
                } else {
                    if (response.STATUS == 'Y') {
                        $.magnificPopup.close();
                        showSucessPopup(response.MESSAGE);
                        $form.find('input,textarea').val('');
                    } else {
                        $.magnificPopup.close();
                        showSucessPopup(response.MESSAGE, 'error');
                    }
                }
            });
    });
}

function rezumeFormAddID() {
    $('[data-popup="rezume"]').click(function () {
        $('#vacancyID').val($(this).data('id'));
    })
}

function palletteSliderInit() {
    $('body').find('[data-palette-slider]').each(function () {
        let id = '#' + $(this).attr('id');
        let navigationWrapper = '[data-filter="' + $(this).attr('id') + '"]';
        var paletteSlider = new Swiper(id, {
            lazy: true,
            slidesPerView: 1,
            navigation: {
                nextEl: navigationWrapper + ' .swiper-button-next',
                prevEl: navigationWrapper + ' .swiper-button-prev',
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 20
                },
                992: {
                    slidesPerView: 1,
                    spaceBetween: 20
                }
            }
        });
    });
}

function showHidePasswordInit() {
    $('.show-hide').click(function (e) {
        e.preventDefault();
        var $input = $(this).closest('.form-wrapper__item').find('input');
        if ($input.hasClass('_showed'))
            $input.attr('type', 'password').removeClass('_showed');
        else
            $input.attr('type', 'text').addClass('_showed');
    })
}

function registerInit() {
    $('body').on('change', 'input[type="radio"]', function () {
        $(this).closest('.radio-group__item').addClass('_active').siblings().removeClass('_active');
        var num = $(this).data('form');
        $('form').find('.personal-form-inputs._active').fadeOut(0).find('input').each(function () {
            $(this).prop('disabled', true);
        });;
        $('form').find('.personal-form-inputs').eq(num - 1).fadeIn(500).addClass('_active').find('input').each(function () {
            $(this).prop('disabled', false);
        });
    });

    $('body').find('.personal-form-inputs:not(._active)').each(function () {
        $(this).find('input').prop('disabled', true);
    });
}

$(document).ready(function () {
    useFilter();
    fileInputInit();
    addFormInit();
    moreDescriptionInit();
    imageGalleryPopupInit();
    ajaxDownloadInit();
    downloadsPopupInit();
    downloadsPageInit();
    defaultFileFieldInit();
    formWithFileInit();
    rezumeFormAddID();
    showHidePasswordInit();
    registerInit();
    maskInputInit();
    //palletteSliderInit();

});

// Загрузка по скроллу -->
var loadScroll_pallette = true;
$(document).ready(function () {
    $(document).on({
        'scroll touchstart mouseenter click': function () {
            loadOnScroll_pallette();
        }
    });
});

function loadOnScroll_pallette() {
    if (loadScroll_pallette == true) {
        palletteSliderInit();
        loadScroll_pallette = false;
    }
}
// <-- Загрузка по скроллу 

$(document)
    .on('blur', 'input[type="email"]', function () {
        if ($(this).val()) {
            var $form = $(this).closest('form');
            if (!validateEmail($(this).val()))
                $form.find($(this)).closest('.form-wrapper__item').addClass('_error');
            else
                $form.find($(this)).closest('.form-wrapper__item').removeClass('_error');
        }
    })
    .on('input', 'input[type="email"]', function () {
        if (!$(this).val()) {
            var $form = $(this).closest('form');
            $form.find($(this)).closest('.form-wrapper__item').removeClass('_error');
        }
        else if ($(this).parent().is('._error')) {
            var $form = $(this).closest('form');
            if (validateEmail($(this).val())) {
                $form.find($(this)).closest('.form-wrapper__item').removeClass('_error');
            }
        }
    })

$(document)
    .on('focus change', '#authForm input[name=suggestion]', function (e) {
        if (!$(this).is(':checked')) {
            $(this).addClass('_error');
        }
        else {
            $(this).removeClass('_error');
        }
    });

// Show all social icons
$('.js-header-socials-trigger').click(function (event) {
    event.preventDefault();
    let parents = $(this).parents('.middle-header__contacts__socials');

    parents.toggleClass('middle-header__contacts__socials_open');
});

(function fancyboxClose() {
    document.body.addEventListener('click', function (e) {
        var trigger = e.target.matches('.js-fancybox-close')
            ? e.target
            : e.target.closest('.js-fancybox-close');

        if (trigger) {
            Fancybox.close();
        }
    });
})();