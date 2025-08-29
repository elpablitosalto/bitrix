<?php

use Bitrix\Main\Application;
use Bitrix\Main\Web\Cookie;
// 41868
$arRegionPriceId = 1;
if (!empty($GLOBALS["arRegion"])) {
    $arRegion = $GLOBALS["arRegion"];
} else {
    $arRegion = \Mirvendinga\Geo::getCurrentRegion();
}
if (!empty($arRegion["PRICE_ID"])) {
    $arRegionPriceId = $arRegion["PRICE_ID"];
}
//
$arSortFields = [
    "name"      => ["NAME" => "По алфавиту", "FIELD" => "NAME", "ORDER" => ["asc" => "возрастание", "desc" => "убывание"]],
    "price"     => ["NAME" => "По цене", "FIELD" => "CATALOG_PRICE_" . $arRegionPriceId, "ORDER" => ["asc" => "сначала дешевле", "desc" => "сначала дороже"]],
    "available" => ["NAME" => "По наличию", "FIELD" => "PROPERTY_SORT_AVAILABLE", "ORDER" => ["asc" => "нет в наличии", "desc" => "в наличии"]],
];
$request = Application::getInstance()->getContext()->getRequest();
$cookieSort = Application::getInstance()->getContext()->getRequest()->getCookie("COOKIE_SORT");
$currentUrl = new \Bitrix\Main\Web\Uri($request->getRequestUri());
$currentUrl->deleteParams(["method", "sort"]);
if (!empty($cookieSort)) {
    $cookieSortValues = \Bitrix\Main\Web\Json::decode($cookieSort);
    $sortField = $cookieSortValues["method"]; // поле сортировки из кук
    $sortOrder = $cookieSortValues["sort"]; // направление сортировки из кук
} else {
    $sortField = 'sort'; // поле сортировки по умолчанию
    $sortOrder = 'asc'; // направление сортировки по умолчанию
}
if (!empty($request->get("sort")) && !empty($request->get("method")) && in_array($request->get("sort"), array_keys($arSortFields))) {
    $sortField = $request->get("sort");
    $sortOrder = $request->get("method");
}
// Устанавливаем результаты
$cookie = new Cookie("COOKIE_SORT", \Bitrix\Main\Web\Json::encode(["method" => $sortField, "sort" => $sortOrder]));
$cookie->setPath("/");
Application::getInstance()->getContext()->getResponse()->addCookie($cookie);
$GLOBALS["SORT_FIELD"] = $arSortFields[$sortField]["FIELD"];
$GLOBALS["SORT_ORDER"] = strtoupper($sortOrder);

// Первоначальная сортировка каталога -->
if (!empty($GLOBALS["arRegion"])) {
    $arCurrentRegion = $GLOBALS["arRegion"];
} else {
    $arCurrentRegion = \Mirvendinga\Geo::getCurrentRegion();
}
$megaregionCode = $arCurrentRegion['MEGAREGION_CODE'];
if (!empty($megaregionCode) && $GLOBALS["SORT_FIELD"] != 'PROPERTY_SORT_AVAILABLE') {
    //vardump($arCurrentRegion);
    $GLOBALS["SORT_FIELD_FIRST"] = 'PROPERTY_SORT_' . $megaregionCode;
    $GLOBALS["SORT_ORDER_FIRST"] = 'asc';
}
// <-- 
?>
<div class="catalog__filter-panel">
    <div class="catalog__filter-trigger">
        <!-- begin .filter-trigger-->
        <button class="filter-trigger js-toggle" type="button" data-toggle-scope=".catalog, .page__body" data-toggle-class="catalog_filters_open, frozen-scroll">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="filter-trigger__icon">
                <path d="M14.9103 2.59502C14.8304 2.41973 14.7015 2.27127 14.5391 2.16749C14.3768 2.06371 14.188 2.00903 13.9953 2.01002H1.99531C1.80372 2.00905 1.61589 2.06314 1.45415 2.16585C1.29241 2.26856 1.16359 2.41556 1.083 2.58938C1.00241 2.7632 0.973453 2.95651 0.999568 3.14632C1.02568 3.33612 1.10577 3.51443 1.23031 3.66002L5.99031 9.19502V13.51C5.99055 13.6005 6.01533 13.6892 6.06199 13.7667C6.10866 13.8441 6.17547 13.9075 6.25531 13.95C6.32753 13.989 6.40824 14.0096 6.49031 14.01C6.59003 14.0102 6.68754 13.9806 6.77031 13.925L9.77031 11.925C9.83817 11.8792 9.89372 11.8173 9.93208 11.745C9.97044 11.6726 9.99044 11.5919 9.99031 11.51V9.18502L14.7503 3.65002C14.8739 3.50722 14.9545 3.33235 14.9828 3.14565C15.0111 2.95894 14.986 2.76804 14.9103 2.59502Z"></path>
            </svg>
            <div class="filter-trigger__text">Фильтры</div>
        </button>
        <!-- end .filter-trigger-->
    </div>
    <div class="catalog__filter-group">
        <!-- begin .filter-group-->
        <div class="filter-group">
            <div class="filter-group__wrapper">
                <div class="filter-group__item filter-group__label">
                    Сортировать:
                </div>
                <div class="filter-group__item">
                    <div class="filter-group__option-filter">
                        <!-- begin .option-filter-->
                        <div class="option-filter js-option-filter">
                            <div class="option-filter__header">
                                <button class="option-filter__trigger js-option-filter-trigger">
                                    <span class="option-filter__label">
                                        <? if (empty($arSortFields[$sortField])) : ?>
                                            По умолчанию
                                        <? else : ?>
                                            <?= $arSortFields[$sortField]["NAME"] ?> (<?= $arSortFields[$sortField]["ORDER"][$sortOrder] ?>)
                                        <? endif; ?>
                                    </span>
                                </button>
                            </div>
                            <div class="option-filter__body">
                                <ul class="option-filter__list">
                                    <? foreach ($arSortFields as $sortName => $sortData) : ?>
                                        <? if (!empty($sortData["ORDER"])) : ?>
                                            <? foreach ($sortData["ORDER"] as $order => $orderName) : ?>
                                                <?
                                                if (!empty($arSortFields[$sortField])) {
                                                    $activeSortItem = $sortName === $sortField && $order === $sortOrder;
                                                } else {
                                                    $activeSortItem = false;
                                                }
                                                ?>
                                                <li class="option-filter__item">
                                                    <a href="<?= $currentUrl->addParams(["sort" => $sortName, "method" => $order])->getUri() ?>" class="option-filter__link js-option-filter-item<?= ($activeSortItem ? ' option-filter__link_state_active' : '') ?>">
                                                        <? if ($order === 'asc') : ?>
                                                            <svg class="option-filter__icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M8.66667 4C8.85556 4 9.01378 4.064 9.14133 4.192C9.26933 4.31955 9.33333 4.47778 9.33333 4.66667C9.33333 4.85556 9.26933 5.01378 9.14133 5.14133C9.01378 5.26933 8.85556 5.33333 8.66667 5.33333L7.33333 5.33333C7.14444 5.33333 6.986 5.26933 6.858 5.14133C6.73045 5.01378 6.66667 4.85555 6.66667 4.66667C6.66667 4.47778 6.73045 4.31955 6.858 4.192C6.986 4.064 7.14444 4 7.33333 4L8.66667 4ZM13.3333 10.6667C13.5222 10.6667 13.6804 10.7304 13.808 10.858C13.936 10.986 14 11.1444 14 11.3333C14 11.5222 13.936 11.6807 13.808 11.8087C13.6804 11.9362 13.5222 12 13.3333 12L2.66667 12C2.47778 12 2.31956 11.9362 2.192 11.8087C2.064 11.6807 2 11.5222 2 11.3333C2 11.1444 2.064 10.986 2.192 10.858C2.31956 10.7304 2.47778 10.6667 2.66667 10.6667L13.3333 10.6667ZM11.3333 7.33333C11.5222 7.33333 11.6807 7.39733 11.8087 7.52533C11.9362 7.65289 12 7.81111 12 8C12 8.18889 11.9362 8.34733 11.8087 8.47533C11.6807 8.60289 11.5222 8.66667 11.3333 8.66667L4.66667 8.66667C4.47778 8.66667 4.31956 8.60289 4.192 8.47533C4.064 8.34733 4 8.18889 4 8C4 7.81111 4.064 7.65289 4.192 7.52533C4.31956 7.39733 4.47778 7.33333 4.66667 7.33333L11.3333 7.33333Z" />
                                                            </svg>
                                                        <? elseif ($order === 'desc') : ?>
                                                            <svg class="option-filter__icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M8.66667 12C8.85555 12 9.01378 11.936 9.14133 11.808C9.26933 11.6804 9.33333 11.5222 9.33333 11.3333C9.33333 11.1444 9.26933 10.9862 9.14133 10.8587C9.01378 10.7307 8.85555 10.6667 8.66667 10.6667L7.33333 10.6667C7.14444 10.6667 6.986 10.7307 6.858 10.8587C6.73044 10.9862 6.66667 11.1444 6.66667 11.3333C6.66667 11.5222 6.73044 11.6804 6.858 11.808C6.986 11.936 7.14444 12 7.33333 12L8.66667 12ZM13.3333 5.33333C13.5222 5.33333 13.6804 5.26956 13.808 5.142C13.936 5.014 14 4.85556 14 4.66667C14 4.47778 13.936 4.31933 13.808 4.19133C13.6804 4.06378 13.5222 4 13.3333 4L2.66667 4C2.47778 4 2.31956 4.06378 2.192 4.19133C2.064 4.31933 2 4.47778 2 4.66667C2 4.85555 2.064 5.014 2.192 5.142C2.31956 5.26955 2.47778 5.33333 2.66667 5.33333L13.3333 5.33333ZM11.3333 8.66667C11.5222 8.66667 11.6807 8.60267 11.8087 8.47467C11.9362 8.34711 12 8.18889 12 8C12 7.81111 11.9362 7.65267 11.8087 7.52467C11.6807 7.39711 11.5222 7.33333 11.3333 7.33333L4.66667 7.33333C4.47778 7.33333 4.31955 7.39711 4.192 7.52467C4.064 7.65267 4 7.81111 4 8C4 8.18889 4.064 8.34711 4.192 8.47467C4.31955 8.60267 4.47778 8.66667 4.66667 8.66667L11.3333 8.66667Z" />
                                                            </svg>
                                                        <? endif; ?>
                                                        <span class="option-filter__text">
                                                            <?= $sortData["NAME"] ?> (<?= $orderName ?>)
                                                        </span>
                                                    </a>
                                                </li>
                                            <? endforeach; ?>
                                        <? endif; ?>
                                    <? endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <!-- end .option-filter-->
                    </div>
                </div>
            </div>
        </div>
        <!-- end .filter-group-->
    </div>
    <div class="catalog__layout-group">
        <!-- begin .layout-group-->
        <div class="layout-group js-layout-group">
            <ul class="layout-group__list">
                <li class="layout-group__item">
                    <button class="layout-group__trigger <?= (CATALOG_LAYOUT === 'GRID' ? 'layout-group__trigger_state_active' : '') ?> js-catalog-layout-trigger" aria-label="Вид сетки">
                        <svg class="layout-group__icon" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.36328 19.0908H14.5072V9.09082H6.36328V19.0908ZM6.36328 30.7575H14.5072V20.7575H6.36328V30.7575ZM16.136 30.7575H24.2799V20.7575H16.136V30.7575ZM25.9087 30.7575H34.0527V20.7575H25.9087V30.7575ZM16.136 19.0908H24.2799V9.09082H16.136V19.0908ZM25.9087 9.09082V19.0908H34.0527V9.09082H25.9087Z"></path>
                        </svg>
                    </button>
                </li>
                <li class="layout-group__item">
                    <button class="layout-group__trigger <?= (CATALOG_LAYOUT === 'LIST' ? 'layout-group__trigger_state_active' : '') ?> js-catalog-layout-trigger" aria-label="Вид списка">
                        <svg class="layout-group__icon" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.5459 21.5908H7.87923V18.3333H4.5459V21.5908ZM4.5459 28.106H7.87923V24.8484H4.5459V28.106ZM4.5459 15.0757H7.87923V11.8181H4.5459V15.0757ZM11.2126 21.5908H34.5459V18.3333H11.2126V21.5908ZM11.2126 28.106H34.5459V24.8484H11.2126V28.106ZM11.2126 11.8181V15.0757H34.5459V11.8181H11.2126Z"></path>
                        </svg>
                    </button>
                </li>
            </ul>
        </div>
        <!-- end .layout-group-->
    </div>

    <div class="catalog__cart-panel <?= (CATALOG_LAYOUT === 'LIST' ? 'catalog__cart-panel_state_shown' : '') ?>" id="cartPanel">
        <div class="catalog__check">
            <!-- begin .check-elem-->
            <label class="check-elem check-elem_text-size_l">
                <input class="check-elem__input" type="checkbox" id="addAllToShopingList">
                <span class="check-elem__label">Выбрать все</span>
            </label>
            <!-- end .check-elem-->
        </div>
        <div class="catalog__control">
            <!-- begin .button-->
            <button disabled class="button button_width_full button_size_l button_text-size_l" id="addShoppingListToCart">
                <span class="button__holder">
                    В корзину (<span class="js-catalog-cart-product-amount" id="numberOfListProducts">0</span>)
                </span>
            </button>
            <!-- end .button-->
        </div>
    </div>
</div>