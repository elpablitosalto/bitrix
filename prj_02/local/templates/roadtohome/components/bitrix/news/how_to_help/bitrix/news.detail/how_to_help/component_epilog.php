<div id="modal-book" class="modal modal-book">
	<button type="button" data-fancybox-close class="modal-close">
    	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-close">
        	<use xlink:href="#close"></use>
        </svg>
    </button>
	<?$APPLICATION->IncludeComponent(
		"indexis:ajax.form",
		"how_to_help_callback",
		Array(
			"IBLOCK_ID" => Indexis::getIblockId("how_to_help_callback", "requests", "s1"),
			"IBLOCK_TYPE" => "requests",
            "CREATE_LEAD" => "Связаться с фондом (контакты)",
			"CHECK_CAPTCHA" => "N",
			"FIELDS" => [
				"NAME" => ["CLEAR","NOT_EMPTY","TEXT"],
				"PREVIEW_TEXT" => ["NOT_EMPTY","TEXT"],
				"PROPERTY_EMAIL" => ["CLEAR","NOT_EMPTY","TEXT","EMAIL"],
				"PROPERTY_PHONE" => ["CLEAR","NOT_EMPTY","PHONE"],
			],
        	"SEND_MESSAGE" => "HOW_TO_HELP_CALLBACK",
			"HANDLERS" => [
            	"AGREE" => [
                	"method_name" => "check_value",
                    "method_params" => [
                    	"VALUE" => "y",
                         "TO" => "MAIN",
                         "ERROR" => "Необходимо принять условия политики конфидициальности",
                    ]
                ]
             ],
			)
		);?>
</div>
