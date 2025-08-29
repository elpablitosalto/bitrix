<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);

if ($arResult['ITEMS']) {?>
    <div class="row anim-list">
        <?foreach ($arResult['ITEMS'] as $arItem) {
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));  
            
            $img = [];
            $img = CFile::ResizeImageGet($arItem['~PREVIEW_PICTURE'], ['width' => 360 * 2, 'height' => 240 * 2], BX_RESIZE_IMAGE_PROPORTIONAL, true, false, false, 100);
            $img = $img['src'] ? : SITE_TEMPLATE_PATH.'/img/no_photo.png';
            ?>
            <div class="col-6 col-md-3" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="anim-item anim-item_article">
                    <a class="anim-item__link" href="<?=$arItem['DETAIL_PAGE_URL']?>">
                        <div class="anim-item__img">
                            <img class="lazyload" data-src="<?=$img?>" src="<?=$img?>" alt="<?=$arItem['NAME']?>">
                        </div>
                        <div class="anim-item__caption">
                            <p class="anim-item__title"><?=$arItem['NAME']?></p>
                            <time class="anim-item__date" datetime="<?=FormatDate('Y-m-d', MakeTimeStamp($arItem['ACTIVE_FROM'])); ?>">
                                <?=FormatDate('j F Y', MakeTimeStamp($arItem['ACTIVE_FROM'])); ?>
                            </time>
                        </div>
                    </a>
                </div>
            </div>
        <?}?>
    </div>
    <?=$arResult['NAV_STRING']?>
<?}?>