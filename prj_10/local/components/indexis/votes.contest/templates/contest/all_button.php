<?php use Bitrix\Main\Localization\Loc; ?>

<form class="js--send_vote__for_contest" action="#" type="POST">

    <input type="hidden" name="user_id" value="<?= $arParams['USER_ID'] ?>" />
    <input type="hidden" name="contest_id" value="<?= $arParams['CONTEST_ID'] ?>" />
    <input type="hidden" name="participants_id" value="<?= $arParams['PARTICIPANTS_ID'] ?>" />
    <input type="hidden" name="iblock_id" value="<?= $arParams['IBLOCK_ID'] ?>" />
    <input type="hidden" name="type_vote" value="<?= $arParams['TYPE_VOTE'] ?>" />

    <button type="submit" class="ml-btn ml-btn_round anim-item__voting-btn <?= $arResult['ACTIVE_BUTTON_FOR_VOTE'] ?>">
        <?= Loc::getMessage('TITLE_BUTTON_TEXT') ?>
    </button>

</form>