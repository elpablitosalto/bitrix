<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<? if(!empty($arResult["ITEMS"])): ?>
    <ul class="important-numbers__list">
        <?foreach($arResult["ITEMS"] as $arMetric):?>
            <li class="important-numbers__item">
                <div class="important-numbers__item__title"><?=$arMetric["PROPERTIES"]["NUMBER"]["VALUE"]?></div>
                <div class="important-numbers__item__subtitle">
                    <?=$arMetric["PROPERTIES"]["DESCRIPTION"]["VALUE"]?>
                </div>
            </li>
        <?endforeach;?>
    </ul>
<? endif; ?>
