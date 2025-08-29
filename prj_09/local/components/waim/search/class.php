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

class SearchComponent extends CBitrixComponent implements Controllerable, Errorable
{
	protected ErrorCollection $errorCollection;
	private $queryStr = null;
	private $resultStr = '';
	private $resultNumbers = 0;
	private $resultType = 'empty';
	private $groups = [];
	private $currentGroup = [];


	public function onPrepareComponentParams($arParams)
	{
		$this->errorCollection = new ErrorCollection();

		return $arParams;
	}

	public function executeComponent()
	{
		$this->setQueryStr();

		if (!empty($this->queryStr)) {
			$this->setGroups();

			if (!empty($this->groups)) {
				$this->setType();
				$this->setCurrentGroup();
				$this->setNumbers();
				$this->setResultStr();
				$this->setResultData();
			}
		}

		// Посчитаем сколько нашлось групп -->
		$countGroups = 0;
		foreach ($this->arParams['GROUPS'] as $arGroup) {
			if (!empty($this->groups[$arGroup['CODE']]['ITEMS'])) {
				$countGroups++;
			}
		}
		// <-- 

		if ($this->arParams['SHOW_TYPE'] == 'ALL' && $countGroups > 1) {
			$this->includeComponentTemplate('all');
		} else {
			$this->includeComponentTemplate($this->resultType);
		}
	}

	public function getErrors(): array
	{
		return $this->errorCollection->toArray();
	}

	public function getErrorByCode($code): Error
	{
		return $this->errorCollection->getErrorByCode($code);
	}

	private function setGroups()
	{
		if (!empty($this->arParams['GROUPS'])) {
			foreach ($this->arParams['GROUPS'] as $arGroup) {
				if (!empty($arGroup['CODE'])) {
					$arGroup['URL'] = $this->getGroupUrl($arGroup);
					$arGroup['ITEMS'] = $this->getSearchItems($arGroup);
					$this->groups[$arGroup['CODE']] = $arGroup;
				}
			}
		}
		//vardump($this->groups);

		$this->filterCatalogItems();
		$this->filterPromoItems();
	}

	private function filterCatalogItems()
	{
		if (!empty($this->groups['catalog']['ITEMS'])) {
			$arNewItems = array();
			$arSelect = array("ID");
			$arFilter = array(
				"ID" => $this->groups['catalog']['ITEMS'],
				"ACTIVE_DATE" => "Y",
				"ACTIVE" => "Y",
				'!IBLOCK_SECTION_ID' => false
			);
			$res = \CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
			while ($ob = $res->GetNextElement()) {
				$arFields = $ob->GetFields();
				$arNewItems[] = $arFields['ID'];
			}
			$this->groups['catalog']['ITEMS'] = $arNewItems;
		}
	}

	private function filterPromoItems()
	{
		//vardump($this->groups['promo']['ITEMS']);
		if (!empty($this->groups['promo']['ITEMS'])) {
			$arNewItems = array();
			$arSelect = array("ID");
			$arFilter = array(
				"ID" => $this->groups['promo']['ITEMS'],
				"ACTIVE_DATE" => "Y",
				"ACTIVE" => "Y",
				//'!IBLOCK_SECTION_ID' => false
			);
			$res = \CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
			while ($ob = $res->GetNextElement()) {
				$arFields = $ob->GetFields();
				$arNewItems[] = $arFields['ID'];
			}
			$this->groups['promo']['ITEMS'] = $arNewItems;
		}
		//vardump($this->groups['promo']['ITEMS']);
	}

	private function getSearchItems($arGroup)
	{
		$items = [];

		if (!empty($arGroup['IBLOCK_ID']) && !empty($this->queryStr)) {
			$obSearch = new \CSearch;
			$q = $this->queryStr;
			$obSearch->Search(
				array(
					"QUERY" => $q,
					"=MODULE_ID" => "iblock",
					"=PARAM2" => array($arGroup['IBLOCK_ID']),
					/*"PARAMS" => [
                        "SEARCH_PAGE" => 'Y'
                    ]*/
				)
			);

			while ($arItem = $obSearch->fetch()) {
				$items[] = $arItem['ITEM_ID'];
			}

			//vardump($items);
		}

		return $items;
	}

	private function setCurrentGroup()
	{
		if (!empty($this->groups[$this->resultType])) {
			$this->currentGroup = $this->groups[$this->resultType];
		}
	}

	private function setNumbers()
	{
		if (!empty($this->groups[$this->resultType]['ITEMS'])) {
			$this->resultNumbers = count($this->groups[$this->resultType]['ITEMS']);
		}
	}

	private function getGroupUrl($arGroup)
	{
		$url = null;

		if (!empty($arGroup['CODE'])) {
			$ap = new \CMain();
			$groupParamStr = 'group=' . $arGroup['CODE'];
			$url = $ap->GetCurPageParam($groupParamStr, ['group']);
		}

		return $url;
	}

	private function setQueryStr()
	{
		$request = Context::getCurrent()->getRequest();
		$request->getQueryList()->toArray();
		$query = $request->get('q');
		$query = strip_tags($query);
		$query = htmlspecialchars($query);

		$this->queryStr = $query;
	}

	private function setType()
	{
		$request = Context::getCurrent()->getRequest();
		$request->getQueryList()->toArray();
		$type = $request->get('group');
		$type = strip_tags($type);
		$type = htmlspecialchars($type);

		//vardump($this->groups);

		//echo 'type = '.$type.'<br />';

		if (empty($type)) {
			foreach ($this->groups as $arGroup) {
				//echo 'CODE = '.$arGroup['CODE'].'<br />';
				if (!empty($arGroup['ITEMS']) && !empty($arGroup['CODE']) && $this->resultType === 'empty') {
					$type = $arGroup['CODE'];
					$this->resultType = $type;
				}
			}
		}

		//echo 'type = '.$type.'<br />';

		if (!empty($type)) $this->resultType = $type;
	}

	private function setResultStr()
	{
		if (!empty($this->queryStr)) {
			$one = !empty($this->arParams['RESULT_LABEL']['ONE']) ? $this->arParams['RESULT_LABEL']['ONE'] : 'результат';
			$four = !empty($this->arParams['RESULT_LABEL']['ONE']) ? $this->arParams['RESULT_LABEL']['FOUR'] : 'результата';
			$five = !empty($this->arParams['RESULT_LABEL']['ONE']) ? $this->arParams['RESULT_LABEL']['FIVE'] : 'результатов';

			$resultDeclension = new Declension($one, $four, $five);
			$this->resultStr = $this->resultNumbers . ' ' . $resultDeclension->get($this->resultNumbers);
		}
	}

	private function setResultData()
	{
		$this->arResult = [
			'QUERY_STR' => $this->queryStr,
			'NUMBERS' => $this->resultNumbers,
			'RESULT_STR' => $this->resultStr,
			'TYPE' => $this->resultType,
			'GROUPS' => $this->groups,
			'CURRENT' => $this->currentGroup,
			'CATALOG' => $this->groups['catalog'],
			'PROMO' => $this->groups['promo'],
		];
	}

	// Actions
	public function configureActions(): array
	{
		return [];
	}
}
