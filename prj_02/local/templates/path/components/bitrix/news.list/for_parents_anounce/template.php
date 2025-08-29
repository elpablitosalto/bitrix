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

    <section class="wrapper rs__cources">
    <div class="container">
    <div class="rs__content">
    <div class="rs__content--top">
        <h3 class="rs__section--title">Курсы для родителей и анонсы мероприятий</h3>
    </div>
    <div class="rs__cources--block">
    <? foreach ($arResult["ITEMS"] as $item) { ?>
        <?
        $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="rs__cources--item" id="<?= $this->GetEditAreaId($item['ID']); ?>">
            <div class="rs__cources--box">
                <div class="rs__cources--stub">
                    <?if($item["DISPLAY_PROPERTIES"]["EVENT_DATE"]["DISPLAY_VALUE"]){?>
                    <div class="rs__cources--date"><?=substr($item["DISPLAY_PROPERTIES"]["EVENT_DATE"]["DISPLAY_VALUE"],0,5)?></div>
                    <?}?>
                     <?if($item["DISPLAY_PROPERTIES"]["EVENT_TIME"]["DISPLAY_VALUE"]){?>
                    <div class="rs__cources--time">
                        <time>в <?=$item["DISPLAY_PROPERTIES"]["EVENT_TIME"]["DISPLAY_VALUE"]?></time>
                        <span>по московскому времени</span>
                    </div>
                     <?}?>
                </div>
                <div class="rs__cources--content">
                    <div class="rs__cources--info">
                        <div class="rs__cources--title"><a href="<?$item["DETAUL_PAGE_URL"]?>"><?= $item["NAME"] ?></a>
                        </div>
                        <? if (!empty($item["DISPLAY_PROPERTIES"]["AUDIENCE_TYPE"]["DISPLAY_VALUE"])) { ?>
                            <div class="rs__label">
                                <div class="rs__label--box">
                                    <? foreach ($item["DISPLAY_PROPERTIES"]["AUDIENCE_TYPE"]["DISPLAY_VALUE"] as $num => $val) { ?>
                                        <div class="rs__label--item"><?= $val ?></div>
                                    <? } ?>
                                </div>
                            </div>
                        <? } ?>

                        <? if (mb_strlen($item["PREVIEW_TEXT"])) { ?>
                            <div class="rs__cources--text"><?= $item["PREVIEW_TEXT"] ?>
                            </div>
                        <? } ?>
                        <!--<div class="rs__button__group">
                            <a class="rs__button__default rs__button--icon ico-arrow-main rs__button--icon-right"
                               href="">Зарегистрироваться</a>
                        </div>-->
                    </div>
                    <?if($item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"]){?>
                    <a href="<?$item["DETAUL_PAGE_URL"]?>">
                    <picture class="rs__cources--pic">
                        <img src="<?=$item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"]?>" class="rs__cources--img">
                    </picture>
                    </a>
                    <?}?>
                </div>
            </div>
        </div>
        <? } ?>
        </div>
        <div class="rs__button__group rs__section--nav">
            <a class="rs__button__default rs__button--icon ico-arrow-main rs__button--icon-right"
               href="/news/">Больше новостей и анонсов</a>
        </div>
        </div>
        </div>
        </section>


    <? } ?>