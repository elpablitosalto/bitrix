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
$projectRequest = IntVal($request->get("project"));
$cityRequest = $request->get("city");

?>
<form method="" action="" autocomplete="off" class="managers-filter" id="projects_filter">
	<div class="row justify-content-xxl-between">
    	<div class="col-12 mobile-visible">
        	<div class="form-group cities_mob">
            	<select name="CITIES" id="CITIES" class="form-control">
                    <option value="0" disabled <? if(empty($cityRequest)) {echo 'selected';}?> class="placeholder-option" data-city="all">Все города</option>
					<?foreach($arResult['CITIES'] as $cityCode => $city) {?>
                      <option value="<?=$cityCode?>" <? if($cityRequest === $cityCode ) {echo 'selected';}?> data-city="<?=$cityCode?>"><?=$city['NAME']?></option>
					<?}?>
                 </select>
            </div>
        </div>
        <div class="col-lg-9 mobile-hidden">
        	<div class="form-group managers-filter__tags cities_desk">
            	<div class="buttons-line">
					<a href="" class="btn <? if(empty($cityRequest)) {echo 'selected';}?>" data-city="">Все города</a>
					<?foreach($arResult['CITIES'] as $cityCode => $city) {?>
						<a href="#" class="btn <? if($cityRequest === $cityCode ) {echo 'selected';}?>" data-city="<?=$cityCode?>"><?=$city['NAME']?></a>
					<?}?>
				</div>
            </div>
        </div>
        <div class="col-lg-3">
        	<div class="form-group">
            	<select name="PROJECTS" id="PROJECTS" class="form-control">
                	<option value="0" disabled <? if(empty($projectRequest)) {echo 'selected';}?> class="placeholder-option">Выберете проект</option>
					<?foreach($arResult['PROJECTS'] as $projectID => $projectName) {?>
                      <option value="<?=$projectID?>" <? if($projectRequest === $projectID ) {echo 'selected';}?> ><?=$projectName?></option>
					<?}?>
                </select>
            </div>
        </div>
	</div>
</form>

<? if (!empty($arParams["AJAX_URL"]) && !empty($arParams["AJAX_RESULT"])) {?>
 <script>
	function refresh_list(param) {
	 elem = "#"+param;
  	 $.ajax({
        	type: "POST",
        	url: "<?=$arParams["AJAX_URL"]?>",
        	data: {
				param : param,
				value : $(elem).val(),
				baseLink : "<?=$APPLICATION->GetCurPage();?>"
			}
    	})
	 .done(function( result ) { 
        $("#<?=$arParams["AJAX_RESULT"]?>").html(result);
		LoadImagesLazy(); 
	 }
	 );  
	}

	$('#PROJECTS').on('change', function() {
		history.pushState(null, null, "<?=$APPLICATION->GetCurPage();?>?project="+$(this).val());
		refresh_list("PROJECTS");
	});
	$('#CITIES').on('change', function() {
		history.pushState(null, null, "<?=$APPLICATION->GetCurPage();?>?city="+$(this).val());
		refresh_list("CITIES");
	});
	$('.cities_desk a').on('click', function() { 
		$("#CITIES").val($(this).attr("data-city"));
		history.pushState(null, null, "<?=$APPLICATION->GetCurPage();?>?city="+$(this).attr("data-city"));
		refresh_list("CITIES")
		$(".cities_desk a").removeClass("selected");
		$(this).addClass("selected");
		return false;
	});
 </script>
<?}?>