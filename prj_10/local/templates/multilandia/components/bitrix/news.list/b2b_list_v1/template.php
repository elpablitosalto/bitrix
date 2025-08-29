<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if ($arResult['ITEMS']) {?>
    <div class="ml-news-detail__content">
        <ul>
            <?foreach ($arResult['ITEMS'] as $arItem) {
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));  
                
                $link = '';
                $download = '';
                if ($arItem['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE']['SRC']) {
                    $link = $arItem['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE']['SRC'];
                    $download = ' download';
                } else if ($arItem['PROPERTIES']['LINK']['VALUE']) {
                    $link = $arItem['PROPERTIES']['LINK']['VALUE'];
                } else {
                    $link = 'javascript:void(0);';
                }
                ?>
                <li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <a href="<?=$link?>"<?=$download?>><?=$arItem['NAME'];?></a>
                </li>
            <?}?>
        </ul>
    </div>
<?}?>