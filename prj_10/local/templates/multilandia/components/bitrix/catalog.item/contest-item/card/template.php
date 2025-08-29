<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

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
<?
// Данные конкурса -->
$ar_item["arContest"] = array(
    "DATE_START" => $item['PROPERTIES']['DATE_START']['VALUE'],
    "DATE_END" => $item['PROPERTIES']['DATE_END']['VALUE'],
);
// <--

// Дата окончания конкурса для счётчика -->
if (strlen($ar_item["arContest"]["DATE_END"]) > 0) {
    $ar_item["arContest"]["DATE_END_COUNT"] = date("c", strtotime($ar_item["arContest"]["DATE_END"]));
}
// <--
?>
<a class="anim-item__link" href="<?= $item['DETAIL_PAGE_URL'] ?>">
    <div class="anim-item__img">
        <img src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $imgAlt ?>" title="<?= $imgTitle ?>">
        <?
        if ($item['LABEL']) {
            if (!empty($item['LABEL_ARRAY_VALUE'])) {
                foreach ($item['LABEL_ARRAY_VALUE'] as $code => $value) {
                    ?>
                    <span class="age-limit-label age-limit-label_light">
                        <?= $value ?>
                    </span>
                <?
                }
            }
        }
        ?>
    </div>
    <div class="anim-item__caption">
        <p class="anim-item__title">
            <?= $productTitle ?>
        </p>
		<? if (mb_strlen($item['PREVIEW_TEXT']) > 0): ?>
            <div class="anim-item__desc">
                <?= $item['PREVIEW_TEXT'] ?>
            </div>
        <? endif; ?>
        <? if ($isActiveContest): ?>
            <?
            if( strlen( $ar_item["arContest"]["DATE_END_COUNT"] ) )
            {
                ?>
                <div class="ml-timer" data-end="<? echo $ar_item["arContest"]["DATE_END_COUNT"]; ?>"></div>
                <?
            }
            ?>
        <? else: ?>
			<div class="anim-item__action">
				<span class="anim-item__dates">Завершен</span>
			</div>
            <span class="anim-item__votes">Голосов:
                <?= (isset($arParams['VOTED_COUNT'][$item['ID']])) ? $arParams['VOTED_COUNT'][$item['ID']] : 0; ?>
            </span>
        <? endif; ?>
    </div>
</a>