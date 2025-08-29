<div class="page__section">
	<div class="page__search" style="min-height: 48px;">
		<!-- begin .section-->
		<div class="section <?=(!empty($arParams["CLASS"]) ? $arParams["CLASS"] : "section_space-top_close")?>">
			<? $APPLICATION->IncludeComponent(
				"waim:search.form",
				"",
				array(
					'SEARCH_PAGE' => '/search/',
					'PLACEHOLDER' => 'Поиск по сайту',
					'CLASS' => 'search-form_type_fixed'
				)
			); ?>
		</div>
		<!-- end .section-->
	</div>
</div>