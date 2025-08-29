<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<? if (strlen($arResult['COUNT']) > 0) { ?>
    <div class="lk__section">
        <h4 class="documentation__anchor" id="lkorder">Сделать заказ</h4>
        <div class="lk__section-wrapper">
            <div class="lk__order">
                Количество наименований: <span class="lk__order-quantity"><?= $arResult['COUNT']; ?></span>
            </div>
            <?/*?>
            <div class="lk__order">
                Сумма: <span class="lk__order-sum"> 600000 ₽</span>
            </div>
            <?*/ ?>
        </div>
        <ul class="order-list">
            <?
            $countItems = 6;
            $i = 0;
            ?>
            <? foreach ($arResult['ITEMS'] as $key => $arItem) { ?>
                <?
                $i++;
                if ($i > $countItems) {
                    break;
                }
                ?>
                <li class="order-item">
                    <img src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
                </li>
            <? } ?>
            <? if ($arResult['COUNT'] > $countItems) { ?>
                <li class="order-item"><a class="order__more" href="/personal/order/">+<?=($arResult['COUNT']-$countItems)?></a></li>
            <? } ?>
        </ul><a class="link-button_rose" href="/personal/order/">Перейти к заказу</a>
    </div>
<? } ?>