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

// id блока cо слайдшоу -->
if ($arParams["WINNERS"] == "Y") {
    $slideshowBlockId = $GLOBALS["arSiteConfig"]["arModalsParams"]["contest_works_winner_slides_modal_id"];
    if (strlen($slideshowBlockId) <= 0) {
        $slideshowBlockId = "modal-work-winner";
    }
    $tile_id_prefix = "work_tile_winners";
} else {
    $slideshowBlockId = $GLOBALS["arSiteConfig"]["arModalsParams"]["contest_works_slides_modal_id"];
    if (strlen($slideshowBlockId) <= 0) {
        $slideshowBlockId = "modal-work";
    }
    $tile_id_prefix = "work_tile";
}
// <-- id блока cо слайдшоу 

// Картинка -->
$PICTURE_PATH = $item['PREVIEW_PICTURE']['SRC'];
$PHOTO_WITH_PRIZE_ID = $item['PROPERTIES']['PHOTO_WITH_PRIZE']['VALUE'];
if (intval($PHOTO_WITH_PRIZE_ID) > 0) {
    $PICTURE_PATH = CFile::GetPath($PHOTO_WITH_PRIZE_ID);
}
// <-- Картинка

//echo "item:";echo "<pre>";print_r($item);echo "</pre>";
?>
<div class="anim-item__link">
    <div id="<?= $tile_id_prefix; ?>_<?= $item['ID']; ?>" class="anim-item__img"
        data-elid="<?= $item['ID']; ?>" data-contestworks="Y" data-modal="#<?= $slideshowBlockId; ?>">
        <img src="<?= $PICTURE_PATH ?>" alt="<?= $imgAlt ?>" title="<?= $imgTitle ?>">
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
        <span class="anim-item__votes">
            Голосов:
            <span class="votes" id="votes_<?= $item['ID']; ?>"><?= ($item['PROPERTIES']['SUM_VOTED']['VALUE']) ? $item['PROPERTIES']['SUM_VOTED']['VALUE'] : 0; ?></span>
        </span>

        <?
        global $USER;
        if (!$USER->GetID()) {
            $userId = $_COOKIE['BX_USER_ID'];
        } else {
            $userId = $USER->GetID();
        }

        /* Кнопка Нравится --> */
        if ($userId != $item['PROPERTIES']['USER_ID']['VALUE']) {
            $ar_params = [
                'TYPE_VOTE' => $arParams['TYPE_VOTE'],
                'USER_ID' => $USER->GetID(),
                'CONTEST_ID' => $arParams['CONTEST_ID'],
                'PARTICIPANTS_ID' => $item['ID'],
                'IBLOCK_ID' => Indexis::getIblockId('participants'),
            ];
		?>
		<div class="anim-item__action">
		<?
            //vardump($ar_params);
            $APPLICATION->IncludeComponent(
                'indexis:votes.contest',
                'contest',
                $ar_params
            );
		?>
		</div>
		<?
        }
        /* <-- Кнопка Нравится */
        ?>

    </div>
</div>
<?
/*
?>
<a class="anim-item__link" href="#" data-elid="<?= $item['ID']; ?>" data-contestworks="Y"
id="work_tile_<?= $item['ID']; ?>">
<div class="anim-item__img">
<img src="<?= $PICTURE_PATH ?>" alt="<?= $imgAlt ?>" title="<?= $imgTitle ?>">
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
<span class="anim-item__votes">
Голосов:
<?= ($item['PROPERTIES']['SUM_VOTED']['VALUE']) ? $item['PROPERTIES']['SUM_VOTED']['VALUE'] : 0; ?>
</span>
<?
global $USER;
if (!$USER->GetID()) {
$userId = $_COOKIE['BX_USER_ID'];
} else {
$userId = $USER->GetID();
}
$APPLICATION->IncludeComponent(
'indexis:votes.contest',
'contest',
[
'TYPE_VOTE' => $arParams['TYPE_VOTE'],
'USER_ID' => $USER->GetID(),
'CONTEST_ID' => $arParams['CONTEST_ID'],
'PARTICIPANTS_ID' => $item['ID'],
'IBLOCK_ID' => Indexis::getIblockId('participants'),
]
);
?>
</div>
</a>
<?
*/
?>