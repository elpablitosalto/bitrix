<?
if (!defined('FIRST_CONTENT_PAGE_TYPE')) {
    define('FIRST_CONTENT_PAGE_TYPE', 1);
}
//echo '!!';
?>
<? if (FIRST_CONTENT_PAGE_TYPE == 1) { ?>
    <div id="FirstContent">
        <div class="content centerMargin">
            <h2><?= $GLOBALS['PAGE_H2']; ?></h2>
            <h1><?= $GLOBALS['PAGE_H1']; ?></h1>
            <?
            // Дата -->
            if ($arParams['DISPLAY_DATE'] == 'Y') {
            ?>
                <div class="artikelMeta">
                    <span class="datum"><? echo !empty($arResult["DISPLAY_ACTIVE_FROM"]) ? $arResult["DISPLAY_ACTIVE_FROM"] : FormatDate("j F Y", MakeTimeStamp($arResult['DATE_CREATE'])); ?></span>
                </div>
            <?
            }
            // <-- Дата
            ?>
            <div class="page-opener-description">
                <?= $GLOBALS['PAGE_DESCRIPTION']; ?>
                <? if (!empty($GLOBALS['RED_BLOCK'])) { ?>
                    <div class="red-bottom-card">
                        <div style="margin: 2em auto; background-color: #b70c1d; width: 570px; max-width: 100%; height: 255px;">
                            <?= $GLOBALS['RED_BLOCK']; ?>
                        </div>
                    </div>
                <? } ?>
            </div>
        </div>
    </div>
<? } else if (FIRST_CONTENT_PAGE_TYPE == 2) { ?>
    <section id="Content" class="ccb">
        <div class="contentBlock flexBlock ">
            <div class="">
                <h2><?= $GLOBALS['PAGE_H2']; ?></h2>
                <h1><?= $GLOBALS['PAGE_H1']; ?></h1>
                <div class="page-opener-description">
                    <?= $GLOBALS['PAGE_DESCRIPTION']; ?>
                    <? if (!empty($GLOBALS['RED_BLOCK'])) { ?>
                        <div class="red-bottom-card">
                            <div style="margin: 2em auto; background-color: #b70c1d; width: 570px; max-width: 100%; height: 255px;">
                                <?= $GLOBALS['RED_BLOCK']; ?>
                            </div>
                        </div>
                    <? } ?>
                </div>
            </div>
        </div>
    </section>
<? } ?>