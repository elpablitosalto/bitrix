<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
$GLOBALS['exclude'] = array();
function buildList($section){
			echo '<li><a href="'.$section["SECTION_PAGE_URL"].'">'.$section["NAME"].'</a>';
			//getElems($section["ID"]);
			if(!empty($section["CHILD"])){
				echo "<ul>";
					foreach($section["CHILD"] as $child_id => $arChild){
						buildList($arChild);
						
					}
				echo "</ul>";
			}
			if(!empty($section["ITEMS"])){
				echo "<ul>";
					foreach($section["ITEMS"] as $item_id => $arItem){
						
						if(in_array($item_id,$GLOBALS['exclude'])){
							continue;
						}
						else{
							$GLOBALS['exclude'][] = $item_id;
						}
						echo '<li><a href="'.$arItem["DETAIL_PAGE_URL"].'">'.$arItem["NAME"].'</a></li>';
					}
				echo "</ul>";
			}
			echo '</li>';
}
function getElems($sectId){
	$res = CIBlockElement::GetList(Array('left_margin' => 'ASC'), Array("IBLOCK_ID"=> 7, "SECTION_ID" => $sectId, "ACTIVE" => "Y", ), false, false, Array("NAME","DETAIL_PAGE_URL"));
	echo "<ul>";
	while ($arrElements = $res->GetNext())
	{

	   echo "<li><a href='".$arrElements["DETAIL_PAGE_URL"]."'>".$arrElements["NAME"]."</a></li>";
	}
	echo "</ul>";
}
?>

<ul class="sitemap_html">
	<li><a href="/">Главная</a></li>
	
	<? 
	asort($arResult["FOLDERS"]);
	/*echo "<pre>";
	print_r($arResult["FOLDERS"]);
	echo "</pre>";*/
	foreach($arResult["FOLDERS"] as $root => $arFolder){
            
		//echo $full_pathname.'<br />';
		$arFolder["count"] = count(explode('/', trim($arFolder["PATH"], '/'))); 
        $arrPrev = $arFolder;
        ?>
		
		
			<li><a href="<?=$arrPrev["PATH"];?>"><?=$arrPrev["NAME"];?></a>

			<?foreach($arResult["IBLOCKS"] as $ib_id => $arIblock){?>
			
			<?if($ib_id == 7 ){?>
				<?foreach($arIblock as $sect_id => $arSection){?>
				<?
				if (strpos($arSection["SECTION_PAGE_URL"],$arrPrev["PATH"])!==false && !preg_match("/\/shop_catalog\//", $arSection["SECTION_PAGE_URL"])){ ?>
					<?
						if($sect_id == 0){
							continue;
						}else{?>
							<ul>
							<?buildList($arSection);?>
							</ul>
						<?}
					?>
				<? }
				}?>
			<?}else{?>

		<?if(count($arIblock["ITEMS"]) > 0){?>
		
			<ul>
			<?foreach($arIblock["ITEMS"] as $arItem){?>
			<?
			
			/*if (!strpos($arItem["DETAIL_PAGE_URL"],'Slider') && strpos($arItem["DETAIL_PAGE_URL"],$arrPrev["PATH"])!==false){ */
			$arr = explode('/',$arItem["DETAIL_PAGE_URL"]);
			$beg = '/'.$arr[1].'/';
			if (!strpos($arItem["DETAIL_PAGE_URL"],'Slider') && $beg == $arrPrev["PATH"]){
				if($arItem["DETAIL_PAGE_URL"]=="/news/usilenie-konstruktsiy-mapei-planitop-hpc-floor-r/"){continue;}
			?>
				<li><a href="<? echo $arItem["DETAIL_PAGE_URL"];?>"><?=$arItem["NAME"];?> </a></li>
			<? } 
			}?>
			</ul>
		<?}elseif(count($arIblock) > 0){?>
			<ul>

			<?foreach($arIblock as $sect_id => $arSection){?>
			<?
			if (strpos($arSection["SECTION_PAGE_URL"],$arrPrev["PATH"])!==false){ ?>
				<?
					if($sect_id == 0){
						continue;
					}else{
						buildList($arSection);
					}
				?>
			<? } }?>		
			</ul>
		<?}?>
		<?}?>
		<?}?>

			<? if ($arrPrev["count"] < $arFolder["count"]) { 
				echo '<ul>';
			} elseif ($arrPrev["count"] > $arFolder["count"])	{
				echo '</li></ul></li>';
			} else {
				echo '</li>';
			}
		
		//$arrPrev = $arFolder;
	}?>	
	
	

	<?/*foreach($arResult["IBLOCKS"] as $ib_id => $arIblock):?>
	
		<?if(!empty($arIblock["ITEMS"])):?>
			<?foreach($arIblock["ITEMS"] as $arItem):?>
			<?if (!strpos($arItem["DETAIL_PAGE_URL"],'Slider')){ ?>
				<li><a href="<?=$arItem["DETAIL_PAGE_URL"];?>"><?=$arItem["NAME"];?></a></li>
			<? } endforeach;?>
		<?else:?>
		
			<?foreach($arIblock as $sect_id => $arSection):?>
				<?
					if($sect_id == 0){
						continue;
					}else{
						buildList($arSection);
					}
				?>
			<?endforeach;?>		
		<?endif;?>
	<?endforeach;*/?>
</ul>
