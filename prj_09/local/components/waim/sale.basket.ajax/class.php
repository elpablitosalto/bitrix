<?php
namespace Waim\Components;

use Bitrix\Main\Loader;
use Bitrix\Main\Type\DateTime;
use Bitrix\Main\Error;
use Bitrix\Main\Errorable;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Sale\DiscountCouponsManager;
use Bitrix\Sale\Discount\Actions;
use CBitrixComponent;

class SaleBasketAjaxComponent extends CBitrixComponent implements Controllerable, Errorable
{
	protected ErrorCollection $errorCollection;
	private $basket;

	public function onPrepareComponentParams($arParams)
	{
		$this->errorCollection = new ErrorCollection();

		return $arParams;
	}

	public function executeComponent()
	{
		$this->basket = new \Mirvendinga\Basket();
		$this->setResultData();
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

	private function setResultData() {
		$this->arResult = [
			'NUM_PRODUCTS' => $this->basket->getNumberOfProducts()
		];
	}

	// Actions
	public function configureActions(): array
	{
		return [
			'addShopingListToCart' => [
				'prefilters' => [
					// new ActionFilter\Authentication(), // проверяет авторизован ли пользователь
				]
			],
			'removeItem' => [
				'prefilters' => [
					// new ActionFilter\Authentication(), // проверяет авторизован ли пользователь
				]
			]
		];
	}

	public function removeItemAction($productId): array
	{
		$this->basket = new \Mirvendinga\Basket();

		try {
			$this->basket->removeItem($productId);

			return [
				"message" => "Товар удален",
				"quantity" => $this->basket->getNumberOfProducts()
			];

		} catch (\Exception $e) {
			$this->errorCollection[] = new Error($e->getMessage());

			return [
				"message" => "Произошла ошибка",
				"quantity" => $this->basket->getNumberOfProducts()
			];
		}
	}

	// $_REQUEST['item'] будет передан в $item
	public function addShopingListToCartAction($shoppingList): array
	{
		$this->basket = new \Mirvendinga\Basket();

		try {
			foreach($shoppingList as $item) {
				if(!empty($item['id'])) {
					$quantity = !empty($item['quantity']) ? $item['quantity'] : 1;
					$this->addItemToCart($item['id'], $quantity);
				}
			}
			return [
				'items' => $shoppingList,
				"quantity" => $this->basket->getNumberOfProducts()
			];
		} catch (\Exception $e) {
			$this->errorCollection[] = new Error($e->getMessage());

			return [
				"message" => "Произошла ошибка",
				"quantity" => $this->basket->getNumberOfProducts()
			];
		}
	}

	public function addItemToCart($productId, $quantity = 1) {
		if(!isEmpty($productId)) {
			$item = $this->basket->getBasketItemByProductId($productId);

			if($item) {
				if (!isEmpty($item->getField('QUANTITY'))) {
					if($item->getField('QUANTITY') !== $quantity) {
						// Обновляем количество
						$this->basket->setItemField($productId, 'QUANTITY', $quantity);
					}
				}
			} else {
				$this->basket->createItem($productId, $quantity);
			}
		}
	}
}