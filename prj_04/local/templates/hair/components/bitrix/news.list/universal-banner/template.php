<?
use Hair\General;
?>
<?foreach($arResult['ITEMS'] as $arItem):?>
	<section class="full-page-banner">
		<?if(!empty($arItem['PROPERTIES']['VIDEO_FILE']['VALUE'])):?>
			<?$arFile = CFIle::GetFileArray($arItem['PROPERTIES']['VIDEO_FILE']['VALUE']);?>
			<video muted autoplay width="100%" height="100%">
				<source src="<?=$arFile['SRC']?>" type="<?=$arFile['CONTENT_TYPE']?>">
			</video>
		<?elseif(!empty($arItem['PROPERTIES']['VIDEO_URL']['VALUE'])):?>
			<?
				$url = General::ParseShortYouTubeLink($arItem['PROPERTIES']['VIDEO_URL']['VALUE']);
				$duration = General::GetYouTubeVideoDuration($url);
			?>
			<iframe width="100%" height="100%" src="<?=$url.'?mute=1&showinfo=0&controls=0'?>" data-duration="<?=$duration?>" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		<?else:?>
			<?
				if (!empty($arItem['PROPERTIES']['DESKTOP_IMAGE']['VALUE'])) {
					$bannerDesktop = CFile::ResizeImageGet($arItem['PROPERTIES']['DESKTOP_IMAGE']['VALUE'], array('width'=>1920, 'height'=>600), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				} else {
					$bannerDesktop = false;
				}
				if (!empty($arItem['PROPERTIES']['TABLET_IMAGE']['VALUE'])) {
					$bannerTablet = CFile::ResizeImageGet($arItem['PROPERTIES']['TABLET_IMAGE']['VALUE'], array('width'=>992, 'height'=>310), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				} else {
					$bannerTablet = false;
				}
				if (!empty($arItem['PROPERTIES']['MOBILE_IMAGE']['VALUE'])) {
					$bannerMobile = CFile::ResizeImageGet($arItem['PROPERTIES']['MOBILE_IMAGE']['VALUE'], array('width'=>640, 'height'=>360), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				} else {
					$bannerMobile = false;
				}

				if (!$bannerDesktop) {
					if (!$bannerMobile) {
						continue;
					} elseif (!$bannerTablet) {
						$bannerTablet = $bannerMobile;
					}
					$bannerDesktop = $bannerMobile;
				} else {
					if (!$bannerMobile) {
						$bannerMobile = $bannerDesktop;
					}
					if (!$bannerTablet) {
						$bannerTablet = $bannerDesktop;
					}
				}
			?>
			<img class="show-desktop" src="<?=$bannerDesktop['src']?>">
			<img class="middle-show" src="<?=$bannerTablet['src']?>">
			<img class="show-mobile" src="<?=$bannerMobile['src']?>">
		<?endif;?>
	</section>
<?endforeach;?>