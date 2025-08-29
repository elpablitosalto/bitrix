<?
use Hair\General;

$activeSocial = [];
foreach($arResult['DB_SOCSERV_USER'] as $social):
    $activeSocial[] = $social['EXTERNAL_AUTH_ID'];
endforeach;
//$arResult["AUTH_SERVICES"] = false;
//if(CModule::IncludeModule("socialservices")) {
//    $oAuthManager = new CSocServAuthManager();
//    $arServices = $oAuthManager->GetActiveAuthServices($arResult);
//    if(!empty($arServices)) $arResult["AUTH_SERVICES"] = $arServices;
//}
//?>
<!--<p style="word-wrap: break-word;">--><?php //foreach($arResult['AUTH_SERVICES_ICONS'] as $element):?>
<!---->
<!--            --><?php //echo $element['ID']?>
<!--    --><?// endforeach?>
<!--</p>-->
<div class="showed-info">
    <div class="socials">
        <div class="socials__wrapper">
            <?
                foreach($arResult['AUTH_SERVICES_ICONS'] as $socialCode => $arSocial):
            ?>
                    <a onclick="<?=$arSocial['ONCLICK']?>" href="javascript:void(0)" class="socials__wrapper-item<?=(in_array($arSocial['ID'],$activeSocial)) ? '_active' : ''?>">
                    <?=General::getSocialIcon($arSocial['ID'])?>
                </a>
            <?
                endforeach;
            ?>
        </div>
    </div>
</div>