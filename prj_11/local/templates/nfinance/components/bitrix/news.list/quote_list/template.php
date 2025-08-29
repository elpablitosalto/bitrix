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
    <!-- begin .quote-list-->
    <div class="quote-list page__quote-list js-quote-list">
        <div class="quote-list__progress">
            <!-- begin .scroll-progress-->
            <div class="scroll-progress js-scroll-progress quote-list__bar">
            <div class="scroll-progress__wrapper">
                <div class="scroll-progress__scroller js-scroll-progress-scroller">
                <div class="scroll-progress__knob">&nbsp;
                </div>
                </div>
            </div>
            </div>
            <!-- end .scroll-progress-->
        </div>
        <ul class="quote-list__list">
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                    $title = !empty($arItem["PROPERTIES"]["TITLE"]["VALUE"]) ? $arItem["PROPERTIES"]["TITLE"]["VALUE"] : '';
                    $subtitle = !empty($arItem["PROPERTIES"]["SUBTITLE"]["VALUE"]) ? $arItem["PROPERTIES"]["SUBTITLE"]["VALUE"] : '';
                    $text = !empty($arItem["PROPERTIES"]["TEXT"]["VALUE"]["TEXT"]) ? $arItem["PROPERTIES"]["TEXT"]["VALUE"]["TEXT"] : '';
                    $name = !empty($arItem["PROPERTIES"]["NAME"]["VALUE"]) ? $arItem["PROPERTIES"]["NAME"]["VALUE"] : '';
                    $position = !empty($arItem["PROPERTIES"]["POSITION"]["VALUE"]) ? $arItem["PROPERTIES"]["POSITION"]["VALUE"] : '';
                    $photoId = !empty($arItem["PROPERTIES"]["PHOTO"]["VALUE"]) ? $arItem["PROPERTIES"]["PHOTO"]["VALUE"] : '';
                    $photoSRC = '';
                    if(!empty($photoId)) {
                        $photoFileArray = CFile::GetFileArray($photoId);
                        $renderPhoto = CFile::ResizeImageGet(
                            $photoFileArray,
                            Array("width" => 200, "height" => 200),
                            BX_RESIZE_IMAGE_PROPORTIONAL_ALT , true
                        );
                        $photoSRC = $renderPhoto['src'];
                    }
                ?>
                <li class="quote-list__item">
                    <!-- begin .quote-->
                    <div class="quote">
                        <div class="quote__main">
                            <div class="quote__sign">“</div>
                            <div class="quote__title"><?=$title?></div>
                            <? if(!empty($subtitle)): ?>
                                <div class="quote__subtitle"><?=$subtitle?></div>
                            <? endif; ?>
                            <div class="quote__text"><?=htmlspecialchars_decode($text)?></div>
                        </div>
                        <? if(!empty($photoSRC) || !empty($name) || !empty($position)): ?>
                            <div class="quote__entity">
                                <!-- begin .entity-->
                                <div class="entity entity_type_decorated">
                                    <? if(!empty($photoSRC)): ?>
                                        <div class="entity__illustration">
                                            <picture class="entity__picture">
                                                <img src="<?=$photoSRC?>" alt="<?=$name?>" class="entity__image" />
                                            </picture>
                                        </div>
                                    <? endif; ?>
                                    <div class="entity__main">
                                        <div class="entity__title"><?=$name?></div>
                                        <div class="entity__text"><?=$position?></div>
                                    </div>
                                </div>
                                <!-- end .entity-->
                            </div>
                        <? endif; ?>
                    </div>
                    <!-- end .quote-->
                </li>
            <? endforeach; ?>
        </ul>
        <div class="quote-list__gradient js-quote-list-gradient">&nbsp;
        </div>
    </div>
    <!-- end .quote-list-->
<? endif; ?>