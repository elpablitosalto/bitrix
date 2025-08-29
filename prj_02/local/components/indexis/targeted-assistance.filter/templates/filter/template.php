<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

use \Bitrix\Main\Context;
$request = Context::getCurrent()->getRequest();
$thCategory = $request->get("th");
$needCategory = $request->get("need");

?>

<div id="target-help-filter" class="target-help-filter">
	<form action="" method="" autocomplete="off" class="filter-form" id="cat_filter">
    	<div class="row align-items-center">
            <div class="col-sm-6 col-lg-4">
            	<div class="form-group">
                	<select id="th" name="th" class="form-control">
                    	<option id="thf-1"  <? if (empty($thCategory)) {echo 'selected';}?> value="" class="placeholder-option">Чем помочь</option>
                    	<option id="thf-1-0" value="">Все категории</option>
                        <?foreach ($arResult['THCATEGORY'] as $code) {?>
                        	<option id="thf-1-<?=$arResult['ALL_THCATEGORY'][$code]['ID']?>" <? if ($thCategory == $code) {echo 'selected';}?> value="<?=$code?>"><?=$arResult['ALL_THCATEGORY'][$code]['NAME']?></option>
						<?}?>		
                    </select>
                </div>
        	</div>
        	<div class="col-sm-6 col-lg-4">
            	<div class="form-group">
                	<select id="need" name="need" class="form-control">
                    	<option id="thf-2" <? if (empty($needCategory)) {echo 'selected';}?> value="" class="placeholder-option">Кому нужна помощь</option>
                    	<option id="thf-2-0" value="">Все группы</option>
                        <?foreach ($arResult['NEEDCATEGORY'] as $code) {?>
                        	<option id="thf-2-<?=$arResult['ALL_NEEDCATEGORY'][$code]['ID']?>" <? if ($needCategory == $code) {echo 'selected';}?> value="<?=$code?>"><?=$arResult['ALL_NEEDCATEGORY'][$code]['NAME']?></option>
						<?}?>		
                    </select>
                </div>
        	</div>
        </div>
    </form>
</div>

<? if (!empty($arParams["AJAX_URL"]) && !empty($arParams["AJAX_RESULT"])) {?>
 <script>
	function refresh_list() {  
  	 $.ajax({
        	type: "POST",
        	url: "<?=$arParams["AJAX_URL"]?>",
        	data: {
				th : $("#th").val(),
				need : $("#need").val(),
				baseLink : "<?=$APPLICATION->GetCurPage();?>"
			}
    	})
	 .done(function( result ) {  
        $("#<?=$arParams["AJAX_RESULT"]?>").html(result);
		LoadImagesLazy(); 
	 }
	 );  
	}

	$('#target-help-filter select').on('change', function() {  
		history.pushState(null, null, "<?=$APPLICATION->GetCurPage();?>?th="+$("#th").val()+"&need="+$("#need").val());
		refresh_list();
	});
 </script>
<?}?>