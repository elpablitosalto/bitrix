<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрационное соглашение");
?>
<div class="row">
    <div class="col-lg-3 order-lg-1">
        <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "indexis_about_menu",
            array(
                "COMPONENT_TEMPLATE" => "vertical_multilevel",
                "ROOT_MENU_TYPE" => "about",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "MENU_CACHE_GET_VARS" => array(
                ),
                "MAX_LEVEL" => "2",
                "CHILD_MENU_TYPE" => "footer_sub_about",
                "USE_EXT" => "Y",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "N"
            ),
            false
        );?>
    </div>
    <div class="col-lg-9 order-lg-0">
        <div class="ml-page-content">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                ".default",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "",
                    "AREA_FILE_RECURSIVE" => "Y",
                    "EDIT_TEMPLATE" => "standard.php",
                    "COMPONENT_TEMPLATE" => ".default",
                    "PATH" => "content.php"
                ),
                false
            );?>
        </div>
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>