<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult["ITEMS"])) { ?>
    <ul class="base__list">
        <? foreach ($arResult["ITEMS"] as $item) {
            $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
            <li class="base__item base__item-video" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                <?
                //$item['VIDEO_URL'] = '/img/content/reagents/reagents.mp4';
                ?>
                <div class="base__video" data-link-video="<?= $item['VIDEO_URL']; ?>">
                    <img src="<?= $item['PICTURE']['SRC']; ?>" alt="<?= $item['PICTURE']['ALT']; ?>" title="<?= $item['PICTURE']['TITLE']; ?>" />
                    <svg width="20" height="25">
                        <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons/sprite/svg-sprite.svg#play"></use>
                    </svg>
                </div><?= $item['NAME']; ?><? if (!empty($item['EXT'])) { ?> <span>(<?= $item['EXT']; ?>)</span><? } ?>
            </li>
        <? } ?>
    </ul>

    <?/*?>
    <?
    // --> 
    if ($arParams['POPUP_BUFFER'] == 'Y') {
        $this->SetViewTarget('ADD_PAGE_CONTENT');
    }
    ?>
    <div class="popup popup__video">
        <div class="local-video">
            <video preload="metadata" controls autoplay>
                <source src="/img/content/reagents/reagents.mp4" type="video/mp4">
            </video>
        </div>
        <div class="youtube-video">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/ik-k6Nr6-iI?si=if7QKFjUh6EqLggL" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
        <button class="popup_close" type="button"></button>
    </div>
    <?
    if ($arParams['POPUP_BUFFER'] == 'Y') {
        $this->EndViewTarget();
    }
    // <-- 
    ?>
    <?*/?>
<? } ?>