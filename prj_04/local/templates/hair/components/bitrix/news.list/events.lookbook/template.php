<?//d($arResult)?>
<?foreach($arResult['ITEMS'] as $arItem):?>
    <?$pic = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>500, 'height'=>288), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
    <div class="container _column _inside-page">
        <h2 class="_text-left">Обучающие мероприятия</h2>
        <section class="content-text">
            <p>У вас есть возможность посетить семинар по продукции CONCEPT, использованной для создания этого образа. Семинар проведет <?=$arItem['LEADER']['POSITION']?> CONCEPT <?=$arItem['LEADER']['NAME']?></p>
        </section>
    </div>
    <div class="container">
        <div class="events-wrapper">
            <div class="event-item">
                <div class="col-lg-5 event-item__image">
                    <div class="event-item__image-container">
                        <img src="<?= $pic['src'] ?>" alt role="presentation" class="event-item__img">
                        <div class="event-item__image-date show-mobile">
                            <p class="event-item__description-name"><?=$arItem['LEADER']['NAME']?></p>
                            <p><?=$arItem['LEADER']['POSITION']?></p>
                            <p><?=$arItem['LEADER']['LOCATION']?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 event-item__description">
                    <div class="show-desktop">
                        <p class="event-item__description-name"><?=$arItem['LEADER']['NAME']?></p>
                        <p><?=$arItem['LEADER']['POSITION']?></p>
                        <p><?=$arItem['LEADER']['LOCATION']?></p>
                    </div>
                    <div class="event-item__description-text">
                        <?=$arItem['PREVIEW_TEXT']?>
                    </div>
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="button _small">Подробнее</a>
                </div>
            </div>
        </div>
    </div>
<?endforeach;?>