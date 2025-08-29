<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc,
	Bitrix\Main\Loader;

class IndexisBonusTransactionList extends CBitrixComponent
{
    protected function checkParams()
    {
        if (empty($this->arParams['USER_ID'])) {
            ShowError(Loc::getMessage('BONUS_TRANSACTION_LIST_NO_USER_ID'));
            return;
        }

        if (!isset($this->arParams['TRANSACTION_COUNT']))
            $this->arParams['TRANSACTION_COUNT'] = 20;
    }

	protected function getTransactionList()
	{
        $arItems = [];
        $res = CSaleUserTransact::GetList(Array("ID" => "DESC"), array("USER_ID" => $this->arParams['USER_ID']));
        $res->NavStart($this->arParams['TRANSACTION_COUNT']);
        while ($arFields = $res->Fetch())
            $arItems[] = $arFields;

        $this->arResult['NAV_STRING'] = $res->GetPageNavStringEx($navComponentObject, "", "");

        return $arItems;
	}

	public function executeComponent()
	{
		$this->includeComponentLang('class.php');

		if (!Loader::includeModule('sale'))
			return;

		$this->arResult['ITEMS'] = $this->getTransactionList();

        $this->includeComponentTemplate();
	}
}
