<?

use \Bitrix\Main\Page\Asset;

class TemplateTools
{
    public static function showJS()
    {
        $pageCode = self::getCurPageCode();
        if (self::checkShowJS($pageCode, 'jquery.actual')) { // home
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/jquery.actual.min.js");
        }
        if (self::checkShowJS($pageCode, 'jqModal')) { // home
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/jqModal.js");
        }
        if (self::checkShowJS($pageCode, 'jquery.fancybox')) { // home
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/jquery.fancybox.js");
        }
        if (self::checkShowJS($pageCode, 'jquery.history')) { // home
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/jquery.history.js");
        }
        if (self::checkShowJS($pageCode, 'jquery.flexslider')) { // home
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/jquery.flexslider.js");
        }
        if (self::checkShowJS($pageCode, 'jquery.validate.min')) { // home
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/jquery.validate.min.js");
        }
        if (self::checkShowJS($pageCode, 'jquery.inputmask.bundle')) { // home
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/jquery.inputmask.bundle.min.js");
        }
        if (self::checkShowJS($pageCode, 'jquery.easing.1.3')) { // home
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/jquery.easing.1.3.js");
        }
        if (self::checkShowJS($pageCode, 'equalize')) { // home
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/equalize.min.js");
        }
        if (self::checkShowJS($pageCode, 'jquery.alphanumeric')) { // home
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/jquery.alphanumeric.js");
        }
        if (self::checkShowJS($pageCode, 'jquery.cookie')) { // home
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/jquery.cookie.js");
        }
        if (self::checkShowJS($pageCode, 'jquery.plugin')) { // home
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/jquery.plugin.min.js");
        }
        if (self::checkShowJS($pageCode, 'jquery.countdown')) { // home
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/jquery.countdown.min.js");
        }
        if (self::checkShowJS($pageCode, 'jquery.countdown-ru')) { // home
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/jquery.countdown-ru.min.js");
        }
        if (self::checkShowJS($pageCode, 'jquery.ikSelect')) { // home
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/jquery.ikSelect.js");
        }
        if (self::checkShowJS($pageCode, 'sly')) { // home
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/sly.js");
        }
        if (self::checkShowJS($pageCode, 'jquery.mousewheel-3.0.6')) { // home
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/jquery.mousewheel-3.0.6.min.js");
        }
        if (self::checkShowJS($pageCode, 'jquery.mCustomScrollbar')) { // home
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/jquery.mCustomScrollbar.min.js");
        }
        if (self::checkShowJS($pageCode, 'equalize_ext')) { // home
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/equalize_ext.js");
        }
        if (self::checkShowJS($pageCode, 'velocity')) { // home
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/velocity.js");
        }
        if (self::checkShowJS($pageCode, 'velocity.ui')) { // home
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/velocity.ui.js");
        }
        if (self::checkShowJS($pageCode, 'xzoom')) { // home
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/xzoom.js");
        }
        if (self::checkShowJS($pageCode, 'scrollTabs')) { // home
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/scrollTabs.js");
        }
        if (self::checkShowJS($pageCode, 'main')) { // home
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/main.js");
        }
        if (self::checkShowJS($pageCode, 'custom')) { // home
            Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js_custom/custom.js", true);
        }
    }

    public static function checkShowCSS($pageCode, $css_file_code)
    {
        $result = true;

        $arCssFilesPagesCodes = array(
            'home' => array(
                //'xzoom.min',
                //'xzoom',
                'custom',
                //'animation_ext',
                //'jquery.mCustomScrollbar.min',
            ),
        );
        if (!empty($pageCode) && !empty($css_file_code) && !empty($arCssFilesPagesCodes[$pageCode])) {
            if (!in_array($css_file_code, $arCssFilesPagesCodes[$pageCode])) {
                $result = false;
            }
        }

        return $result;
    }

    public static function checkShowJS($pageCode, $js_file_code)
    {
        $result = true;

        //echo '2';

        /*
        $arJSFilesCodes = array(
            'jquery.actual', 'jqModal', 'jquery.fancybox', 'jquery.history', 'jquery.flexslider',
            'jquery.validate', 'jquery.inputmask.bundle', 'jquery.easing.1.3', 'equalize', 'jquery.alphanumeric',
            'jquery.cookie', 'jquery.plugin', 'jquery.countdown', 'jquery.countdown-ru', 'jquery.ikSelect',
            'sly', 'equalize_ext', 'main', 'custom'
        );
        */

        $arJsFilesPagesCodes = array(
            'home' => array(
                'jquery.actual',
                'jquery.flexslider',
                'jquery.cookie',
                'main',
                'custom',
                'jqModal', 
                'jquery.fancybox', 
                'jquery.validate.min', 
                'jquery.inputmask.bundle',
                'jquery.alphanumeric',
                //'jquery.countdown',
                //'jquery.countdown-ru',
                'jquery.ikSelect', 
                'jquery.plugin',
                'sly',
                //'jquery.mousewheel-3.0.6',
                //'jquery.mCustomScrollbar',
                'equalize',
                'jquery.history',
                //'jquery.easing.1.3',
                'equalize_ext',
                //'velocity',
                //'velocity.ui',
                //'xzoom',
                'scrollTabs',
            ),
        );

        //echo 'pageCode = '.$pageCode.'; ';
        //echo 'js_file_code = '.$js_file_code.'; ';
        //echo 'in_array = '.in_array($js_file_code, $arJsFilesPagesCodes[$pageCode]).'; ';
        //vardump($arJsFilesPagesCodes[$pageCode]);

        if (!empty($pageCode) && !empty($js_file_code) && !empty($arJsFilesPagesCodes[$pageCode])) {
            if (!in_array($js_file_code, $arJsFilesPagesCodes[$pageCode])) {
                $result = false;
            }
        }
        //echo 'result = '.$result.'; ';

        return $result;
    }

    public static function getCurPageCode()
    {
        global $APPLICATION;

        $arPages = array(
            'home' => array(
                'urls' => array('/', '/index.php'),
            )
        );

        $page = $APPLICATION->GetCurPage();

        $code = '';

        foreach ($arPages as $key => $val) {
            if (in_array($page, $val['urls'])) {
                $code = $key;
            }
        }

        return $code;
    }
}
