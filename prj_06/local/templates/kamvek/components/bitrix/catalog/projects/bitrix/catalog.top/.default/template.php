<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogTopComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);

if (!empty($arResult['ITEMS'])) { ?>

    <div class="bgGrau wideGallery">
        <div class=" responsiveBlock">
            <div id="BigBlocks" class="bigBlocks">
                <?foreach ($arResult['ITEMS'] as $item) :?>
                    <a class="bigBlock bigBlockM " href="<?=$item["DETAIL_PAGE_URL"];?>">
                        <img class="bbimg" loading="lazy" data-size="M"
                             src="<?=$item["PREVIEW_PICTURE"]["SRC"];?>
                             sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw"
                             style="object-position:50% 50%;"
                             width="570" height="255" alt="<?=$item["NAME"];?>" title="<?=$item["NAME"];?>"/>
                        <div class="content">
                            <div class="title "><?=$item["NAME"];?></div>
                            <div class="text d"><?=$item["PREVIEW_TEXT"];?></div>
                            <?/*?>
                            <p class="text d"><?=$item["PREVIEW_TEXT"];?></p>
                            <?*/?>
                        </div>
                    </a>
                <?endforeach;?>
            </div>
            <?/*<div class="loadMore"> Mehr laden</div>*/?>
        </div>
    </div>
<? } ?>