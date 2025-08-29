<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!defined('REMOVE_CONTENT_WRAPPER')) : ?>
	</div><!-- .section__content -->
	</div><!-- .section -->
	</div><!-- .page__container -->
	</div><!-- .page__section -->
<? endif ?>

<? if (defined('SHOW_MAP_AFTER_CONTENT')) : ?>
	<? $APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		array(
			"AREA_FILE_SHOW" => "file",
			"PATH" => SITE_TEMPLATE_PATH . "/include/common/map.php",
			"AREA_FILE_RECURSIVE" => "N",
			"EDIT_MODE" => "html",
		),
		false
	);
	?>
	<?/*?>
	<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
	<?*/?>
<? endif ?>

<? if (!defined('IS_PRODUCT_DETAIL')) : ?>
	<? ob_start(); // старт отложенного вывода
	?>
	<meta property="og:image" content="//<?= $_SERVER["SERVER_NAME"] . LOGO_URL ?>" />
	<meta property="og:image:secure_url" content="<?= (CMain::IsHTTPS()) ? "https://" : "http://" ?><?= $_SERVER["SERVER_NAME"] . LOGO_URL ?>" />
	<meta property="og:image:type" content="image/png" />
	<meta property="og:image:width" content="128" />
	<meta property="og:image:height" content="128" />
	<?
	$ogImageContent = ob_get_contents(); // сложили все в буфер
	ob_end_clean(); // очистили
	$APPLICATION->AddViewContent('og_image', $ogImageContent);
	?>
<? endif; ?>

</div> <!-- .page__content -->
<div class="page__footer">
	<!-- begin .footer-->
	<div class="footer">
		<div class="page__container">
			<div class="footer__main">
				<div class="footer__col footer__logo-col">
					<div class="footer__logo">
						<!-- begin .logo-->
						<a href="/" class="logo">
							<span class="logo__figure-wrapper">
								<?
								$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									array(
										"AREA_FILE_SHOW" => "file",
										"PATH" => SITE_TEMPLATE_PATH . "/include/common/main_logo.php",
										"AREA_FILE_RECURSIVE" => "N",
										"EDIT_MODE" => "html"
									)
								);
								?>
							</span>
						</a>
						<!-- end .logo-->
					</div>
				</div>
				<div class="footer__col footer__info-col">
					<div class="footer__sub-group">
						<div class="footer__sub-col footer__sub-col_state_closed">
							<div class="footer__title">
								<!-- begin .title-->
								<div class="title title_size_h5">
									<button type="button" data-toggle-scope=".footer__sub-col" data-toggle-class="footer__sub-col_state_closed" class="footer__trigger js-toggle">
										<? $APPLICATION->IncludeComponent(
											"bitrix:main.include",
											"",
											array(
												"AREA_FILE_SHOW" => "file",
												"PATH" => SITE_TEMPLATE_PATH . "/include/footer/menu-catalog-title.php",
												"AREA_FILE_RECURSIVE" => "N",
												"EDIT_MODE" => "html",
											),
											false
										);
										?>
									</button>
								</div>
								<!-- end .title-->
							</div>
							<div class="footer__nav">
								<? $APPLICATION->IncludeComponent(
									"bitrix:menu",
									"footer_menu",
									array(
										"ROOT_MENU_TYPE" => "footer_catalog",
										"MENU_CACHE_TYPE" => "N",
										"MENU_CACHE_TIME" => "3600",
										"MENU_CACHE_USE_GROUPS" => "Y",
										"MENU_CACHE_GET_VARS" => array(),
										"MAX_LEVEL" => "1",
										"CHILD_MENU_TYPE" => "",
										"USE_EXT" => "N",
										"DELAY" => "N",
										"ALLOW_MULTI_SELECT" => "N",
										"COMPONENT_TEMPLATE" => "footer_catalog"
									),
									false
								); ?>
							</div>
						</div>
						<div class="footer__sub-col footer__sub-col_state_closed">
							<div class="footer__title">
								<!-- begin .title-->
								<div class="title title_size_h5">
									<button type="button" data-toggle-scope=".footer__sub-col" data-toggle-class="footer__sub-col_state_closed" class="footer__trigger js-toggle">
										<? $APPLICATION->IncludeComponent(
											"bitrix:main.include",
											"",
											array(
												"AREA_FILE_SHOW" => "file",
												"PATH" => SITE_TEMPLATE_PATH . "/include/footer/menu-info-title.php",
												"AREA_FILE_RECURSIVE" => "N",
												"EDIT_MODE" => "html",
											),
											false
										);
										?>
									</button>
								</div>
								<!-- end .title-->
							</div>
							<div class="footer__nav">
								<? $APPLICATION->IncludeComponent(
									"bitrix:menu",
									"footer_menu",
									array(
										"ROOT_MENU_TYPE" => "footer_info",
										"MENU_CACHE_TYPE" => "N",
										"MENU_CACHE_TIME" => "3600",
										"MENU_CACHE_USE_GROUPS" => "Y",
										"MENU_CACHE_GET_VARS" => array(),
										"MAX_LEVEL" => "1",
										"CHILD_MENU_TYPE" => "",
										"USE_EXT" => "N",
										"DELAY" => "N",
										"ALLOW_MULTI_SELECT" => "N",
										"COMPONENT_TEMPLATE" => "footer_info",
										"WRAPPER_CLASS" => "nav_layout_2-cols"
									),
									false
								); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="footer__col footer__contact-col">
					<div class="footer__title footer__title_type_mobile-hidden">
						<!-- begin .title-->
						<div class="title title_size_h5">
							<? $APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_TEMPLATE_PATH . "/include/footer/contacts-title.php",
									"AREA_FILE_RECURSIVE" => "N",
									"EDIT_MODE" => "html",
								),
								false
							);
							?>
						</div>
						<!-- end .title-->
					</div>
					<div class="footer__contact-group">
						<div class="footer__controls">
							<div class="footer__control">
								<!-- begin .button-->
								<a class="button button_width_full button_size_s js-modal" href="#askAQuestion">
									<span class="button__holder">Задать вопрос</span>
								</a>
								<!-- end .button-->
							</div>
						</div>
						<div class="footer__contacts">
							<?
							$arFooterContactsFilter = array('PROPERTY_AREAS_VALUE' => 'Футер');
							if (!empty($GLOBALS["arRegion"]) && $GLOBALS["arRegion"]["NAME"] != "Москва") {
								$arFooterContactsFilter["!XML_ID"] = 'moscow';
							}
							$APPLICATION->IncludeComponent(
								"bitrix:news.list",
								"contact-list",
								array(
									"ACTIVE_DATE_FORMAT" => "d.m.Y",
									"ADD_SECTIONS_CHAIN" => "N",
									"AJAX_MODE" => "N",
									"AJAX_OPTION_ADDITIONAL" => "",
									"AJAX_OPTION_HISTORY" => "N",
									"AJAX_OPTION_JUMP" => "N",
									"AJAX_OPTION_STYLE" => "N",
									"CACHE_FILTER" => "Y",
									"CACHE_GROUPS" => "N",
									"CACHE_TIME" => "3600",
									"CACHE_TYPE" => "A",
									"CHECK_DATES" => "Y",
									"COMPONENT_TEMPLATE" => "contact-list",
									"DETAIL_URL" => "",
									"DISPLAY_BOTTOM_PAGER" => "N",
									"DISPLAY_DATE" => "N",
									"DISPLAY_NAME" => "N",
									"DISPLAY_PICTURE" => "N",
									"DISPLAY_PREVIEW_TEXT" => "N",
									"DISPLAY_TOP_PAGER" => "N",
									"FIELD_CODE" => array(
										0 => "ID",
										1 => "NAME",
										2 => "PREVIEW_PICTURE",
										3 => "",
									),
									"FILTER_NAME" => "arFooterContactsFilter",
									"HIDE_LINK_WHEN_NO_DETAIL" => "N",
									"IBLOCK_ID" => CONTACTS_IB_ID,
									"IBLOCK_TYPE" => "info",
									"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
									"INCLUDE_SUBSECTIONS" => "N",
									"MESSAGE_404" => "",
									"NEWS_COUNT" => "10",
									"PAGER_BASE_LINK" => "",
									"PAGER_BASE_LINK_ENABLE" => "N",
									"PAGER_DESC_NUMBERING" => "N",
									"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
									"PAGER_PARAMS_NAME" => "arrPager",
									"PAGER_SHOW_ALL" => "N",
									"PAGER_SHOW_ALWAYS" => "N",
									"PAGER_TEMPLATE" => "",
									"PAGER_TITLE" => "Новости",
									"PARENT_SECTION" => "",
									"PARENT_SECTION_CODE" => "",
									"PREVIEW_TRUNCATE_LEN" => "",
									"PROPERTY_CODE" => array(
										0 => "ICON_HTML",
										1 => "LINK",
										2 => "LINK_TEXT",
										3 => "AREAS",
										4 => "TYPE",
										5 => "",
										6 => "",
										7 => "",
										8 => "",
										9 => "",
										10 => "",
									),
									"SET_BROWSER_TITLE" => "N",
									"SET_LAST_MODIFIED" => "N",
									"SET_META_DESCRIPTION" => "N",
									"SET_META_KEYWORDS" => "N",
									"SET_STATUS_404" => "N",
									"SET_TITLE" => "N",
									"SHOW_404" => "N",
									"SORT_BY1" => "SORT",
									"SORT_BY2" => "SORT",
									"SORT_ORDER1" => "ASC",
									"SORT_ORDER2" => "ASC",
									"STRICT_SECTION_CHECK" => "N",
									"TITLE" => ""
								),
								false
							);
							unset($arFooterContactsFilter);
							?>
						</div>
						<div class="footer__social-nav">
							<? $APPLICATION->IncludeComponent(
								"bitrix:news.list",
								"social-nav",
								array(
									"ACTIVE_DATE_FORMAT" => "d.m.Y",
									"ADD_SECTIONS_CHAIN" => "N",
									"AJAX_MODE" => "N",
									"AJAX_OPTION_ADDITIONAL" => "",
									"AJAX_OPTION_HISTORY" => "N",
									"AJAX_OPTION_JUMP" => "N",
									"AJAX_OPTION_STYLE" => "N",
									"CACHE_FILTER" => "Y",
									"CACHE_GROUPS" => "N",
									"CACHE_TIME" => "3600",
									"CACHE_TYPE" => "A",
									"CHECK_DATES" => "Y",
									"COMPONENT_TEMPLATE" => "social-nav",
									"DETAIL_URL" => "",
									"DISPLAY_BOTTOM_PAGER" => "N",
									"DISPLAY_DATE" => "N",
									"DISPLAY_NAME" => "N",
									"DISPLAY_PICTURE" => "N",
									"DISPLAY_PREVIEW_TEXT" => "N",
									"DISPLAY_TOP_PAGER" => "N",
									"FIELD_CODE" => array(
										0 => "ID",
										1 => "NAME",
										2 => "PREVIEW_PICTURE",
										3 => "",
									),
									"FILTER_NAME" => "",
									"HIDE_LINK_WHEN_NO_DETAIL" => "N",
									"IBLOCK_ID" => SOCIAL_NAV_IB_ID,
									"IBLOCK_TYPE" => "info",
									"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
									"INCLUDE_SUBSECTIONS" => "N",
									"MESSAGE_404" => "",
									"NEWS_COUNT" => "3",
									"PAGER_BASE_LINK" => "",
									"PAGER_BASE_LINK_ENABLE" => "N",
									"PAGER_DESC_NUMBERING" => "N",
									"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
									"PAGER_PARAMS_NAME" => "arrPager",
									"PAGER_SHOW_ALL" => "N",
									"PAGER_SHOW_ALWAYS" => "N",
									"PAGER_TEMPLATE" => "",
									"PAGER_TITLE" => "Новости",
									"PARENT_SECTION" => "",
									"PARENT_SECTION_CODE" => "",
									"PREVIEW_TRUNCATE_LEN" => "",
									"PROPERTY_CODE" => array(
										0 => "",
										1 => "ICON",
										2 => "",
									),
									"SET_BROWSER_TITLE" => "N",
									"SET_LAST_MODIFIED" => "N",
									"SET_META_DESCRIPTION" => "N",
									"SET_META_KEYWORDS" => "N",
									"SET_STATUS_404" => "N",
									"SET_TITLE" => "N",
									"SHOW_404" => "N",
									"SORT_BY1" => "SORT",
									"SORT_BY2" => "SORT",
									"SORT_ORDER1" => "ASC",
									"SORT_ORDER2" => "ASC",
									"STRICT_SECTION_CHECK" => "N",
									"TITLE" => ""
								),
								false
							); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="footer__sub">
				<div class="footer__links">
					<? $APPLICATION->IncludeComponent(
						"bitrix:menu",
						"extra_menu",
						array(
							"ROOT_MENU_TYPE" => "footer_extra",
							"MENU_CACHE_TYPE" => "N",
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_CACHE_GET_VARS" => array(),
							"MAX_LEVEL" => "1",
							"CHILD_MENU_TYPE" => "",
							"USE_EXT" => "N",
							"DELAY" => "N",
							"ALLOW_MULTI_SELECT" => "N",
							"COMPONENT_TEMPLATE" => "footer_inextra_menufo"
						),
						false
					); ?>
				</div>
				<div class="footer__credit">
					<? $APPLICATION->IncludeComponent(
						"bitrix:main.include",
						".default",
						array(
							"COMPONENT_TEMPLATE" => ".default",
							"PATH" => SITE_TEMPLATE_PATH . "/include/footer/dev-credit.php",
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "",
							"AREA_FILE_RECURSIVE" => "Y",
							"EDIT_TEMPLATE" => "standard.php"
						),
						false
					); ?>
				</div>
				<div class="footer__copyright"><? $APPLICATION->IncludeComponent(
													"bitrix:main.include",
													".default",
													array(
														"COMPONENT_TEMPLATE" => ".default",
														"PATH" => SITE_TEMPLATE_PATH . "/include/footer/copyright.php",
														"AREA_FILE_SHOW" => "file",
														"AREA_FILE_SUFFIX" => "",
														"AREA_FILE_RECURSIVE" => "Y",
														"EDIT_TEMPLATE" => "standard.php"
													),
													false
												); ?></div>
			</div>
		</div>
	</div>
	<!-- end .footer-->
</div>
<div class="page__slide-nav">
	<!-- begin .mobile-menu-->
	<div class="mobile-menu">
		<button type="button" data-toggle-scope=".page__body" data-toggle-class="page__body_nav_open frozen-scroll" class="mobile-menu__close js-toggle">
			Закрыть меню
		</button>
		<div class="mobile-menu__catalog-trigger">
			<!-- begin .button-->
			<div class="button button_width_full button_size_xl button_text-size_l button_type_caps js-catalog-menu-trigger">
				<span class="button__holder">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="button__icon">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M21 17C21.5523 17 22 17.4477 22 18C22 18.5523 21.5523 19 21 19H3C2.44772 19 2 18.5523 2 18C2 17.4477 2.44772 17 3 17H21ZM21 11C21.5523 11 22 11.4477 22 12C22 12.5523 21.5523 13 21 13H3C2.44772 13 2 12.5523 2 12C2 11.4477 2.44772 11 3 11H21ZM21 5C21.5523 5 22 5.44772 22 6C22 6.55228 21.5523 7 21 7H3C2.44772 7 2 6.55228 2 6C2 5.44772 2.44772 5 3 5H21Z"></path>
					</svg>
					<span class="button__text">Каталог</span>
				</span>
			</div>
			<!-- end .button-->
		</div>
		<div class="mobile-menu__search">
			<? $APPLICATION->IncludeComponent(
				"waim:search.form",
				"",
				array(
					'SEARCH_PAGE' => '/search/',
					'PLACEHOLDER' => 'Поиск по сайту'
				)
			); ?>
		</div>
		<div class="mobile-menu__nav">
			<? $APPLICATION->IncludeComponent(
				"bitrix:menu",
				"mobile_menu",
				array(
					"ROOT_MENU_TYPE" => "mobile",
					"MENU_CACHE_TYPE" => "N",
					"MENU_CACHE_TIME" => "3600",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"MENU_CACHE_GET_VARS" => array(),
					"MAX_LEVEL" => "1",
					"CHILD_MENU_TYPE" => "",
					"USE_EXT" => "N",
					"DELAY" => "N",
					"ALLOW_MULTI_SELECT" => "N",
					"COMPONENT_TEMPLATE" => "mobile_menu"
				),
				false
			); ?>
		</div>
		<div class="mobile-menu__nav-link-group">
			<!-- begin .link-group-->
			<div class="link-group link-group_type_separatred">
				<ul class="link-group__list">
					<li class="link-group__item">
						<div class="link-group__wrapper">
							<!-- begin .link-item-->
							<a class="link-item link-item_type_padded link-item_text-size_l link-item_icon-size_l link-item_icon-offset_l<?= ($GLOBALS["USER"]->IsAuthorized() ? ' link-item_style_primary js-controlled-dropdown-trigger' : '') ?>" href="<?= ($GLOBALS["USER"]->IsAuthorized() ? PROFILE_URL : AUTH_URL . '?actionurl=' . CURRENT_PAGE_URL) ?>" data-for-dropdown="authMenuMobile" data-active-class="link-item_state_active">
								<span class="link-item__icon-wrapper">
									<svg class="link-item__icon" width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M29 15.7504C29.0001 13.6293 28.471 11.5417 27.4606 9.6767C26.4502 7.8117 24.9906 6.22824 23.2138 5.06974C21.437 3.91124 19.3993 3.21432 17.2852 3.0421C15.1711 2.86988 13.0475 3.22781 11.1066 4.08347C9.16577 4.93912 7.46905 6.26546 6.17017 7.94235C4.87129 9.61923 4.01128 11.5937 3.66804 13.6868C3.32481 15.7799 3.5092 17.9256 4.20451 19.9295C4.89981 21.9334 6.08407 23.7322 7.65 25.1629L7.8 25.2879C10.1288 27.3562 13.1353 28.4985 16.25 28.4985C19.3647 28.4985 22.3712 27.3562 24.7 25.2879L24.85 25.1629C26.1588 23.9692 27.2039 22.5155 27.9185 20.8947C28.6331 19.2739 29.0015 17.5217 29 15.7504ZM5 15.7504C4.99749 13.9138 5.44467 12.1045 6.30248 10.4805C7.16029 8.85657 8.40264 7.46732 9.92105 6.43409C11.4395 5.40087 13.1877 4.75511 15.0132 4.5532C16.8387 4.35129 18.6858 4.59937 20.3933 5.27579C22.1008 5.9522 23.6168 7.03637 24.8087 8.43362C26.0007 9.83086 26.8325 11.4987 27.2314 13.2914C27.6303 15.0842 27.5843 16.9474 27.0972 18.7182C26.6102 20.4891 25.6971 22.1138 24.4375 23.4504C23.2562 21.6229 21.4954 20.2451 19.4375 19.5379C20.4648 18.8537 21.2446 17.857 21.6617 16.6953C22.0788 15.5336 22.1111 14.2686 21.7536 13.0872C21.3962 11.9057 20.6681 10.8707 19.677 10.1351C18.6858 9.39943 17.4843 9.00225 16.25 9.00225C15.0157 9.00225 13.8142 9.39943 12.823 10.1351C11.8319 10.8707 11.1038 11.9057 10.7464 13.0872C10.3889 14.2686 10.4212 15.5336 10.8383 16.6953C11.2554 17.857 12.0352 18.8537 13.0625 19.5379C11.0046 20.2451 9.24382 21.6229 8.0625 23.4504C6.09368 21.3704 4.99758 18.6144 5 15.7504ZM12 14.7504C12 13.9098 12.2493 13.0881 12.7163 12.3892C13.1833 11.6903 13.847 11.1456 14.6236 10.8239C15.4002 10.5022 16.2547 10.4181 17.0791 10.5821C17.9036 10.746 18.6608 11.1508 19.2552 11.7452C19.8496 12.3396 20.2544 13.0968 20.4183 13.9213C20.5823 14.7457 20.4982 15.6002 20.1765 16.3768C19.8548 17.1534 19.3101 17.8171 18.6112 18.2841C17.9123 18.7511 17.0906 19.0004 16.25 19.0004C15.1238 18.9971 14.0448 18.5483 13.2484 17.752C12.4521 16.9556 12.0033 15.8765 12 14.7504ZM9.175 24.5004C9.91027 23.2815 10.948 22.2732 12.1876 21.5733C13.4271 20.8734 14.8265 20.5056 16.25 20.5056C17.6735 20.5056 19.0729 20.8734 20.3125 21.5733C21.552 22.2732 22.5897 23.2815 23.325 24.5004C21.3217 26.1178 18.8247 27 16.25 27C13.6753 27 11.1783 26.1178 9.175 24.5004Z" />
									</svg>
								</span>
								<span class="link-item__label"><?= ($GLOBALS["USER"]->IsAuthorized() ? 'Личный кабинет' : 'Войти') ?></span>
							</a>
							<!-- end .link-item-->
						</div>
					</li>
				</ul>
			</div>
			<!-- end .link-group-->
			<? if ($GLOBALS["USER"]->IsAuthorized()) : ?>
				<div class="mobile-menu__auth-menu">
					<!-- begin .controlled-dropdown-->
					<div class="controlled-dropdown" id="authMenuMobile">
						<div class="controlled-dropdown__body">
							<!-- begin .nav-->
							<? $APPLICATION->IncludeComponent(
								"bitrix:menu",
								"personal_header_menu",
								array(
									"ROOT_MENU_TYPE" => "personal",
									"MENU_CACHE_TYPE" => "A",
									"MENU_CACHE_TIME" => "3600",
									"MENU_CACHE_USE_GROUPS" => "Y",
									"MENU_CACHE_GET_VARS" => array(),
									"MAX_LEVEL" => "1",
									"DELAY" => "N",
									"ALLOW_MULTI_SELECT" => "N",
								),
								false
							); ?>
							<!-- end .nav-->
						</div>
					</div>
					<!-- end .controlled-dropdown-->
				</div>
			<? endif; ?>
		</div>
		<div class="mobile-menu__link-group">
			<!-- begin .link-group-->
			<div class="link-group link-group_spacing_close">
				<ul class="link-group__list">
					<!--<li class="link-group__item">
								<div class="link-group__wrapper">
									<a
										class="link-item link-item_type_padded link-item_text-size_l link-item_icon-size_l link-item_icon-offset_l"
										href="#"
									>
										<span class="link-item__icon-wrapper">
											<svg
												class="link-item__icon"
												width="33"
												height="32"
												viewBox="0 0 33 32"
												fill="none"
												xmlns="http://www.w3.org/2000/svg"
											>
												<path d="M4.5 12H8.5V29.3333H4.5V12Z" />
												<path d="M11.1667 2.66667H15.1667V29.3333H11.1667V2.66667Z" />
												<path d="M17.8333 16H21.8333V29.3333H17.8333V16Z" />
												<path d="M24.5 8.00001H28.5V29.3333H24.5V8.00001Z" />
											</svg>
										</span>
										<span class="link-item__label">
											Сравнение
											<span>(5)</span>
										</span>
									</a>
								</div>
							</li>-->
					<li class="link-group__item">
						<div class="link-group__wrapper">
							<!-- begin .link-item-->
							<? $APPLICATION->IncludeComponent(
								"waim:sale.favorites.ajax",
								"mobile",
								array(
									'PATH_TO_FAVORITES' => FAVORITES_URL
								)
							); ?>
							<!-- end .link-item-->
						</div>
					</li>
				</ul>
			</div>
			<!-- end .link-group-->
		</div>
		<div class="mobile-menu__contact-group">
			<?
			$arMobileMenuContactsFilter = array('PROPERTY_AREAS_VALUE' => 'Меню под бургером');
			if (!empty($GLOBALS["arRegion"]) && $GLOBALS["arRegion"]["NAME"] != "Москва") {
				$arMobileMenuContactsFilter["!XML_ID"] = 'moscow';
			}
			$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"mobile-menu-contact",
				array(
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"ADD_SECTIONS_CHAIN" => "N",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_ADDITIONAL" => "",
					"AJAX_OPTION_HISTORY" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "N",
					"CACHE_FILTER" => "Y",
					"CACHE_GROUPS" => "N",
					"CACHE_TIME" => "3600",
					"CACHE_TYPE" => "N",
					"CHECK_DATES" => "Y",
					"COMPONENT_TEMPLATE" => "contact-list",
					"DETAIL_URL" => "",
					"DISPLAY_BOTTOM_PAGER" => "N",
					"DISPLAY_DATE" => "N",
					"DISPLAY_NAME" => "N",
					"DISPLAY_PICTURE" => "N",
					"DISPLAY_PREVIEW_TEXT" => "N",
					"DISPLAY_TOP_PAGER" => "N",
					"FIELD_CODE" => array(
						0 => "ID",
						1 => "NAME",
						2 => "PREVIEW_PICTURE",
						3 => "",
					),
					"FILTER_NAME" => "arMobileMenuContactsFilter",
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",
					"IBLOCK_ID" => CONTACTS_IB_ID,
					"IBLOCK_TYPE" => "info",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"INCLUDE_SUBSECTIONS" => "N",
					"MESSAGE_404" => "",
					"NEWS_COUNT" => "10",
					"PAGER_BASE_LINK" => "",
					"PAGER_BASE_LINK_ENABLE" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_PARAMS_NAME" => "arrPager",
					"PAGER_SHOW_ALL" => "N",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_TEMPLATE" => "",
					"PAGER_TITLE" => "Новости",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"PREVIEW_TRUNCATE_LEN" => "",
					"PROPERTY_CODE" => array(
						0 => "ICON_HTML",
						1 => "LINK",
						2 => "LINK_TEXT",
						3 => "AREAS",
						4 => "TYPE",
						5 => "",
						6 => "",
						7 => "",
						8 => "",
						9 => "",
						10 => "",
					),
					"SET_BROWSER_TITLE" => "N",
					"SET_LAST_MODIFIED" => "N",
					"SET_META_DESCRIPTION" => "N",
					"SET_META_KEYWORDS" => "N",
					"SET_STATUS_404" => "N",
					"SET_TITLE" => "N",
					"SHOW_404" => "N",
					"SORT_BY1" => "SORT",
					"SORT_BY2" => "SORT",
					"SORT_ORDER1" => "ASC",
					"SORT_ORDER2" => "ASC",
					"STRICT_SECTION_CHECK" => "N",
					"TITLE" => ""
				),
				false
			);
			unset($arMobileMenuContactsFilter);
			?>
		</div>
		<div class="mobile-menu__geo-selector">
			<!-- begin .geo-selector-->
			<div class="geo-selector">
				<a href="#modalGeoSelect" class="geo-selector__trigger js-modal">
					<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="geo-selector__icon">
						<path d="M7.99984 7.99999C8.3665 7.99999 8.6805 7.86933 8.94184 7.60799C9.20273 7.34711 9.33317 7.03333 9.33317 6.66666C9.33317 6.29999 9.20273 5.98599 8.94184 5.72466C8.6805 5.46377 8.3665 5.33333 7.99984 5.33333C7.63317 5.33333 7.31939 5.46377 7.0585 5.72466C6.79717 5.98599 6.6665 6.29999 6.6665 6.66666C6.6665 7.03333 6.79717 7.34711 7.0585 7.60799C7.31939 7.86933 7.63317 7.99999 7.99984 7.99999ZM7.99984 14.6667C6.21095 13.1444 4.87495 11.7304 3.99184 10.4247C3.10828 9.11933 2.6665 7.91111 2.6665 6.79999C2.6665 5.13333 3.20273 3.80555 4.27517 2.81666C5.34717 1.82777 6.58873 1.33333 7.99984 1.33333C9.41095 1.33333 10.6525 1.82777 11.7245 2.81666C12.7969 3.80555 13.3332 5.13333 13.3332 6.79999C13.3332 7.91111 12.8916 9.11933 12.0085 10.4247C11.1249 11.7304 9.78873 13.1444 7.99984 14.6667Z"></path>
					</svg>
					<span class="geo-selector__label"><?= $GLOBALS["arRegion"]["NAME"] ?></span>
				</a>
			</div>
			<!-- end .geo-selector-->
		</div>
	</div>
	<!-- end .mobile-menu-->
</div>
<div class="page__floating-catalog js-floating-catalog">
	<div class="page__container">
		<div class="page__catalog-menu">
			<? $APPLICATION->IncludeComponent(
				"bitrix:catalog.section.list",
				"floating-catalog",
				array(
					"VIEW_MODE" => "TEXT",
					"SHOW_PARENT_NAME" => "Y",
					"IBLOCK_TYPE" => "1c_goods",
					"IBLOCK_ID" => CATALOG_IB_ID,
					"SECTION_ID" => $_REQUEST["SECTION_ID"],
					"SECTION_CODE" => $_REQUEST["SECTION_CODE"],
					"SECTION_URL" => "/catalog/#SECTION_CODE_PATH#/",
					//"COUNT_ELEMENTS" => "Y",
					"COUNT_ELEMENTS" => "N",
					"TOP_DEPTH" => "5",
					//"TOP_DEPTH" => "1",
					"SECTION_FIELDS" => array(
						0 => "ID",
						1 => "CODE",
						2 => "NAME",
						3 => "DESCRIPTION",
						4 => "PICTURE",
						5 => "",
					),
					"SECTION_USER_FIELDS" => array(
						0 => "",
						1 => "",
					),
					"ADD_SECTIONS_CHAIN" => "N",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "36000000",
					"CACHE_NOTES" => "",
					"CACHE_GROUPS" => "Y",
					"COMPONENT_TEMPLATE" => "floating-catalog",
					"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
					"ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
					"HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
					"FILTER_NAME" => "sectionsFilter",
					"CACHE_FILTER" => "N"
				),
				false
			); ?>
		</div>
	</div>
</div>
<? $APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_TEMPLATE_PATH . "/include/common/modals.php",
		"AREA_FILE_RECURSIVE" => "N",
		"EDIT_MODE" => "html",
	),
	false
);
?>
</div>
<script>
	document.addEventListener('order_begin', function() {
		console.log('order_begin');
		if (typeof ym !== 'undefined') ym(92893558, 'reachGoal', 'goal_order_begin');
	});

	document.addEventListener('order_success', function() {
		console.log('order_success');
		if (typeof ym !== 'undefined') ym(92893558, 'reachGoal', 'goal_order_success');
	});

	document.addEventListener('basket_add', function() {
		console.log('basket_add');
		if (typeof ym !== 'undefined') ym(92893558, 'reachGoal', 'goal_basket_add');
	});

	document.addEventListener('success_ask', function() {
		console.log('success_ask');
		if (typeof ym !== 'undefined') ym(92893558, 'reachGoal', 'goal_webform_success_ask');
	});

	document.addEventListener('success_partner', function() {
		console.log('success_partner');
		if (typeof ym !== 'undefined') ym(92893558, 'reachGoal', 'goal_webform_success_partner');
	});

	document.addEventListener('success_partner', function() {
		console.log('success_partner');
		if (typeof ym !== 'undefined') ym(92893558, 'reachGoal', 'goal_webform_success_partner');
	});
</script>
<script>
	BX.showWait = function() {
		var loader = '<div class="loader"><div class="cssload-clock"></div></div>';
		$('body').append(loader);
	};

	BX.closeWait = function() {
		$('body').find('.loader').remove();
	};
</script>
</body>

</html>