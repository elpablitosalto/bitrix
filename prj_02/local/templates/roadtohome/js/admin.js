var initPageConstructor = function() {

    //alert('!!!');

    var pageConstructorInitialized = false;
    var $typeBlockField = document.querySelector('input[id^="PROP[190]["]');
    if (!$typeBlockField) {
        $typeBlockField = document.querySelector('input[id^="PROP[192]["]');
    }    
    //alert($typeBlockField);
    var updateAdditionalFields = function() {
        //alert('!!');
        if (typeof window.pageConstructorPropertyRelation[$typeBlockField.value] != 'undefined') {
            //alert('!');
            document.querySelectorAll('.show-property-row').forEach(function ($propertyRow) {
                $propertyRow.classList.remove("show-property-row");
                //alert('!!');
            });

            window.pageConstructorPropertyRelation[$typeBlockField.value].forEach(function (propertyId) {
                var $propertyRow = document.querySelector('#tr_PROPERTY_' + propertyId);
                if ($propertyRow)
                    $propertyRow.classList.add("show-property-row");
            });
        }
    };

    if ($typeBlockField) {
        $typeBlockField.addEventListener('change', updateAdditionalFields);
    }

    if (!pageConstructorInitialized && $typeBlockField) {
        updateAdditionalFields();
        pageConstructorInitialized = true;
    }
};

document.addEventListener('DOMContentLoaded', initPageConstructor);