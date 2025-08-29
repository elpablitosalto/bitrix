
<div class="search__header">
		<div class="search__field">
			<?$APPLICATION->IncludeComponent(
					"waim:search.form", "inner",
					Array(
							'SEARCH_PAGE' => '/search/',
							'PLACEHOLDER' => 'Поиск по сайту'
					)
			);?>
		</div>
		<div class="search__message">Найдены <?=$arParams['RESULT_STR']?> по запросу «<?=$arParams['QUERY_STR']?>»</div>
		<div class="search__filters">
				<!-- begin .link-filter-->
				<div class="link-filter undefined js-link-filter">
						<ul class="link-filter__list">
								<?foreach($arParams['GROUPS'] as $arGroup):?>
									<?if(!empty($arGroup['ITEMS'])):?>
										<li class="link-filter__item">
												<a class="link-filter__link <?=($arGroup['CODE'] === $arParams['TYPE'] ? 'link-filter__link_state_active' : '')?>" href="<?=$arGroup['URL']?>">
														<?=$arGroup['NAME']?>
												</a>
										</li>
									<?endif?>
								<?endforeach?>
						</ul>
				</div>
				<!-- end .link-filter-->
		</div>
</div>