<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<?
//echo 'count = '.count($arResult["ITEMS"]).'<br />';
?>

<? if (!empty($arResult["ITEMS"])) { ?>
    <div class="lk__section">
        <h4 id="lkmodel">Сравнения моделей</h4>
        <ul class="comparison__list">
            <? foreach ($arResult["ITEMS"] as $item) {
                $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
                <li class="comparison__item" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                    <a class="comparison__link" href="<?= $item['FILE']['SRC'] ?>" download>
                        <div class="recommendation__title"><?= $item['FILE']['NAME'] ?></div>
                        <div class="recommendation__file"><?= $item['FILE']['TYPE_FORMAT'] ?>, <?= $item['FILE']['SIZE_FORMAT'] ?></div>
                        <div class="recommendation__download">
                            <svg width="16" height="16">
                                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#downward"></use>
                            </svg>
                        </div>
                    </a>
                </li>
            <? } ?>
        </ul>
        <a class="link-button_grey" href="/personal/compare/">Смотреть все</a>
    </div>
<? } ?>