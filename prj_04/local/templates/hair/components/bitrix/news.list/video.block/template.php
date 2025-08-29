<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Hair\General;

?>
<div class="container">
	<section class="content-text _full-width">
		<h2>Видео-материалы</h2>
		<div class="videos-container _flex-start mb-50">
			<?foreach($arResult['ITEMS'] as $video):?>
				<a class="videos-container__item" data-youtube="" href="<?=$video['PROPERTIES']['VIDEO_LINK']['VALUE']?>">
					<div class="videos-container__illustration">
						<img src="<?=\CFile::GetPath($video['PROPERTIES']['VIDEO_PREVIEW']['VALUE'])?>" alt role="presentation" class="videos-container__image">
					</div>
				</a>
			<?endforeach;?>
		</div>
	</section>
</div>