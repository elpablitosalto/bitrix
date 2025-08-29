'use strict';
var WaimAjaxBasket;

document.addEventListener("DOMContentLoaded", function (event) {
	WaimAjaxBasket = (function () {
		// Props
		var isReady = false,
			shoppingList = window.shoppingList || {},
			nodes = {};

		// Methods
		var
			_init = function () {
				nodes = _initNodes();
				_setNodes();
				_addEventListeners();
				isReady = true;
			},

			_initNodes = function () {
				return {
					cartPanel: document.getElementById('cartPanel'),
					numbeOfBasketProducts: document.getElementById('numberOfBasketProducts'),
					numbeOfListProducts: document.getElementById('numberOfListProducts'),
					addAllToShopingList: document.getElementById('addAllToShopingList'),
					addShoppingListToCart: document.getElementById('addShoppingListToCart'),
					addToShopingList: document.querySelectorAll('[data-product-add-to-list]'),
					addToCard: document.querySelectorAll('[data-product-add-to-card]'),
					removeFromCart: document.querySelectorAll('[data-product-remove-from-card]'),
					quantityInput: document.querySelectorAll('[data-product-quantity]'),
					items: {},
				}
			},

			_setNodes = function () {
				var items = document.querySelectorAll('[data-product]');

				items.forEach(function (item) {
					var itemId = item.dataset.product;

					if (typeof itemId !== 'undefined') {
						nodes.items[itemId] = item
					}
				});
			},

			_addEventListeners = function () {
				// AddToList button
				if (nodes.addToShopingList) {
					nodes.addToShopingList.forEach(function (item) {
						item.addEventListener('change', function (e) {
							console.log('checked', e.target.checked);
							var itemId = e.currentTarget.dataset.productItem,
								productId = e.currentTarget.dataset.productId;

							if (itemId && productId) {
								if (e.target.checked) {
									_addToShoppingList(productId, itemId);
								} else {
									_removeFromShoppingList(productId, itemId);
								}
							}
						});
					});
				}

				// Add to Card
				if (nodes.addToCard) {
					nodes.addToCard.forEach(function (item) {
						item.addEventListener('click', function (e) {
							var button = e.currentTarget,
								itemId = button.dataset.productItem,
								productId = button.dataset.productId,
								packageAmount = button.dataset.packageAmount,
								productCard = button.closest('.product-snippet'),
								productDetail = button.closest('.product-card');
							/*console.log('###########################')
							console.log('###########################')
							console.log('###########################')
							console.log(productDetail)
							console.log('###########################')
							console.log('###########################')
							console.log('###########################')
							console.log('###########################')*/
							if (button.classList.contains('button_state_alt-content')) {
								window.location.assign('/personal/cart/');
								return;
							}

							button.classList.add('button_state_loading');
							button.disabled = true;

							console.log('addToCard', productId, itemId);
							if (itemId && productId) {
								_addToShoppingList(productId, itemId, false, true, packageAmount);
								_addShoppingListToCart(function () {
									button.classList.add('button_state_alt-content');
									setTimeout(function () {
										if (productCard) {
											var hide_count = productCard.getAttribute('data-hide-count');
											if( hide_count == undefined || hide_count != 'N' ){
											productCard.classList.add('product-snippet_state_added');
											} else {
												doAfterAdd2BasketInDetail($(button));
											}
										} else if (productDetail) {
											var hide_count = productDetail.getAttribute('data-hide-count');
											if( hide_count == undefined || hide_count != 'N' ){
												productDetail.classList.add('product-card_state_added');
											} else {
												doAfterAdd2BasketInDetail($(button));
											}
										}
										button.classList.remove('button_state_loading');
										button.disabled = false;
									}, 1000)
								});
							}
						});
					});
				}

				// Remove from cart button
				if (nodes.removeFromCart) {
					nodes.removeFromCart.forEach(function (item) {
						item.addEventListener('click', function (e) {
							var itemId = e.currentTarget.dataset.productItem,
								productId = e.currentTarget.dataset.productId;
							if (itemId && productId) _removeFromCart(productId, itemId);
						});
					});
				}

				// Quantity
				if (nodes.quantityInput) {
					nodes.quantityInput.forEach(function (input) {
						input.addEventListener('change', function (e) {
							var itemId = e.currentTarget.dataset.productItem,
								productId = e.currentTarget.dataset.productId,
								quantity = e.currentTarget.dataset.value || null;
							if (itemId && productId && typeof shoppingList[itemId] !== 'undefined') _addToShoppingList(productId, itemId, quantity);
						})
					});
				}

				// All To ShoppingList
				if (nodes.addAllToShopingList) {
					nodes.addAllToShopingList.addEventListener('change', function (e) {
						if (e.target.checked) {
							_addAllToShopingList();
						} else {
							shoppingList = {};
						}

						_shoppingListHasChanged();
					});

					// ShoppingList to Cart
					if (nodes.addShoppingListToCart) {
						nodes.addShoppingListToCart.addEventListener('click', function (e) {
							var listButton = e.target.closest('.button'),
								productIds = Object.keys(shoppingList),
								productButtons = [],
								productCards = [];

							listButton.classList.add('button_state_loading');
							listButton.disabled = true;

							console.log(productIds);
							productIds.forEach(function(id) {
								var product = document.querySelector('[data-product="' + id + '"]');
								if (product) {
									var button = product.querySelector('[data-product-add-to-card]');
									button.classList.add('button_state_loading');
									button.disabled = true;

									productCards.push(product);
									productButtons.push(button);
								}
							});

							_addShoppingListToCart(function () {
								setTimeout(function () {
									listButton.classList.remove('button_state_loading');

									productButtons.forEach(function(button, i) {
										console.log(button);
										button.classList.add('button_state_alt-content');
										button.classList.remove('button_state_loading');
										button.disabled = false;
										productCards[i].classList.add('product-snippet_state_added')
									});
								}, 1000)
							});
						});
					}
				}
			},

			_addShoppingListToCart = function (callback) {
				if (Object.keys(shoppingList).length) {
					window.BX.ajax.runComponentAction("waim:sale.basket.ajax", "addShopingListToCart", {
						mode: 'class',
						data: {
							shoppingList: shoppingList
						}
					}).then(function (result) {
						console.log('result', result);
						if (typeof result.data !== 'undefined') {
							if (typeof result.status !== 'undefined') {
								if (result.status === 'success') {
									let evt = new CustomEvent('basket_add', { detail: {} });
									document.dispatchEvent(evt);
									// _checkItems(shoppingList);
								}
							} else {
								console.log('Произошла ошибка добавления товара в корзину')
							}
							var quantity = result.data.quantity || 0;
							_updateNumbeOfCartProducts(quantity);
						}
						shoppingList = {};
						if (typeof callback === 'function') callback();
						_shoppingListHasChanged();
					}).catch(function () {
						console.log('Произошла ошибка добавления товара в корзину')
						// Ошибки
					});
				}
			},

			_checkItems = function () {
				nodes.addToShopingList.forEach(function (item) {
					var itemId = item.dataset.productItem;
					if (typeof shoppingList[itemId] !== 'undefined') {
						item.checked = true;
					}
				});
			},

			_uncheckItems = function (items) {
				nodes.addToShopingList.forEach(function (item) {
					item.checked = false;
				});
			},

			_addAllToShopingList = function () {
				if (nodes.items) {
					Object.values(nodes.items).map(function (item) {
						var productId = item.dataset.productId,
							itemId = item.dataset.product,
							buyButton = item.querySelector('[data-product-add-to-card]');

						if (productId && itemId && buyButton) _addToShoppingList(productId, itemId);
					});
				}
			},

			_addToShoppingList = function (productId, itemId, quantity, silent = false, packageAmount) {
				if (!quantity) {
					quantity = _getProductQuantity(productId, itemId);
				}

				if (productId && itemId && quantity) {
					shoppingList[itemId] = {
						id: parseInt(productId),
						quantity: parseInt(quantity)
					}
				}

				if(packageAmount > 1){
					shoppingList[itemId]["packageAmount"] = packageAmount;
				}

				if (!silent) _shoppingListHasChanged();
			},

			_removeFromShoppingList = function (productId, itemId, quantity) {

				if (typeof shoppingList[itemId] !== 'undefined') {
					delete (shoppingList[itemId]);
				}

				_shoppingListHasChanged();
			},

			_removeFromCart = function (productId, itemId) {
				window.BX.ajax.runComponentAction("waim:sale.basket.ajax", "removeItem", {
					mode: 'class',
					data: {
						productId: productId
					}
				}).then(function (result) {
					if (typeof result.data !== 'undefined') {
						if (typeof result.status !== 'undefined') {
							if (result.status === 'success') {
								var list = {};
								list[itemId] = {
									id: itemId
								};
								_uncheckItems(list);
							}
						} else {
							console.log('Произошла ошибка удаления товара из корзины')
						}
						var quantity = result.data.quantity || 0;
						_updateNumbeOfCartProducts(quantity);
					}
					shoppingList = {};
					_shoppingListHasChanged();
				}).catch(function () {
					console.log('Произошла ошибка добавления товара в корзину')
					// Ошибки
				});
			},

			_shoppingListHasChanged = function () {
				var numberOfProducts = _getNumberOfListProducts();
				if (nodes.numbeOfListProducts) nodes.numbeOfListProducts.innerHTML = numberOfProducts;
				if (numberOfProducts) {
					nodes.addShoppingListToCart.disabled = false;
					_checkItems();
				} else {
					nodes.addShoppingListToCart.disabled = true;
					_uncheckItems();
					addAllToShopingList.checked = false;
				}


			},

			_getNumberOfListProducts = function () {
				return Object.keys(shoppingList).length;
			},

			_updateNumbeOfCartProducts = function ($number) {
				if (nodes.numbeOfBasketProducts && typeof $number !== 'undefined') nodes.numbeOfBasketProducts.innerHTML = $number;
			},

			_getProductQuantity = function (productId, itemId) {
				var quantity = 1;

				if (productId && itemId && typeof nodes.items[itemId] !== 'undefined') {
					var quantityInput = nodes.items[itemId].querySelector('[data-product-quantity="' + productId + '"]');
					if (quantityInput) quantity = quantityInput.value;
				}

				return quantity;
			},

			_addToCart = function (productId, productQuantity) {
				console.log('_addToCart', productId, productQuantity);
			},

			_error = function (message = '', data = {}) {
				console.error(message, data);
			},

			_moduleIsReady = function () {
				if (!isReady) {
					_error('Не инициализировам модуль каталога. Попробуйте сначала вызвать WaimAjaxBasket.init()');
					return false;
				}
			};

		return {
			init: function () {
				_init();
			},
			addToCart: function (productId, productQuantity = 1) {
				if (_moduleIsReady()) return false;
				if (typeof productId === 'undefined') {
					_error('Не передан ID товара');
					return false;
				}

				_addToCart(productId, productQuantity);
			},
			addToShoppingList: function (productId) {
				if (_moduleIsReady()) return false;
				if (typeof productId === 'undefined') {
					_error('Не передан ID товара');
					return false;
				}
			},
			nodes: function () {
				return nodes;
			},
			reloadNodes: function () {
				console.log(nodes)
				nodes = _initNodes();
				_setNodes();
				console.log(nodes)
			}
		}
	})();
	WaimAjaxBasket.init();

	WaimAjaxBasket.addToShoppingList(10);

	if (typeof BX !== 'undefined') {
		BX.addCustomEvent('onAjaxSuccess', function () {
			setTimeout(function() {
				WaimAjaxBasket.init();
			}, 1000);
		});
	}

	window.addEventListener('popstate', function () {
		if (typeof BX !== 'undefined' && typeof WaimAjaxBasket !== 'undefined') {
			WaimAjaxBasket.init();
		}
	});
});