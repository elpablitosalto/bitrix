<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

if (mb_strlen($arResult["REQUEST"]["QUERY"]) > 0)
	$APPLICATION->SetTitle('Результаты поиска по фразе «' . $arResult["REQUEST"]["QUERY"] . '»');
?>
<section class="nb-section nb-standards-section">
	<div class="container">
		<div class="nb-section__header">
			<h2 class="nb-section__title">Результаты поиска<?if (mb_strlen($arResult["REQUEST"]["QUERY"]) > 0):?> по фразе <span class="font-weight_normal">«<?=$arResult["REQUEST"]["QUERY"]?>»</span><?endif;?></h2>
		</div>
		<div class="nb-section__body">
			<div class="nb-header-search">
				<form action="" method="get" class="nb-header-search-form">
					<?if($arParams["USE_SUGGEST"] === "Y"):
						if(mb_strlen($arResult["REQUEST"]["~QUERY"]) && is_object($arResult["NAV_RESULT"]))
						{
							$arResult["FILTER_MD5"] = $arResult["NAV_RESULT"]->GetFilterMD5();
							$obSearchSuggest = new CSearchSuggest($arResult["FILTER_MD5"], $arResult["REQUEST"]["~QUERY"]);
							$obSearchSuggest->SetResultCount($arResult["NAV_RESULT"]->NavRecordCount);
						}
						?>
						<?$APPLICATION->IncludeComponent(
						"bitrix:search.suggest.input",
						"",
						array(
							"NAME" => "q",
							"VALUE" => $arResult["REQUEST"]["~QUERY"],
							"INPUT_SIZE" => 40,
							"DROPDOWN_SIZE" => 10,
							"FILTER_MD5" => $arResult["FILTER_MD5"],
						),
						$component, array("HIDE_ICONS" => "Y")
					);?>
					<?else:?>
						<input type="text" placeholder="Поиск" name="q" value="<?=$arResult["REQUEST"]["QUERY"]?>" size="40" class="nb-header-search-form__input" />
					<?endif;?>
					<?if($arParams["SHOW_WHERE"]):?>
						&nbsp;<select name="where">
							<option value=""><?=GetMessage("SEARCH_ALL")?></option>
							<?foreach($arResult["DROPDOWN"] as $key=>$value):?>
								<option value="<?=$key?>"<?if($arResult["REQUEST"]["WHERE"]==$key) echo " selected"?>><?=$value?></option>
							<?endforeach?>
						</select>
					<?endif;?>
					<button class="nb-header-search-form__submit" type="submit">
						<svg class="icon icon-search nb-header-search-form__icon">
							<use xlink:href="#search"></use>
						</svg>
					</button>
					<input type="hidden" name="how" value="<?echo $arResult["REQUEST"]["HOW"]=="d"? "d": "r"?>" />
					<?if($arParams["SHOW_WHEN"]):?>
						<script>
							var switch_search_params = function()
							{
								var sp = document.getElementById('search_params');
								var flag;
								var i;

								if(sp.style.display == 'none')
								{
									flag = false;
									sp.style.display = 'block'
								}
								else
								{
									flag = true;
									sp.style.display = 'none';
								}

								var from = document.getElementsByName('from');
								for(i = 0; i < from.length; i++)
									if(from[i].type.toLowerCase() == 'text')
										from[i].disabled = flag;

								var to = document.getElementsByName('to');
								for(i = 0; i < to.length; i++)
									if(to[i].type.toLowerCase() == 'text')
										to[i].disabled = flag;

								return false;
							}
						</script>
						<br /><a class="search-page-params" href="#" onclick="return switch_search_params()"><?echo GetMessage('CT_BSP_ADDITIONAL_PARAMS')?></a>
						<div id="search_params" class="search-page-params" style="display:<?echo $arResult["REQUEST"]["FROM"] || $arResult["REQUEST"]["TO"]? 'block': 'none'?>">
							<?$APPLICATION->IncludeComponent(
								'bitrix:main.calendar',
								'',
								array(
									'SHOW_INPUT' => 'Y',
									'INPUT_NAME' => 'from',
									'INPUT_VALUE' => $arResult["REQUEST"]["~FROM"],
									'INPUT_NAME_FINISH' => 'to',
									'INPUT_VALUE_FINISH' =>$arResult["REQUEST"]["~TO"],
									'INPUT_ADDITIONAL_ATTR' => 'size="10"',
								),
								null,
								array('HIDE_ICONS' => 'Y')
							);?>
						</div>
					<?endif?>
				</form>
			</div>

				<?if(isset($arResult["REQUEST"]["ORIGINAL_QUERY"])):
					?>
					<div class="search-language-guess">
						<?echo GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>'))?>
					</div><br /><?
				endif;?>

				<?if($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false):?>
				<?elseif($arResult["ERROR_CODE"]!=0):?>
					<?ShowError($arResult["ERROR_TEXT"]);?>
				<?elseif(count($arResult["SEARCH"])>0):?>
					<?if($arParams["DISPLAY_TOP_PAGER"] != "N") echo $arResult["NAV_STRING"]?>

					<div class="nb-standards">
						<div class="row" data-entity="items">
							<?foreach($arResult["SEARCH"] as $arItem):?>
								<div class="col-md-12">
									<a href="<?echo $arItem["URL"]?>">
										<div class="nb-standard">
											<h3 class="nb-standard__title"><?echo $arItem["TITLE_FORMATED"]?></h3>
											<?if (mb_strlen($arItem["BODY_FORMATED"]) > 0):?>
												<div class="nb-standard__desc">
													<?echo $arItem["BODY_FORMATED"]?>
												</div>
											<?endif;?>
										</div>
									</a>
								</div>
							<?endforeach;?>
						</div>
					</div>

					<br>
					<?if($arParams["DISPLAY_BOTTOM_PAGER"] != "N") echo $arResult["NAV_STRING"]?>

				<?else:?>
					<?ShowNote(GetMessage("SEARCH_NOTHING_TO_FOUND"));?>
				<?endif;?>
		</div>
	</div>
</section>
