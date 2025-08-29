<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
//vardump($arResult["DISPLAY_PROPERTIES"]);
?>

<?$this->SetViewTarget('news_title');?>
<div class="rs__label--container">
    <div class="rs__news--detail-label">
        <div class="rs__news--detail-date"><?=$arResult["DISPLAY_PROPERTIES"]["PUBLIC_DATE"]["DISPLAY_VALUE"]?></div>
        <div class="rs__link rs__news--detail-category"><?=($arResult["IBLOCK_ID"] == Indexis::getIblockId("news", "content", "s1"))?"Новость":"Материал";?></div>
        <?if(!empty($arResult["DISPLAY_PROPERTIES"]["AUDIENCE_TYPE"]["DISPLAY_VALUE"])){?>
        <div class="rs__label--box">
            <?foreach($arResult["DISPLAY_PROPERTIES"]["AUDIENCE_TYPE"]["DISPLAY_VALUE"] as $val){?>
            <a class="rs__label--item" href=""><?=$val?></a>
            <?}?>
        </div>
        <?}?>
    </div>
</div>
<?$this->EndViewTarget();?>

<section class="wrapper rs__news--detail-body">
    <div class="container">
        <div class="rs__content">
            <div class="rs__news--detail-info">
                <div class="rs__news--detail-banner">
                    <picture><img class="rs__news--detail-banner--img" src="<?= $arResult["DETAIL_PICTURE"]["SRC"]; ?>" alt="<?= $arResult["DETAIL_PICTURE"]["ALT"]; ?>" title="<?= $arResult["DETAIL_PICTURE"]["TITLE"]; ?>" />
                    </picture>
                </div>
                <div class="rs__news--detail-block">
                    <? if (strlen($arResult["PREVIEW_TEXT"]) > 0) { ?>
                        <div class="rs__news--detail-title rs__news--detail-title--first"><?= htmlspecialchars_decode($arResult["PREVIEW_TEXT"]); ?></div>
                    <? } ?>
                    <? if (strlen($arResult["DETAIL_TEXT"]) > 0) { ?>
                        <div class="rs__news--detail-text">
                            <?= htmlspecialchars_decode($arResult["DETAIL_TEXT"]); ?>
                        </div>
                    <? } ?>
                </div>
                <? if (intval($arResult["DISPLAY_PROPERTIES"]["CONSTRUCTOR"]["VALUE"]) > 0) { ?>
                    <? $APPLICATION->IncludeComponent(
                        "indexis:page.constructor",
                        "path",
                        array(
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "SECTION_ID" => $arResult["DISPLAY_PROPERTIES"]["CONSTRUCTOR"]["VALUE"]
                        )
                    ); ?>
                <? } ?>

            </div>
        </div>
    </div>
</section>
