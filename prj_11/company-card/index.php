<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Реквизиты");
$APPLICATION->SetTitle("Реквизиты");
?><div class="page__content-top">
	<div class="page__holder">
		<div class="page__top-wrapper">
			<div class="page__breadcrumbs">
				<!-- begin .breadcrumbs--> <?$APPLICATION->IncludeComponent(
					"bitrix:breadcrumb",
					"main",
					Array(
						"SITE_ID" => "s1",
						"START_FROM" => "0"
					)
				);?> <!-- end .breadcrumbs-->
			</div>
			<div class="page__search">
				<!-- begin .search-panel--> <?$APPLICATION->IncludeComponent(
					"bitrix:search.title",
					"gazeta",
					Array(
						"CATEGORY_0" => array(0=>"iblock_newspaper",),
						"CATEGORY_0_TITLE" => "Новости",
						"CATEGORY_0_iblock_content" => array(0=>"all",),
						"CATEGORY_0_iblock_news" => array(0=>"all",),
						"CATEGORY_0_iblock_newspaper" => array(0=>"4",1=>"5",2=>"6",),
						"CATEGORY_1" => array(0=>"forum",),
						"CATEGORY_1_TITLE" => "Форумы",
						"CATEGORY_1_forum" => array(0=>"all",),
						"CATEGORY_2" => array(0=>"iblock_books",),
						"CATEGORY_2_TITLE" => "Каталоги",
						"CATEGORY_2_iblock_books" => "all",
						"CATEGORY_OTHERS_TITLE" => "Прочее",
						"CHECK_DATES" => "Y",
						"COMPONENT_TEMPLATE" => "gazeta",
						"CONTAINER_ID" => "gazeta-body-search",
						"CONVERT_CURRENCY" => "Y",
						"CURRENCY_ID" => "RUB",
						"INPUT_ID" => "gazeta-body-search-input",
						"NUM_CATEGORIES" => "1",
						"ORDER" => "date",
						"PAGE" => "#SITE_DIR#search/",
						"PREVIEW_HEIGHT" => "75",
						"PREVIEW_TRUNCATE_LEN" => "150",
						"PREVIEW_WIDTH" => "75",
						"PRICE_VAT_INCLUDE" => "Y",
						"SHOW_INPUT" => "Y",
						"SHOW_OTHERS" => "Y",
						"SHOW_PREVIEW" => "Y",
						"TOP_COUNT" => "10",
						"USE_LANGUAGE_GUESS" => "Y"
					)
				);?> <!-- end .search-panel-->
			</div>
		</div>
	</div>
</div>
<div class="page__section">
	<div class="page__holder">
		 <!-- begin .section-->
		<div class="section section_space_top-close">
			<div class="section__content">
				<h1>Реквизиты НФ</h1>

					<h2>Карточка компании</h2>
					<table>
					<tbody>
					<tr>
						<td>
							Наименование организации
						</td>
						<td>
							ООО «НЕСКУЧНЫЕ ФИНАНСЫ»
						</td>
					</tr>
					<tr>
						<td>
							Полное наименование организации
						</td>
						<td>
							ОБЩЕСТВО С ОГРАНИЧЕННОЙ ОТВЕТСТВЕННОСТЬЮ «НЕСКУЧНЫЕ ФИНАНСЫ»
						</td>
					</tr>
					<tr>
						<td>
							Полное наименование на английском языке
						</td>
						<td>
							NOBORING FINANCE LIMITED LIABILITY COMPANY
						</td>
					</tr>
					<tr>
						<td>
							Юридический адрес
						</td>
						<td>
							454080, РОССИЯ, ЧЕЛЯБИНСК Г., ЦЕНТРАЛЬНЫЙ ВН.Р-Н, ТЕРНОПОЛЬСКАЯ УЛ., Д. 6
						</td>
					</tr>
					<tr>
						<td>
							Фактический адрес
						</td>
						<td>
							454080, РОССИЯ, ЧЕЛЯБИНСК Г., ЦЕНТРАЛЬНЫЙ ВН.Р-Н, ТЕРНОПОЛЬСКАЯ УЛ., Д. 6
						</td>
					</tr>
					<tr>
						<td>
							ИНН/КПП
						</td>
						<td>
							7453354145 / 745301001
						</td>
					</tr>
					<tr>
						<td>
							ОГРН
						</td>
						<td>
							1237400025180
						</td>
					</tr>
					<tr>
						<td>
							ОКВЭД
						</td>
						<td>
							Основной 72.19, Дополнительные 93.29, 85.41, 70.22, 69.20
						</td>
					</tr>
					<tr>
						<td>
							Генеральный директор
						</td>
						<td>
							Краснов Сергей Николаевич
						</td>
					</tr>
					</tbody>
					</table>

					<h2>Банковские реквизиты</h2>
					<table>
					<tbody>
					<tr>
						<td>
							Банк
						</td>
						<td>
							ООО «Банк Точка»
						</td>
					</tr>
					<tr>
						<td>
							Расчетный счет
						</td>
						<td>
							40702810920000016348
						</td>
					</tr>
					<tr>
						<td>
							БИК
						</td>
						<td>
							044525104
						</td>
					</tr>
					<tr>
						<td>
							Корр.счет
						</td>
						<td>
							30101810745374525104
						</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
		</div>
		 <!-- end .section-->
	</div>
</div>
 <br><? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>