<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?>

<?
$formAction = '';
if (!empty($arParams['FORM_ACTION'])) {
    $formAction = $arParams['FORM_ACTION'];
}
?>

<? if (!empty($arResult['ITEMS'])) { ?>
    <div class="dp-filter-section">
        <div class="dp-filter dp-filter-slider">
			<p class="dp-filter__title">Тема</p>
            <div class="dp-modal dp-filter__modal">
                <div class="dp-modal__overlay"></div>
                <button class="dp-modal__close" type="button">
                    <svg class="icon icon-cross ">
                        <use xlink:href="#cross"></use>
                    </svg>
                </button>
                <div class="dp-modal__dialog">
                    <form class="dp-filter-form dp-filter-form-topic js_themes_form" action="<?=$formAction;?>" method="post">
						<p class="dp-filter-form__title">Тема</p>
						<input type="hidden" value="Y" name="set_filter" />
                        <input type="hidden" value="topic" name="filter_type" />
                        <div class="dp-filter-form__body">
                            <div class="dp-filter-form__list">
                                <? foreach ($arResult['ITEMS'] as $key => $arItem) { ?>
                                    <div class="dp-filter-form__item">
                                        <input onclick="ClickOnNewClosedMaterials('<?= $arItem['UF_NAME'] ?>');" id="ff-topic-<?= $arItem['ID'] ?>" type="checkbox" name="topic[<?= $arItem['ID'] ?>]" value="<?= $arItem['ID'] ?>" <? if ($arItem['CHECKED'] == 'Y') { ?> checked <? } ?> />
                                        <label for="ff-topic-<?= $arItem['ID'] ?>"><?= $arItem['UF_NAME'] ?></label>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                        <div class="dp-filter-form__actions">
                            <button class="dp-btn dp-btn_m dp-btn_orange" type="submit">Применить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<? } ?>