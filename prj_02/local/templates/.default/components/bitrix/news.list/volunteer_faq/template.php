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

    <section class="volunteerism-faq">
        <div class="container">
            <h3 class="section__title">Часто задаваемые вопросы</h3>
            <div class="site-accordeon">
                <? foreach ($arResult["ITEMS"] as $key => $val) { ?>
                    <div class="site-accordeon__item">
                        <div class="site-accordeon__item-head">
                            <h4 class="site-accordeon__item-title"><?=$val["NAME"];?></h4>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-drop-light site-accordeon__item-icon">
                                <use xlink:href="#drop-light"></use>
                            </svg>
                        </div>
                        <div class="site-accordeon__item-body">
                            <div class="text-size-lg"><?=$val["PREVIEW_TEXT"];?></div>
                        </div>
                    </div>
                <? } ?>
            </div>
        </div>
    </section>

<? } ?>