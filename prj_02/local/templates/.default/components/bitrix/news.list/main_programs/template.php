<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Grid\Declension;
?>

<? foreach ($arResult["ITEMS"] as $item) { ?>
    <?
    $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <div class="col-12" id="<?=$this->GetEditAreaId($item['ID']);?>">
        <div class="list-item main-programs-item bg-orange">
            <div class="main-programs-item__head">
                <div class="h4 main-programs-item__title"><?= $item["NAME"] ?></div>
                <button type="button" class="btn btn-white main-programs-item__toggler">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop-light">
                        <use xlink:href="#drop-light"></use>
                    </svg>
                </button>
            </div>
            <div class="row align-items-height">
                <div class="col-lg-6 main-programs-item__content-wrapper">
                    <div class="main-programs-item__content">
                        <? if (!empty($item["DISPLAY_PROPERTIES"]["AUDIENCE_TYPE"]["DISPLAY_VALUE"])) { ?>
                            <div class="main-programs-item__tags">
                                <div class="buttons-line">
                                    <?foreach($item["DISPLAY_PROPERTIES"]["AUDIENCE_TYPE"]["DISPLAY_VALUE"] as $val){?>
                                    <span class="btn btn-xs btn-orange-light">#<?=$val?></span>
                                    <?}?>
                                </div>
                            </div>
                        <? } ?>
                        <?if(!empty($item["DISPLAY_PROPERTIES"]["PROGRAM_ACTIVITY"]["DISPLAY_VALUE"])){?>
                        <div class="text-size-lg main-programs-item__text">
                            <ul>
                                <?foreach($item["DISPLAY_PROPERTIES"]["PROGRAM_ACTIVITY"]["DISPLAY_VALUE"] as $activity){?>
                                <li><?=$activity?></li>
                                <?}?>
                            </ul>
                        </div>
                        <?}?>
                        <?if(count($item["DISPLAY_PROPERTIES"]["PROJECTS"]["VALUE"]) > 0){
                            $num = count($item["DISPLAY_PROPERTIES"]["PROJECTS"]["VALUE"]);
                            $Declension = new Declension('проект', 'проекта', 'проектов');
                            $link = "/projects/";
                            switch ($item["CODE"]){
                                case "programma-doroga-k-domu":
                                    $link = "/projects/programma-doroga-k-domu/";
                                    break;
                                case "programma-put-k-uspekhu":
                                    $link = "/projects/programma-put-k-uspekhu/";
                                    break;
                            }
                            ?>
                        <div class="main-programs-item__buttons">
                            <div class="buttons-line"><a href="<?=$link?>"
                                                         target="_self"
                                                         class="btn btn-white main-programs-item__btn"><?=$num?>
                                    <?=$Declension->get($num);?>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                         class="icon icon-arrow">
                                        <use xlink:href="#arrow"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <?}?>
                    </div>
                </div>
                <div class="col-lg-6 main-programs-item__image-wrapper">
                    <div class="main-programs-item__image">
                        <?if($item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"]){?>
                        <picture><img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg"
                                      data-src="<?=$item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"]?>"
                                      loading="lazy" alt="<?=$item["PREVIEW_PICTURE"]["ALT"]?>"
                                      title="<?=$item["PREVIEW_PICTURE"]["TITLE"]?>"/>
                        </picture>
                        <?}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<? } ?>

