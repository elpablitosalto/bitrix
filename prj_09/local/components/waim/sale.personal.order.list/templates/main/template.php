<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main,
	Bitrix\Main\Localization\Loc,
	Bitrix\Main\Page\Asset;

\Bitrix\Main\UI\Extension::load([
	'ui.design-tokens',
	'ui.fonts.opensans',
	'clipboard',
	'fx',
]);
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
Loc::loadMessages(__FILE__);

if (!empty($arResult['ERRORS']['FATAL']))
{
	foreach($arResult['ERRORS']['FATAL'] as $error)
	{
		ShowError($error);
	}
	$component = $this->__component;
	if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED]))
	{
		$APPLICATION->AuthForm('', false, false, 'N', false);
	}

}
else
{
	if (!empty($arResult['ERRORS']['NONFATAL']))
	{
		foreach($arResult['ERRORS']['NONFATAL'] as $error)
		{
			ShowError($error);
		}
	}
	?>
    <div class="profile__order-group js-order-group">
        <div class="order-group__search">
            <!-- begin .search-form-->
            <form class="search-form js-order-search">
                <div class="search-form__field">
                    <input type="text" class="search-form__input js-order-group-search" name="" placeholder="Поиск заказов по коду" value="<?=$request->get("order_search")?>">
                    <div class="search-form__control">
                        <button type="submit" class="search-form__submit js-order-search-submit">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="search-form__icon">
                                    <path d="M18.031 16.617L22.314 20.899L20.899 22.314L16.617 18.031C15.0237 19.3082 13.042 20.0029 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20.0029 13.042 19.3082 15.0237 18.031 16.617ZM16.025 15.875C17.2941 14.5699 18.0029 12.8204 18 11C18 7.132 14.867 4 11 4C7.132 4 4 7.132 4 11C4 14.867 7.132 18 11 18C12.8204 18.0029 14.5699 17.2941 15.875 16.025L16.025 15.875Z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
            <!-- end .search-form-->
        </div>
        <?if (count($arResult['ORDERS'])):?>
            <!-- begin .order-group-->
            <div class="order-group">
                <div class="order-group__header">
                        <div class="order-group__label order-group__number">
                                № заказа
                        </div>
                        <div class="order-group__label order-group__status">
                                Статус
                        </div>
                        <div class="order-group__label order-group__date">Дата</div>
                        <div class="order-group__label order-group__price">
                                Сумма
                        </div>
                </div>
                <ul class="order-group__list">
                    <?foreach($arResult['ORDERS'] as $order):?>
                        <li class="order-group__item js-order-group-item" data-order-id="<?=$order['ORDER']['ACCOUNT_NUMBER']?>">
                            <!-- begin .order-panel-->
                            <div class="order-panel">
                                <div class="order-group__message">Результатов не найдено</div>
                                <div class="order-panel__header">
                                        <div class="order-panel__prop order-panel__number">
                                            <div class="order-panel__value">
                                                    Заказ №<?=$order['ORDER']['ACCOUNT_NUMBER']?>
                                            </div>
                                        </div>
                                        <div class="order-panel__prop order-panel__status">
                                            <div class="order-panel__label">
                                                    Статус:
                                            </div>
                                            <div class="order-panel__value">
                                                    <?=$order['ORDER']['STATUS_NAME']?>
                                            </div>
                                        </div>
                                        <div class="order-panel__prop order-panel__date">
                                            <div class="order-panel__label">Дата:</div>
                                            <div class="order-panel__value"><?=$order['ORDER']['DATE_INSERT_FORMATED']?></div>
                                        </div>
                                        <div class="order-panel__prop order-panel__price">
                                            <div class="order-panel__label">Сумма:</div>
                                            <div class="order-panel__value"><?=$order['ORDER']['FORMATED_PRICE']?></div>
                                        </div>
                                        <button type="button" data-toggle-scope=".order-panel" data-toggle-class="order-panel_state_open" class="order-panel__trigger js-toggle">
                                                Открыть / закрыть
                                        </button>
                                </div>
                                <div class="order-panel__body">
                                    <div class="order-panel__content">
                                        <div class="order-panel__products">
                                            <div class="order-panel__product-group">
                                                <!-- begin .order-products-->
                                                <div class="order-products">
                                                    <div class="order-products__header">
                                                        <div class="order-products__label order-products__name">
                                                            Товары в заказе:
                                                        </div>
                                                        <div class="order-products__label order-products__quantity">
                                                            Количество:
                                                        </div>
                                                        <div class="order-products__label order-products__price">
                                                            Сумма:
                                                        </div>
                                                    </div>
                                                    <div class="order-products__content">
                                                        <ul class="order-products__list">
                                                            <?foreach ($order['BASKET_ITEMS'] as $basketItem):?>
                                                                <li class="order-products__item">
                                                                    <div class="order-products__product">
                                                                        <div class="order-products__heading">
                                                                            <div class="order-products__title">
                                                                                <a href="<?=htmlspecialcharsbx($basketItem['DETAIL_PAGE_URL'])?>" class="order-products__link">
                                                                                    <?=$basketItem['NAME']?>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="order-products__fields">
                                                                            <div class="order-products__field">
                                                                                <div class="order-products__label">Количество:</div>
                                                                                <div class="order-products__value">
                                                                                    <?=$basketItem['QUANTITY']?>&nbsp;<?=htmlspecialcharsbx($basketItem['MEASURE_NAME'])?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="order-products__field">
                                                                                <div class="order-products__label">Сумма:</div>
                                                                                <div class="order-products__value"><?=CCurrencyLang::CurrencyFormat($basketItem['PRICE'] * $basketItem['QUANTITY'], $basketItem['CURRENCY'], true)?></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            <?endforeach?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- end .order-products-->
                                            </div>
                                        </div>
                                        <div class="order-panel__props">
                                            <!-- begin .props-->
                                            <div class="props props_size_l">
                                                <div class="props__prop props__prop_type_notable">
                                                    <div class="props__label">
                                                        Профиль заказа:
                                                    </div>
                                                    <div class="props__value"><?=$order['ORDER']['PROPS']["profileName"]?></div>
                                                </div>
                                            </div>
                                            <!-- end .props-->
                                        </div>
                                        <div class="order-panel__fields">
                                            <div class="order-panel__field">
                                                <div class="order-panel__subtitle">
                                                    Адрес доставки:
                                                </div>
                                                <?
                                                if($order["ORDER"]["DELIVERY_ID"] == 2){ // Самовывоз
                                                    $address = $order['ORDER']['PROPS']["delivery"]["pvzName"];
                                                }else {
                                                    $address = implode(", ", [
                                                        !empty($order['ORDER']['PROPS']["address"]["city"]) ? "г. " . $order['ORDER']['PROPS']["address"]["city"] : "",
                                                        !empty($order['ORDER']['PROPS']["address"]["street"]) ? "ул. " . $order['ORDER']['PROPS']["address"]["street"] : "",
                                                        !empty($order['ORDER']['PROPS']["address"]["houseNumber"]) ? "д. " . $order['ORDER']['PROPS']["address"]["houseNumber"] : "",
                                                        !empty($order['ORDER']['PROPS']["address"]["building"]) ? "к. " . $order['ORDER']['PROPS']["address"]["building"] : "",
                                                    ]);
                                                }
                                                ?>
                                                <div class="order-panel__text"><?=$address?></div>
                                            </div>
                                            <div class="order-panel__field">
                                                <div class="order-panel__subtitle">
                                                    Контактное лицо:
                                                </div>
                                                <div class="order-panel__text"><?=$order['ORDER']['PROPS']["customer"]["fullName"]?></div>
                                            </div>
                                        </div>
                                        <?if(
                                            !empty($order['ORDER']['PROPS']["files"]["contract"]) ||
                                            !empty($order['ORDER']['PROPS']["files"]["payCheck"]) ||
                                            !empty($order['ORDER']['PROPS']["files"]["garantyCheck"])
                                        ):?>
                                            <div class="order-panel__docs">
                                                <div class="order-panel__title">
                                                    Документы
                                                </div>
                                                <div class="order-panel__doc-list">
                                                    <!-- begin .doc-list-->
                                                    <div class="doc-list doc-list_type_order-panel">
                                                        <ul class="doc-list__list">
                                                            <?if(!empty($order['ORDER']['PROPS']["files"]["payCheck"])):?>
                                                                <li class="doc-list__item">
                                                                    <div class="doc-list__document">
                                                                        <div class="doc-list__main">
                                                                            <!-- begin .link-item-->
                                                                            <div class="link-item link-item_text-size_l link-item_icon-size_m link-item_effects_static">
                                                                                <div class="link-item__icon-wrapper">
                                                                                    <svg class="link-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                        <path d="M6.8891 12.2333C6.73577 12.2333 6.63243 12.2483 6.5791 12.2633V13.245C6.64243 13.26 6.7216 13.2642 6.83077 13.2642C7.22993 13.2642 7.47577 13.0625 7.47577 12.7217C7.47577 12.4167 7.2641 12.2333 6.8891 12.2333ZM9.79493 12.2433C9.62827 12.2433 9.51993 12.2583 9.45577 12.2733V14.4483C9.51993 14.4633 9.62327 14.4633 9.7166 14.4633C10.3974 14.4683 10.8408 14.0933 10.8408 13.3C10.8458 12.6083 10.4416 12.2433 9.79493 12.2433Z" fill="#939393"></path>
                                                                                        <path d="M11.6663 1.66666H4.99967C4.55765 1.66666 4.13372 1.84225 3.82116 2.15481C3.5086 2.46737 3.33301 2.8913 3.33301 3.33332V16.6667C3.33301 17.1087 3.5086 17.5326 3.82116 17.8452C4.13372 18.1577 4.55765 18.3333 4.99967 18.3333H14.9997C15.4417 18.3333 15.8656 18.1577 16.1782 17.8452C16.4907 17.5326 16.6663 17.1087 16.6663 16.6667V6.66666L11.6663 1.66666ZM7.91467 13.4917C7.65717 13.7333 7.27717 13.8417 6.83467 13.8417C6.74887 13.8426 6.66311 13.8376 6.57801 13.8267V15.015H5.83301V11.735C6.16922 11.6848 6.50894 11.662 6.84884 11.6667C7.31301 11.6667 7.64301 11.755 7.86551 11.9325C8.07717 12.1008 8.22051 12.3767 8.22051 12.7017C8.21967 13.0283 8.11134 13.3042 7.91467 13.4917ZM11.0872 14.6208C10.7372 14.9117 10.2047 15.05 9.55384 15.05C9.16384 15.05 8.88801 15.025 8.70051 15V11.7358C9.03684 11.6867 9.37646 11.6636 9.71634 11.6667C10.3472 11.6667 10.7572 11.78 11.0772 12.0217C11.423 12.2783 11.6397 12.6875 11.6397 13.275C11.6397 13.9108 11.4072 14.35 11.0872 14.6208ZM14.1663 12.3083H12.8897V13.0675H14.083V13.6792H12.8897V15.0158H12.1347V11.6917H14.1663V12.3083ZM11.6663 7.49999H10.833V3.33332L14.9997 7.49999H11.6663Z" fill="#939393"></path>
                                                                                    </svg>
                                                                                </div>
                                                                                <div class="link-item__label">
                                                                                    Чек к
                                                                                    заказу
                                                                                </div>
                                                                            </div>
                                                                            <!-- end .link-item-->
                                                                        </div>
                                                                        <div class="doc-list__link">
                                                                            <!-- begin .link-item-->
                                                                            <a class="link-item link-item_icon-size_m link-item_style_primary" href="<?=$order['ORDER']['PROPS']["files"]["payCheck"]["SRC"]?>" download="true">
                                                                            <span class="link-item__icon-wrapper">
                                                                                <svg class="link-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                    <path d="M9.99967 13.3333L5.83301 9.16668L6.99967 7.95834L9.16634 10.125V3.33334H10.833V10.125L12.9997 7.95834L14.1663 9.16668L9.99967 13.3333ZM3.33301 16.6667V12.5H4.99967V15H14.9997V12.5H16.6663V16.6667H3.33301Z"></path>
                                                                                </svg>
                                                                            </span>
                                                                            <span class="link-item__label">
                                                                                Скачать
                                                                            </span>
                                                                            </a>
                                                                            <!-- end .link-item-->
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            <?endif;?>
                                                            <?if(!empty($order['ORDER']['PROPS']["files"]["contract"])):?>
                                                                <li class="doc-list__item">
                                                                    <div class="doc-list__document">
                                                                        <div class="doc-list__main">
                                                                            <!-- begin .link-item-->
                                                                            <div class="link-item link-item_text-size_l link-item_icon-size_m link-item_effects_static">
                                                                                <div class="link-item__icon-wrapper">
                                                                                    <svg class="link-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                        <path d="M6.8891 12.2333C6.73577 12.2333 6.63243 12.2483 6.5791 12.2633V13.245C6.64243 13.26 6.7216 13.2642 6.83077 13.2642C7.22993 13.2642 7.47577 13.0625 7.47577 12.7217C7.47577 12.4167 7.2641 12.2333 6.8891 12.2333ZM9.79493 12.2433C9.62827 12.2433 9.51993 12.2583 9.45577 12.2733V14.4483C9.51993 14.4633 9.62327 14.4633 9.7166 14.4633C10.3974 14.4683 10.8408 14.0933 10.8408 13.3C10.8458 12.6083 10.4416 12.2433 9.79493 12.2433Z" fill="#939393"></path>
                                                                                        <path d="M11.6663 1.66666H4.99967C4.55765 1.66666 4.13372 1.84225 3.82116 2.15481C3.5086 2.46737 3.33301 2.8913 3.33301 3.33332V16.6667C3.33301 17.1087 3.5086 17.5326 3.82116 17.8452C4.13372 18.1577 4.55765 18.3333 4.99967 18.3333H14.9997C15.4417 18.3333 15.8656 18.1577 16.1782 17.8452C16.4907 17.5326 16.6663 17.1087 16.6663 16.6667V6.66666L11.6663 1.66666ZM7.91467 13.4917C7.65717 13.7333 7.27717 13.8417 6.83467 13.8417C6.74887 13.8426 6.66311 13.8376 6.57801 13.8267V15.015H5.83301V11.735C6.16922 11.6848 6.50894 11.662 6.84884 11.6667C7.31301 11.6667 7.64301 11.755 7.86551 11.9325C8.07717 12.1008 8.22051 12.3767 8.22051 12.7017C8.21967 13.0283 8.11134 13.3042 7.91467 13.4917ZM11.0872 14.6208C10.7372 14.9117 10.2047 15.05 9.55384 15.05C9.16384 15.05 8.88801 15.025 8.70051 15V11.7358C9.03684 11.6867 9.37646 11.6636 9.71634 11.6667C10.3472 11.6667 10.7572 11.78 11.0772 12.0217C11.423 12.2783 11.6397 12.6875 11.6397 13.275C11.6397 13.9108 11.4072 14.35 11.0872 14.6208ZM14.1663 12.3083H12.8897V13.0675H14.083V13.6792H12.8897V15.0158H12.1347V11.6917H14.1663V12.3083ZM11.6663 7.49999H10.833V3.33332L14.9997 7.49999H11.6663Z" fill="#939393"></path>
                                                                                    </svg>
                                                                                </div>
                                                                                <div class="link-item__label">
                                                                                    Договор
                                                                                </div>
                                                                            </div>
                                                                            <!-- end .link-item-->
                                                                        </div>
                                                                        <div class="doc-list__link">
                                                                            <!-- begin .link-item-->
                                                                            <a class="link-item link-item_icon-size_m link-item_style_primary" href="<?=$order['ORDER']['PROPS']["files"]["contract"]["SRC"]?>" download="true">
                                                                            <span class="link-item__icon-wrapper">
                                                                                <svg class="link-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                    <path d="M9.99967 13.3333L5.83301 9.16668L6.99967 7.95834L9.16634 10.125V3.33334H10.833V10.125L12.9997 7.95834L14.1663 9.16668L9.99967 13.3333ZM3.33301 16.6667V12.5H4.99967V15H14.9997V12.5H16.6663V16.6667H3.33301Z"></path>
                                                                                </svg>
                                                                            </span>
                                                                            <span class="link-item__label">
                                                                                Скачать
                                                                            </span>
                                                                            </a>
                                                                            <!-- end .link-item-->
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            <?endif;?>
                                                            <?if(!empty($order['ORDER']['PROPS']["files"]["garantyCheck"])):?>
                                                                <?foreach ($order['ORDER']['PROPS']["files"]["garantyCheck"] as $index => $garantyCheck):?>
                                                                    <li class="doc-list__item">
                                                                        <div class="doc-list__document">
                                                                            <div class="doc-list__main">
                                                                                <!-- begin .link-item-->
                                                                                <div class="link-item link-item_text-size_l link-item_icon-size_m link-item_effects_static">
                                                                                    <div class="link-item__icon-wrapper">
                                                                                        <svg class="link-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                            <path d="M6.8891 12.2333C6.73577 12.2333 6.63243 12.2483 6.5791 12.2633V13.245C6.64243 13.26 6.7216 13.2642 6.83077 13.2642C7.22993 13.2642 7.47577 13.0625 7.47577 12.7217C7.47577 12.4167 7.2641 12.2333 6.8891 12.2333ZM9.79493 12.2433C9.62827 12.2433 9.51993 12.2583 9.45577 12.2733V14.4483C9.51993 14.4633 9.62327 14.4633 9.7166 14.4633C10.3974 14.4683 10.8408 14.0933 10.8408 13.3C10.8458 12.6083 10.4416 12.2433 9.79493 12.2433Z" fill="#939393"></path>
                                                                                            <path d="M11.6663 1.66666H4.99967C4.55765 1.66666 4.13372 1.84225 3.82116 2.15481C3.5086 2.46737 3.33301 2.8913 3.33301 3.33332V16.6667C3.33301 17.1087 3.5086 17.5326 3.82116 17.8452C4.13372 18.1577 4.55765 18.3333 4.99967 18.3333H14.9997C15.4417 18.3333 15.8656 18.1577 16.1782 17.8452C16.4907 17.5326 16.6663 17.1087 16.6663 16.6667V6.66666L11.6663 1.66666ZM7.91467 13.4917C7.65717 13.7333 7.27717 13.8417 6.83467 13.8417C6.74887 13.8426 6.66311 13.8376 6.57801 13.8267V15.015H5.83301V11.735C6.16922 11.6848 6.50894 11.662 6.84884 11.6667C7.31301 11.6667 7.64301 11.755 7.86551 11.9325C8.07717 12.1008 8.22051 12.3767 8.22051 12.7017C8.21967 13.0283 8.11134 13.3042 7.91467 13.4917ZM11.0872 14.6208C10.7372 14.9117 10.2047 15.05 9.55384 15.05C9.16384 15.05 8.88801 15.025 8.70051 15V11.7358C9.03684 11.6867 9.37646 11.6636 9.71634 11.6667C10.3472 11.6667 10.7572 11.78 11.0772 12.0217C11.423 12.2783 11.6397 12.6875 11.6397 13.275C11.6397 13.9108 11.4072 14.35 11.0872 14.6208ZM14.1663 12.3083H12.8897V13.0675H14.083V13.6792H12.8897V15.0158H12.1347V11.6917H14.1663V12.3083ZM11.6663 7.49999H10.833V3.33332L14.9997 7.49999H11.6663Z" fill="#939393"></path>
                                                                                        </svg>
                                                                                    </div>
                                                                                    <div class="link-item__label">
                                                                                        Гарантийный
                                                                                        талон №<?=$index?>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- end .link-item-->
                                                                            </div>
                                                                            <div class="doc-list__link">
                                                                                <!-- begin .link-item-->
                                                                                <a class="link-item link-item_icon-size_m link-item_style_primary" href="<?=$garantyCheck["SRC"]?>" download="true">
                                                                                <span class="link-item__icon-wrapper">
                                                                                    <svg class="link-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                        <path d="M9.99967 13.3333L5.83301 9.16668L6.99967 7.95834L9.16634 10.125V3.33334H10.833V10.125L12.9997 7.95834L14.1663 9.16668L9.99967 13.3333ZM3.33301 16.6667V12.5H4.99967V15H14.9997V12.5H16.6663V16.6667H3.33301Z"></path>
                                                                                    </svg>
                                                                                </span>
                                                                                <span class="link-item__label">
                                                                                    Скачать
                                                                                </span>
                                                                                </a>
                                                                                <!-- end .link-item-->
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                <?endforeach;?>
                                                            <?endif;?>
                                                        </ul>
                                                    </div>
                                                    <!-- end .doc-list-->
                                                </div>
                                            </div>
                                        <?endif;?>
                                        <div class="order-panel__controls">
                                            <div class="order-panel__control">
                                                <!-- begin .button-->
                                                <a class="button button_width_full button_size_s" href="<?=$order["ORDER"]["URL_TO_COPY"]?>">
                                                    <span class="button__holder">
                                                    Повторить заказ
                                                    </span>
                                                </a>
                                                <!-- end .button-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end .order-panel-->
                        </li>
                    <?endforeach?>
                </ul>
                <div class="promo-grid__pagination" style="margin-top: 25px">
                    <?echo $arResult["NAV_STRING"];?>
                </div>
            </div>
            <!-- end .order-group-->
        <?else:?>
            <p>Заказов еще нет</p>
        <?endif?>
    </div>
    <?
    $javascriptParams = array(
        "url" => CUtil::JSEscape($this->__component->GetPath().'/ajax.php'),
        "templateFolder" => CUtil::JSEscape($templateFolder),
        "templateName" => $this->__component->GetTemplateName(),
        "returnUrl" => CUtil::JSEscape($arResult["RETURN_URL"]),
    );
    $javascriptParams = CUtil::PhpToJSObject(array_merge($javascriptParams, $arParams));
    ?>
    <script>
        BX.Sale.PersonalOrderComponent.PersonalOrderList.init(<?=$javascriptParams?>);
        BX.addCustomEvent('onAjaxSuccess', function(){
            BX.Sale.PersonalOrderComponent.PersonalOrderList.init(<?=$javascriptParams?>);
        });
    </script>
    <?
}
?>