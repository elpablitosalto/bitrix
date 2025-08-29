<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var string $discountPositionClass
 * @var string $labelPositionClass
 * @var CatalogSectionComponent $component
 */
?>
<div class="anim-item anim-item_article">
    <a class="anim-item__link" href="<?=$item['DETAIL_PAGE_URL']?>">
        <div class="anim-item__img">
            <img class="lazyload" data-src="<?=$item['PREVIEW_PICTURE']['SRC']?>" src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="<?=$imgAlt?>" title="<?=$imgTitle?>">
            <?
            if ($item['LABEL'])
            {
                if (!empty($item['LABEL_ARRAY_VALUE']))
                {
                    foreach ($item['LABEL_ARRAY_VALUE'] as $code => $value)
                    {
                        ?>
                        <span class="age-limit-label age-limit-label_light"><?=$value?></span>
                        <?
                    }
                }
            }
            ?>
        </div>
        <div class="anim-item__caption">
            <p class="anim-item__title"><?=$productTitle?></p>
            <time class="anim-item__date" datetime="<? echo FormatDate("Y-m-d", MakeTimeStamp($item["ACTIVE_FROM"])); ?>"><? echo FormatDate("j F Y", MakeTimeStamp($item["ACTIVE_FROM"])); ?></time>
        </div>
    </a>
</div>