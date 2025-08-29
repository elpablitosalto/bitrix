<?php
namespace Waim\Components;

use Bitrix\Main\Loader;
use Bitrix\Main\Type\DateTime;
use Bitrix\Main\Error;
use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Context;
use Bitrix\Main\Grid\Declension;
use Bitrix\Sale\DiscountCouponsManager;
use Bitrix\Sale\Discount\Actions;
use CBitrixComponent;

class SearchFormComponent extends CBitrixComponent implements Controllerable, Errorable
{
	protected ErrorCollection $errorCollection;
	private $queryStr = null;

	public function onPrepareComponentParams($arParams)
	{
		$this->errorCollection = new ErrorCollection();

		return $arParams;
	}

	public function executeComponent()
	{
		$this->setQueryStr();
		$this->setResultData();

		$this->includeComponentTemplate($this->resultType);
	}

	public function getErrors(): array
	{
		return $this->errorCollection->toArray();
	}

	public function getErrorByCode($code): Error
	{
		return $this->errorCollection->getErrorByCode($code);
	}


	private function setQueryStr() {
		$request = Context::getCurrent()->getRequest();
		$request->getQueryList()->toArray();
		$query = $request->get('q');
		$query = strip_tags($query);
		$query = htmlspecialchars($query);

		$this->queryStr = $query;
	}

	private function setResultData() {
		$this->arResult = [
			'FORM_ACTION' => !empty($this->arParams['SEARCH_PAGE']) ? $this->arParams['SEARCH_PAGE'] : '',
			'SEARCH_QUERY' => $this->queryStr,
			'PLACEHOLDER' => !empty($this->arParams['PLACEHOLDER']) ? $this->arParams['PLACEHOLDER'] : ''
		];
	}

	// Actions
	public function configureActions(): array
	{
		return [

		];
	}
}