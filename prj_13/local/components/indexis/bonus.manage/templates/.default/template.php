<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<div class="bonuses__panels">
    <div class="c-panel c-panel--bonuses">
        <div class="c-panel__title">
            Доступно бонусов
            <a href="/loyalty/" title="Вам <?=Indexis::num2word(floor($arResult['CURRENT_BUDGET']), ['доступен #NUM# бонус', 'доступно #NUM# бонуса', 'доступно #NUM# бонусов'])?>. При накоплении 500, 700, 1000 бонусов можете обменять их на карту OZON.">?</a>
        </div>
        <div class="c-panel__how-much"><?=floor($arResult['CURRENT_BUDGET'])?></div>
        <?if($arResult['CURRENT_BUDGET'] < $arParams['MIN_WITHDRAW']):?>
            <button class="btn-default" title="Минимальная сумма для обмена <?=Indexis::num2word($arParams['MIN_WITHDRAW'], ['#NUM# бонус', '#NUM# бонуса', '#NUM# бонусов'])?>" disabled>Обменять на карту OZON</button>
        <?else:?>
            <a href="mailto:marketing@stroyservis.su?subject=<?=urlencode('Обмен бонусов на карту OZON (ID пользователя: ' . $arParams['USER_ID'] . ')')?>" class="btn-default">Обменять на карту OZON</a>
        <?endif;?>
    </div>
    <?/*
    <div class="c-panel c-panel--notifications">
        <div class="c-panel__title">Уведомления</div>
        <p>Предупреждение о сгорании бонусов</p>
        <button class="btn-no-border">Отписаться</button>
    </div>
    */?>
</div>