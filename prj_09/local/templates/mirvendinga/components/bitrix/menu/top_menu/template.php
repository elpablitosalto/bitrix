<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode( true );
$closeParent = null;
?>
<?if(!empty($arResult)): ?>
	<!-- begin .nav-->
	<nav class="nav nav_type_primary">
		<ul class="nav__list">
			<?foreach($arResult as $key => $arItem):?>
				<?if($arItem['DEPTH_LEVEL'] === 1 && empty($arItem['IS_PARENT'])):?>
					<?if($key > 0 && !empty($closeParent)){
						$closeParent = null;
					?>
						</ul></div></li>
					<?}?>
					<li class="nav__item">
						<a href="<?=$arItem['LINK']?>" class="nav__link<?if(!empty($arItem['SELECTED'])):?> nav__link_state_active<?endif;?>"><?=$arItem['TEXT']?></a>
					</li>
				<?endif;?>

				<?if($arItem['DEPTH_LEVEL'] === 1 && !empty($arItem['IS_PARENT'])):?>
					<li class="nav__item">
						<a href="<?=$arItem['LINK']?>" class="nav__link<?if(!empty($arItem['SELECTED'])):?> nav__link_state_active<?endif;?>"><?=$arItem['TEXT']?></a>

						<nav class="nav__submenu">
							<ul class="nav__sub-list">
				<?endif;?>

				<?if($arItem['DEPTH_LEVEL'] === 2){
					$closeParent = 1;
				?>
					<li class="nav__sub-item">
						<a href="<?=$arItem['LINK']?>" class="nav__link<?if(!empty($arItem['SELECTED'])):?> nav__link_state_active<?endif;?>"><?=$arItem['TEXT']?></a>
					</li>
				<?}?>
			<?endforeach;?>
		</ul>
	</nav>
	<!-- end .nav-->
<?endif;?>