function tabOpenDefault() {
    var hash = window.location.hash;
    var hash = hash.substring(1);
    if(hash)
        $('.personal-menu__item[data-tab="'+hash+'"]').click();
}

function ajaxCall(data,url) {
    return $.ajax({
        url: url,
        type: "POST",
        processData: false,
        contentType: false,
        data: data
    });
}

function ajaxPost(data,url) {
    return $.post(url, data);
}

function userAuth() {
    $('#authForm').submit(function(e){
        e.preventDefault();
        let $form = $(this);
        let url = $form.data('ajax-url');
        var params = $form.serialize();
        var request = ajaxPost(params,url);
        request.done(function(resp) {
            var response = JSON.parse(resp);
            if(response.STATUS == 'Y')
                showSucessPopup(response.MESSAGE,'success',true);
            else 
                showSucessPopup(response.MESSAGE,'error');
        });
    })
}

function deletePhoto() {
    $('body').on('click','.exist-delete',function(e){
        e.preventDefault();
        
        let $photo = $(this).closest('.aks-file-upload-preview');
    
        var photoID = $photo.data('photo_id');
        var photosToDelete = $('[name="PHOTOS_TO_DELETE"]').val();
        photosToDelete += (photosToDelete == '') ? photoID : '|'+photoID;
        
        $('[name="PHOTOS_TO_DELETE"]').val(photosToDelete);
        $photo.remove();
    })
}

function dadataInit() {
    $('[data-address-init]').each(function(){
        var $input = $(this);
        $input.suggestions({
            token: "35feed8928f54feb9655ce38286c870137aa1bce",
            type: "ADDRESS",
            minChars: 3,
            /* Вызывается, когда пользователь выбирает одну из подсказок */
            onSelect: function(suggestion) {
                $input.parents('[data-address-init-item]:first').find('[data-address-init-geo]').val(JSON.stringify(suggestion.data));
            }
        });
    });

    $(document).on('click', '[data-address-remove]', function(e){
        e.preventDefault();
        $(this).parents('[data-address-init-item]:first').remove();
    });

    $('[data-address-add]').on('click', function(e){
        e.preventDefault();
        var $addressItem = $('<div data-address-init-item>' +
            '<input type="text" data-address-init name="ADDRESS[]" value="" required/>' +
            '<input type="hidden" data-address-init-geo name="GEO_DATA[]" />' +
            '<a href="" data-address-remove>' +
                '<svg width="16" height="16" viewBox="0 0 7 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.46995 3L6.89995 0.569996C6.95456 0.506228 6.98309 0.424203 6.97985 0.340311C6.97661 0.256419 6.94184 0.176839 6.88247 0.117475C6.82311 0.0581097 6.74353 0.0233321 6.65963 0.0200917C6.57574 0.0168513 6.49372 0.0453868 6.42995 0.0999956L3.99995 2.53L1.56995 0.0966622C1.50618 0.0420534 1.42416 0.0135182 1.34027 0.0167586C1.25637 0.019999 1.17679 0.0547763 1.11743 0.114141C1.05806 0.173506 1.02329 0.253086 1.02005 0.336978C1.01681 0.42087 1.04534 0.502895 1.09995 0.566662L3.52995 3L1.09662 5.43C1.06172 5.45988 1.03338 5.49665 1.01338 5.53801C0.993368 5.57936 0.982124 5.6244 0.980351 5.67031C0.978578 5.71622 0.986313 5.762 1.00307 5.80477C1.01983 5.84755 1.04525 5.88639 1.07773 5.91888C1.11022 5.95136 1.14907 5.97678 1.19184 5.99354C1.23462 6.0103 1.2804 6.01803 1.3263 6.01626C1.37221 6.01449 1.41725 6.00325 1.45861 5.98324C1.49996 5.96323 1.53673 5.93489 1.56662 5.9L3.99995 3.47L6.42995 5.9C6.49372 5.9546 6.57574 5.98314 6.65963 5.9799C6.74353 5.97666 6.82311 5.94188 6.88247 5.88252C6.94184 5.82315 6.97661 5.74357 6.97985 5.65968C6.98309 5.57579 6.95456 5.49376 6.89995 5.43L4.46995 3Z" fill="#282323"></path></svg>' +
            '</a>' +
            '</div>');
        $(this).parent().find('[data-address-init-list]').append($addressItem);
        var $input = $addressItem.find('[data-address-init]');
        $input.suggestions({
            token: "35feed8928f54feb9655ce38286c870137aa1bce",
            type: "ADDRESS",
            minChars: 3,
            /* Вызывается, когда пользователь выбирает одну из подсказок */
            onSelect: function(suggestion) {
                $input.parents('[data-address-init-item]:first').find('[data-address-init-geo]').val(JSON.stringify(suggestion.data));
            }
        });
    });

    $('[data-forimcity-init]').suggestions({
        token: "35feed8928f54feb9655ce38286c870137aa1bce",
        type: "ADDRESS",
        minChars: 3,
        bounds: "city",
        constraints: {
          locations: { city_type_full: "город" }
        },
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: function(suggestion) {
            $('[name="GEO_DATA"]').val(JSON.stringify(suggestion.data));
        }
    });
}

function singlePhotoPreview() {
    $('[name="USER_PICTURE"]').change(function(){
        var $parent = $(this).parent();
        var file = $(this)[0].files[0];
        var reader = new FileReader();   
        reader.readAsDataURL(file);  
        reader.onload = function () {  
            $parent.css('background-image','url('+reader.result+')');
            $parent.addClass('_photo');
        };  
        reader.onerror = function (error) {  
            console.log('Error: ', error);  
        };   
    })
}

function salonLogoPreview() {
    $('[name="SALON_LOGO"]').change(function(){
        var $parent = $(this).parent();
        var file = $(this)[0].files[0];
        var reader = new FileReader();   
        reader.readAsDataURL(file);  
        reader.onload = function () { 
            if($('body').find('#salonLogo').length > 0) {
                $('body').find('#salonLogo').attr('src',reader.result);
            } else {
                var img = '<img id="salonLogo" src="'+reader.result+'" style="max-width:100px;margin-bottom:20px;">';
                $parent.next().prepend(img);
            }
        };  
        reader.onerror = function (error) {  
            console.log('Error: ', error);  
        };   
    })
}

function chooseCity() {

    $('[data-city-init]').suggestions({
        token: "35feed8928f54feb9655ce38286c870137aa1bce",
        type: "ADDRESS",
        minChars: 3,
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: function(suggestion) {
            var city = suggestion.data;
            
            var fd = new FormData();
            var url = '/local/ajax/personal/cityChoose.php';
            fd.append('latitude',city.geo_lat);
            fd.append('longitude',city.geo_lon);
            fd.append('cityName',city.city);
            fd.append('regionCode',city.region_iso_code);

            var request = ajaxCall(fd,url);
            request.done(function(resp) {
                console.log(resp);
                let result = $.parseJSON(resp);
                if(result.status && result.status == 'success' && result.domain) {
                    window.location.href = result.domain + window.location.pathname + window.location.search;
                }
            });
        }
    });

    $('#cityChoose .cityChoose').click(function(){
        var url = "https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/address";
        var token = "35feed8928f54feb9655ce38286c870137aa1bce";
        var query = $(this).text();

        var options = {
            method: "POST",
            mode: "cors",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "Authorization": "Token " + token
            },
            body: JSON.stringify({query: query,locations:{'city_type_full':'город'}})
        }

        fetch(url, options)
        .then(response => response.text())
        .then(result => {
            var resp = JSON.parse(result);
            var city = resp.suggestions[0].data;
            
            var fd = new FormData();
            var url = '/local/ajax/personal/cityChoose.php';
            fd.append('latitude',city.geo_lat);
            fd.append('longitude',city.geo_lon);
            fd.append('cityName',city.city);
            fd.append('regionCode',city.region_iso_code);

            var request = ajaxCall(fd,url);
            request.done(function(resp) {
                console.log(resp);
                let result = $.parseJSON(resp);
                if(result.status && result.status == 'success' && result.domain) {
                    window.location.href = result.domain + window.location.pathname + window.location.search;
                }
            });
        })
        .catch(error => console.log("error", error));
    })
}

$(document).ready(function(){
    deletePhoto();
    dadataInit();
    singlePhotoPreview();
    salonLogoPreview();
    chooseCity();
    userAuth();

    tabOpenDefault();
    
    $(this).on('submit','[data-personal-form]',function(e){
        e.preventDefault();
        let $form = $(this);
        let url = $form.attr('action');

        var fd = new FormData();
        $.each($form.find("input[type='file']"), function(i, tag) {
            $.each($(tag)[0].files, function(i, file) {
                fd.append(tag.name, file);
            });
        });
        var params = $form.serializeArray();
        $.each(params, function (i, val) {
            fd.append(val.name, val.value);
        });

        var request = ajaxCall(fd,url);
        request.done(function(resp) {
            console.log(resp);
            var response = JSON.parse(resp);
            if(response.STATUS == 'Y')
                showSucessPopup(response.MESSAGE,'success',true);
            else 
                showSucessPopup(response.MESSAGE,'error');
        });
    });
    
    $(this).on('submit','[data-registration-form]',function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serialize();

        $.ajax({
            method: "POST",
            url: url,
            data: data,
            success: function(resp) {
                console.log(resp);
                var response = JSON.parse(resp);
                if(response.TYPE == 'OK') {
                    window.location.reload();
                } else {
                    showSucessPopup(response.MESSAGE,'error');
                }
            }
        })
        /*.done(function( resp ) {
            console.log(resp);
            var response = JSON.parse(resp);
            if(response.SUCCESS == 'Y') {
                window.open(response.MESSAGE, "_blank");
            } else {
                showSucessPopup(response.MESSAGE,'error');
            }
        });*/
    });
    
    $(this).on('submit','[data-order-form]',function(e){
        e.preventDefault();
        let $form = $(this);
        let url = $form.attr('action');

        var fd = new FormData();
        var params = $form.serializeArray();
        $.each(params, function (i, val) {
            fd.append(val.name, val.value);
        });

        var request = ajaxCall(fd,url);
        request.done(function(resp) {
            var response = JSON.parse(resp);
            if(response.STATUS == 'SUCCESS') {
                $form.fadeOut(300);
                setTimeout(function(){
                    $('.order-success').addClass('_show');
                },500)
            } else {
                showSucessPopup(response.MESSAGE,'error');
            }
        });
    });
});