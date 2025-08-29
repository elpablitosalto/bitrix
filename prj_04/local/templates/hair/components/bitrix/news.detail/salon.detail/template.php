
<section class="content">
    <div class="container _inside-page">
        <div class="breadcrumbs">
            <ul class="breadcrumbs-list">
                <li class="breadcrumbs-list__item"><a href="/">Главная</a></li>
                <li class="breadcrumbs-list__item"><a href="/find-salon/map/">Найти салон</a></li>
                <li class="breadcrumbs-list__item"><?=$arResult['NAME']?></li>
            </ul>
        </div>
        <section class="content-text">
            <div class="salon-info">   
                <?$logo = CFile::ResizeImageGet($arResult['PROPERTIES']['LOGO']['VALUE'], array('width'=>82, 'height'=>9999), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>             
                <img src="<?=$logo['src']?>">
                <div class="salon-info__text">
                    <p><?=$arResult['NAME']?></p>
                    <a href="#" class="location-link"><?=$arResult['PROPERTIES']['ADDRESS']['VALUE']?></a>
                </div>
            </div>
            <div class="salon-photos">
                <?foreach($arResult['PROPERTIES']['PHOTOS']['VALUE'] as $photo):?>
                    <?
                        $preview = CFile::ResizeImageGet($photo, array('width'=>285, 'height'=>285), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                        $full = CFile::GetPath($photo);
                    ?>
                    <a data-image-popup href="<?=$full?>"><img src="<?=$preview['src']?>" alt="" title=""></a>
                <?endforeach;?>
            </div>
        </section>
    </div>   
</section>