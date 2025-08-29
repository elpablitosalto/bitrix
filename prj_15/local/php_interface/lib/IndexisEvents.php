<?php


class IndexisEvents
{
    public static function OnBeforeUserRegisterHandler(&$arFields)
    {
        if($arFields["PERSONAL_PHONE"]){
            $res =  Bitrix\Main\UserTable::getList([
                'select' => ["ID"],
                'filter' => ["PERSONAL_PHONE" => $arFields["PERSONAL_PHONE"]],
                'limit' => 1
            ]);
            if($res->Fetch()){
                global $APPLICATION;
                $APPLICATION->ThrowException('Пользователь с таким номером телефона уже зарегистрирован');
                return false;
            }
        }
    }


    public static function OnUserLoginSocservHandler($arFields) {
        if($arFields["LOGIN"]){
            $arUser = CUser::GetByLogin($arFields["LOGIN"])->Fetch();
            if(!$arUser['UF_SOC_COMPLETE']){
                ob_start();
                ?>
                <script type="text/javascript">
                    if(window.opener) {
                        window.opener.location = '/?show_complete_window=y';
                    }
                    window.close();
                </script>
                <?php
                $html = ob_get_contents();
                ob_end_clean();

                echo $html;
                die();
            }
        }
    }

}
