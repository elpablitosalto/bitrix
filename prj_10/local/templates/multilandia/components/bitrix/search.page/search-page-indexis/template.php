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
?>
<?
use Bitrix\Main\Application,
    Bitrix\Main\Web\Uri;
session_start();
?>
<?if(!isset($_GET['where']) && !isset($_GET['is_about_articles'])):?>
<h1 class="ml-page-title">По запросу “<?=$_GET['q']?>” найдено <?=count($arResult['SEARCH']);?> <?=getRightWord(count($arResult['SEARCH']), array('результат', 'результата', 'результатов'));?></h1>
<?endif;?>
<div class="ml-tab-btn-nav ">
    <div class="ml-tab-btn-nav__container">
        <ul class="ml-tab-btn-nav__list">
            <?

                $request = Application::getInstance()->getContext()->getRequest();
                $uriString = $request->getRequestUri();
                $uri = new Uri($uriString);
                $last_uri = str_replace(' ', '+', urldecode($uri->getUri()));
                $pure_uri = str_replace('&where=iblock_movies', '', $last_uri);
                $pure_uri = str_replace('&where=iblock_contests', '', $pure_uri);
                $pure_uri = str_replace('&is_about_articles=1', '', $pure_uri);
                $is_all = ($last_uri == $pure_uri);
                $last_uri = $pure_uri;
                $get_part = '?' . explode('?', $last_uri)[1];

                if($is_all){
                    unset($_SESSION['SEARCH_PAGE_MOVIES']);
                    unset($_SESSION['SEARCH_PAGE_CONTESTS']);
                    unset($_SESSION['SEARCH_PAGE_ABOUT']);
                }

                if(count($arResult['ABOUT_BLOCK']) && !count($arResult['PARTNERS_BLOCK'])){
                    $about_tab_name = 'О канале';
                } elseif(!count($arResult['ABOUT_BLOCK']) && count($arResult['PARTNERS_BLOCK'])){
                    $about_tab_name = 'Партнёрам';
                } else {
                    $about_tab_name = 'О нас';
                }

            ?>
            <li class="ml-tab-btn-nav__item"><a class="ml-tab-btn-nav__link <?if($is_all):?>ml-tab-btn-nav__link_active<?endif;?>" href="<?=$pure_uri;?>">Все</a></li>
            <?if($arResult['MOVIES_COUNT'] > 0 || $_SESSION['SEARCH_PAGE_MOVIES']):?>
            <li class="ml-tab-btn-nav__item"><a class="ml-tab-btn-nav__link <?if($_GET['where'] == 'iblock_movies'):?>ml-tab-btn-nav__link_active<?endif;?>" href="<?=$get_part;?>&where=iblock_movies">Мультфильмы</a></li>
            <?$_SESSION['SEARCH_PAGE_MOVIES'] = true;?>
            <?endif;?>
            <?if($arResult['CONTESTS_COUNT'] > 0 || $_SESSION['SEARCH_PAGE_CONTESTS']):?>
            <li class="ml-tab-btn-nav__item"><a class="ml-tab-btn-nav__link <?if($_GET['where'] == 'iblock_contests'):?>ml-tab-btn-nav__link_active<?endif;?>" href="<?=$get_part;?>&where=iblock_contests"">Конкурсы</a></li>
                <?$_SESSION['SEARCH_PAGE_CONTESTS'] = true;?>
            <?endif;?>
            <?if($arResult['ABOUT_COUNT'] > 0 || $_SESSION['SEARCH_PAGE_ABOUT']):?>
            <li class="ml-tab-btn-nav__item"><a class="ml-tab-btn-nav__link <?if($_GET['is_about_articles'] == 1):?>ml-tab-btn-nav__link_active<?endif;?>" href="<?=$get_part;?>&is_about_articles=1"><?=$about_tab_name;?></a></li>
                <?$_SESSION['SEARCH_PAGE_ABOUT'] = true;?>
            <?endif;?>
        </ul>
    </div>
</div>

<?
session_write_close();
?>

<?if(!isset($_GET['where']) && !isset($_GET['is_about_articles'])):?>
<div class="ml-search-result">
    <?if($arResult['MOVIES_COUNT'] > 0):?>
    <section class="ml-section ml-search-section">
        <div class="ml-section-header">
            <h2 class="ml-section-subtitle">Мультфильмы</h2>
            <?if($arResult['MOVIES_COUNT'] > 8):?>
            <a class="ml-btn ml-btn_round ml-section-btn" href="<?=$get_part;?>&where=iblock_movies">
                Все мультфильмы
            </a>
            <?endif;?>
        </div>
        <div class="ml-section-body">
            <div class="anim-list">
                <div class="row">
                    <?
                        $res_count = 0;
                        $res_count_limit = 8;
                        foreach($arResult['SEARCH'] as $search_item):
                            if($res_count >= $res_count_limit){
                                break;
                            }
                            if($search_item['PARAM1'] == 'movies'){
                                $res_count++;
                            } else {
                                continue;
                            }
                    ?>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="anim-item"><a class="anim-item__link" href="<?=$search_item['DETAIL_PAGE_URL'];?>">
                                <div class="anim-item__img"><img class="lazyload" data-src="<?=$search_item['PREVIEW_PICTURE'];?>" src="<?=$search_item['PREVIEW_PICTURE'];?>" alt=""/>
                                    <?if(!empty($search_item['PROPERTIES']['VOZRAST']['VALUE'])):?>
                                        <span class="age-limit-label age-limit-label_light"><?=$search_item['PROPERTIES']['VOZRAST']['VALUE'];?></span>
                                    <?endif;?>
                                </div>
                                <div class="anim-item__caption">
                                    <p class="anim-item__title"><?=$search_item['NAME'];?></p>
                                    <?foreach($search_item['PROPERTIES']['TEGI']['VALUE'] as $tag_value):?>
                                    <span class="anim-item__tag">#<?=$tag_value;?></span>
                                    <?endforeach;?>
                                </div></a></div>
                    </div>
                    <?endforeach;?>
            </div>
        </div>
    </section>
    <?endif;?>
    <?if($arResult['CONTESTS_COUNT'] > 0):?>
    <section class="ml-section ml-search-section">
        <div class="ml-section-header">
            <h2 class="ml-section-subtitle">Конкурсы</h2>
        </div>
        <div class="ml-section-body">
            <div class="anim-list">
                <div class="row">
                    <?
                        $res_count = 0;
                        $res_count_limit = 8;
                        foreach($arResult['SEARCH'] as $search_item):
                            if($res_count >= $res_count_limit){
                                //break;
                            }
                            if($search_item['PARAM1'] == 'contests'){
                                $res_count++;
                            } else {
                                continue;
                            }
                    ?>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="anim-item anim-item_contest">
                            <a class="anim-item__link" href="<?=$search_item['DETAIL_PAGE_URL'];?>">
                                <div class="anim-item__img">
                                    <img class="lazyload" data-src="<?=$search_item['PREVIEW_PICTURE'];?>" src="<?=$search_item['PREVIEW_PICTURE'];?>" alt="<?=$search_item['NAME'];?>"/>
                                </div>
                                <div class="anim-item__caption">
                                    <p class="anim-item__title"><?=$search_item['NAME'];?></p>
                                    <?
                                    global $DB;
                                    if(!empty($search_item['PROPERTIES']['DATE_START']['VALUE'])){
                                        $start_date = $DB->FormatDate($search_item['PROPERTIES']['DATE_START']['VALUE'], "DD.MM.YYYY", "YYYY-MM-DD");
                                        $unix_date_start = strtotime($start_date);
                                    }
                                    if(!empty($search_item['PROPERTIES']['DATE_END']['VALUE'])){
                                        $end_date = $DB->FormatDate($search_item['PROPERTIES']['DATE_END']['VALUE'], "DD.MM.YYYY", "YYYY-MM-DD");
                                        $unix_date_end = strtotime($end_date);
                                    }


                                    if(isset($unix_date_start) && isset($unix_date_end)){
                                        $now = time();
                                        if($now > $unix_date_end){
                                            $achieved = true;
                                        } else {
                                            $achieved = false;
                                        }
                                    } else {
                                        if(!isset($unix_date_end)){
                                            $achieved = false;
                                        } else {
                                            if($now > $unix_date_end){
                                                $achieved = true;
                                            } else {
                                                $achieved = false;
                                            }
                                        }
                                    }
                                    ?>
                                    <?if(!$achieved):?>
										<div class="anim-item__action">
											<span class="anim-item__dates anim-item__dates_active">
												<?
													$contest_from = $search_item['PROPERTIES']['DATE_START']['VALUE'];
													$from_exp = explode('.', $contest_from);
													array_pop($from_exp);
													$contest_from = implode('.', $from_exp);
												?>
												с <?=$contest_from;?> по <?=$search_item['PROPERTIES']['DATE_END']['VALUE'];?>
											</span>
										</div>
                                    <?else:?>
										<div class="anim-item__action">
											<span class="anim-item__dates">Завершен</span>
										</div>
                                    <?endif;?>
                                    <span class="anim-item__votes">Голосов: 19</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?endforeach;?>
                </div>
            </div>
        </div>
    </section>
    <?endif;?>
    <?if($arResult['ABOUT_COUNT'] > 0 && count($arResult['ABOUT_BLOCK'])):?>
    <section class="ml-section ml-search-section">
        <div class="ml-section-header">
            <h2 class="ml-section-subtitle">О канале</h2>
        </div>
        <div class="ml-section-body">
            <div class="row">
                <div class="col-lg-10 col-xl-9">
                    <?
                    $res_count = 0;
                    $res_count_limit = 8;
                    foreach($arResult['ABOUT_BLOCK'] as $search_item):
                    if($res_count > $res_count_limit){
                        //break;
                    }
                    if($search_item['MODULE_ID'] == 'main'){
                        $res_count++;
                    } else {
                        continue;
                    }
                    ?>
                    <div class="text-item">
                        <a class="text-item__link" href="<?=$search_item['URL'];?>" target="_blank">
                            <p class="text-item__title">
                                <?=$search_item['TITLE_FORMATED'];?>
                            </p>
                            <p class="text-item__desc">
                                <?=$search_item['BODY_FORMATED'];?>
                            </p>
                        </a>
                    </div>
                    <?endforeach;?>
                </div>
            </div>
        </div>
    </section>
    <?endif;?>

    <?if($arResult['ABOUT_COUNT'] > 0 && count($arResult['PARTNERS_BLOCK'])):?>
        <section class="ml-section ml-search-section">
            <div class="ml-section-header">
                <h2 class="ml-section-subtitle">Партнёрам</h2>
            </div>
            <div class="ml-section-body">
                <div class="row">
                    <div class="col-lg-10 col-xl-9">
                        <?
                        $res_count = 0;
                        $res_count_limit = 8;
                        foreach($arResult['PARTNERS_BLOCK'] as $search_item):
                            if($res_count > $res_count_limit){
                                //break;
                            }
                            if($search_item['MODULE_ID'] == 'main'){
                                $res_count++;
                            } else {
                                continue;
                            }
                            ?>
                            <div class="text-item">
                                <a class="text-item__link" href="<?=$search_item['URL'];?>" target="_blank">
                                    <p class="text-item__title">
                                        <?=$search_item['TITLE_FORMATED'];?>
                                    </p>
                                    <p class="text-item__desc">
                                        <?=$search_item['BODY_FORMATED'];?>
                                    </p>
                                </a>
                            </div>
                        <?endforeach;?>
                    </div>
                </div>
            </div>
        </section>
    <?endif;?>
</div>
<?else:?>
<?if($_GET['where'] == 'iblock_movies'):?>
    <!--
    <div class="ml-page-body">
        <div class="container">
        -->
            <div class="ml-search-result">
                <div class="anim-list">
                    <div class="row">
                        <?foreach($arResult['SEARCH'] as $search_item):?>
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="anim-item">
                                <a class="anim-item__link" href="<?=$search_item['DETAIL_PAGE_URL'];?>">
                                    <div class="anim-item__img">
                                        <img class="lazyload" data-src="<?=$search_item['PREVIEW_PICTURE'];?>" src="<?=$search_item['PREVIEW_PICTURE'];?>" alt=""/>
                                        <?if(!empty($search_item['PROPERTIES']['VOZRAST']['VALUE'])):?>
                                        <span class="age-limit-label age-limit-label_light">
                                             <?=$search_item['PROPERTIES']['VOZRAST']['VALUE'];?>
                                        </span>
                                        <?endif;?>
                                    </div>
                                    <div class="anim-item__caption">
                                        <p class="anim-item__title">
                                            <?=$search_item['NAME'];?>
                                        </p>
                                        <?foreach($search_item['PROPERTIES']['TEGI']['VALUE'] as $tag_value):?>
                                            <span class="anim-item__tag">
                                                <?='#' . $tag_value;?>
                                            </span>
                                        <?endforeach;?>

                                    </div>
                                </a>
                            </div>
                        </div>
                        <?endforeach;?>
                    </div>
                    <?if($arParams["DISPLAY_BOTTOM_PAGER"] != "N") echo $arResult["NAV_STRING"]?>
                </div>
            </div>
    <!--
        </div>
    </div>
    -->
    <?elseif($_GET['where'] == 'iblock_contests'):?>

        <div class="ml-search-result">
            <div class="anim-list">
                <div class="row">
                    <?foreach($arResult['SEARCH'] as $search_item):?>
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="anim-item anim-item_contest">
                                <a class="anim-item__link" href="<?=$search_item['DETAIL_PAGE_URL'];?>">
                                    <div class="anim-item__img">
                                        <img class="lazyload" data-src="<?=$search_item['PREVIEW_PICTURE'];?>" src="<?=$search_item['PREVIEW_PICTURE'];?>" alt="<?=$search_item['NAME'];?>"/>
                                    </div>
                                    <div class="anim-item__caption">
                                        <p class="anim-item__title"><?=$search_item['NAME'];?></p>

                                        <?
                                        global $DB;
                                        if(!empty($search_item['PROPERTIES']['DATE_START']['VALUE'])){
                                            $start_date = $DB->FormatDate($search_item['PROPERTIES']['DATE_START']['VALUE'], "DD.MM.YYYY", "YYYY-MM-DD");
                                            $unix_date_start = strtotime($start_date);
                                        }
                                        if(!empty($search_item['PROPERTIES']['DATE_END']['VALUE'])){
                                            $end_date = $DB->FormatDate($search_item['PROPERTIES']['DATE_END']['VALUE'], "DD.MM.YYYY", "YYYY-MM-DD");
                                            $unix_date_end = strtotime($end_date);
                                        }


                                        if(isset($unix_date_start) && isset($unix_date_end)){
                                            $now = time();
                                            if($now > $unix_date_end){
                                                $achieved = true;
                                            } else {
                                                $achieved = false;
                                            }
                                        } else {
                                            if(!isset($unix_date_end)){
                                                $achieved = false;
                                            } else {
                                                if($now > $unix_date_end){
                                                    $achieved = true;
                                                } else {
                                                    $achieved = false;
                                                }
                                            }
                                        }
                                        ?>

                                        <?if(!$achieved):?>
											<div class="anim-item__action">
												<span class="anim-item__dates anim-item__dates_active">
													<?
													$contest_from = $search_item['PROPERTIES']['DATE_START']['VALUE'];
													$from_exp = explode('.', $contest_from);
													array_pop($from_exp);
													$contest_from = implode('.', $from_exp);
													?>
													с <?=$contest_from;?> по <?=$search_item['PROPERTIES']['DATE_END']['VALUE'];?>
												</span>
											</div>
                                        <?else:?>
											<div class="anim-item__action">
												<span class="anim-item__dates">Завершен</span>
											</div>
                                        <?endif;?>
                                        <span class="anim-item__votes">Голосов: 19</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?endforeach;?>

                </div>
                <?if($arParams["DISPLAY_BOTTOM_PAGER"] != "N") echo $arResult["NAV_STRING"]?>

            </div>
        </div>

<?elseif($_GET['is_about_articles']):?>
    <?if(count($arResult['ABOUT_BLOCK'])):?>
    <section class="ml-section ml-search-section">
        <div class="ml-section-header">
            <h2 class="ml-section-subtitle">О канале</h2>
        </div>
        <div class="ml-section-body">
            <div class="row">
                <div class="col-lg-10 col-xl-9">
                    <?
                    $res_count = 0;
                    $res_count_limit = 8;
                    foreach($arResult['ABOUT_BLOCK'] as $search_item):
                        if($res_count > $res_count_limit){
                            //break;
                        }
                        if($search_item['MODULE_ID'] == 'main'){
                            $res_count++;
                        } else {
                            continue;
                        }
                        ?>
                        <div class="text-item">
                            <a class="text-item__link" href="<?=$search_item['URL'];?>" target="_blank">
                                <p class="text-item__title">
                                    <?=$search_item['TITLE_FORMATED'];?>
                                </p>
                                <p class="text-item__desc">
                                    <?=$search_item['BODY_FORMATED'];?>
                                </p>
                            </a>
                        </div>
                    <?endforeach;?>
                </div>
            </div>
        </div>
    </section>
    <?endif;?>
        <?if(count($arResult['PARTNERS_BLOCK'])):?>
            <section class="ml-section ml-search-section">
                <div class="ml-section-header">
                    <h2 class="ml-section-subtitle">Партнёрам</h2>
                </div>
                <div class="ml-section-body">
                    <div class="row">
                        <div class="col-lg-10 col-xl-9">
                            <?
                            $res_count = 0;
                            $res_count_limit = 8;
                            foreach($arResult['PARTNERS_BLOCK'] as $search_item):
                                if($res_count > $res_count_limit){
                                    //break;
                                }
                                if($search_item['MODULE_ID'] == 'main'){
                                    $res_count++;
                                } else {
                                    continue;
                                }
                                ?>
                                <div class="text-item">
                                    <a class="text-item__link" href="<?=$search_item['URL'];?>" target="_blank">
                                        <p class="text-item__title">
                                            <?=$search_item['TITLE_FORMATED'];?>
                                        </p>
                                        <p class="text-item__desc">
                                            <?=$search_item['BODY_FORMATED'];?>
                                        </p>
                                    </a>
                                </div>
                            <?endforeach;?>

                        </div>
                    </div>
                </div>
            </section>
        <?endif;?>
<?endif;?>
<?endif;?>
<!--
<div class="search-page">
<form action="" method="get">
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
	<input type="text" name="q" value="<?=$arResult["REQUEST"]["QUERY"]?>" size="40" />
<?endif;?>
<?if($arParams["SHOW_WHERE"]):?>
	&nbsp;<select name="where">
	<option value=""><?=GetMessage("SEARCH_ALL")?></option>
	<?foreach($arResult["DROPDOWN"] as $key=>$value):?>
	<option value="<?=$key?>"<?if($arResult["REQUEST"]["WHERE"]==$key) echo " selected"?>><?=$value?></option>
	<?endforeach?>
	</select>
<?endif;?>
	&nbsp;<input type="submit" value="<?=GetMessage("SEARCH_GO")?>" />
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
</form><br />

<?if(isset($arResult["REQUEST"]["ORIGINAL_QUERY"])):
	?>
	<div class="search-language-guess">
		<?echo GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>'))?>
	</div><br /><?
endif;?>

<?if($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false):?>
<?elseif($arResult["ERROR_CODE"]!=0):?>
	<p><?=GetMessage("SEARCH_ERROR")?></p>
	<?ShowError($arResult["ERROR_TEXT"]);?>
	<p><?=GetMessage("SEARCH_CORRECT_AND_CONTINUE")?></p>
	<br /><br />
	<p><?=GetMessage("SEARCH_SINTAX")?><br /><b><?=GetMessage("SEARCH_LOGIC")?></b></p>
	<table border="0" cellpadding="5">
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_OPERATOR")?></td><td valign="top"><?=GetMessage("SEARCH_SYNONIM")?></td>
			<td><?=GetMessage("SEARCH_DESCRIPTION")?></td>
		</tr>
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_AND")?></td><td valign="top">and, &amp;, +</td>
			<td><?=GetMessage("SEARCH_AND_ALT")?></td>
		</tr>
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_OR")?></td><td valign="top">or, |</td>
			<td><?=GetMessage("SEARCH_OR_ALT")?></td>
		</tr>
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_NOT")?></td><td valign="top">not, ~</td>
			<td><?=GetMessage("SEARCH_NOT_ALT")?></td>
		</tr>
		<tr>
			<td align="center" valign="top">( )</td>
			<td valign="top">&nbsp;</td>
			<td><?=GetMessage("SEARCH_BRACKETS_ALT")?></td>
		</tr>
	</table>
<?elseif(count($arResult["SEARCH"])>0):?>
	<?if($arParams["DISPLAY_TOP_PAGER"] != "N") echo $arResult["NAV_STRING"]?>
	<br /><hr />
	<?foreach($arResult["SEARCH"] as $arItem):?>
		<a href="<?echo $arItem["URL"]?>"><?echo $arItem["TITLE_FORMATED"]?></a>
		<p><?echo $arItem["BODY_FORMATED"]?></p>
		<?if (
			$arParams["SHOW_RATING"] == "Y"
			&& $arItem["RATING_TYPE_ID"] <> ''
			&& $arItem["RATING_ENTITY_ID"] > 0
		):?>
			<div class="search-item-rate"><?
				$APPLICATION->IncludeComponent(
					"bitrix:rating.vote", $arParams["RATING_TYPE"],
					Array(
						"ENTITY_TYPE_ID" => $arItem["RATING_TYPE_ID"],
						"ENTITY_ID" => $arItem["RATING_ENTITY_ID"],
						"OWNER_ID" => $arItem["USER_ID"],
						"USER_VOTE" => $arItem["RATING_USER_VOTE_VALUE"],
						"USER_HAS_VOTED" => $arItem["RATING_USER_VOTE_VALUE"] == 0? 'N': 'Y',
						"TOTAL_VOTES" => $arItem["RATING_TOTAL_VOTES"],
						"TOTAL_POSITIVE_VOTES" => $arItem["RATING_TOTAL_POSITIVE_VOTES"],
						"TOTAL_NEGATIVE_VOTES" => $arItem["RATING_TOTAL_NEGATIVE_VOTES"],
						"TOTAL_VALUE" => $arItem["RATING_TOTAL_VALUE"],
						"PATH_TO_USER_PROFILE" => $arParams["~PATH_TO_USER_PROFILE"],
					),
					$component,
					array("HIDE_ICONS" => "Y")
				);?>
			</div>
		<?endif;?>
		<small><?=GetMessage("SEARCH_MODIFIED")?> <?=$arItem["DATE_CHANGE"]?></small><br /><?
		if($arItem["CHAIN_PATH"]):?>
			<small><?=GetMessage("SEARCH_PATH")?>&nbsp;<?=$arItem["CHAIN_PATH"]?></small><?
		endif;
		?><hr />
	<?endforeach;?>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"] != "N") echo $arResult["NAV_STRING"]?>
	<br />
	<p>
	<?if($arResult["REQUEST"]["HOW"]=="d"):?>
		<a href="<?=$arResult["URL"]?>&amp;how=r<?echo $arResult["REQUEST"]["FROM"]? '&amp;from='.$arResult["REQUEST"]["FROM"]: ''?><?echo $arResult["REQUEST"]["TO"]? '&amp;to='.$arResult["REQUEST"]["TO"]: ''?>"><?=GetMessage("SEARCH_SORT_BY_RANK")?></a>&nbsp;|&nbsp;<b><?=GetMessage("SEARCH_SORTED_BY_DATE")?></b>
	<?else:?>
		<b><?=GetMessage("SEARCH_SORTED_BY_RANK")?></b>&nbsp;|&nbsp;<a href="<?=$arResult["URL"]?>&amp;how=d<?echo $arResult["REQUEST"]["FROM"]? '&amp;from='.$arResult["REQUEST"]["FROM"]: ''?><?echo $arResult["REQUEST"]["TO"]? '&amp;to='.$arResult["REQUEST"]["TO"]: ''?>"><?=GetMessage("SEARCH_SORT_BY_DATE")?></a>
	<?endif;?>
	</p>
<?else:?>
	<?
    //ShowNote(GetMessage("SEARCH_NOTHING_TO_FOUND"));
    ?>
<?endif;?>
</div>
-->