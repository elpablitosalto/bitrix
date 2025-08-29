<?
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>

<?ShowError($arResult["strProfileError"]);?>
<?
if ($arResult['DATA_SAVED'] == 'Y')
  ShowNote(GetMessage('PROFILE_DATA_SAVED'));
?>
<form method="post" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data" novalidate="true" autocomplete="off" class="accprofile__form site-form js-validate js-not-ajax-submit">

    <?=$arResult["BX_SESSION_CHECK"]?>
    <input type="hidden" name="lang" value="<?=LANG?>">
    <input type="hidden" name="ID" value="<?=$arResult["ID"]?>">

    <h4 class="lk__subtitle">Личные данные</h4>
    <div class="custom-form-group">
        <input type="text" name="NAME" placeholder="<?=GetMessage('NAME')?>" class="form-control" value="<?=$arResult["arUser"]["NAME"]?>">
        <input type="text" name="LAST_NAME" placeholder="<?=GetMessage('LAST_NAME')?>" class="form-control" value="<?=$arResult["arUser"]["LAST_NAME"]?>">
        <input type="text" name="EMAIL" placeholder="<?=GetMessage('EMAIL')?>" class="form-control" required pattern="email" value="<?=$arResult["arUser"]["EMAIL"]?>">
        <input type="text" name="PERSONAL_BIRTHDAY" placeholder="<?=GetMessage('USER_BIRTHDAY_DT')?>" class="form-control" value="<?=$arResult["arUser"]["PERSONAL_BIRTHDAY"]?>">
    </div>

    <h4 class="lk__subtitle">Пароль</h4>
    <div class="custom-form-group">
        <input type="password" name="NEW_PASSWORD" placeholder="<?=GetMessage('NEW_PASSWORD')?>" class="form-control" autocomplete="off">
        <input type="text" name="NEW_PASSWORD_CONFIRM" placeholder="<?=GetMessage('NEW_PASSWORD_CONFIRM')?>" class="form-control">
    </div>
    <button class="btn-default" name="save" value="yes" type="submit"><?=GetMessage('SAVE')?></button>
</form>

<a class="link--logout" href="<?=SITE_DIR?>?logout=yes&amp;<?=bitrix_sessid_get()?>">Выйти из аккаунта &nbsp;
    <svg width="16" height="16">
        <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons/sprite/svg-sprite.svg#logout"></use>
    </svg>
</a>