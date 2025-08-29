<?php
namespace Waim\Components;

use Bitrix\Main\Loader;
use Bitrix\Main\Error;
use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\Contract\Controllerable;
use CBitrixComponent;

class FavoriteItems extends CBitrixComponent implements Controllerable, Errorable
{
	protected ErrorCollection $errorCollection;
    private $favorites = null;

	public function onPrepareComponentParams($arParams)
	{
		$this->errorCollection = new ErrorCollection();
        $this->favorites =  new \Mirvendinga\Favorites();
		return $arParams;
	}

	public function executeComponent()
	{
        $this->arResult = $this->favorites->getFavoritesList();
		$this->includeComponentTemplate();
	}

	public function getErrors(): array
	{
		return $this->errorCollection->toArray();
	}

	public function getErrorByCode($code): Error
	{
		return $this->errorCollection->getErrorByCode($code);
	}

	// Actions
	public function configureActions(): array
	{
		return [
			'toggleFavorite' => [
				'prefilters' => [
					// new ActionFilter\Authentication(), // проверяет авторизован ли пользователь
				]
			]
		];
	}

	public function toggleFavoriteAction(int $productId) : array
    {
        $arResult = [
            "status" => true,
            "quantity" => 0,
        ];
        $currentItems = [];
        $arItems = $this->favorites->getFavoritesList();
        if(is_array($arItems)){
            if(in_array($productId, $arItems)){
                $currentItems = array_diff($arItems, [$productId]);
                $this->favorites->save($currentItems);
            }else{
                $currentItems = array_merge([$productId], $arItems);
                $this->favorites->save($currentItems);
            }
        }
        $arResult["quantity"] = count($currentItems);
        return $arResult;
    }
}