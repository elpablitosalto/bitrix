var initPageConstructor = function () {

    var pageConstructorInitialized = false;
    var $typeBlockField = document.querySelector('input[id^="PROP[1]["]');

    var updateAdditionalFields = function () {

        document.querySelectorAll('.show-property-row').forEach(function ($propertyRow) {
            $propertyRow.classList.remove("show-property-row");
        });

        document.querySelectorAll('.hide-property-row').forEach(function ($propertyRow) {
            $propertyRow.classList.remove("hide-property-row");
        });

        if (typeof window.pageConstructorPropertyRelation[$typeBlockField.value] != 'undefined') {

            window.pageConstructorPropertyRelation[$typeBlockField.value].forEach(function (propertyId) {
                var $propertyRow = document.querySelector('#tr_PROPERTY_' + propertyId);
                if ($propertyRow)
                    $propertyRow.classList.add("show-property-row");

                if (typeof window.pageConstructorComplexItemCounts[propertyId] != 'undefined') {
                    var complexItemCounts = window.pageConstructorComplexItemCounts[propertyId] - document.querySelectorAll('#tr_PROPERTY_' + propertyId + ' .adm-detail-content-cell-r > table > tbody > tr > td > div:not([style*="display:none"])').length;
                    if (complexItemCounts > 0) {
                        for (var i = 0; i < complexItemCounts; i++) {
                            document.querySelector('#tr_PROPERTY_' + propertyId + ' input[name="apply"]').click();
                        }
                    }
                }
            });
        }

        if (typeof window.pageConstructorPropertySettings[$typeBlockField.value] != 'undefined') {
            var settings = window.pageConstructorPropertySettings[$typeBlockField.value];

            if (typeof settings.HIDE_FIELDS !== 'undefined') {
                for (var propertyIndex in settings.HIDE_FIELDS) {
                    var $propertyRow = document.querySelector('#tr_PROPERTY_' + settings.HIDE_FIELDS[propertyIndex]);
                    if ($propertyRow)
                        $propertyRow.classList.add("hide-property-row");
                }
            }

            var setDefaultCheckboxState = (!pageConstructorInitialized && window.blockId == 0) || pageConstructorInitialized;
            if (typeof settings.DEFAULT_CHECKBOX_STATE !== 'undefined' && setDefaultCheckboxState) {
                for (var propertyId in settings.DEFAULT_CHECKBOX_STATE) {
                    var $checkbox = document.querySelector('#tr_PROPERTY_' + propertyId + ' input[type="checkbox"]');
                    if ($checkbox)
                        $checkbox.checked = settings.DEFAULT_CHECKBOX_STATE[propertyId];
                }
            }
        }
    };

    if ($typeBlockField) {
        $typeBlockField.addEventListener('change', updateAdditionalFields);
    }

    if (!pageConstructorInitialized && $typeBlockField) {
        updateAdditionalFields();
        pageConstructorInitialized = true;
    }

    // Раскрыть для блока P-1 три составных значения, сразу при открытии -->
    var prop_id = '9';
    var k = 3;
    let elements = document.querySelectorAll('.simai_visible_block_' + prop_id);
    k = k - elements.length - 1;
    //alert(k);
    for (let i = 0; i <= k; i++) {
        let elements = document.querySelectorAll('#tr_PROPERTY_' + prop_id + ' input[name="apply"]');
        for (let elem of elements) {
            elem.click();
        }
    }
    // <--
};

document.addEventListener('DOMContentLoaded', initPageConstructor);