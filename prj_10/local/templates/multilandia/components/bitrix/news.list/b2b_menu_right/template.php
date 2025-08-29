<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if ($arResult['ITEMS']) {?>
    <div class="ml-sidebar-block">
        <?foreach ($arResult['ITEMS'] as $arItem) {
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));  
            
            $link = '';
            $download = '';
            $class = '';
            if ($arItem['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE']['SRC']) {
                $link = $arItem['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE']['SRC'];
                $download = ' download';
            } else if ($arItem['PROPERTIES']['LINK']['VALUE']) {
                $link = $arItem['PROPERTIES']['LINK']['VALUE'];
                if (stristr($link, '#')) {
                    $class = ' link';
                }
            } else {
                $link = 'javascript:void(0);';
            }
            ?>
            <div class="ml-sidebar-menu-b2b" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <p class="ml-sidebar-menu__item">
                    <a class="ml-sidebar-menu__link<?=$class?>" href="<?=$link?>"<?=$download?>><?=$arItem['NAME'];?></a>
                </p>
            </div>
        <?}?>
    </div>
<?}?>