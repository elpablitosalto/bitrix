<?
namespace Mirvendinga;

use \Bitrix\Main\Loader;

class Users {

    public static function getUserContacts($userId){
        $arResult = [];
        if(Loader::includeModule("iblock")){
            $rsContacts = \CIBlockElement::GetList(["SORT" => "ASC"], ["IBLOCK_ID" => CONTACTS_IB_ID, "ACTIVE" => "Y", "PROPERTY_USER_ID" => $userId]);
            while ($contact = $rsContacts->GetNextElement()){
                $arFields = $contact->GetFields();
                $arProps = $contact->GetProperties();
                $arProps["NAME"]["VALUE"] = $arFields["NAME"];
                $arResult[$arFields["NAME"]] = array_merge($arFields, array("PROPERTIES" => $arProps));
            }
        }
        return $arResult;
    }

    public static function getUserCompanies($userId){
        $arResult = [];
        if(Loader::includeModule("iblock")){
            $rsCompanies = \CIBlockElement::GetList(["SORT" => "ASC"], ["IBLOCK_ID" => COMPANIES_IB_ID, "ACTIVE" => "Y", "PROPERTY_USER_ID" => $userId]);
            while ($company = $rsCompanies->GetNextElement()){
                $arCompanyFields = $company->GetFields();
                $arCompanyProps = $company->GetProperties();
                $arCompanyProps["NAME"]["VALUE"] = $arCompanyFields["NAME"];
                $arResult[$arCompanyFields["NAME"]] = array_merge($arCompanyFields, array("PROPERTIES" => $arCompanyProps));
                if(!empty($arCompanyProps["CONTACTS"]["VALUE"])) {
                    $rsContacts = \CIBlockElement::GetList(["SORT" => "ASC"], ["IBLOCK_ID" => CONTACTS_IB_ID, "ACTIVE" => "Y", "PROPERTY_USER_ID" => $userId, "ID" => $arCompanyProps["CONTACTS"]["VALUE"]]);
                    while ($contact = $rsContacts->GetNextElement()) {
                        $arContactFields = $contact->GetFields();
                        $arContactProps = $contact->GetProperties();
                        $arContactProps["NAME"]["VALUE"] = $arContactFields["NAME"];
                        $arResult[$arCompanyFields["NAME"]]["CONTACTS"][$arContactFields["NAME"]] = array_merge($arContactFields, array("PROPERTIES" => $arContactProps));
                    }
                }
            }
        }
        return $arResult;
    }
}