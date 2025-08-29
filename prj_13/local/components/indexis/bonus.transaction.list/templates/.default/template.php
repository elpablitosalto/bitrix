<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<h4 class="lk__subtitle">История начислений и списаний</h4>
<?if (is_array($arResult['ITEMS']) && count($arResult['ITEMS']) > 0):?>
    <div class="notifications__list">
        <?foreach($arResult['ITEMS'] as $arItem):?>
            <div class="notification">
                <div class="notification__date"><?=date('d.m.Y', strtotime($arItem['TRANSACT_DATE']))?></div>
                <div class="notification__content">
                    <div class="notification__middle">
                        <div class="notification__title"><?if ($arItem['DEBIT'] == 'Y'):?>Начисление бонусов<?else:?>Списание бонусов<?endif;?></div>
                        <?if (mb_strlen($arItem['DESCRIPTION']) > 0):?>
                            <div class="notification__text"><?=$arItem['DESCRIPTION']?></div>
                        <?endif;?>
                    </div>
                    <div class="notification__how"><?if ($arItem['DEBIT'] == 'Y'):?>+<?else:?>-<?endif;?><?=floor($arItem['AMOUNT'])?></div>
                </div>
            </div>
        <?endforeach;?>
    </div>
    <div class="bonuses__pagination">
        <?=$arResult['NAV_STRING']?>
    </div>
<?else:?>
    <p class="notification">У вас пока нет бонусов. Чтобы получить СтройБонусы от нашей компании сделайте заказ как юр.лицо и оформите его через корзину</p>
<?endif;?>