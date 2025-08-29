<div class="page__modals">
	<!-- begin .modal-->
	<div class="modal" id="contactForm">
			<div class="modal__header">
					<div class="modal__title">
							<!-- begin .title-->
							<h3 class="title title_size_h3">Стать партнером</h3>
							<!-- end .title-->
					</div>
			</div>
			<div class="modal__content">
				<?$APPLICATION->IncludeComponent(
					"bitrix:form.result.new",
					"main",
					array(
						"AJAX_MODE" => "N",
						"AJAX_OPTION_SHADOW" => "N",
						"AJAX_OPTION_JUMP" => "Y",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N",
						"COMPONENT_TEMPLATE" => "question",
						"WEB_FORM_ID" => "2",
						"IGNORE_CUSTOM_TEMPLATE" => "N",
						"USE_EXTENDED_ERRORS" => "Y",
						"SEF_MODE" => "N",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "3600",
						"LIST_URL" => "",
						"EDIT_URL" => "",
						"SHOW_LICENCE" => "Y",
						"SUCCESS_URL" => "",
						"CHAIN_ITEM_TEXT" => "",
						"CHAIN_ITEM_LINK" => "",
						"VARIABLE_ALIASES" => array(
							"WEB_FORM_ID" => "WEB_FORM_ID",
							"RESULT_ID" => "RESULT_ID",
						),
						"JS_SUCCESS_EVENT" => 'success_partner'
					),
					$component
				);?>
			</div>
	</div>
	<!-- end .modal-->
	<!-- begin .modal-->
	<div class="modal" id="askAQuestion">
			<div class="modal__header">
					<div class="modal__title">
							<!-- begin .title-->
							<h3 class="title title_size_h3">Задать вопрос</h3>
							<!-- end .title-->
					</div>
			</div>
			<div class="modal__content">
				<?$APPLICATION->IncludeComponent(
					"bitrix:form.result.new",
					"main",
					array(
						"AJAX_MODE" => "N",
						"AJAX_OPTION_SHADOW" => "N",
						"AJAX_OPTION_JUMP" => "Y",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N",
						"COMPONENT_TEMPLATE" => "question",
						"WEB_FORM_ID" => "1",
						"IGNORE_CUSTOM_TEMPLATE" => "N",
						"USE_EXTENDED_ERRORS" => "Y",
						"SEF_MODE" => "N",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "3600",
						"LIST_URL" => "",
						"EDIT_URL" => "",
						"SHOW_LICENCE" => "Y",
						"SUCCESS_URL" => "",
						"CHAIN_ITEM_TEXT" => "",
						"CHAIN_ITEM_LINK" => "",
						"VARIABLE_ALIASES" => array(
							"WEB_FORM_ID" => "WEB_FORM_ID",
							"RESULT_ID" => "RESULT_ID",
						),
						"JS_SUCCESS_EVENT" => 'success_ask'
					),
					$component
				);?>
			</div>
	</div>
	<!-- end .modal-->
	<!-- begin .modal-->
	<div class="modal" id="modalRequestAOR">
			<div class="modal__header">
					<div class="modal__title">
							<!-- begin .title-->
							<h3 class="title title_size_h3">Запросить акт сверки</h3>
							<!-- end .title-->
					</div>
			</div>
			<div class="modal__content">
				<?$APPLICATION->IncludeComponent(
					"bitrix:form.result.new",
					"request_aor",
					array(
						"AJAX_MODE" => "N",
						"AJAX_OPTION_SHADOW" => "N",
						"AJAX_OPTION_JUMP" => "Y",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N",
						"COMPONENT_TEMPLATE" => "question",
						"WEB_FORM_ID" => "3",
						"IGNORE_CUSTOM_TEMPLATE" => "N",
						"USE_EXTENDED_ERRORS" => "Y",
						"SEF_MODE" => "N",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "3600",
						"LIST_URL" => "",
						"EDIT_URL" => "",
						"SHOW_LICENCE" => "Y",
						"SUCCESS_URL" => "",
						"CHAIN_ITEM_TEXT" => "",
						"CHAIN_ITEM_LINK" => "",
						"VARIABLE_ALIASES" => array(
							"WEB_FORM_ID" => "WEB_FORM_ID",
							"RESULT_ID" => "RESULT_ID",
						)
					),
					$component
				);?>
			</div>
	</div>
	<!-- end .modal-->
	<!-- begin .modal-->
	<div class="modal" id="modalGeoSelect">
        <?$APPLICATION->IncludeComponent(
            "waim:geo.search",
            "top",
            array(
                "AJAX_MODE" => "Y",
                "AJAX_OPTION_SHADOW" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "N",
                "AJAX_OPTION_HISTORY" => "N",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "86400",
            ),
            $component
        );?>
	</div>
	<!-- end .modal-->
	<!-- begin .modal-->
	<div class="modal" id="modalOrder">
			<div class="modal__header">
					<div class="modal__title">
							<!-- begin .title-->
							<h3 class="title title_size_h3">Товар под заказ</h3>
							<!-- end .title-->
					</div>
			</div>
			<div class="modal__content">
				<?$APPLICATION->IncludeComponent(
					"bitrix:form.result.new",
					"request_order",
					array(
						"AJAX_MODE" => "N",
						"AJAX_OPTION_SHADOW" => "N",
						"AJAX_OPTION_JUMP" => "Y",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N",
						"COMPONENT_TEMPLATE" => "question",
						"WEB_FORM_ID" => "4",
						"IGNORE_CUSTOM_TEMPLATE" => "N",
						"USE_EXTENDED_ERRORS" => "Y",
						"SEF_MODE" => "N",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "3600",
						"LIST_URL" => "",
						"EDIT_URL" => "",
						"SHOW_LICENCE" => "Y",
						"SUCCESS_URL" => "",
						"CHAIN_ITEM_TEXT" => "",
						"CHAIN_ITEM_LINK" => "",
						"VARIABLE_ALIASES" => array(
							"WEB_FORM_ID" => "WEB_FORM_ID",
							"RESULT_ID" => "RESULT_ID",
						)
					),
					$component
				);?>
			</div>
	</div>
	<!-- end .modal-->
	<!-- begin .modal-->
	<div class="modal" id="modalConfirmSignout">
		<div class="modal__content">
			<div class="modal__title">
				<!-- begin .title-->
				<h2 class="title title_size_h3 title_align_center">
					Вы уверены, что хотите выйти из учетной записи?
				</h2>
				<!-- end .title-->
			</div>
			<div class="modal__controls">
				<div class="modal__control">
					<!-- begin .button-->
					<a class="button button_width_full button_size_s" href="?logout=yes&sessid=<?=bitrix_sessid_val()?>">
						<span class="button__holder">Выйти</span>
					</a>
					<!-- end .button-->
				</div>
				<div class="modal__control">
					<!-- begin .button-->
					<div class="button button_width_full button_size_s button_style_outline js-fancybox-close">
						<span class="button__holder">Отмена</span>
					</div>
					<!-- end .button-->
				</div>
			</div>
		</div>
	</div>
	<!-- end .modal-->
	<!-- begin .modal-->
	<div class="modal" id="modalConfirmProfileDeletion">
		<div class="modal__content">
			<div class="modal__title">
				<!-- begin .title-->
				<h2 class="title title_size_h3 title_align_center">
					Вы уверены, что хотите удалить этот профиль?
				</h2>
				<!-- end .title-->
			</div>
			<div class="modal__text modal__text_size_s modal__text_align_center">
				<p>Восстановить профиль будет невозможно</p>
			</div>
			<div class="modal__controls">
				<div class="modal__control">
					<!-- begin .button-->
					<div
						class="button button_width_full button_size_s js-profile-panel-remove-confirm js-fancybox-close"
					>
						<span class="button__holder">Удалить</span>
					</div>
					<!-- end .button-->
				</div>
				<div class="modal__control">
					<!-- begin .button-->
					<div class="button button_width_full button_size_s button_style_outline js-fancybox-close">
						<span class="button__holder">Отмена</span>
					</div>
					<!-- end .button-->
				</div>
			</div>
		</div>
	</div>
	<!-- end .modal-->
	<!-- begin .modal-->
	<div class="modal" id="modalConfirmAddressDeletion">
		<div class="modal__content">
			<div class="modal__title">
				<!-- begin .title-->
				<h2 class="title title_size_h3 title_align_center">
					Вы уверены, что хотите удалить этот адрес?
				</h2>
				<!-- end .title-->
			</div>
			<div class="modal__text modal__text_size_s modal__text_align_center">
				<p>Восстановить адрес будет невозможно</p>
			</div>
			<div class="modal__controls">
				<div class="modal__control">
					<!-- begin .button-->
					<div
						class="button button_width_full button_size_s js-profile-panel-address-remove-confirm js-fancybox-close"
					>
						<span class="button__holder">Удалить</span>
					</div>
					<!-- end .button-->
				</div>
				<div class="modal__control">
					<!-- begin .button-->
					<div class="button button_width_full button_size_s button_style_outline js-fancybox-close">
						<span class="button__holder">Отмена</span>
					</div>
					<!-- end .button-->
				</div>
			</div>
		</div>
	</div>
	<!-- end .modal-->
</div>
