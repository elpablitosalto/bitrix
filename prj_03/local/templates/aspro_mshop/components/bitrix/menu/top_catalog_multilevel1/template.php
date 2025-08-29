<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)die();
$this->setFrameMode(true);
$maxRootItems = 30;
$bMoreThanMax = count($arResult) > $maxRootItems ;
?>
<?if($arResult):?>
	<ul class="menu bottom">
		<?foreach($arResult as $key => $arItem):?>
			<?if($key < $maxRootItems):?>
				<li class="menu_item_l1 <?=(!$key ? ' first' : '')?><?=($arItem["SELECTED"] ? ' current' : '')?><?=($arItem["PARAMS"]["ACTIVE"]=="Y" ? ' active' : '')?>">
					<a class="<?=($arItem["SELECTED"] ? ' current' : '')?>" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
					<?if($arItem["IS_PARENT"]):?>
						<div class="child submenu">
							<div class="child_wrapp">
								<?foreach($arItem["CHILD"] as $i => $arSubItem):?>
									<?if(count($arSubItem["CHILD"])):?>
										<div class="depth3<?=($i > 4 ? ' d' : '')?>">
											<a class="title<?=($arSubItem["SELECTED"] ? ' current' : '')?>" href="<?=$arSubItem["LINK"]?>"><?=$arSubItem["TEXT"]?></a>
											<?if($arSubItem["CHILD"] && is_array($arSubItem["CHILD"])):?>
												<?foreach($arSubItem["CHILD"] as $ii => $arSubItem3):?>
													<a class="<?=($arSubItem3["SELECTED"] ? ' current' : '')?>" href="<?=$arSubItem3["LINK"]?>"><?=$arSubItem3["TEXT"]?></a>
												<?endforeach;?>
											<?endif;?>
										</div>
									<?else:?>
										<a class="<?=($arSubItem["SELECTED"] ? ' current' : '')?><?=($i > 4 ? ' d' : '')?>" href="<?=$arSubItem["LINK"]?>"><?=$arSubItem["TEXT"]?></a>
									<?endif;?>
								<?endforeach;?>

							</div>
						</div>
					<?endif;?>
				</li>
			<?endif;?>
		<?endforeach;?>
		<li class="stretch"></li>
	</ul>

<?endif;?>