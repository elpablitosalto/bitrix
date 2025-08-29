<?php

namespace lib\usertype;

use \Bitrix\Main,
    \Bitrix\Main\Localization\Loc,
    \Bitrix\Main\UserField,
    Bitrix\Main\Page\Asset;


class StorybookUserType
{
    private static $frameUrl = 'https://nf.khromchenkov.com/storybook/index.html';
    private static $defaultFrameHeight = 500;

     /**
     * @return array
     */
    public static function GetUserTypeDescription()
    {
        return array(
            "PROPERTY_TYPE"         => "S",
            "USER_TYPE"             => 'storybookUserType',
            "DESCRIPTION"           => 'Storybook',
            "CheckFields" => array(__CLASS__, "CheckFields"),
            "GetLength" => array(__CLASS__, "GetLength"),
            "GetPropertyFieldHtml" => array(__CLASS__, "GetPropertyFieldHtml"),
            "GetAdminListViewHTML" => array(__CLASS__, "GetAdminListViewHTML"),
            "GetPublicViewHTML" => array(__CLASS__, "GetPublicViewHTML"),
            "GetSearchContent" => array(__CLASS__, "GetSearchContent"),
            "GetSettingsHTML" => array(__CLASS__, "GetSettingsHTML"),
            "PrepareSettings" => array(__CLASS__, "PrepareSettings"),
        );
    }

    public static function CheckFields(array $arProperty, array $value)
    {
        $arResult = array();
        if(intval($value["VALUE"]))
        {
            $by = "c_sort";
            $order = "asc";
            $groups = CGroup::GetList($by, $order, array("ACTIVE" => "Y"));
            $bFound = false;
            while($arGroup = $groups->Fetch())
            {
                if($arGroup["ID"] == $value["VALUE"])
                    $bFound = true;
            }
            if(!$bFound)
                $arResult[] = "Группа пользователей не найдена";
        }
        return $arResult;
    }
    public static function GetLength($arProperty, $value)
    {
        if(is_array($value) && array_key_exists("VALUE", $value))
            return strLen(trim($value["VALUE"]));
        else
            return 0;
    }
    public static function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName)
    {
        $fields = [];
        if (isset($arProperty['USER_TYPE_SETTINGS']) && is_array($arProperty['USER_TYPE_SETTINGS']))
        {
            $fields = $arProperty['USER_TYPE_SETTINGS'];
        }

        $url = !empty($fields['URL']) ? $fields['URL'] : self::$frameUrl;
        $frameHeight = !empty($fields['FRAME_HEIGHT']) ? $fields['FRAME_HEIGHT'] : self::$defaultFrameHeight;

        ob_start();
        ?>
        <?if(!empty($url)):?>
            <iframe src="<?=$url?>" height="<?=$frameHeight?>" width="100%"></iframe>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    (function() {
                        var row = document.getElementById("tr_PROPERTY_<?=$arProperty["ID"]?>");
                        if(row) {
                            var rowLabel = row.querySelector('.adm-detail-content-cell-l');

                            if(rowLabel) {
                                rowLabel.style.display = 'none';
                            }

                            var rowValue = row.querySelector('.adm-detail-content-cell-r');
                            if(rowValue) {
                                rowValue.width = '100%';
                                rowValue.style.width = '100%';
                                rowValue.colSpan = 2;
                            }
                        }
                    })();
                });
            </script>
        <?endif;?>
        <?$result = ob_get_clean();
        return $result;
    }
    public static function GetAdminListViewHTML($arProperty, $value, $strHTMLControlName)
    {
        print_r($strHTMLControlName);
        $group_id = intval($value["VALUE"]);
        if($group_id){
            $arGroup = CGroup::GetByID($value["VALUE"])->Fetch();
            return "[{$arGroup["ID"]}] ".htmlspecialcharsex($arGroup["NAME"]);
        }
        return "&nbsp;";
    }
    public static function GetPublicViewHTML($arProperty, $value, $strHTMLControlName)
    {
        $group_id = intval($value["VALUE"]);
        if($group_id){
            $arGroup = CGroup::GetByID($value["VALUE"])->Fetch();
            return "[{$arGroup["ID"]}] ".htmlspecialcharsex($arGroup["NAME"]);
        }
        return "&nbsp;";
    }

    public static function GetSearchContent($arProperty, $value, $strHTMLControlName)
    {
        if(strlen($value["VALUE"])>0)
            return $value["VALUE"];
        else
            return '';
    }

    public static function GetSettingsHTML($arProperty, $strHTMLControlName, &$arPropertyFields)
    {
        $arPropertyFields = array(
            "HIDE" => array(
                "MULTIPLE",
                "SEARCHABLE",
                "FILTRABLE",
                "WITH_DESCRIPTION",
                "MULTIPLE_CNT",
                "ROW_COUNT",
                "COL_COUNT ",
                "DEFAULT_VALUE",
            ),
            "USER_TYPE_SETTINGS_TITLE" => "Путь к странице Storybook"
        );

        $fields = [];
        if (isset($arProperty['USER_TYPE_SETTINGS']) && is_array($arProperty['USER_TYPE_SETTINGS']))
        {
            $fields = $arProperty['USER_TYPE_SETTINGS'];
        }

        $url = !empty($fields['URL']) ? $fields['URL'] : self::$frameUrl;
        $frameHeight = !empty($fields['FRAME_HEIGHT']) ? $fields['FRAME_HEIGHT'] : self::$defaultFrameHeight;

        return '<tr>
        <td>URL:</td>
        <td><input type="text" name="'.$strHTMLControlName["NAME"].'[URL]" value="'.$url.'"></td>
        </tr><tr>
        <td>Высота фрейма:</td>
        <td><input type="text" name="'.$strHTMLControlName["NAME"].'[FRAME_HEIGHT]" value="'.$frameHeight.'"></td>
        </tr>';
    }

    public static function PrepareSettings($arFields) {
        $fields = [];
        if (isset($arFields['USER_TYPE_SETTINGS']) && is_array($arFields['USER_TYPE_SETTINGS']))
        {
            $fields = $arFields['USER_TYPE_SETTINGS'];
        }

        return [
            'URL' => !empty($fields['URL']) ? $fields['URL'] : self::$frameUrl,
            'FRAME_HEIGHT' => !empty($fields['FRAME_HEIGHT']) ? $fields['FRAME_HEIGHT'] : self::$defaultFrameHeight
        ];
    }
}