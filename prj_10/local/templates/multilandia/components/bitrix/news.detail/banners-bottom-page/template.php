<?php if(!empty($arResult)) : ?>
    <section class="ml-section ml-banner-section <?=$arParams['ADDITIONAL_CLASS'];?>">
        <div class="container">
            <a class="ml-banner" href="<?=$arResult['PROPERTIES']['LINK']['VALUE']?>">
                <picture class="ml-banner__img">
                    <source media="(max-width: 480px)" srcset="<?=CFile::GetPath($arResult['PROPERTIES']['BANNER_SMARTPHONE']['VALUE'])?>">
                    <source media="(max-width: 991px)" srcset="<?=CFile::GetPath($arResult['PROPERTIES']['BANNER_TABLET']['VALUE'])?>">
                    <img src="<?=CFile::GetPath($arResult['PROPERTIES']['BANNER_DESKTOP']['VALUE'])?>" alt="">
                </picture>
				<?if($arResult['PROPERTIES']['BANNER_TITLE']['VALUE'] || $arResult['PROPERTIES']['BANNER_DESC']['VALUE'] || $arResult['PROPERTIES']['BANNER_BTN']['VALUE']):?>
				<div class="ml-banner__caption">
					<div class="ml-banner__caption-inner">
						<?if($arResult['PROPERTIES']['BANNER_TITLE']['VALUE']):?>
						<p class="ml-banner__title"><span><?=$arResult['PROPERTIES']['BANNER_TITLE']['VALUE']?></span></p>
						<?endif;?>
						<?if($arResult['PROPERTIES']['BANNER_DESC']['VALUE']):?>
						<p class="ml-banner__desc"><span><?=$arResult['PROPERTIES']['BANNER_DESC']['VALUE']?></span></p>
						<?endif;?>
						<?if($arResult['PROPERTIES']['BANNER_BTN']['VALUE']):?>
						<span class="ml-banner__link"><?=$arResult['PROPERTIES']['BANNER_BTN']['VALUE']?></span>
						<?endif;?>
					</div>
				</div>
				<?endif;?>
            </a>
        </div>
    </section>
<?php endif; ?>