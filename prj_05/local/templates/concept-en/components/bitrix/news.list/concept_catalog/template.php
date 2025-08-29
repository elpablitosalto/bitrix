<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Hair\General;
?>
<? if (!empty($arResult['ITEMS'])) { ?>
    <div class="catalog__entry-grid">
        <!-- begin .entry-grid-->
        <div class="entry-grid js-entry-grid">
            <div class="entry-grid__main" data-ajax-container>
                <ul class="entry-grid__list js_nav_result_<?= $arResult['NAV_RESULT']->NavNum ?>">
                    <?
                    //vardump($GLOBALS[$arParams["FILTER_NAME"]]);
                    /*
                    if (isset($_REQUEST['AJAX_CALL']) && $_REQUEST['AJAX_CALL'] == 'Y') {
                        $APPLICATION->RestartBuffer();
                    } 
                    */
                    ?>
                    <? foreach ($arResult['ITEMS'] as $k => $arItem) { ?>
                        <?
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <li class="entry-grid__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                            <!-- begin .entry-snippet-->
                            <div class="entry-snippet entry-grid__snippet">
                                <a class="entry-snippet__illustration" href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                                    <picture class="entry-snippet__picture">
                                        <img src="<?= $arItem['LIST_PICTURE']['SRC']; ?>" alt="<?= $arItem['LIST_PICTURE']["ALT"] ?>" title="<?= $arItem['LIST_PICTURE']["TITLE"] ?>" class="entry-snippet__image" />
                                    </picture>
                                </a>
                                <div class="entry-snippet__content">
                                    <div class="entry-snippet__title">
                                        <?= $arItem['NAME'] ?>
                                    </div>
                                    <?/*?>
                                    <div class="entry-snippet__text">
                                    <?= $arItem['PREVIEW_TEXT'] ?>
                                    </div>
                                    <?*/ ?>
                                </div>
                            </div>
                            <!-- end .entry-snippet-->
                        </li>
                    <? } ?>
                </ul>
                <?
                $navNum = $arResult['NAV_RESULT']->NavNum;
                ?>
                <div class="js_nav_string <?= "js_nav_string_" . $navNum; ?>">
                    <?
                    echo $arResult["NAV_STRING"];
                    ?>
                </div>
            </div>
        </div>
        <!-- end .entry-grid-->
    </div>
<? } ?>