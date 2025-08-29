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


<section class="dp-section dp-features-section dp-gradient-bg">
    <div class="container">
        <div class="dp-section__header">
            <h2 class="dp-section__title"><?= $arResult["SECTION"]["NAME"] ?></h2>
        </div>
        <div class="dp-section__body">
            <div class="dp-section__desc">
                <p><?= $arResult["SECTION"]["DESCRIPTION"] ?></p>
            </div>
            <div class="dp-features">
                <div class="dp-features__list">
                    <? foreach ($arResult["ITEMS"] as $arItem) : ?>
                        <?
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <div class="dp-features__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                            <div class="dp-feature">
                                <div class="dp-feature__header"><span class="dp-feature__icon">
                                        <? if (isset($arItem["PREVIEW_PICTURE"]["SRC"])) { ?>
                                            <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>">
                                        <? } ?>
                                    </span>
                                    <h3 class="dp-feature__title"><?= $arItem["NAME"] ?></h3>
                                </div>
                                <p class="dp-feature__desc"><?= $arItem["PREVIEW_TEXT"] ?></p>
                            </div>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
            <? if (!empty($arResult['arNumbers'])) { ?>
                <div class="dp-features-stat">
                    <div class="dp-features-stat__list">
                        <? foreach ($arResult['arNumbers'] as $key => $arItem) { ?>
                            <div class="dp-features-stat__item">
                                <div class="dp-feature-stat">
                                    <h3 class="dp-feature-stat__title">
                                        <?= $arItem['STR_WITH_NUM']; ?>
                                    </h3>
                                    <p class="dp-feature-stat__desc"><?= $arItem['TEXT']; ?></p>
                                </div>
                            </div>
                        <? } ?>
                    </div>
                </div>
            <? } ?>
            <?/*?>
            <div class="dp-features-stat">
                <div class="dp-features-stat__list">
                    <div class="dp-features-stat__item">
                        <div class="dp-feature-stat">
                            <h3 class="dp-feature-stat__title">
                                    <span class="dp-feature-stat__number">49 358</span>
                                        <span class="dp-feature-stat__cat">врачей</span>
                                </h3>
                            <p class="dp-feature-stat__desc">Посетили наши вебинары, мастер-классы и
                                онлайн-курсы.</p>
                        </div>
                    </div>
                    <div class="dp-features-stat__item">
                        <div class="dp-feature-stat">
                            <h3 class="dp-feature-stat__title"><span class="dp-feature-stat__number">253</span><span
                                        class="dp-feature-stat__cat">лектора</span></h3>
                            <p class="dp-feature-stat__desc">Только эксперты-практики в сфере здравоохранения.</p>
                        </div>
                    </div>
                    <div class="dp-features-stat__item">
                        <div class="dp-feature-stat">
                            <h3 class="dp-feature-stat__title"><span class="dp-feature-stat__number">562</span><span
                                        class="dp-feature-stat__cat">вебинара</span></h3>
                            <p class="dp-feature-stat__desc">По самым востребованным темам: от подходов в терапии до
                                юридических аспектов взаимодействия с пациентом.</p>
                        </div>
                    </div>
                    <div class="dp-features-stat__item">
                        <div class="dp-feature-stat">
                            <h3 class="dp-feature-stat__title"><span
                                        class="dp-feature-stat__number">140 000</span><span
                                        class="dp-feature-stat__cat">просмотров</span></h3>
                            <p class="dp-feature-stat__desc">Вдохновляют нас продолжать создавать онлайн-мероприятия
                                и повышать их качество для вас.</p>
                        </div>
                    </div>
                </div>
            </div>
            <?*/ ?>
        </div>
    </div>
</section>