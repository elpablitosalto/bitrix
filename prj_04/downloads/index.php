<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Маркетинговые материалы «CONCEPT»");
?>
<section class="content">
	<div class="container _inside-page">    
        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb","hair.crumbs",Array(
                "START_FROM" => "0", 
                "PATH" => "", 
                "SITE_ID" => "s1" 
            )
        );?>
        <h1 class="_small"><?=$APPLICATION->ShowTitle(false)?></h1>
        <div class="list-page__header">
            <div class="left-side">
                <form class="search-block smart-filter-form" action="/local/ajax/downloads/filter.php">
                    <input type="text" name="NAME" class="search-block__input" placeholder="Поиск" />
                    <button class="search-block__button"></button>
                </form>
            </div>
            <div class="right-side _download-controls">
                <div class="download-actions">
                    <!--<div class="form-wrapper__item form-wrapper__item-checkbox">
                        <input id="suggestion" type="checkbox" value="Y" name="suggestion">
                        <label for="suggestion">Выбрать все</label>
                    </div>-->
                    <a target="_blank" data-ajax-download href="#">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0)">
                                <path d="M7.99996 10.6666C7.8633 10.6666 7.73263 10.6106 7.63863 10.512L4.13863 6.84531C3.8353 6.52798 4.06063 5.99998 4.49996 5.99998H6.3333V2.16665C6.3333 1.70731 6.7073 1.33331 7.16663 1.33331H8.8333C9.29263 1.33331 9.66663 1.70731 9.66663 2.16665V5.99998H11.5C11.9393 5.99998 12.1646 6.52798 11.8613 6.84531L8.3613 10.512C8.2673 10.6106 8.13663 10.6666 7.99996 10.6666Z" fill="#282323"></path>
                                <path d="M14.8333 14.6667H1.16667C0.523333 14.6667 0 14.1433 0 13.5V13.1667C0 12.5233 0.523333 12 1.16667 12H14.8333C15.4767 12 16 12.5233 16 13.1667V13.5C16 14.1433 15.4767 14.6667 14.8333 14.6667Z" fill="#282323"></path>
                            </g>
                            <defs>
                                <clipPath id="clip0">
                                    <rect width="16" height="16" fill="white"></rect>
                                </clipPath>
                            </defs>
                        </svg>                                
						<span class="downloads-cnt">Скачать (<i>0</i>)</span>
						<input type="hidden" id="filesToDownload" name="FILES" />
                    </a>
				</div>
				<!--
                <div class="pagination">
                    <ul>
                        <li>
                            <a class="prev" href="#">
                                <svg width="13" height="13" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0466 21.4207C12.1921 21.2756 12.3075 21.1032 12.3863 20.9133C12.4651 20.7235 12.5056 20.52 12.5056 20.3145C12.5056 20.1089 12.4651 19.9054 12.3863 19.7156C12.3075 19.5258 12.1921 19.3534 12.0466 19.2082L3.7747 10.9395L12.0466 2.67072C12.34 2.37732 12.5048 1.97939 12.5048 1.56447C12.5048 1.14954 12.34 0.751614 12.0466 0.458218C11.7532 0.164822 11.3552 -3.86498e-06 10.9403 -3.88312e-06C10.5254 -3.90126e-06 10.1275 0.164822 9.83407 0.458218L0.459073 9.83322C0.313563 9.97836 0.198118 10.1508 0.119347 10.3406C0.0405774 10.5304 3.10048e-05 10.7339 3.09958e-05 10.9395C3.09868e-05 11.145 0.0405774 11.3485 0.119347 11.5383C0.198118 11.7282 0.313563 11.9006 0.459073 12.0457L9.83407 21.4207C9.97922 21.5662 10.1516 21.6817 10.3415 21.7604C10.5313 21.8392 10.7348 21.8798 10.9403 21.8798C11.1458 21.8798 11.3493 21.8392 11.5392 21.7604C11.729 21.6817 11.9014 21.5662 12.0466 21.4207Z" fill="#959595"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M21.8777 10.9395C21.8777 10.5251 21.7131 10.1276 21.42 9.8346C21.127 9.54157 20.7296 9.37695 20.3152 9.37695L4.69019 9.37695C4.27579 9.37695 3.87836 9.54157 3.58533 9.8346C3.29231 10.1276 3.12769 10.5251 3.12769 10.9395C3.12769 11.3539 3.29231 11.7513 3.58533 12.0443C3.87836 12.3373 4.27579 12.502 4.69019 12.502L20.3152 12.502C20.7296 12.502 21.127 12.3373 21.42 12.0443C21.7131 11.7513 21.8777 11.3539 21.8777 10.9395Z" fill="#959595"></path>
                                </svg>
                            </a>
                        </li>
                        <li><a class="_active" href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">6</a></li>
                        <li><a href="#">...</a></li>
                        <li><a href="#">16</a></li>
                        <li><a href="#">17</a></li>
                        <li><a href="#">18</a></li>
                        <li>
                            <a class="next" href="#">
                                <svg width="13" height="13" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.83111 21.4207C9.6856 21.2756 9.57016 21.1032 9.49139 20.9133C9.41262 20.7235 9.37207 20.52 9.37207 20.3145C9.37207 20.1089 9.41262 19.9054 9.49139 19.7156C9.57016 19.5258 9.6856 19.3534 9.83111 19.2082L18.103 10.9395L9.83111 2.67072C9.53772 2.37732 9.37289 1.97939 9.37289 1.56447C9.37289 1.14954 9.53772 0.751614 9.83111 0.458218C10.1245 0.164822 10.5224 -3.86498e-06 10.9374 -3.88312e-06C11.3523 -3.90126e-06 11.7502 0.164822 12.0436 0.458218L21.4186 9.83322C21.5641 9.97836 21.6796 10.1508 21.7583 10.3406C21.8371 10.5304 21.8777 10.7339 21.8777 10.9395C21.8777 11.145 21.8371 11.3485 21.7583 11.5383C21.6796 11.7282 21.5641 11.9006 21.4186 12.0457L12.0436 21.4207C11.8985 21.5662 11.726 21.6817 11.5362 21.7604C11.3464 21.8392 11.1429 21.8798 10.9374 21.8798C10.7318 21.8798 10.5283 21.8392 10.3385 21.7604C10.1487 21.6817 9.97626 21.5662 9.83111 21.4207Z" fill="#3333CC"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M-6.8299e-08 10.9395C-8.64131e-08 10.5251 0.16462 10.1276 0.457646 9.8346C0.750671 9.54157 1.1481 9.37695 1.5625 9.37695L17.1875 9.37695C17.6019 9.37695 17.9993 9.54157 18.2924 9.8346C18.5854 10.1276 18.75 10.5251 18.75 10.9395C18.75 11.3539 18.5854 11.7513 18.2924 12.0443C17.9993 12.3373 17.6019 12.502 17.1875 12.502L1.5625 12.502C1.1481 12.502 0.750672 12.3373 0.457646 12.0443C0.16462 11.7513 -5.0185e-08 11.3539 -6.8299e-08 10.9395Z" fill="#959595"></path>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>-->
            </div>
        </div>
		<div class="seminars-list">
			<div class="mobile-filter-button"></div>
			<div class="seminars-list__filter">
			<?$APPLICATION->IncludeComponent(
				"bitrix:catalog.smart.filter", 
				"downloads.page.filter", 
				array(
					"CACHE_GROUPS" => "Y",
					"CACHE_TIME" => "36000000",
					"CACHE_TYPE" => "A",
					"DISPLAY_ELEMENT_COUNT" => "Y",
					"FILTER_NAME" => "arrFilter",
					"FILTER_VIEW_MODE" => "vertical",
					"IBLOCK_ID" => "4",
					"IBLOCK_TYPE" => "materials",
					"PAGER_PARAMS_NAME" => "arrPager",
					"POPUP_POSITION" => "left",
					"PREFILTER_NAME" => "smartPreFilter",
					"SAVE_IN_SESSION" => "N",
					"SECTION_CODE" => "",
					"SECTION_CODE_PATH" => "",
					"SECTION_DESCRIPTION" => "-",
					"SECTION_ID" => $_REQUEST["SECTION_ID"],
					"SECTION_TITLE" => "-",
					"SEF_MODE" => "Y",
					"SEF_RULE" => "",
					"SMART_FILTER_PATH" => "",
					"TEMPLATE_THEME" => "blue",
					"XML_EXPORT" => "N",
					"COMPONENT_TEMPLATE" => "downloads.page.filter"
				),
				false
			);?>
			</div>
			<div class="seminars-list__wrapper">
			<?$APPLICATION->IncludeComponent(
				"bitrix:news.list", 
				"downloads.page", 
				array(
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"ADD_SECTIONS_CHAIN" => "Y",
					"AJAX_MODE" => "Y",
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
					"DISPLAY_BOTTOM_PAGER" => "Y",
					"DISPLAY_DATE" => "Y",
					"DISPLAY_NAME" => "Y",
					"DISPLAY_PICTURE" => "Y",
					"DISPLAY_PREVIEW_TEXT" => "Y",
					"DISPLAY_TOP_PAGER" => "N",
					"FIELD_CODE" => array(
						0 => "",
						1 => "",
					),
					"FILTER_NAME" => "",
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",
					"IBLOCK_ID" => "4",
					"IBLOCK_TYPE" => "materials",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
					"INCLUDE_SUBSECTIONS" => "Y",
					"MESSAGE_404" => "",
					"NEWS_COUNT" => "150",
					"PAGER_BASE_LINK_ENABLE" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "N",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_TEMPLATE" => ".default",
					"PAGER_TITLE" => "Новости",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"PREVIEW_TRUNCATE_LEN" => "",
					"PROPERTY_CODE" => array(
						0 => "PRODUCT_LINES",
						1 => "MATERIAL_TYPE",
						2 => "MATERIAL_FORMAT",
						3 => "",
					),
					"SET_BROWSER_TITLE" => "Y",
					"SET_LAST_MODIFIED" => "N",
					"SET_META_DESCRIPTION" => "Y",
					"SET_META_KEYWORDS" => "Y",
					"SET_STATUS_404" => "N",
					"SET_TITLE" => "Y",
					"SHOW_404" => "N",
					"SORT_BY1" => "ACTIVE_FROM",
					"SORT_BY2" => "SORT",
					"SORT_ORDER1" => "DESC",
					"SORT_ORDER2" => "ASC",
					"STRICT_SECTION_CHECK" => "N",
					"COMPONENT_TEMPLATE" => "downloads.page"
				),
				false
			);?>
			</div>
		</div>
	</div>
</section>

<div id="downloadsPopup" class="popup downloads-popup mfp-hide">
	
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>