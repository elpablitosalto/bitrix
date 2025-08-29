<?//d($arParams,true)?>
<?
use Hair\General;

$activeSocial = [];
foreach($arResult['DB_SOCSERV_USER'] as $social):
    $activeSocial[] = $social['EXTERNAL_AUTH_ID'];
endforeach;
?>
<form method="post" name="bx_auth_services<?=$arParams["SUFFIX"]?>" target="_top" action="<?=$arParams["AUTH_URL"]?>">
    <?foreach($arPost as $key => $value):?>
        <?if(!preg_match("|OPENID_IDENTITY|", $key)):?>
            <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
        <?endif;?>
    <?endforeach?>
    <input type="hidden" name="auth_service_id" value="" />
    <div class="form-wrapper__item _text-center">
        <div class="socials">
            <div class="socials__wrapper">
                <?foreach($arParams['AUTH_SERVICES'] as $arSocial):?>
                    <a href="javascript:void(0)" onclick="<?=$arSocial['ONCLICK']?>" class="socials__wrapper-item _active">            
                        <?=General::getSocialIcon($arSocial['ID'])?>
                    </a>
                <?endforeach;?>
            </div>
        </div>
    </div>
</form>