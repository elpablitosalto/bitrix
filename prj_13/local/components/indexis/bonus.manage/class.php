<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc,
	Bitrix\Main\Loader;

class IndexisBonusManage extends CBitrixComponent
{
    protected function checkParams()
    {
        if (empty($this->arParams['USER_ID'])) {
            ShowError(Loc::getMessage('BONUS_MANAGE_NO_USER_ID'));
            return;
        }
    }

	protected function getUserBalance()
	{
        return CSaleUserAccount::GetList(array(), array('USER_ID' => $this->arParams['USER_ID']))->Fetch();
	}

	public function executeComponent()
	{
		$this->includeComponentLang('class.php');

		if (!Loader::includeModule('sale'))
			return;

		$this->arResult = $this->getUserBalance();

        $this->includeComponentTemplate();
	}
}
