<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<div class="nb-footer-menu">
		<ul class="nb-footer-menu__list<?=(($arParams["ADDITIONAL_CLASS"]) ? ' '.$arParams["ADDITIONAL_CLASS"] : '')?>">
			<?foreach($arResult as $arItem):
				if($arParams["MAX_LEVEL"] != $arItem["DEPTH_LEVEL"])
					continue;
				?>
				<li class="nb-footer-menu__item">
					<a 
						class="nb-footer-menu__link" 
						href="<?=$arItem["LINK"]?>"
						<?if($arItem["LINK"] === "https://hh.ru/employer/10057678"):?>
							rel="nofollow"
						<?endif;?>
					><?=$arItem['TEXT']?></a>
				</li>
			<?endforeach;?>
		</ul>
	</div>
<?endif?>