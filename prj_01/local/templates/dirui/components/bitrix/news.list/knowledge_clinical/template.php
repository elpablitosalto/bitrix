<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<?
//echo 'count = '.count($arResult["ITEMS"]).'<br />';
?>

<? if (!empty($arResult["ITEMS"])) { ?>

    <ul class="recommendation__list js_nav_result_<?= $arResult['NAV_RESULT']->NavNum ?>">
        <?
        $i = 1;
        ?>
        <? foreach ($arResult["ITEMS"] as $item) {
            $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
            <li class="recommendation__item" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                <a class="recommendation__link" href="<?= $item['FILE']['SRC'] ?>" target="_blank" download>
                    <div class="recommendation__title"><?/*=$i;*/ ?><?= $item['FILE']['NAME'] ?></div>
                    <div class="recommendation__date"><?= $item['FILE']['DATE'] ?></div>
                    <div class="recommendation__file"><?= $item['FILE']['TYPE_FORMAT'] ?>, <?= $item['FILE']['SIZE_FORMAT'] ?></div>
                    <div class="recommendation__download">
                        <svg width="16" height="16">
                            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#downward"></use>
                        </svg>
                    </div>
                </a>
            </li>
            <?
            $i++;
            ?>
        <? } ?>
    </ul>
    <? if ($arParams['DISPLAY_BOTTOM_PAGER'] == 'Y') { ?>
        <div class="<?= "js_nav_string_" . $arResult['NAV_RESULT']->NavNum; ?>">
            <? echo $arResult["NAV_STRING"]; ?>
        </div>
    <? } ?>
<? } ?>