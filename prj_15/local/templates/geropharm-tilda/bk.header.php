<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

    $curDir = $APPLICATION->GetCurDir();
?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title><? $APPLICATION->ShowTitle(); ?></title>
        <?
        switch ($curDir) {
            case '/kodjizni/';
                $headerType = 'kodjizni';
                break;
            case '/courses/vygoranie_osnovybalansa/';
                $headerType = 'vygoranie_osnovybalansa';
                break;
            case '/courses/trydnii_pacient/':
                $headerType = 'tp';
                break;
            case '/courses/kalgari_kembridgskaya_model/':
                $headerType = 'kkm';
                break;
            case '/master-class/top_3_tehniki/':
            case '/master-class/goret_no_ne_vigorat/':
                $headerType = 'master-class';
                break;
            default:
                $headerType = 'default';
        }

        require_once($_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/header/' . $headerType . '.php');
        ?>
        <?
        $APPLICATION->ShowHead();
        ?>
    </head>
    <?
        $bodyClass = "t-body";
        if(mb_substr($curDir,0, 14) == "/master-class/")
            $bodyClass = "gc-user-guest";
    ?>
    <body class="<?=$bodyClass?>" style="margin:0;">
<? $APPLICATION->ShowPanel(); ?>