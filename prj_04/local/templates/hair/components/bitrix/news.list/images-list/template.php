<?$arItem = $arResult['ITEMS'][0]?>
<section class="images-list">
    <?foreach($arItem['PROPERTIES']['PHOTOS']['VALUE'] as $photo):?>
        <?
            $fullPic = CFIle::GetPath($photo);
            $pic = CFile::ResizeImageGet($photo, array('width'=>$arParams['PICTURE_WIDTH'], 'height'=>$arParams['PICTURE_HEIGHT']), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        ?>
        <a data-image-popup href="<?=$fullPic?>"><img src="<?=$pic['src']?>"></a>
    <?endforeach;?>
</section>