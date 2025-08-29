<?
class CMarkingOG
{
    public static function show()
    {
        global $APPLICATION;

        $ogUrl = $APPLICATION->GetProperty("OG_URL");
        $host = 'https://kamenniyvek.info';
        //$url =  $host . '/' . $ogUrl;
        $url =  $host . $ogUrl;
?>
        <meta property="og:title" content="<? $APPLICATION->ShowTitle(); ?>">
        <meta property="og:site_name" content="Каменный век">
        <meta property="og:url" content="<?= $url; ?>">
        <meta property="og:description" content="<? $APPLICATION->ShowProperty("OG_DESCRIPTION"); ?>">
        <meta property="og:image" content="<?=$host;?><? $APPLICATION->ShowProperty("OG_IMAGE"); ?>">
        <meta property="og:image:width" content="<? $APPLICATION->ShowProperty("OG_IMAGE_WIDTH"); ?>" />
        <meta property="og:image:height" content="<? $APPLICATION->ShowProperty("OG_IMAGE_HEIGHT"); ?>" />
<?
    }

    public static function setPageProps()
    {
        global $APPLICATION;
        //echo 'OG_DESCRIPTION = '.$GLOBALS['OG_DESCRIPTION'].'<br />';
        if (!empty($GLOBALS['OG_DESCRIPTION'])) {
            $APPLICATION->SetPageProperty("OG_DESCRIPTION", $GLOBALS['OG_DESCRIPTION']);
        }
        if (!empty($GLOBALS['OG_IMAGE'])) {
            $APPLICATION->SetPageProperty("OG_IMAGE", $GLOBALS['OG_IMAGE']);
        }
        if (!empty($GLOBALS['OG_IMAGE_WIDTH'])) {
            $APPLICATION->SetPageProperty("OG_IMAGE_WIDTH", $GLOBALS['OG_IMAGE_WIDTH']);
        }
        if (!empty($GLOBALS['OG_IMAGE_HEIGHT'])) {
            $APPLICATION->SetPageProperty("OG_IMAGE_HEIGHT", $GLOBALS['OG_IMAGE_HEIGHT']);
        }
    }

    public static function getDataFromIB($arParams = array())
    {
        $arResult = array();

        return $arResult;
    }

    public static function getGlobalData($arParams = array())
    {
        $arResult = array();

        //vardump($arParams);

        $TEXT_MAX_LEN = $arParams['TEXT_MAX_LEN'];
        if (intval($TEXT_MAX_LEN) <= 0) {
            $TEXT_MAX_LEN = 500;
        }

        $obParser = new CTextParser;
        $description = strip_tags($arParams['DESCRIPTION']);
        $description = trim( $description );
        $description = str_replace(array("\r", "\n"), '', $description);
        $description = $obParser->html_cut($description, $TEXT_MAX_LEN);

        //echo 'description = '.$description.'<br />';

        $arResult['OG_DESCRIPTION'] = $description;

        $arResult['OG_IMAGE'] = $arParams['PICTURE'];

        return $arResult;
    }

    public static function setGlobalData($arParams = array())
    {
        global $APPLICATION;

        $arResult = array();

        $GLOBALS['OG_DESCRIPTION'] = $arParams['OG_DESCRIPTION'];
        $GLOBALS['OG_IMAGE'] = $arParams['OG_IMAGE'];
        $GLOBALS['OG_URL'] = $APPLICATION->GetCurUri("", false);

        return $arResult;
    }
}
?>