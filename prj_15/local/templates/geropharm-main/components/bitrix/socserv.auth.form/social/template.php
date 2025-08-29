<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var array $arParams
 */

CUtil::InitJSCore(array("popup"));

$arAuthServices = $arPost = array();
if (is_array($arParams["~AUTH_SERVICES"])) {
    $arAuthServices = $arParams["~AUTH_SERVICES"];
}
if (is_array($arParams["~POST"])) {
    $arPost = $arParams["~POST"];
}

$hiddens = "";
foreach ($arPost as $key => $value) {
    if (!preg_match("|OPENID_IDENTITY|", $key)) {
        $hiddens .= '<input type="hidden" name="' . $key . '" value="' . $value . '" />' . "\n";
    }
}
?>

<ul class="dp-social dp-social-auth">
    <?
    foreach ($arAuthServices as $service):
        $onclick = ($service["ONCLICK"] <> '' ? $service["ONCLICK"] : "BxSocServPopup('" . $service["ID"] . "')");
        ?>
        <li class="dp-social__item">
            <a id="bx_socserv_icon_<?= $service["ID"] ?>"
               class="<?= \Bitrix\Main\Text\HtmlFilter::encode($service["ICON"]) ?> dp-social__link"
               href="javascript:void(0)" onclick="<?= \Bitrix\Main\Text\HtmlFilter::encode($onclick) ?>"
               title="<?= \Bitrix\Main\Text\HtmlFilter::encode($service["NAME"]) ?>">
            </a>
            <? if ($service["ONCLICK"] == '' && $service["FORM_HTML"] <> ''):?>
                <div id="bx_socserv_form_<?= $service["ID"] ?>" class="bx-authform-social-popup">
                    <form action="<?= $arParams["AUTH_URL"] ?>" method="post">
                        <?= $service["FORM_HTML"] ?>
                        <?= $hiddens ?>
                        <input type="hidden" name="auth_service_id" value="<?= $service["ID"] ?>"/>
                    </form>
                </div>
            <?endif ?>
        </li>
    <?
    endforeach;
    ?>
</ul>
