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
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
?>
<?
$arModifiers = array(
  'online' => array(
    'panel' => 'service-item_role_online',
    'label-first' => 'label_style_primary',
    'label-other' => 'label_style_primary-dashed',
  ),
  'top_5' => array(
    'panel' => 'service-item_role_top',
    'label-first' => '',
    'label-other' => 'label_style_dashed',
  ),
  'books' => array(
    'panel' => 'service-item_role_book',
    'label-first' => 'label_style_secondary',
    'label-other' => 'label_style_secondary-dashed',
  ),
);
$categoryId = !empty($_GET['category_id']) && array_key_exists($_GET['category_id'], $arResult["CATEGORIES"]) ? $_GET['category_id'] : '';
?>
<? if (!empty($arResult["ITEMS"])): ?>
    <?if(!empty($arResult["CATEGORIES"])):?>
        <?if($categoryId):?>
            <script>
                (function () {
                    BX.ajax.insertToNode('?category=<?=$categoryId?>&bxajaxid=<?=$arParams["AJAX_ID"]?>', 'comp_<?=$arParams["AJAX_ID"]?>');
                    history.pushState('', '', window.location.origin + window.location.pathname);
                })();
            </script>
            <?unset($categoryId);?>
        <?endif;?>
        <div class="section__tags">
            <!-- begin .tag-list-->
            <div class="tag-list section__tags-list">
                <div class="tag-list__container">
                    <button class="tag-list__mobile-trigger js-toggle" type="button" data-toggle-scope=".tag-list" data-toggle-class="tag-list_state_open">
                        Открыть список
                    </button>
                    <div class="tag-list__tags">
                        <div
                            onclick="BX.ajax.insertToNode('?category=&bxajaxid=<?=$arParams["AJAX_ID"]?>', 'comp_<?=$arParams["AJAX_ID"]?>'); return false;"
                            class="tag-list__tag <?=((!$request->isAjaxRequest() || empty($request->get("category"))) ? "tag-list__tag_state_active" : "")?>"
                        >
                            Все услуги
                        </div>
                        <?foreach ($arResult["CATEGORIES"] as $valueId => $valueName):?>
                            <div
                                onclick="BX.ajax.insertToNode('?category=<?=$valueId?>&bxajaxid=<?=$arParams["AJAX_ID"]?>', 'comp_<?=$arParams["AJAX_ID"]?>'); return false;"
                                class="tag-list__tag <?=(($request->isAjaxRequest() && $request->get("category") == $valueId) ? "tag-list__tag_state_active" : "")?>"
                            >
                                <?=$valueName?>
                            </div>
                        <?endforeach;?>
                    </div>
                    <button class="tag-list__close js-toggle" type="button" data-toggle-scope=".tag-list" data-toggle-class="tag-list_state_open">
                      <div class="tag-list__icon">
                        Закыть список
                      </div>
                    </button>
                </div>
            </div>
            <!-- end .tag-list-->
        </div>
    <?endif;?>
    <div class="section__content">
        <div class="section__cards-panel">
            <!-- no modifiers - panels take all available width, divinging equally up to three in one row-->
            <!-- promo-group_layout_l - one panel per row-->
            <!-- promo-group_layout_m - two panels per row-->
            <!-- promo-group_layout_s - three panels per row-->
            <!-- promo-group_layout_mixed - three panels every odd row, two panels every even row-->
            <!-- begin .cards-panel-->
            <div class="cards-panel cards-panel_layout_m cards-panel_panel-height_l cards-panel_mobile-gutter_l">
                <div class="cards-panel__container">
                    <div class="cards-panel__wrapper">
                        <? foreach ($arResult["ITEMS"] as $arItem): ?>
                        <?
                        $type = !empty($arItem["PROPERTIES"]["CATEGORY"]["VALUE_XML_ID"]) ? $arItem["PROPERTIES"]["CATEGORY"]["VALUE_XML_ID"][0] : '';
                        $cardClass = $arModifiers[$type]['panel'];
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        $backgroundImg = SITE_TEMPLATE_PATH."/assets/blocks/service-item/images/5.png";
                        if(!empty($arItem["PROPERTIES"]["BACKGROUND_IMG"]["VALUE"])){
                            $backgroundImg = \CFile::GetPath($arItem["PROPERTIES"]["BACKGROUND_IMG"]["VALUE"]);
                        }
                        $link = !empty($arItem["PROPERTIES"]["LINK"]["VALUE"]) ? $arItem["PROPERTIES"]["LINK"]["VALUE"] : $arItem['DETAIL_PAGE_URL'];
                        $tag = !empty($link) ? 'a' : 'div';
                        $isExternalLink = !empty($link) ? preg_match('/(http|www)/', $link) : false;
                        ?>
                            <div class="cards-panel__item cards-panel__item_type_service <?=$itemClass?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                                <!-- begin .service-item-->
                                <<?=$tag?>
                                    class="service-item service-item_style_primary <?=$cardClass?> cards-panel__panel"
                                    <?if(!empty($link)):?>
                                        href="<?=$link?>"
                                        <?=($isExternalLink ? 'target="_blank"' : '');?>
                                    <?endif;?>
                                >
                                    <div class="service-item__content">
                                        <?if(!empty($backgroundImg)):?>
                                            <div class="service-item__background">
                                                <picture class="service-item__picture">
                                                    <img
                                                        src="<?= $backgroundImg ?>"
                                                        alt="image" class="service-item__image" title=""
                                                    />
                                                </picture>
                                            </div>
                                        <?endif;?>
                                        <div class="service-item__header">
                                            <?if(!empty($arItem["PROPERTIES"]["CATEGORY"]["VALUE"])):?>
                                                <div class="service-item__tags">
                                                    <?foreach ($arItem["PROPERTIES"]["CATEGORY"]["VALUE"] as $index => $category):?>
                                                      <?
                                                        $mainLabelClass = !empty($arModifiers[$type]) ? $arModifiers[$type]['label-first'] : '';
                                                        $otherLabelClass = !empty($arModifiers[$type]) ? $arModifiers[$type]['label-other'] : '';
                                                      ?>
                                                        <div class="service-item__tag">
                                                            <!-- begin .label-->
                                                            <div class="label <?= ($index === 0) ? $mainLabelClass : $otherLabelClass ?>">
                                                                <?=$category?>
                                                            </div>
                                                            <!-- end .label-->
                                                        </div>
                                                    <?endforeach;?>
                                                </div>
                                            <?endif;?>
                                        </div>
                                        <div class="service-item__icon-holder">
                                            <?if(!empty($arItem["PROPERTIES"]["ICON"]["VALUE"])):?>
                                                <?
                                                $iconPath = \CFile::GetPath($arItem["PROPERTIES"]["ICON"]["VALUE"]);
                                                ?>
                                                <?if(is_file($_SERVER["DOCUMENT_ROOT"].$iconPath)):?>
                                                    <?=file_get_contents($_SERVER["DOCUMENT_ROOT"].$iconPath)?>
                                                <?endif;?>
                                            <?endif;?>
                                        </div>
                                        <div class="service-item__main">
                                            <div class="service-item__title">
                                                <?=$arItem["NAME"]?>
                                            </div>
                                            <div class="service-item__description">
                                                <?=htmlspecialchars_decode($arItem["PREVIEW_TEXT"])?>
                                            </div>
                                            <?if(!empty($link)):?>
                                                <div class="service-item__controls">
                                                    <div class="service-item__control">
                                                        <!-- begin .button-->
                                                        <div class="button button_style_borderless button_width_fit">
                                                            <span class="button__holder">
                                                                <span class="button__text">Подробнее</span>
                                                                <span class="button__icon">
                                                                    <svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.3536 4.35355C12.5488 4.15829 12.5488 3.84171 12.3536 3.64645L9.17157 0.464465C8.97631 0.269203 8.65973 0.269203 8.46447 0.464465C8.2692 0.659728 8.2692 0.97631 8.46447 1.17157L11.2929 4L8.46447 6.82843C8.2692 7.02369 8.2692 7.34027 8.46447 7.53553C8.65973 7.7308 8.97631 7.7308 9.17157 7.53553L12.3536 4.35355ZM4.37114e-08 4.5L12 4.5L12 3.5L-4.37114e-08 3.5L4.37114e-08 4.5Z" fill="#E31513" /></svg>
                                                                </span>
                                                            </span>
                                                        </div>
                                                        <!-- end .button-->
                                                    </div>
                                                </div>
                                            <?endif;?>
                                        </div>
                                    </div>
                                </<?=$tag?>>
                                <!-- end .service-item-->
                            </div>
                        <? endforeach; ?>
                    </div>
                </div>
            </div>
            <!-- end .cards-panel-->
        </div>
    </div>
<? endif; ?>