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

<? if (!empty($arResult["ITEMS"])): ?>

    <div id="st1717872140" data-auto="false" class="fotorama flex-row ">




        <? foreach ($arResult["ITEMS"] as $num => $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>

            <div class="lt-stsr-block flex-column">
                <div class="lt-stsr-content" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">


                    <div class="rounded-image-wrapper">
                        <img class="rounded-image"
                             data-hash="AB.7352532ad6f80d801d3d852c63e66715.jpeg"
                             data-image-editable="true" data-param="data/0/image"
                             src="<?=SITE_TEMPLATE_PATH?>/images/131.jfif">
                    </div>


                    <div data-editable="true" data-param="data/0/description"
                         class="  f-description lt-tsr-text-part description">
                        <p><span
                                    class="redactor-inline-converted">
                     <?= $arItem["NAME"] ?>:
                            </span>
                        </p>

                        <p><br></p>


                        <p><?= $arItem["PREVIEW_TEXT"] ?></p>


                        <p><br>
                        </p></div>


                    <?if($num == 0){?>
                    <div data-editable="true" data-param="data/0/header"
                         class=" f-header-26 f-header lt-tsr-text-part header">
                        <p>ОТЗЫВЫ</p></div>
                    <?}?>

                </div>

            </div>


        <? endforeach; ?>

    </div>




<? endif; ?>