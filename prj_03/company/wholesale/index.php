<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Продажа оптом");
$APPLICATION->SetPageProperty("keywords", "Продажа оптом");
$APPLICATION->SetPageProperty("description", "Продажа оптом");
$APPLICATION->SetTitle("Продажа оптом");
?>
<div class="text-field">
	<p>
		ГК «ФИРСТ» предлагает всестороннее снабжение необходимыми товарами для безопасности и комфорта на работе. Наш ассортимент включает в себя качественную спецодежду, профессиональную обувь и униформу, а также широкий выбор сопутствующих товаров.
	</p>
</div>
<div class="info-group">
	<div class="info-group__title">
		<h2 class="title">Преимущества нашего оптового предложения:</h2>
	</div>
	<div class="info-group__list">
		<div class="info-group__row">
			<div class="info-group__item">
				<h3 class="info-group__heading">Выгодные цены</h3>
				<div class="info-group__text">
					<p>Отгрузка по оптовым ценам доступна при заказе на сумму от 20 000 рублей</p>
				</div>
			</div>
			<div class="info-group__item info-group__item_type_illustration">
				<img width="493" height="250" src="/images/2024-07-31/image_2024-07-31_175100414.png" class="info-group__image">
			</div>
		</div>
		<div class="info-group__row">
			<div class="info-group__item">
				<h3 class="info-group__heading">Индивидуальный подход</h3>
				<div class="info-group__text">
					<p>Мы предлагаем индивидуальные условия сотрудничества и скидочные предложения, адаптированные под конкретные потребности каждого клиента</p>
				</div>
			</div>
			<div class="info-group__item info-group__item_type_illustration">
				<img width="493" height="250" src="/images/2024-07-31/image_2024-07-31_175155729.png" class="info-group__image">
			</div>
		</div>
		<div class="info-group__row">
			<div class="info-group__item">
				<h3 class="info-group__heading">Гибкая логистика</h3>
				<div class="info-group__text">
					<p>Мы располагаем собственной службой курьерской доставки, готовой доставить заказы в удобное для клиента место.</p>
					<p>Мы также предлагаем возможность выбора любой транспортной компании по предпочтениям клиента</p>
				</div>
			</div>
			<div class="info-group__item info-group__item_type_illustration">
				<img width="493" height="250" src="/images/2024-07-31/image_2024-07-31_175256715.png" class="info-group__image">
			</div>
		</div>
	</div>
</div>

<div class="quote-section">
	<div class="quote-section__title">
		<h2 class="title">Наши офисы</h2>
	</div>
	<div class="quopte-section__content">
		<blockquote class="quote-section__quote">
			ГК «ФИРСТ» будет рад приветствовать вас в наших офисах, расположенных в ключевых региональных центрах — Новочеркасске и Ростове-на-Дону. Мы создали комфортные и функциональные пространства, где каждый клиент сможет получить свой заказ, ознакомиться с образцами базовой продукцией и получить квалифицированную консультацию.
		</blockquote>
	</div>
</div>

<div class="entry-group">
	<div class="entry-group__title">
		<h2 class="title">Адреса наших офисов:</h2>
	</div>
	<div class="entry-group__list">
		<div class="entry-group__item">
			<div class="entry-snippet entry-snippet_type_horizontal entry-group__snippet">
				<div class="entry-snippet__illustration">
					<img width="160" height="120" src="/images/2024-07-31/image_2024-07-31_175447771.png" class="entry-snippet__image">
				</div>
				<div class="entry-snippet__content">
					<h3 class="entry-snippet__title">г. Ростов-на-Дону</h3>
					<div class="entry-snippet__text">ул. Можайская, зд. 38/1, стр.4</div>
				</div>
			</div>
		</div>
		<div class="entry-group__item">
			<div class="entry-snippet entry-snippet_type_horizontal entry-group__snippet">
				<div class="entry-snippet__illustration">
					<img width="160" height="120" src="/images/2024-07-31/image_2024-07-31_175552622.png" class="entry-snippet__image">
				</div>
				<div class="entry-snippet__content">
					<h3 class="entry-snippet__title">г. Новочеркасск</h3>
					<div class="entry-snippet__text">проспект Баклановский, 105 литер А</div>
				</div>
			</div>
		</div>
	</div>
	<div class="entry-group__controls">
		<div class="entry-group__control">
			<a class="rd-button rd-button_size_l fancy" href="#modalFormPartnership">
				<span class="rd-button__holder">Станьте нашими партнёрами</span>
			</a>
		</div>
	</div>
</div>
<div class="fancy-modal" id="modalFormPartnership">
	<? $APPLICATION->IncludeComponent(
		"bitrix:form.result.new",
		"popup_partnership",
		array(
			"AJAX_MODE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"CACHE_TIME" => "3600",
			"CACHE_TYPE" => "A",
			"CHAIN_ITEM_LINK" => "",
			"CHAIN_ITEM_TEXT" => "",
			"EDIT_URL" => "",
			"IGNORE_CUSTOM_TEMPLATE" => "N",
			"LIST_URL" => "",
			"SEF_MODE" => "N",
			"SUCCESS_URL" => "?send=ok",
			"USE_EXTENDED_ERRORS" => "N",
			"VARIABLE_ALIASES" => array("WEB_FORM_ID" => "WEB_FORM_ID", "RESULT_ID" => "RESULT_ID"),
			"WEB_FORM_ID" => 9,
		)
	);?>
</div>
<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>