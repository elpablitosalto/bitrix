$(document).ready(function () {
    initPhoneMasks();
    initBXAjax();
    setDisabledButtonAgreeCheckBox();
});

function setDisabledButtonAgreeCheckBox() {
    $('.js_agree_checkbox').on("change", function (e) {
        $button = $(this).closest('form').find('.js_send_form_button');
        if ($button) {
            //alert($(this).is(':checked'));
            //alert($button.html());
            if ($(this).is(':checked') == true) {
                //$button.attr('disabled', '');
                $button.removeAttr('disabled');
            } else {
                $button.attr('disabled', 'disabled');
            }
        }
    });
}

function initBXAjax() {
    BX.addCustomEvent('onAjaxSuccess', function () {
        initOnAjaxSuccess();
    });
}

function initPhoneMasks() {
    if ($('.js_phone_country').length > 0)
        initPhoneMaskCountry('.js_phone_country');

    if ($('.js_phone_country_kkm_1').length > 0)
        initPhoneMaskCountry('.js_phone_country_kkm_1');

    if ($('.js_phone_country_kkm_2').length > 0)
        initPhoneMaskCountry('.js_phone_country_kkm_2');

    if ($('.js_phone_country_profile').length > 0)
        initPhoneMaskCountry('.js_phone_country_profile');
}

function initOnAjaxSuccess() {
    initPhoneMasks();
}

// Выбор кода страны в поле телефон -->
function initPhoneMaskCountry(phoneInputID) {
    var input = document.querySelector(phoneInputID);
    var curTelValue = $(input).val();

    if ($(input).length > 0) {
        var initialCountry = 'ru';

        let isMobile = $('body').hasClass('iti-mobile');

        var params = {
            // allowDropdown: false,
            // autoPlaceholder: "off",
            // containerClass: "test",
            // countrySearch: false,
            // customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
            //   return "e.g. " + selectedCountryPlaceholder;
            // },
            //dropdownContainer: document.querySelector('#js_phone_country_container'),
            // excludeCountries: ["us"],
            // fixDropdownWidth: false,
            // formatAsYouType: false,
            // formatOnDisplay: false,
            // geoIpLookup: function(callback) {
            //   fetch("https://ipapi.co/json")
            //     .then(function(res) { return res.json(); })
            //     .then(function(data) { callback(data.country_code); })
            //     .catch(function() { callback(); });
            // },
            //i18n: { 'de': 'Deutschland', 'ru': 'Россия' },
            //initialCountry: "us",
            //initialCountry: initialCountry,
            nationalMode: false,
            // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            // placeholderNumberType: "MOBILE",
            // preferredCountries: ['cn', 'jp'],
            preferredCountries: ["ru", "by", "kz", "ua"],
            // showFlags: false,
            // showSelectedDialCode: true,
            // useFullscreenPopup: true,
            //utilsScript: "/local/lib/intl-tel-input-master/build/js/utils.js",
            utilsScript: "/local/templates/geropharm-tilda/libs/intl-tel-input/js/utils.js",
            //formatOnDisplay: true,
            //hiddenInput: () => "phone_full",
            //hiddenInput: "full_frm_mobilephone",
            //hiddenInput: "full_number",
            //useFullscreenPopup: true,
        };
        //alert(curTelValue);
        if (curTelValue.length <= 0) {
            params.initialCountry = initialCountry;
        }

        if (isMobile == true) {
            var id_parent_container = $(input).closest('.js_phone_mask_container').attr('id');
            params.dropdownContainer = document.querySelector('#' + id_parent_container);
        }

        var iti = window.intlTelInput(input, params);
        var setOne = false;

        $(phoneInputID).on("countrychange", function (event) {

            // Get the selected country data to know which country is selected.
            var selectedCountryData = iti.getSelectedCountryData();

            let isMobile = $('body').hasClass('iti-mobile');

            if (isMobile == true && setOne == false) {
                params.dropdownContainer = document.querySelector('#' + id_parent_container);
                iti = window.intlTelInput(input, params);
                setOne = true;
            }

            // Get an example number for the selected country to use as placeholder.
            let str = '';
            if (curTelValue.length > 0) {
                str = curTelValue;
            }

            newPlaceholder = intlTelInputUtils.getExampleNumber(
                selectedCountryData.iso2,
                //true, 
                false,
                intlTelInputUtils.numberFormat.INTERNATIONAL
            ),
                // Reset the phone number input.
                iti.setNumber(str);

            // Convert placeholder as exploitable mask by replacing all 1-9 numbers with 0s
            var second_part = newPlaceholder.replace('+' + selectedCountryData.dialCode, '');
            second_part = second_part.replace(/[0-9]/g, "x");
            //second_part.replace('0', '9');
            mask = '+' + selectedCountryData.dialCode + second_part;

            // Apply the new mask for the input
            var phoneMask = new Inputmask(mask);
            phoneMask.definitions['9'] = '';
            phoneMask.definitions['x'] = '[0-9]';
            phoneMask.mask($(this));

            //$('#js_country_phone_code').val(selectedCountryData.iso2);
        });


        // When the plugin loads for the first time, we have to trigger the "countrychange" event manually, 
        // but after making sure that the plugin is fully loaded by associating handler to the promise of the 
        // plugin instance.

        iti.promise.then(function () {
            $(phoneInputID).trigger("countrychange");
        });
    }
}
// <-- Выбор кода страны в поле телефон

function isMobile() {
    var isMobile = false; //initiate as false
    // device detection
    if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
        || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0, 4))) {
        isMobile = true;
    }
    return isMobile;
}