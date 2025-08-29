<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
?>
<?
//vardump($arResult['ITEMS']);
?>
<? foreach ($arResult['ITEMS'] as $index => $arItem) : ?>
    <?/*?>
    <?if ($index == 1 && count($arResult['ANCHORS']) > 0):?>
        <div class="nb-ancor-menu">
            <div class="container">
                <ul class="nb-ancor-menu__list">
                    <?foreach ($arResult['ANCHORS'] as $arAnchor):?>
                        <li class="nb-ancor-menu__item">
                            <a class="nb-ancor-menu__link" href="#block-<?=$arAnchor['ID']?>">
                                <svg class="icon icon-btn-arrow">
                                    <use xlink:href="#btn-arrow"></use>
                                </svg>
                                <span><?=$arAnchor['NAME']?></span>
                            </a>
                        </li>
                    <?endforeach;?>
                </ul>
            </div>
        </div>
    <?endif;?>
    <?*/ ?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    $arBlock = reset($arItem['DISPLAY_PROPERTIES']['BLOCK_ID']['LINK_ELEMENT_VALUE']);
    //vardump($arBlock);
    ?>
    <?
    $arParams['BLOCK_AREA_ID'] = 'block-' . $arItem['ID'];
    ?>
    <div id="<?= $arParams['BLOCK_AREA_ID'] ?>">
        <?
        $APPLICATION->IncludeFile(
            $templateFolder . '/blocks/' . $arBlock['CODE'] . '/template.php',
            array(
                'ITEM' => $arItem,
                'EDIT_AREA_ID' => $this->GetEditAreaId($arItem['ID']),
                'BLOCK_AREA_ID' => $arParams['BLOCK_AREA_ID'],
                'SERVICE_ID' => $arParams['SERVICE_ID'],
                'arComponentResult' => $arResult,
                "POST" => $_POST,
            ),
            array('SHOW_BORDER' => false)
        );
        ?>
    </div>
<? endforeach; ?>