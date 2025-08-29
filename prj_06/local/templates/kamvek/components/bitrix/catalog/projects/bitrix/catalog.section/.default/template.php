<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 *
 *  _________________________________________________________________________
 * |	Attention!
 * |	The following comments are for system use
 * |	and are required for the component to work correctly in ajax mode:
 * |	<!-- items-container -->
 * |	<!-- pagination-container -->
 * |	<!-- component-end -->
 */

$this->setFrameMode(true);
$this->addExternalCss('/bitrix/css/main/bootstrap.css');

$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

if (!empty($arResult['ITEMS'])) { ?>

    <div class="bgGrau wideGallery">
        <div class=" responsiveBlock">
            <div id="BigBlocks" class="bigBlocks">
                <?foreach ($arResult['ITEMS'] as $item) :?>
                    <?
                    $uniqueId = $item['ID'].'_'.md5($this->randString().$component->getAction());
                    $areaIds[$item['ID']] = $this->GetEditAreaId($uniqueId);
                    $this->AddEditAction($uniqueId, $item['EDIT_LINK'], $elementEdit);
                    $this->AddDeleteAction($uniqueId, $item['DELETE_LINK'], $elementDelete, $elementDeleteParams);
                    ?>
                    <a href="<?=$item["DETAIL_PAGE_URL"]?>" class="bigBlock bigBlockM " id="<?=$areaIds[$item['ID']]?>">
                        <img class="bbimg" loading="lazy" data-size="M"
                             src="<?=$item["PREVIEW_PICTURE"]["SRC"];?>"
                             sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw"
                             style="object-position:50% 50%;"
                             width="570" height="255" alt="<?=$item["ELEMENT_PREVIEW_PICTURE_FILE_ALT"];?>" title="<?=$item["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"];?>"/>
                        <div class="content">
                            <div class="title "><?=$item["NAME"];?></div>
                            <?if($item["PREVIEW_TEXT"]):?>
                                <div class="text d"><?=$item["PREVIEW_TEXT"];?></div>
                                <?/*?>
                                <p class="text d"><?=$item["PREVIEW_TEXT"];?></p>
                                <?*/?>
                            <?endif;?>
                        </div>
                    </a>
                <?endforeach;?>
            </div>
            <?/*<div class="loadMore"> Mehr laden</div>*/?>
        </div>
    </div>
<? } ?>
