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
)
?>
<? if (!empty($arResult["ITEMS"])): ?>
    <div class="section">
        <div class="section__header section__header_type_inline">
            <div class="section__title">
                <!-- begin .title-->
                <h2 class="title title_size_h2">Наши услуги
                </h2>
                <!-- end .title-->
            </div>
            <div class="section__extra">
                <div class="section__link-item">
                    <!-- begin .link-item--><a
                            class="link-item link-item_text-size_l link-item_icon-size_l link-item_icon-offset_l link-item_style_primary"
                            href="/services/"><span class="link-item__label">Еще больше услуг</span>
                        <svg width="13" height="8" viewBox="0 0 13 8" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.3536 4.35355C12.5488 4.15829 12.5488 3.84171 12.3536 3.64645L9.17157 0.464465C8.97631 0.269203 8.65973 0.269203 8.46447 0.464465C8.2692 0.659728 8.2692 0.97631 8.46447 1.17157L11.2929 4L8.46447 6.82843C8.2692 7.02369 8.2692 7.34027 8.46447 7.53553C8.65973 7.7308 8.97631 7.7308 9.17157 7.53553L12.3536 4.35355ZM4.37114e-08 4.5L12 4.5L12 3.5L-4.37114e-08 3.5L4.37114e-08 4.5Z"
                                  fill="#E31513"/>
                        </svg>
                    </a>
                    <!-- end .link-item-->
                </div>
            </div>
        </div>
        <div class="section__content">
            <div class="section__cards-panel">
                <!-- no modifiers - panels take all available width, divinging equally up to three in one row-->
                <!-- cards-panel_layout_l - one panel per row-->
                <!-- cards-panel_layout_m - two panels per row-->
                <!-- cards-panel_layout_s - three panels per row-->
                <!-- cards-panel_layout_mixed - three panels every odd row, two panels every even row-->
                <!-- begin .cards-panel-->
                <div class="cards-panel cards-panel_layout_m cards-panel_panel-height_l cards-panel_mobile-gutter_l">
                    <div class="cards-panel__container">
                        <div class="cards-panel__wrapper">
                            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                                <?
                                $type = !empty($arItem["PROPERTIES"]["CATEGORY"]["VALUE_XML_ID"]) ? $arItem["PROPERTIES"]["CATEGORY"]["VALUE_XML_ID"][0] : '';
                                $cardClass = !empty($arModifiers[$type]) ? $arModifiers[$type]['panel'] : '';
                                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                $backgroundImg = SITE_TEMPLATE_PATH."/assets/blocks/service-item/images/5.png";
                                if(!empty($arItem["PROPERTIES"]["BACKGROUND_IMG"]["VALUE"])){
                                    $backgroundImg = \CFile::GetPath($arItem["PROPERTIES"]["BACKGROUND_IMG"]["VALUE"]);
                                }
                                ?>
                                <div class="cards-panel__item " id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                                    <!-- begin .service-item-->
                                    <div class="service-item service-item_style_primary <?=$cardClass?> cards-panel__panel">
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

                                                <?
                                                    $link = !empty($arItem["PROPERTIES"]["LINK"]["VALUE"]) ? $arItem["PROPERTIES"]["LINK"]["VALUE"] : $arItem['DETAIL_PAGE_URL'];
                                                ?>
                                                <?if(!empty($link)):?>
                                                    <?
                                                        $isExternalLink = preg_match('/(http|www)/', $link);
                                                    ?>
                                                    <div class="service-item__controls">
                                                        <div class="service-item__controls">
                                                            <!-- begin .button-->
                                                            <a
                                                                href="<?=$link?>"
                                                                <?=($isExternalLink ? 'target="_blank"' : '');?>
                                                                class="button button_style_borderless button_width_fit"
                                                            >
                                                                <span class="button__holder">
                                                                    <span class="button__text">Подробнее</span>
                                                                    <span class="button__icon">
                                                                        <svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.3536 4.35355C12.5488 4.15829 12.5488 3.84171 12.3536 3.64645L9.17157 0.464465C8.97631 0.269203 8.65973 0.269203 8.46447 0.464465C8.2692 0.659728 8.2692 0.97631 8.46447 1.17157L11.2929 4L8.46447 6.82843C8.2692 7.02369 8.2692 7.34027 8.46447 7.53553C8.65973 7.7308 8.97631 7.7308 9.17157 7.53553L12.3536 4.35355ZM4.37114e-08 4.5L12 4.5L12 3.5L-4.37114e-08 3.5L4.37114e-08 4.5Z" fill="#E31513"/></svg>
                                                                    </span>
                                                                </span>
                                                            </a>
                                                            <!-- end .button-->
                                                        </div>
                                                    </div>
                                                <?endif;?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end .service-item-->
                                </div>
                            <? endforeach; ?>
                        </div>
                    </div>
                </div>
                <!-- end .cards-panel-->
            </div>
        </div>
    </div>
<? endif; ?>