<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

$arQuestionsByCodes = [];
foreach($arResult["arQuestions"] as $arQuestion){
    if(mb_strlen($arQuestion["COMMENTS"]) > 0){
        $arQuestion["ANSWERS"] = $arResult["arAnswers"][$arQuestion["SID"]];
        switch ($arQuestion["ANSWERS"][0]["FIELD_TYPE"]){
            case "dropdown":
                $arQuestion["INPUT_CODE"] = "form_dropdown_".$arQuestion["SID"];
                $arQuestion["CURRENT_VALUE"] = $arResult["arrVALUES"][$arQuestion["INPUT_CODE"] ];
                break;
            case "text":
                $arQuestion["INPUT_CODE"] = "form_text_".$arQuestion["ANSWERS"][0]["ID"];
                $arQuestion["CURRENT_VALUE"] = $arResult["arrVALUES"][$arQuestion["INPUT_CODE"] ];
                break;
            case "email":
                $arQuestion["INPUT_CODE"] = "form_email_".$arQuestion["ANSWERS"][0]["ID"];
                $arQuestion["CURRENT_VALUE"] = $arResult["arrVALUES"][$arQuestion["INPUT_CODE"] ];
                break;
        }
        $arQuestionsByCodes[$arQuestion["COMMENTS"]] = $arQuestion;
    }
}
$arResult["arQuestions"] = $arQuestionsByCodes;
unset($arQuestionsByCodes);

?>