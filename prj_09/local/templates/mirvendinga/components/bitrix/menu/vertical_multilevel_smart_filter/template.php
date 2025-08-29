<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
	<div class="catalog-filters__title">
		<!-- begin .title-->
		<h2 class="title title_size_h1">Категории</h2>
		<!-- end .title-->
	</div>
	<div class="catalog-filters__subtitle">Выберите категории:</div>
	<div class="catalog-filters__check-list">
		<!-- begin .check-list-->
		<div class="check-list js_check_list_tree">
			<?
			//echo 'SECTION_ID = '.$arParams['SECTION_ID'].'<br />';
			//vardump($arResult);
			?>
			<ul class="check-list__list js-checklist-list">
				<?
				$previousLevel = 0;
				$arCountElsInLevel = [];
				foreach ($arResult as $arItem) { ?>
					<?
					$arCheckBoxParams = $arItem['arCheckBoxParams'];

					$arCountElsInLevel[$arItem["DEPTH_LEVEL"]]++;
					?>
					<? if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) { ?>
						<?
						for ($i = $previousLevel; $i > $arItem["DEPTH_LEVEL"]; $i--) {
							$str = '</ul>';
							/*
							if ($arCountElsInLevel[$i] >= 7) {
								$str .= '
									<div class="check-list__controls">
										<div class="check-list__control">
											<button
												type="button"
												class="check-list__link">
												Свернуть
											</button>
										</div>
									</div>
								';
							}
							*/
							$str .= '
								</div>
							</li>
							';
							echo $str;
							$arCountElsInLevel[$i] = 0;
						}
						?>
						<?/*?>
						<?= str_repeat(
							'
									</ul>
									<div class="check-list__controls">
										<div class="check-list__control">
											<button
												type="button"
												class="check-list__link">
												Свернуть
											</button>
										</div>
									</div>
								</div>
							</li>',
							($previousLevel - $arItem["DEPTH_LEVEL"])
						); ?>
						<?*/ ?>
					<? } ?>

					<? if ($arItem["IS_PARENT"]) { ?>
						<?
						$addClass = '';
						if ($arCountElsInLevel[$arItem["DEPTH_LEVEL"]] == 5) {
							$addClass = 'check-list__item_collapse_threshold';
						}
						$expandedClassLi = '';
						$expandedClassDiv = '';
						if ($arItem["EXPANDED"]) {
							$expandedClassLi = 'check-list__item_state_expanded';
							$expandedClassDiv = 'check-list__item-wrapper_state_expanded';
						}
						?>
						<li class="check-list__item js-checklist-item <?= $addClass; ?> <?= $expandedClassLi; ?>" data-count="<?= $arCountElsInLevel[$arItem["DEPTH_LEVEL"]]; ?>">
							<div
								class="check-list__item-wrapper js-checklist-item-wrapper <?= $expandedClassDiv; ?>">
								<button
									type="button"
									class="check-list__trigger js-checklist-trigger">
									Раскрыть список
								</button>
								<label class="check-list__label">
									<input
										type="checkbox"
										class="check-list__input js-checklist-input"
										name="<? echo $arCheckBoxParams['name']; ?>"
										value="<? echo $arCheckBoxParams['value']; ?>"
										id="<? echo $arCheckBoxParams["id"] ?>"
										<?/* echo $arCheckBoxParams["checked"] ? 'checked="checked"' : '' */?>
										<? echo $arCheckBoxParams["disabled"] ? 'disabled' : '' ?>
										<? echo $arCheckBoxParams['expanded'] ? 'data-expanded="true"' : 'data-expanded="false"' ?>
										<? echo $arCheckBoxParams['tickedPartially'] ? 'data-ticked-partially="true"' : 'data-ticked-partially="false"' ?>
										<?/*?>data-expanded-test="<? echo $arItem["EXPANDED"] ?>"<?*/?>
										data-tickedPartially-test="<? echo $arCheckBoxParams["tickedPartially"] ?>"
										onclick="smartFilter.click(this)"
										<?/*?>
										data-expanded="true"
										data-tickedPartially="true" 
										<?*/ ?> />
									<span class="check-list__check">
										&nbsp;
									</span>
								</label>
								<button
									type="button"
									class="check-list__name js-checklist-trigger js-checklist-select <? echo $arCheckBoxParams["disabled"] ? 'disabled' : '' ?>">
									<?= $arItem["TEXT"] ?>
								</button>
							</div>
							<div class="check-list__sub">
								<ul
									class="check-list__list js-checklist-list">

								<? } else { ?>
									<?
									$addClass = '';
									if ($arCountElsInLevel[$arItem["DEPTH_LEVEL"]] == 5) {
										$addClass = 'check-list__item_collapse_threshold';
									}
									?>
									<li class="check-list__item js-checklist-item <?= $addClass; ?>" data-count="<?= $arCountElsInLevel[$arItem["DEPTH_LEVEL"]]; ?>">
										<div
											class="check-list__item-wrapper js-checklist-item-wrapper">
											<label class="check-list__label">
												<input
													type="checkbox"
													name="<? echo $arCheckBoxParams['name']; ?>"
													value="<? echo $arCheckBoxParams['value']; ?>"
													id="<? echo $arCheckBoxParams["id"] ?>"
													<? echo $arCheckBoxParams["checked"] ? 'checked="checked"' : '' ?>
													<? echo $arCheckBoxParams["disabled"] ? 'disabled' : '' ?>
													onclick="smartFilter.click(this)"
													class="check-list__input js-checklist-input" 
													<?/*?>data-test="<?=$arCheckBoxParams["ajaxCall"];?>"<?/**/?>
													<?/*?>data-test="<?=$arParams["AJAX_CALL"];?>"<?*/?>
													<?/*?>data-test="<?=serialize($_GET);?>"<?*/?>
													/>
												<span class="check-list__check">
													&nbsp;
												</span>
											</label>
											<button
												type="button"
												class="check-list__name js-checklist-trigger js-checklist-select <? echo $arCheckBoxParams["disabled"] ? 'disabled' : '' ?>">
												<?= $arItem["TEXT"] ?>
											</button>
										</div>
									</li>
								<? } ?>

								<? $previousLevel = $arItem["DEPTH_LEVEL"]; ?>
							<? } ?>
							<? if ($previousLevel > 1) { //close last item tags
							?>
								<?
								for ($i = $previousLevel; $i > 1; $i--) {
									$str = '</ul>';
									/*
									if ($arCountElsInLevel[$i] >= 7) {
										$str .= '
										<div class="check-list__controls">
											<div class="check-list__control">
												<button
													type="button"
													class="check-list__link">
													Свернуть
												</button>
											</div>
										</div>
									';
									}
									*/
									$str .= '
									</div>
								</li>
								';
									echo $str;
								}
								?>
								<?/*?>
								<?= str_repeat('
									</ul>
									<div class="check-list__controls">
										<div class="check-list__control">
											<button
												type="button"
												class="check-list__link">
												Свернуть
											</button>
										</div>
									</div>
								</div>
							</li>', ($previousLevel - 1)); ?>
							<?*/ ?>
							<? } ?>
								</ul>
								<?/*?>
								<div class="check-list__controls">
									<div class="check-list__control">
										<button type="button" class="check-list__link">
											Свернуть
										</button>
									</div>
								</div>
								<?*/ ?>
							</div>
							<!-- end .check-list-->
		</div>
	<? endif ?>