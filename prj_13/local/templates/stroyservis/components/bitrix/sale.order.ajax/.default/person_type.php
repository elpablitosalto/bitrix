<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$isActiveBlock = in_array('person_type', $arOrderBlocks);
?>
<div class="order__section">
	<h2 class="order__section-title<?if ($isActiveBlock):?> order__section_open<?endif;?>">Тип Плательщика</h2>
	<input class="order__block-toggle" type="checkbox" name="order_blocks[]" value="person_type"<?if ($isActiveBlock):?> checked<?endif;?>>
	<div class="order__body"<?if (!$isActiveBlock):?> style="display: none;"<?endif;?>>
		<?
		if(count($arResult["PERSON_TYPE"]) > 1)
		{
			?>
			<ul class="order__type">
				<?foreach($arResult["PERSON_TYPE"] as $v):?>
					<li>
						<input class="visually-hidden" type="radio" id="PERSON_TYPE_<?=$v["ID"]?>" name="PERSON_TYPE" value="<?=$v["ID"]?>"<?if ($v["CHECKED"]=="Y") echo " checked=\"checked\"";?> onClick="submitForm()">
						<label class="order__type-entity" for="PERSON_TYPE_<?=$v["ID"]?>">
							<svg width="22" height="22">
								<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons/sprite/svg-sprite.svg#<?=$v['CODE']?>"></use>
							</svg><?=$v["NAME"]?>
						</label>
					</li>
				<?endforeach;?>
			</ul>
			<input type="hidden" name="PERSON_TYPE_OLD" value="<?=$arResult["USER_VALS"]["PERSON_TYPE_ID"]?>" />
			<?
		}
		else
		{
			if(IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"]) > 0)
			{
				//for IE 8, problems with input hidden after ajax
				?>
				<span style="display:none;">
				<input type="text" name="PERSON_TYPE" value="<?=IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"])?>" />
				<input type="text" name="PERSON_TYPE_OLD" value="<?=IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"])?>" />
			</span>
				<?
			}
			else
			{
				foreach($arResult["PERSON_TYPE"] as $v)
				{
					?>
					<input type="hidden" id="PERSON_TYPE" name="PERSON_TYPE" value="<?=$v["ID"]?>" />
					<input type="hidden" name="PERSON_TYPE_OLD" value="<?=$v["ID"]?>" />
					<?
				}
			}
		}
		?>
		<?if (isset($arResult['ORDER_PROP_GROUPED']['Данные для доставки'])):?>
			<?foreach($arResult['ORDER_PROP_GROUPED']['Данные для доставки'] as $arProperties): ?>
				<?if ($arProperties['TYPE'] == 'LOCATION'):?>
					<p class="order__mb">Местоположение</p>
					<label class="visually-hidden"><?=$arProperties['NAME']?></label>
				<?endif;?>
				<?PrintSinglePropForm($arProperties, $arParams["TEMPLATE_LOCATION"])?>
				<?if ($arProperties['TYPE'] == 'LOCATION'):?>
					<p>Выберите свой город в списке. Если вы не нашли свой город, выберите «другое местоположение», а город впишите в поле «Город»</p>
				<?endif;?>
			<?endforeach;?>
		<?endif;?>
	</div>
</div>