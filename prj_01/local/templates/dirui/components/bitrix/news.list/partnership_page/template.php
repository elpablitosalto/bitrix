<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<? if (!empty($arResult["ITEMS"])) { ?>

    <? foreach ($arResult["ITEMS"] as $item) { ?>
        <?
        $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <? if (!empty($item["DISPLAY_PROPERTIES"]["SECT_DESC"]["DISPLAY_VALUE"])) { ?>
            <? foreach ($item["DISPLAY_PROPERTIES"]["SECT_DESC"]["DISPLAY_VALUE"] as $key => $val) { ?>
                <p class="partnership__subtitle"><?= $val; ?></p>
            <? } ?>
        <? } ?>
        <section class="partnership__advantages" id="<?= $this->GetEditAreaId($item['ID']); ?>">
            <div class="page-wrapper">
                <? if (!empty($item['CONTACT_USER'])) { ?>
                    <div class="page-menu">
                        <? if (!empty($item['CONTACT_USER']['PICTURE'])) { ?>
                            <div class="page-menu__image">
                                <img src="<?= $item['CONTACT_USER']['PICTURE']['SRC']; ?>" alt="<?= $item['CONTACT_USER']['PICTURE']['ALT']; ?>" title="<?= $item['CONTACT_USER']['PICTURE']['TITLE']; ?>" />
                            </div>
                        <? } ?>
                        <div class="page-menu__wrapper">
                            <div class="page-menu__description">Контактное лицо:</div>
                            <? if (!empty($item['CONTACT_USER']['FIO'])) { ?>
                                <div class="page-menu__name"><?= $item['CONTACT_USER']['FIO'] ?></div>
                            <? } ?>
                            <? if (!empty($item['CONTACT_USER']['EMAIL'])) { ?>
                                <a class="partnership__contact" href="mailto:<?= $item['CONTACT_USER']['EMAIL']; ?>"><?= $item['CONTACT_USER']['EMAIL']; ?></a>
                            <? } ?>
                            <? if (!empty($item['CONTACT_USER']['PERSONAL_PHONE'])) { ?>
                                <a class="partnership__contact" href="tel:<?= $item['CONTACT_USER']['PERSONAL_PHONE_DIGITS']; ?>"><?= $item['CONTACT_USER']['PERSONAL_PHONE']; ?></a>
                            <? } ?>
                            <a class="link-button_rose" href="#callback">Связаться с нами</a>
                        </div>
                    </div>
                <? } ?>
                <? if (!empty($item["DISPLAY_PROPERTIES"]["OPTIONS"]["VALUE"])) { ?>
                    <div class="page-body">
                        <? foreach ($item["DISPLAY_PROPERTIES"]["OPTIONS"]["VALUE"] as $key => $val) { ?>
                            <?
                            $ar = [];
                            if (!empty($val['SUB_VALUES']['LIST_OPT']['VALUE']['TEXT'])) {
                                $ar = explode(';', $val['SUB_VALUES']['LIST_OPT']['VALUE']['TEXT']);
                            }
                            $text = $val['SUB_VALUES']['TEXT_OPT']['VALUE']['TEXT'];
                            $link = $val['SUB_VALUES']['URL_OPT']['VALUE'];
                            $link_text = $val['SUB_VALUES']['URL_TEXT_OPT']['VALUE'];
                            $text = html_entity_decode($text);
                            ?>
                            <div class="lk__section">
                                <h3><?= $val['SUB_VALUES']['HEADER_OPT']['VALUE']; ?></h3>
                                <? if (!empty($ar)) { ?>
                                    <ul class="partnership__list">
                                        <? foreach ($ar as $k => $v) { ?>
                                            <li class="partnership__item"><?= $v; ?></li>
                                        <? } ?>
                                    </ul>
                                <? } else if (!empty($text)) { ?>
                                    <p><?= $text; ?></p>
                                <? } ?>
                                <? if (!empty($link) && !empty($link_text)) { ?>
                                    <a href="<?= $link; ?>"><?= $link_text; ?></a>
                                <? } ?>
                            </div>
                        <? } ?>
                    </div>
                <? } ?>
            </div>
        </section>
    <? } ?>

<? } ?>