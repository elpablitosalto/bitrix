<?
namespace Hair;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Main\Loader; 
use \Bitrix\Highloadblock; 
use \Bitrix\Main\Entity;

class HL {
    public $arResult;

    public function getList($id,$select = ['*'], $filter = [], $order = []) {
        $hlblock = Highloadblock\HighloadBlockTable::getById($id)->fetch(); 

        $entity = Highloadblock\HighloadBlockTable::compileEntity($hlblock); 
        $entity_data_class = $entity->getDataClass(); 

        $rsData = $entity_data_class::getList(array(
            "select" => $select,
            "order" => $order,
            "filter" => $filter
        ));

        while($arData = $rsData->Fetch()){
            $this->arResult[$arData['UF_CODE']] = $arData;
        }

        return $this->arResult;
    }

}