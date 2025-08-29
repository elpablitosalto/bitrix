<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Мир Вендинга");
?>
<div id="contents" role="main" class="col-lg-12 col-md-12 col-sm-12">
<div class="post-4435 page type-page status-publish hentry">
							    <header>
			    	<h2 class="entry-title">Мир Вендинга</h2>
			    </header>
				
				<div class="entry-content">
				
				 

		
								
								
								
								
								
								
			      <div class="vc_row wpb_row vc_row-fluid no-padding ">
				  
				  <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-3 vc_col-md-4"><div class="vc_column-inner "><div class="wpb_wrapper">
				  
				
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"indexleftmenu", 
	array(
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "N",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "data",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_ID" => "",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "2",
		"VIEW_MODE" => "LINE",
		"COMPONENT_TEMPLATE" => "indexleftmenu"
	),
	false
);?>

			
		
		


				<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"brandlistmain", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "3",
		"IBLOCK_TYPE" => "data",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "8",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Бренды",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"COMPONENT_TEMPLATE" => "brandlistmain"
	),
	false
);?>
	
	
		

				
				</div></div>
				</div>

		<div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-9 vc_col-md-8">
		
		<div class="vc_column-inner ">
		
		<div class="wpb_wrapper">
		
		<?$APPLICATION->IncludeComponent(
	"bitrix:advertising.banner", 
	"slidermain", 
	array(
		"CACHE_TIME" => "0",
		"CACHE_TYPE" => "A",
		"NOINDEX" => "Y",
		"QUANTITY" => "20",
		"TYPE" => "slider",
		"COMPONENT_TEMPLATE" => "slidermain"
	),
	false
);?>

	
<? $arrFilterTop2 = array("PROPERTY_LISTNEW_VALUE"=>"y");  ?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.top", 
	"top2", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"BASKET_URL" => "/personal/basket.php",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_URL" => "",
		"DISPLAY_COMPARE" => "N",
		"ELEMENT_COUNT" => "10",
		"ELEMENT_SORT_FIELD" => "active_from",
		"ELEMENT_SORT_FIELD2" => "sort",
		"ELEMENT_SORT_ORDER" => "desc",
		"ELEMENT_SORT_ORDER2" => "asc",
		"FILTER_NAME" => "arrFilterTop2",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "data",
		"LABEL_PROP" => "-",
		"LINE_ELEMENT_COUNT" => "10",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_COMPARE" => "Сравнить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"OFFERS_LIMIT" => "5",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "STANDARTPRICE",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SEF_MODE" => "Y",
		"SEF_RULE" => "",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "blue",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"VIEW_MODE" => "SECTION",
		"COMPONENT_TEMPLATE" => "top2"
	),
	false
);?>		
					
<? $arrFilterTop1 = array("PROPERTY_LISTTOPSALE_VALUE"=>"y");  ?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.top", 
	"top1", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"BASKET_URL" => "/personal/basket.php",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_URL" => "",
		"DISPLAY_COMPARE" => "N",
		"ELEMENT_COUNT" => "10",
		"ELEMENT_SORT_FIELD" => "active_from",
		"ELEMENT_SORT_FIELD2" => "sort",
		"ELEMENT_SORT_ORDER" => "desc",
		"ELEMENT_SORT_ORDER2" => "asc",
		"FILTER_NAME" => "arrFilterTop1",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "data",
		"LABEL_PROP" => "-",
		"LINE_ELEMENT_COUNT" => "10",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_COMPARE" => "Сравнить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"OFFERS_LIMIT" => "5",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "STANDARTPRICE",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SEF_MODE" => "Y",
		"SEF_RULE" => "",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "blue",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"VIEW_MODE" => "SECTION",
		"COMPONENT_TEMPLATE" => "top1"
	),
	false
);?>
		

		<div class="products-list-desc">
<h2>Вендинг: бизнес будущего</h2>
<p>
	 Возможно ли успешно продавать, не открыв ни единого магазина? Как получить гарантированный доход, не потратившись на аренду, зарплату персонала и дорогостоящую рекламу?
</p>
<p>
	 Сегодня все большую популярность обретает новый способ торговли&nbsp;– вендинг. Ваши товары сами найдут своего покупателя и будут пользоваться неизменным спросом. Благодаря простоте и быстрой окупаемости, вендинговый бизнес невероятными темпами развивается во всем мире. В Японии вендинг-автоматы установлены повсеместно&nbsp;– купить в них можно не только предметы первой необходимости, но и самые неожиданные вещи. Жители Германии и США также предпочитают вендинговые аппараты традиционным магазинам.
</p>
<p>
	 В России вендинг только начинает свое развитие&nbsp;– наши соотечественники уже оценили по достоинству удобство кофейных и снековых автоматов. Между тем, эта перспективная ниша пока остается свободной&nbsp;– самое время занять свое «хлебное» место и получать прибыль. Компания «МИР ВЕНДИНГА» откроет для вас новые горизонты успешного бизнеса.
</p>
<h2>Почему стоит выбрать вендинг</h2>
<p>
</p>
<ul>
	<li>Чтобы начать дело, достаточно купить вендинговый автомат и наполнить его товаром. Никаких непредвиденных расходов и сложных расчетов.</li>
	<li>Вам не понадобиться снимать помещение под офис или склад&nbsp;– потребуется только оплатить аренду площади для установки вендингового оборудования (1–2 кв. метра).</li>
	<li>Вы всегда можете сменить место торговли&nbsp;– риски минимальны.</li>
	<li>Ваши покупатели будут пользоваться кофейными и снековыми аппаратами изо дня в день.</li>
	<li>Никаких затрат на оплату труда продавцов, кассиров и прочего персонала. Также вы не будете покрывать больничные, сверхурочные и терять прибыль по причине «человеческого фактора». Вендинговые автоматы работают круглосуточно без выходных и отпуска.</li>
	<li>Вендинговый бизнес в Москве быстро окупается и приносит хорошую прибыль. При этом вы получаете деньги сразу.</li>
	<li>Вам не придется решать проблемы, связанные с бесконечными проверками надзорных органов.</li>
</ul>
<p>
</p>
<h2>5 причин начать бизнес с нами</h2>
<p>
	 Изучив многочисленные вендинг-сайты, вы непременно оцените преимущества интернет-магазина «МИР ВЕНДИНГА».
</p>
<p>
</p>
<ul>
	<li>Высокое качество. Торговые аппараты, представленные на официальном сайте «МИР ВЕНДИНГА», отличаются прекрасными техническими характеристиками, высокой производительностью и легкостью в эксплуатации. Продовольственные товары имеют все необходимые сертификаты.</li>
	<li>Широкий ассортимент. У нас вы можете купить не только вендинговый аппарат, но и все сопутствующие товары: кофе и различные ингредиенты для вендинга. Покупатели останутся довольны богатым выбором напитков и снеков: от традиционных шоколадных батончиков известных производителей до свежих сэндвичей.</li>
	<li>Минимальные цены. Благодаря выгодным контрактам с поставщиками, мы предлагаем товары превосходного качества по самым низким ценам. Постоянные клиенты могут рассчитывать на скидки и бонусы.</li>
	<li>Профессиональная команда. «МИР ВЕНДИНГА»&nbsp;– это лучшие специалисты в Москве. Опытные консультанты помогут выбрать торговый аппарат и ингредиенты для вендинга. Квалифицированные операторы обеспечат качественное обслуживание автоматов для кофе и снеков.</li>
	<li>Безупречный сервис. Бесплатная доставка по Москве, регулярное наполнение вендингового оборудования, быстрое устранение неполадок&nbsp;– мы станем вашим идеальным партнером по бизнесу.</li>
</ul>
<p>
</p>
<p>
	 Купите у нас свой первый кофейный автомат, и вы очень быстро начнете получать прибыль и задумываться о расширении торговли.<span id="bx-cursor-node"> </span>
</p>
<br><br>
</div>
		
		
		</div></div></div>
















				 
				</div>
				</div>
</div>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>