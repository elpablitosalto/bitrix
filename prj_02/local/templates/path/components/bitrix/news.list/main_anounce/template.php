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



<? if (!empty($arResult["ITEMS"])) { ?>

    <section class="wrapper rs__anonce">
        <div class="container">
            <div class="rs__content">
                <div class="rs__content--top">
                    <div class="rs__section--title">Анонсы мероприятий</div>
                    <div class="rs__slider--control">
                        <div class="rs__slider--control-prev"></div>
                        <div class="rs__slider--control-next"></div>
                    </div>
                </div>
                <div class="rs__materials--block swiper js--anonce-slider">
                    <div class="swiper-wrapper">
                        <? foreach ($arResult["ITEMS"] as $item) { ?>
                            <?
                            $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            $class = "";
                            $showIco = false;
                            switch($item["DISPLAY_PROPERTIES"]["TEMLATE_TYPE"]["VALUE_XML_ID"]){
                                case "BLUE":
                                    $class = " bg--blue";
                                    break;
                                case "YELLOW":
                                    $showIco = true;
                                    $class = " bg--yellow";
                                    break;
                            }
                            ?>
                            <div class="swiper-slide" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                                <div class="rs__materials--item no-pic<?=$class?>">
                                    <div class="rs__materials--info">
                                        <div class="rs__materials--chapter"><?= $item["DISPLAY_ACTIVE_FROM"] ?></div>
                                        <div class="rs__materials--title"><a href="<?=$item["DETAIL_PAGE_URL"]?>"><?= $item["NAME"] ?></a>
                                        </div>
                                        <?if(!empty($item["DISPLAY_PROPERTIES"]["ADD_LINKS"]["DISPLAY_VALUE"])){?>
                                        <div class="rs__materials--links">
                                            <?foreach($item["DISPLAY_PROPERTIES"]["ADD_LINKS"]["DISPLAY_VALUE"] as $num => $val){?>
                                            <a class="rs__link rs__materials--link"<?if(mb_strlen($item["DISPLAY_PROPERTIES"]["ADD_LINKS"]["DESCRIPTION"][$num])){?> href="<?=$item["DISPLAY_PROPERTIES"]["ADD_LINKS"]["DESCRIPTION"][$num]?>"<?}?>><?=$val?></a>
                                            <?}?>
                                        </div>
                                        <?}?>
                                        <?if($showIco){?>
                                            <div class="rs__materials--ico">
                                            <span class="ico-arrow-big">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </span>
                                            </div>
                                        <?}?>
                                    </div>
                                </div>
                            </div>
                        <? } ?>
                    </div>
                    <div class="swiper-pagination is-hidden-tablet"></div>
                    <div class="rs__button__group rs__section--nav">
                        <a class="rs__button__default rs__button--icon ico-arrow-main rs__button--icon-right"
                           href="/news/?set_filter=y&newsFilter_71_2367533627=Y">Все мероприятия</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

<? } ?>